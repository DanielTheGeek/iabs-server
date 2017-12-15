<?php
	class License extends CI_Controller
	{
		
		function __construct()
		{
			parent::__construct();

			if ($this->input->is_ajax_request()) {
				exit("Request type not allowed");
			}
		}

		public function index() {
            if ($this->input->post('step_1')) {
                $data = [
                    'content'	=>	'
                        <div class="form-row">
                            <label>
                                <span>Envato Username</span>
                                <input type="text" name="envato_user">
                            </label>
                        </div>

                        <div class="form-row">
                            <label>
                                <span>Purchase Code</span>
                                <input type="text" name="envato_key">
                                <p class="hint">You can find this in your envato account.</p>
                            </label>
                        </div>
                        <div>
                            <p style="text-align: center; margin-bottom: 20px;">Having issues with validating? Check for possible issues at the <a class="link"  href="https://forum.scriptorigin.com">Script Origin Support Page</a></p>
                        </div>
                        ',
                    'title'	=>	'Purchase Details',
                    'button_val'	=>	'Next',
                    'button_name'	=>	'do_step_1',
                    'action'		=>	form_open('activate', [ 'class' => 'form-basic'] )
                ];
            } elseif ($this->input->post('do_step_1')) {
                // Validate data
                $rules = [
                    [
                        'field' => 'envato_user',
                        'label' => 'envato username',
                        'rules' => 'trim|required'
                    ],
                    [
                        'field' => 'envato_key',
                        'label' => 'purchase code',
                        'rules' => 'trim|required'
                    ]
                ];

                // Set validation rules
                $this->form_validation->set_rules($rules);

                if (!$this->form_validation->run()) {
                    $data =	[
                        'title'		=> 'Oops!',
                        'content'	=>	'<div>
                            <p>All fields are required to continue</p>
                        </div>',
                        'button_name'	=>	'step_1',
                        'button_val'	=>	'Try again',
                        'action'		=>	form_open('activate', [ 'class' => 'form-basic'] )
                    ];
                } else {
                    $this->load->library('license_auth');
                    $credentials = [
                        'key'           => 	$this->input->post('envato_key'),
                        'username'      => 	$this->input->post('envato_user')
                    ];

                    $verify = $this->license_auth->validate($credentials['key'], $credentials['username']);

                    if (!$verify) 
                    {
                        $data =	[
                            'title'		=> 'Error!',
                            'content'	=>	'<div>
                                <p>The credentials you provided are invalid</p>
                            </div>',
                            'button_name'	=>	'step_1',
                            'button_val'	=>	'Try Again',
                            'action'		=>	form_open('activate', [ 'class' => 'form-basic'] )
                        ];
                    } else {
                        $data =	[
                            'title'		=> 'Installation Verified',
                            'content'	=>	'<div>
                                <p style="text-align: left;">Your installation is now valid which means you get access to all our support channels. Thank you for being a good customer.</p>
                            </div>',
                            'button_name'	=>	'step_2',
                            'button_val'	=>	'Okay',
                            'action'		=>	form_open('plugins', [ 'class' => 'form-basic'] )
                        ];
                    }
                }
            } else {
                $data = [
                    'title'		=>	'Activation Note',
                    'content'	=>	'<div><p style="text-align: left;">We need to verify that you purchased this software, a verified purchase means you get unlimited access to all our support channels and automatic updates. Before you continue, you need your:</p>
                            <ol class="iabs-list">
                                <li>Envato Username</li>
                                <li>Envato Purchase code</li>
                            </ol>
                            <p style="text-align: left;">If you don\'t have this information, please contact your sales or technical department. Click "Start" when you\'re ready.</p>
                        </div>',
                    'button_name'	=>	'step_1',
                    'button_val'	=>	'Start',
                    'action'		=>	form_open('activate', [ 'class' => 'form-basic'] )
                ];
            }
            $this->parser->parse('installer/install', $data);
        } 
	}