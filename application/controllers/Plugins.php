<?php defined('BASEPATH') OR exit('Missed a step, right?');

    class Plugins extends CI_Controller {

        private $_plugins;

        public function __construct()
        {
            parent::__construct();

            if (! file_exists(APPPATH.'config/iabs-config.php')) {
                redirect();
            }

            $this->load->library('parser');
            
            $this->_plugins = $this->Plugins_model->get_plugins();

            $this->plugins_lib->update_all_plugin_headers();

            $this->load->model('Iabs_Fetcher', 'fetcher');

            $this->options = array(
                'row'   =>      'option_value',
                'table' =>      'options',
                'where' =>      'option_name',
                'value' =>      'site_name',
                'limit' =>      1
            );
            $this->fetch = $this->fetcher->fetch('where', $this->options);
            
            if ($this->fetch) {
                $this->data = array(
                    'page_title'    =>      'Plugins',
                    'site_name'     =>      $this->fetch->row()->option_value
                );
            }
        }

        public function index()
        {   
            $data = $this->data;
            $data['message'] = '';
            $data['plugin_message'] = '';

            if (get_cookie('plugin_message')) {
                $data['message'] = '<div style="margin-bottom: 5px !important;" class="alert alert-'.get_cookie('plugin_message_class').' alert-dismissable">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.get_cookie('plugin_message').'</div>';
            }   

            if (get_cookie('plugin_deactivation_message') ) {
                $data['plugin_message'] = '<div style="margin-bottom: 5px !important;" class="alert alert-'.get_cookie('plugin_deactivation_message_class').' alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.get_cookie('plugin_deactivation_message').'</div>';                
            }

            if (get_cookie('plugin_activation_message')) {
                $data['message'] = '<div style="margin-bottom: 5px !important;" class="alert alert-'.get_cookie('plugin_activation_message_class').' alert-dismissable"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>'.get_cookie('plugin_activation_message').'</div>'; 
            }

            if (isset($_GET['action'])) {
                if ($_GET['action'] == 'deactivate' && isset($_GET['plugin'])) {
                    $plugin = $this->db->escape_str($_GET['plugin']);

                    $plugin_info = $this->Plugins_model->get_plugin($plugin);

                    if ($plugin_info->status == '1') {
                        $do = $this->plugins_lib->disable_plugin($plugin);

                        if ($do) {
                            $plugin_message['message'] = 'Plugin was deactivated successfully.';
                            $plugin_message['class'] =  'success'; 
                        } else {
                            $plugin_message['message'] = 'Plugin could not be deactivated due to plugin errors.';
                            $plugin_message['class']   =  'danger';
                        }

                        $this->plugins_lib->set_plugin_message($plugin_message);
                    }
                } elseif ($_GET['action'] == 'activate' && isset($_GET['plugin'])) {
                    $plugin = $this->db->escape_str($_GET['plugin']);

                    $plugin_info = $this->Plugins_model->get_plugin($plugin);

                    if ($plugin_info->status == '0') {

                        $do = $this->plugins_lib->enable_plugin($plugin);

                        if ($do) {
                            $plugin_message['message'] = 'Plugin was activated successfully.';
                            $plugin_message['class']   =  'success';
                        } else {
                            $plugin_message['message'] =  'Plugin could not be enabled due to plugin errors.';
                            $plugin_message['class'] =    'danger';                    
                        }

                        $this->plugins_lib->set_plugin_message($plugin_message);
                    }
                } elseif ($_GET['action'] == 'uninstall' && isset($_GET['plugin'])) {
                    $plugin = $this->db->escape_str($_GET['plugin']);

                    $plugin_info = $this->Plugins_model->get_plugin($plugin);

                    // Continue if plugin has been deactivated
                    if ($plugin_info->status == '0') {
                        // Uninstall the plugin
                        $do = $this->plugins_lib->uninstall_plugin($plugin);

                        if ($do) {
                            echo "okay";
                            exit();
                        } else {
                            echo "not_okay";
                            exit();
                        }
                    }
                }

                redirect('plugins');
            }

            $data['content'] = 'pages/plugins';
            $data['plugins'] = $this->Plugins_model->get_plugins();

            $this->parser->parse('includes/template', $data);
        }

        public function show_page($plugin)
        {
            $data = $this->data;

            if( ! isset($this->_plugins[$plugin]))
            {
                die(show_404());
            }
            elseif($this->_plugins[$plugin]->status != 1)
            {
                die("This plugin isn't active, activate it first to access it.");
            }
            else
            {
                $data['plugin'] = $plugin;

                // Just some random stuff to send to the data, not needed unless the plugin
                // controller requires it
                $plugin_data = json_decode($this->_plugins[$plugin]->data);

                if( ! $data['plugin_content'] = $this->plugins_lib->view_controller($plugin, $plugin_data))
                {
                    die(show_404());
                } 
            }

            $data['content'] = 'pages/view_plugin';
            $this->parser->parse('includes/template', $data);
        }

        public function install() 
        {
            $data = $this->data;

            // Show a message if the zlib module is not installed on the server
            if (! class_exists('ZipArchive')) {
                exit('The PHP zlib module is required to install plugins');
            }

            if ( isset($_GET['action']) ) {
                $error_messages = [
                    'install_failed'    =>  'This doesn\'t seem to be a valid plugin. <br><br>',
                    'install_success'   =>  '',
                    'err_extract'       =>  'Plugin files could not be extracted <br><br>',
                    'err_file_exists'   =>  'This plugin is already installed, uninstall it first and try again. <br><br>'
                ];

                if ( $_GET['action'] == 'upload' ) {
                    $data['content'] = 'pages/upload_plugin';
                }
                
                if ( $_GET['action'] == 'upload' && isset( $_GET['type'] ) ) {
                    $config['upload_path']          = PLUGIN_DIR;
                    $config['allowed_types']        = 'zip';
                    $config['max_size']             = 0;

                    $this->load->library('upload', $config);

                    if ( ! $this->upload->do_upload('plugin'))
                    {
                        $data['message'] = 'Error';
                        $data['error'] = $this->upload->display_errors();

                        $data['content'] = 'pages/do_plugin_upload';
                    } else {
                        // File upload data
                        $file_info = $this->upload->data();

                        $path = $file_info['file_path'];
                        $file = $file_info['full_path'];

                        if ( file_exists(PLUGIN_DIR.$file_info['raw_name']) ) {
                            $data['message'] = 'Error';
                            $data['error'] = $error_messages['err_file_exists'];

                            $data['content'] = 'pages/do_plugin_upload';
                        } else {
                            $zip = new ZipArchive;
                            $resp = $zip->open( $file );

                            if ( $resp === TRUE ) {
                                $this->load->helper('file');

                                # Extract to the plugin directory
                                $extract = $zip->extractTo( $path );
                                $zip->close();

                                if ( $extract ) {
                                    // Call the plugin installation method
                                    $resp = $this->plugins_lib->install_plugin( $file_info['raw_name'] );

                                    if ( $resp ) {
                                        $data['message'] = 'Installation Complete';
                                        $data['error'] = $error_messages['install_success'];

                                        $data['upload_data'] = $file_info;

                                        $data['content'] = 'pages/do_plugin_upload';   
                                    } else {
                                        $data['message'] = 'Installation Complete';
                                        $data['error'] = $error_messages['install_success'];

                                        $data['upload_data'] = $file_info;

                                        $data['content'] = 'pages/do_plugin_upload';   
                                    }
                                } else {                                   
                                    // Delete the archive
                                    $archive = $path.$file_info['raw_name'];
                                    delete_files( $archive, TRUE );
                                    rmdir( $archive );

                                    $data['message'] = 'Installation failed';
                                    $data['error'] = $error_messages['install_failed'];

                                    $data['content'] = 'pages/do_plugin_upload';
                                }
                            } else {
                                // Delete the archive
                                unlink( $file );
                                delete_files( $path.$file_info['raw_name'], TRUE );

                                $data['message'] = 'Installation failed';
                                $data['error'] = $error_messages['err_extract'];

                                $data['content'] = 'pages/do_plugin_upload';
                            }
                        }
                        
                    }
                }   
            } else {
                $data['content'] = 'pages/install_plugin';
            }

            $this->parser->parse('includes/template', $data);
        }

        public function do_install() {
            $config['upload_path']          = PLUGIN_DIR;
            $config['allowed_types']        = 'zip';
            $config['max_size']             = 0;

            $this->load->library('upload', $config);

            if ( ! $this->upload->do_upload('plugins'))
            {
                $data['message'] = 'Error';
                $data['error'] = $this->upload->display_errors();

                $data['content'] = 'pages/do_plugin_upload';

                $this->parser->parse('includes/template', $data);
            }
            else
            {
                $data['message'] = 'Installation successful';
                $data['upload_data'] = $this->upload->data();
                $data['content'] = 'pages/do_plugin_uploaded';

                $this->parser->parse('includes/template', $data);
            }
        }
    }
