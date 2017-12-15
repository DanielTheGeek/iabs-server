<?php

	/**
	* IABS Installer
    * Installs IABS on the server
    *
    * @since    1.0.0
    * @author   Daniel Omoniyi
	*/
	class Setup extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

            // Disable ajax requests
			if ($this->input->is_ajax_request()) {
				show_404();
			}
		}
        
		public function index() {
            $data = [
                'action'    =>  '',
                'content'   =>  '',
                'title'     =>  '',
                'button'    =>  '',
                'button_val'=>  ''
            ];

            if (! file_exists(APPPATH.'config/iabs-config.php')) {
                if (isset($_SESSION['iabs_user'])) {
                    $this->session->sess_destroy();
                }
                
                if ($this->input->post('step_1')) {
                    $data = [
                        'content'	=>	'
                            <div>
                                <p style="text-align: center; margin-bottom: 20px;">Please contact your hosting provider if you don\'t know the correct values to enter below.</p>
                            </div>
                            <div class="form-row">
                                <label>
                                    <span>Database Type</span>
                                    <select style="width: 100%;" name="db_driver">
                                        <option value="mysqli" selected="">MySql</option>
                                        <option value="postgre">PostgreSql</option>
                                    </select>
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Database Host</span>
                                    <input type="text" name="db_host">
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Database Name</span>
                                    <input type="text" name="db_name">
                                    <p class="hint">Database name to use for IABS.</p>
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Username</span>
                                    <input type="text" name="db_user">
                                    <p class="hint">If your database user is "root" please change it as it is a security threat.</p>
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Password</span>
                                    <input type="password" name="db_pass">
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Database Port</span>
                                    <input type="text" value="3306" name="db_port">
                                    <p class="hint">Please check with your host. An invalid port would hinder installation.</p>
                                </label>
                            </div>

                            <div class="form-row">
                                <label>
                                    <span>Table Prefix</span>
                                    <input type="text" name="db_table_prefix" value="iabs_">
                                    <p class="hint">Change this value if you want to run multiple IABS installations in a single database.</p>
                                </label>
                            </div>

                            ',
                        'title'	=>	'Database Information',
                        'button_val'	=>	'Next',
                        'button_name'	=>	'do_step_1',
                        'action'		=>	form_open('ignite', [ 'class' => 'form-basic'] )
                    ];
                } elseif ($this->input->post('step_2')) {
                    $this->_ignite();
                } elseif ($this->input->post('do_step_1')) {
                    // Validate data
                    $rules = [
                        [
                            'field' => 'db_driver',
                            'label' => 'database driver',
                            'rules' => 'trim|required'
                        ],
                        [
                            'field' => 'db_host',
                            'label' => 'database host',
                            'rules' => 'trim|required'
                        ],
                        [
                            'field' => 'db_name',
                            'label' => 'database name',
                            'rules' => 'trim|required'
                        ],
                        [
                            'field' => 'db_user',
                            'label' => 'database user',
                            'rules' => 'trim|required'
                        ],
                        [
                            'field' => 'db_pass',
                            'label' => 'database password',
                            'rules' => 'trim'
                        ],
                        [
                            'field' => 'db_port',
                            'label' => 'database port',
                            'rules' => 'trim|required|numeric'
                        ],
                        [
                            'field' => 'db_table_prefix',
                            'label' => 'table prefix',
                            'rules' => 'trim'
                        ]
                    ];

                    // Set validation rules
                    $this->form_validation->set_rules($rules);

                    if (!$this->form_validation->run()) {
                        $data =	[
                            'title'		=> 'Oops!',
                            'content'	=>	'<div>
                                <p>All fields (except the <strong>password and table prefix fields</strong>) are required to continue,<br> please enter the correct values and try again.</p>
                            </div>',
                            'button_name'	=>	'step_1',
                            'button_val'	=>	'Try again',
                            'action'		=>	form_open('ignite', [ 'class' => 'form-basic'] )
                        ];
                    } else {
                        $db_arr = [
                            'dbdriver'  =>  $this->input->post( 'db_driver' ),
                            'hostname' 	=> 	$this->input->post( 'db_host' ),
                            'database' 	=> 	$this->input->post( 'db_name' ),
                            'username' 	=> 	$this->input->post( 'db_user' ),
                            'password'	=>	$this->input->post( 'db_pass' ),
                            'port'      =>  $this->input->post( 'db_port' ),
                            'dbprefix'  =>  $this->input->post( 'db_table_prefix' )
                        ];

                        ( $db_arr['dbdriver'] == 'mysqli' ) ? mysqli_report( MYSQLI_REPORT_STRICT ) : '';

                        try {
                            $connection = ( $db_arr['dbdriver'] == 'mysqli' ) ? new mysqli( $db_arr['hostname'], $db_arr['username'], $db_arr['password'], $db_arr['database'], $db_arr['port'] ) :
                             pg_connect( "host=$db_arr[hostname] port=$db_arr[port] dbname=$db_arr[database] user=$db_arr[username] password=$db_arr[password]" );    

                            if ( $connection ) {
                                // Add database parameters to config file
                                $this->load->helper( 'file' );
                                $config_data = file_get_contents( APPPATH.'views/installer/.iabs_install_data' );
                                $parse_data = $this->parser->parse_string( $config_data, $db_arr, TRUE );
                                
                                //Write configuration
                                $write_data = ( file_exists(APPPATH.'views/installer/.iabs_install_data') ) ?  $parse_data :  '';
                                
                                if ( write_file(APPPATH.'config/iabs-config.php', $write_data) )
                                {
                                    $data = [
                                        'title'     => 'Okay Human!',
                                        'content'   =>  '<div>
                                            <p style="text-align: left;">The first part of the installation has been completed, IABS can now communicate with your database. Proceed to the basic app setup by clicking next.</p>
                                        </div>',
                                        'button_name'   =>  'step_2',
                                        'button_val'    =>  'Next',
                                        'action'        =>  form_open('ignite', [ 'class' => 'form-basic'] )
                                    ];
                                } else {
                                    $data = [
                                        'title'     => 'System error e_UTWF',
                                        'content'   =>  '<div>
                                            <p style="text-align: left;">IABS couldn\'t create the needed configuration files:</p>
                                            <ul class="iabs-list">
                                                <li>Make sure you set the right permissions</li>
                                            </ul>
                                            <p style="text-align: left;">Still doesn\'t work? Contact your host or visit the <a class="link" href="https://scriptorigin.com/support">Script Origin Support Page</a></p>
                                        </div>',
                                        'button_name'   =>  'step_1',
                                        'button_val'    =>  'Try Again',
                                        'action'        =>  form_open('ignite', [ 'class' => 'form-basic'] )
                                    ];
                                }
                            } else {
                                $data = [
                                    'title'     => 'Database Connection Failed',
                                    'content'   =>  '<div>
                                        <p style="text-align: left;">The database information you provided is incorrect, please confirm that:</p>
                                        <ul class="iabs-list">
                                            <li>The database server is up</li>
                                            <li>You have typed the correct database name and password</li>
                                            <li>You have typed the correct hostname</li>
                                            <li>You have typed the correct port (default is usually 3306 for MySql)</li>
                                        </ul>
                                        <p style="text-align: left;">If you don\'t understand what you are doing you should contact your host or visit the <a class="link"  href="https://scriptorigin.com/forums">Script Origin Forums</a></p>
                                    </div>',
                                    'button_name'   =>  'step_1',
                                    'button_val'    =>  'Try Again',
                                    'action'        =>  form_open('ignite', [ 'class' => 'form-basic'] )
                                ];
                            }
                        } catch (Exception $e ) {
                            $data = [
                                'title'     => 'Database Connection Failed',
                                'content'   =>  '<div>
                                    <p style="text-align: left;">The database information you provided is incorrect, please confirm that:</p>
                                    <ul class="iabs-list">
                                        <li>The database server is up</li>
                                        <li>You have typed the correct database name and password</li>
                                        <li>You have typed the correct hostname</li>
                                        <li>You have typed the correct port (default is usually 3306 for MySql)</li>
                                    </ul>
                                    <p style="text-align: left;">If you don\'t understand what you are doing you should contact your host or visit the <a class="link"  href="https://scriptorigin.com/forums">Script Origin Forums</a></p>
                                </div>',
                                'button_name'   =>  'step_1',
                                'button_val'    =>  'Try Again',
                                'action'        =>  form_open('ignite', [ 'class' => 'form-basic'] )
                            ];
                        }
                    }
                } else {
                    $data = [
                        'title'		=>	'Installation Note',
                        'content'	=>	'<div><p style="text-align: left;">Welcome to IABS. Before proceeding with the installation, we need the following database information:</p>
                                <ol class="iabs-list">
                                    <li>Database host</li>
                                    <li>Database name</li>
                                    <li>Database username</li>
                                    <li>Database password</li>
                                    <li>Database port</li>
                                    <li>Table prefix (enables you to run multiple instances of IABS in a single database).</li>
                                </ol>
                                <p style="text-align: left;">If you don\'t have this information, please contact your hosting provider. Click "Start" when you\'re ready.</p>
                            </div>',
                        'button_name'	=>	'step_1',
                        'button_val'	=>	'Start',
                        'action'		=>	form_open( 'ignite', [ 'class' => 'form-basic'] )
                    ];
                }
                $this->parser->parse( 'installer/install', $data );
            } else {
                $this->_ignite();
            }
		}
        
        private function _ignite() {
            // Fetch database parameters from file
            $db_params = $this->_fetch_database_params();
            
            if ( ! $db_params ) {
                $data =	[
                    'title'		=> 'Database Connection Failed',
                    'content'	=>	'<div>
                        <p style="text-align: left;">The database information you provided in your <strong>iabs-config.php</strong> file is incorrect, please confirm that:</p>
                        <ul class="iabs-list">
                            <li>The database server is up</li>
                            <li>You provided the correct database information</li>
                            <li>If you see text displayed at the very top of this page then it means the <strong>iabs-config.php</strong> file is damaged and needs to be regenerated</li>
                        </ul>
                        <p style="text-align: left;">If you don\'t understand what you are doing you should contact your host or visit the <a class="link"  href="https://scriptorigin.com/forums">Script Origin Forums</a></p>
                    </div>',
                    'button_name'	=>	'restart',
                    'button_val'	=>	'Try again',
                    'action'		=>	form_open('ignite', [ 'class' => 'form-basic'] )
                ];
            }
            
            else if ( $this->input->post('do_step_2') ) {
                // Validate data
                $rules = [
                    [
                        'field' => 'site_title',
                        'label' => 'app title',
                        'rules' => 'trim|required'
                    ],
                    [
                        'field' => 'user_name',
                        'label' => 'username',
                        'rules' => 'trim|required|required|min_length[2]|alpha_dash'
                    ],
                    [
                        'field' => 'user_secret',
                        'label' => 'password',
                        'rules' => 'required'
                    ],
                    [
                        'field' => 'user_email',
                        'label' => 'email address',
                        'rules' => 'trim|required|valid_email'
                    ]
                ];

                $this->form_validation->set_rules( $rules );

                if ( ! $this->form_validation->run() ) {
                    $data =	[
                        'title'		=> 'Oops!',
                        'content'	=>	'<div>
                            <p>'.validation_errors().'</p>
                        </div>',
                        'button_name'	=>	'step_2',
                        'button_val'	=>	'Try Again',
                        'action'		=>	form_open('ignite', [ 'class' => 'form-basic'] )
                    ];
                } else {
                    $this->load->helper( 'string' );
                    
                    $uid = random_string( 'nozero', 15 );
                    $user = $this->db->escape_str( $this->input->post('user_name') );
                    $site_name = $this->db->escape_str( $this->input->post('site_title') );
                    $secret = $this->db->escape_str( $this->input->post('user_secret') );
                    $email = $this->db->escape_str( $this->input->post('user_email') );
                    
                    //Hash secret
                    $options = array(
                        'cost'  =>  '5'
                    );
                    $hashed_secret = password_hash( $secret, PASSWORD_BCRYPT, $options );
                    
                    $user_data = array(
                        'username'  =>  $user,
                        'uid'       =>  $uid,
                        'site_name' =>  $site_name,
                        'secret'    =>  $hashed_secret,
                        'email'     =>  $email
                    );

                    $text_data = ( file_exists(APPPATH.'config/iabs-config.php') ) ? file_get_contents( APPPATH.'config/iabs-config.php' ) : exit( 'An error occurred. eUTGC' );

                    // We're done installing
                    $set_installed = str_replace( '$config[\'iabs\'][\'installed\'] = FALSE;', '$config[\'iabs\'][\'installed\'] = TRUE;', $text_data );
                    $installed = file_put_contents( APPPATH.'config/iabs-config.php', $set_installed );
                    $commit = $this->_create_required_tables( $user_data );
                    
                    if ( $commit && $installed ) {
                        // Backup important system directories
                        $this->load->library('iabs_backup');
                        $options1 = array(
                            'zipped_name'   =>  'iabs_',
                            'path'          =>  APPPATH.'config'
                        );

                        $this->iabs_backup->save( 'folder', $options1 );

                        $options2 = array(
                            'zipped_name'   =>  'iabs_',
                            'path'          =>  APPPATH.'controllers'
                        );
                        $this->iabs_backup->save( 'folder', $options2 );

                        $options3 = array(
                            'zipped_name'   =>  'iabs_',
                            'path'          =>  APPPATH.'models'
                        );
                        $this->iabs_backup->save( 'folder', $options3 );

                        $options4 = array(
                            'zipped_name'   =>  'iabs_',
                            'path'          =>  APPPATH.'libraries'
                        );
                        $this->iabs_backup->save( 'folder', $options4 );

                        $backup_data = array(
                            'backup_date'   =>  date( 'Y-m-d' )
                        );

                        file_put_contents( APPPATH.'backup/_data/last_backup.json', json_encode($backup_data) );

                        $data =	array(
                            'title'		=> 'Installation Complete',
                            'content'	=>	'<div>
                                <p style="text-align: left;">Hooray '.$user.', you have successfully installed IABS. You can login to the dashboard anytime, we can\'t wait to see you on the inside ;-).</p>
                                <p style="text-align: left; border-top:1px solid #ccc; padding-top: 5px; margin-top:5px;">Account details:</br><strong>Username</strong> - '.$user.'</br><strong>Password</strong> - <i>Your chosen password</i></p>
                                <ol class="iabs-list">
                                    <li><a href="https://iabs.scriptorigin.com/documentation"> Documentation</a></li>
                                    <li><a href="https://scriptorigin.com/forums">Visit Script Origin Forums</a></li>
                                    <li><a href="https://scriptorigin.com/support">Get Support</a></li>
                                    <li><a href="https://iabs.scriptorigin.com">IABS Website</a></li>
                                </ol>
                                <p class="feedback">Please take a one minute <a class="link" href="https://iabs.scriptorigin.com/survey">Survey</a> on Script Origin to share your experience with us so we can improve.</p>
                            </div>',
                            'button_name'	=>	'login',
                            'button_val'	=>	'Login',
                            'action'		=>	form_open('login', [ 'class' => 'form-basic'] )
                        );
                    } else {
                        $data =	array(
                            'title'		=> 'Installation Failed',
                            'content'	=>	'<div>
                                <p style="text-align: left;">'.$user.', IABS couldn\'t be installed.</p>
                                <ol class="iabs-list">
                                    <li><a href="https://scriptorigin.com/support">Get Support</a></li>
                                </ol>
                            </div>',
                            'button_name'	=>	'start',
                            'button_val'	=>	'Try again',
                            'action'		=>	form_open('ignite', [ 'class' => 'form-basic'] )
                        );
                    }
                }     
            } else {
                $data = [
                    'content'	=>	'<link rel="stylesheet" href="src/css/vendor/fa/css/font-awesome.css">
                        <div>
                            <p style="text-align: center; margin-bottom: 20px;">The information provided below can be changed later.</p>
                        </div>
                        <div class="form-row"> 
                            <label> 
                                <span>App Name</span>
                                <input type="text" name="site_title"> 
                            </label> 
                        </div> 

                        <div class="form-row">
                            <label>
                                <span>Username</span>
                                <input onkeyup="restrict(\'user\')" id="user" type="text" name="user_name">
                                <p class="hint">Allowed: alpha-numeric characters, underscores and hyphens</p>
                            </label>
                        </div>

                        <div class="form-row">
                            <label>
                                <span onclick="toggleState(this)" id="view" class="slick-button"><i class="fa fa-eye"></i>&nbsp;Show</span><span class="fix"> Password</span>
                                <input id="secret" type="password" name="user_secret">
                                <p class="hint"><strong>Note:</strong> this will be required to log in. Store it in a secure location.</p>
                            </label>
                        </div>

                        <div class="form-row">
                            <label>
                                <span>Email Address</span>
                                <input type="text" onkeyup="restrict(\'email\')" id="email" name="user_email">
                                <p class="hint">Cross-check before proceeding.</p>
                            </label>
                        </div>
                        ',
                    'title'	=>	'App Setup',
                    'button_val'	=>	'Finish',
                    'button_name'	=>	'do_step_2',
                    'action'		=>	form_open('ignite', [ 'class' => 'form-basic'] )
                ];   
            }
            $this->parser->parse('installer/install', $data);
        }
        
        private function _fetch_database_params() {
            // Grab the array guy
            $this->load->helper( 'array' );

            $this->config->load( 'iabs-config', FALSE, TRUE );
            $iabs_config = $this->config->item( 'iabs' );

            // fetch database configuration
            $db_arr = ( is_array($iabs_config) ) ? element( 'database', $iabs_config ) : '';

            ( $db_arr['dbdriver'] == 'mysqli' ) ? mysqli_report( MYSQLI_REPORT_STRICT ) : '';

            try {
                $connection = ( ! empty($db_arr) && $db_arr['dbdriver'] == 'mysqli' ) ? new mysqli( $db_arr['hostname'], $db_arr['username'], $db_arr['password'], $db_arr['database'], $db_arr['port'] ) :
                             pg_connect( "host=$db_arr[hostname] port=$db_arr[port] dbname=$db_arr[database] user=$db_arr[username] password=$db_arr[password]" );
                if ( $connection ) {
                    return true;
                } else {
                    return false;
                }
            } catch (Exception $e ) {
                return false;
            }
        }
        
        private function _create_required_tables( $user_data ) {
            // Load base model and create tables if not existing
            $this->load->model( 'iabs_base_model', 'base' );
            
            $db_arr = $this->_fetch_database_params();
            $create_tables = $this->base->create_base_tables( $db_arr, $user_data );
            
            if ($create_tables) {
                return true;
            } else {
                $data =	[
                    'title'		=> 'System Error e_UTCT',
                    'content'	=>	'<div>
                        <p style="text-align: left;">A system error occurred and IABS cannot proceed, get the following:</p>
                        <ul class="iabs-list">
                            <li>A screenshot of this page</li>
                            <li>Your license key/purchase code</li>
                        </ul>
                        <p style="text-align: left;">Send a <a href="mailto:support@scriptorigin.com">mail</a> to the developers or open a support ticket at the <a class="link" href="https://scriptorigin.com/support">Script Origin Support Page</a></p>
                    </div>',
                    'button_name'	=>	'step_1',
                    'button_val'	=>	'Try Again',
                    'action'		=>	form_open('ignite', [ 'class' => 'form-basic'] )
                ];
            }
            
            return $data;
        }
	}

