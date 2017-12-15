<?php defined('BASEPATH') OR exit('Missed a step, right?');
	
	/**
	 *	IABS Authentication
	 *	This controller is responsible for all activities that require authentication
	 *
	 *	@author Daniel Omoniyi
	 *	@since 1.0.0
	*/

	class Auth extends CI_Controller {
		public function __construct() {
			// Constructor
			parent::__construct();

			// Load the required helper
			$this->load->helper('date');
		}

		public function register() {
			// Required model
			$this->load->model('Iabs_Fetcher', 'fetcher');

			$options = array(
				'row'	=>		'option_value',
				'table'	=>		'options',
				'where'	=>		'option_name',
				'value'	=>		'site_name',
				'limit'	=>		1
			);
			$fetch = $this->fetcher->fetch( 'where', $options );
	      
			$data = array(
				'content'		=>		'pages/signup',
				'page_title' 	=> 		'Signup',
				'site_name'		=>		$fetch->row()->option_value,
				'login'			=>		site_url('login'),
				'scripts'		=>		array(
					array('script'	=>	site_url('src/js/vendor/jquery/jquery.min.js')),
					array('script'	=>	site_url('src/js/modules/auth.js'))
				)
			);

			$this->parser->parse('pages/signup', $data);
		}

		public function do_register() {
			if ( $this->input->is_ajax_request() ) {
				$rules = array(
					array(
						'field' => 'username',
	            		'label' => 'username',
	            		'rules' => 'required|is_unique[users.user_name]|min_length[3]|max_length[17]|alpha_dash'
					),
	            	array(
		         		'field' => 'email',
		            	'label' => 'email address',
		            	'rules' => 'required|is_unique[users.user_email]|valid_email'
	            	),
	            	array(
		         		'field' => 'pass',
		            	'label' => 'password',
		            	'rules' => 'required'
	            	)
				);

				$this->form_validation->set_rules( $rules );
				$this->form_validation->set_message('is_unique', 'The {field} is already in use by another user.');

				if ( $this->form_validation->run() ) {
					$data = [];
					$data['username'] = $this->db->escape_str( $this->input->post('username') );
					$data['email'] = $this->db->escape_str( $this->input->post('email') );
					$data['password'] = $this->db->escape_str( $this->input->post('password') );

					// Load the database utility model
					$this->load->model( 'Database_Utils', 'db_utils' );

					$options = array(
						//Todo
					);

					$resp_1 = $this->db_utils->create( 'users', $options );
					$resp_2 = $this->db_utils->create( 'users_meta', $options );

					if ( $do ) {
						echo "true";
						exit();
					} 
					
				} else {
					echo validation_errors('<span class="noti danger">', '</span>');
				}
			} else {
				show_404();
			}
		}
		
		public function login() {
			// Required model
			$this->load->model('Iabs_Fetcher', 'fetcher');

			if ( isset($_POST['login']) && $this->input->is_ajax_request() ) {
				$rules = array(
					array(
						'field' => 'login',
	            		'label' => 'username/email',
	            		'rules' => 'required'
					),
	            	array(
		         		'field' => 'pass',
		            	'label' => 'password',
		            	'rules' => 'required'
	            	)
				);

				$this->form_validation->set_rules( $rules );

				if ( $this->form_validation->run() ) {
					// Validate user credentials
					$this->load->helper( 'email' );
					$row = ( valid_email($this->input->post('login')) ) ? 'user_email' : 'user_name' ;
					$other_row = ( $row == 'user_email' ) ? 'user_name' : 'user_email';
					$user = $this->db->escape_str( $this->input->post('login') );
					$secret = $this->db->escape_str( $this->input->post('pass') );
					
					$options = array(
						'row'	=>		"$row, user_secret, uid, $other_row",
						'table'	=>		'users',
						'where'	=>		$row,
						'value'	=>		$user,
						'limit'	=>		1
					);

					// Fetch values from the db and compare
					$fetch = $this->fetcher->fetch( 'where', $options );

					// Data was fetched, user exists
					if ( $fetch ) {
						$real_secret = $fetch->row()->user_secret;

						if ( password_verify($secret, $real_secret) ) {
							$opt = array(
								'cost'  =>  '5'
							);
							
							if ( password_needs_rehash($real_secret, PASSWORD_BCRYPT, $opt) ) {
								$new_secret = password_hash( $real_secret, PASSWORD_BCRYPT, $opt );
								$this->db->set( 'user_secret', $new_secret );
								$this->db->where( $row, $user );
								$this->db->insert( 'users' );
							}

							$cookie_secret = md5( $real_secret );

							$this->load->library( 'session' );

							if ( $this->input->post('remember') ) {
								setcookie( "iabs_user", $fetch->row()->uid, strtotime( '+100 days' ), "/", "", "", TRUE );
								setcookie( "iabs_access", $cookie_secret, strtotime( '+100 days' ), "/", "", "", TRUE );
							}

							$sess_data = array(
						      	'iabs_user'  =>	$fetch->row()->uid,
						      	'iabs_uname' =>	$fetch->row()->user_name
							);

							$this->session->set_userdata( $sess_data );

							$this->load->model( 'Database_Utils', 'db_utils' );

							$options = array(
								'table'	=>	'users',
								'where'	=>	'uid',
								'value'	=>	$fetch->row()->uid,
								'data'	=>	array(
									'is_online'	=>	'1',
									'last_seen'	=> time()
								)
							);

							$do = $this->db_utils->update( 'where', $options );

							if ( $do ) {
								echo "true";
								exit();
							} 
						}
					} else {
						echo 'invalid';
						exit();
					}
				} else {
					echo 'false';
					exit();
				}
			} else {
				$options = array(
					'row'	=>		'option_value',
					'table'	=>		'options',
					'where'	=>		'option_name',
					'value'	=>		'site_name',
					'limit'	=>		1
				);
				$fetch = $this->fetcher->fetch('where', $options);
		      
				$data = array(
					'content'		=>		'pages/login',
					'page_title' 	=> 	'Login',
					'site_name'		=>		$fetch->row()->option_value,
					'forgot'			=>		site_url('password-recovery'),
					'register'		=>		site_url('signup'),
					'scripts'		=>		array(
						array('script'	=>	site_url('src/js/vendor/jquery/jquery.min.js')),
						array('script'	=>	site_url('src/js/modules/auth.js'))
					)
				);

				$this->parser->parse('pages/login', $data);
			}
		}
		
		public function logout() {
			//Required model
			$this->load->model('Database_Utils', 'db_utils');

			// Update db
			$options = array(
				'table'	=>	'users',
				'where'	=>	'uid',
				'value'	=>	$this->db->escape_str($_SESSION['iabs_user']),
				'data'	=>	array(
					'is_online'	=>	'0',
					'last_seen'	=> time()
				)
			);

			$do = $this->db_utils->update('where', $options);

			// Redirect user
			if ($do) {
				//Unset session
				$this->session->sess_destroy();

				if ( isset($_COOKIE['iabs_user']) || isset($_COOKIE['iabs_access']) ) {
					setcookie( "iabs_user", '', strtotime( '-150 days' ), "/", "", "", TRUE );
					setcookie( "iabs_access", '', strtotime( '-150 days' ), "/", "", "", TRUE );
				}

				redirect();
			}
		}
	}