<?php

	/**
	 * Monitor Class
	 * Handles permissions on restricted pages and some other basic security stuff 
	 *
	 * @since 1.0
	 * @author Daniel Omoniyi
	*/
	class Monitor
	{
		
		/**
		 * CodeIgniter
		 *
		 * @access	private
		 */
		private $ci;

		/**
		 * Configuration
		 *
		 * @access	private
		 */
		private $user;

		/**
		 * Constructor
	    */
		function __construct()
		{
			// Assign CodeIgniter object to $this->ci
			$this->ci =& get_instance();

         // Set
         $this->user = ( $this->is_logged_in() ) ? $_SESSION['iabs_user'] : '';
		}

		public function redirect( $return='' ) {
			if ( file_exists(APPPATH.'config/iabs-config.php') ) {
				if( empty($this->user) && 
					uri_string() !== 'login' && 
					uri_string() !== 'ignite' && 
					uri_string() !== 'activate' &&
					uri_string() !== 'signup' &&
					uri_string() !== 'signup/do_signup'
					) {
					$back = ( ! empty($return) ) ? $return : 'login';
					redirect( $back );
				} else if ( ! empty($this->user) && uri_string() == 'login' ||
					! empty($this->user) && uri_string() == 'signup'
				 ) {
					redirect();
				} else if ( empty($this->user) && uri_string() == 'logout' ) {
					redirect();
				}
			}
		}

		public function is_logged_in() {
			if ( isset($_SESSION['iabs_user']) ) {
				return true;
			} elseif ( isset($_COOKIE['iabs_user']) && isset($_COOKIE['iabs_access']) ) {
				// Load required files
				$this->ci->load->model( 'Iabs_Fetcher', 'fetcher' );
				$this->ci->load->helper('email');

				$user = $this->ci->db->escape_str( $this->ci->input->cookie('iabs_user') );
				$secret = $this->ci
				->db
				->escape_str( 
					$this->ci->input->cookie('iabs_access') 
				);

				$row = ( valid_email($user) ) ? 'user_email' : 'uid' ;
				
				$options = array(
					'row'	=>		"$row, user_secret, user_name",
					'table'	=>		'users',
					'where'	=>		$row,
					'value'	=>		$user,
					'limit'	=>		1
				);

				// Fetch values from the db and compare
				$fetch = $this->ci->fetcher->fetch( 'where', $options );

				if ( $fetch ) {
					$real_secret = $fetch->row()->user_secret;

					if ( $secret == md5($real_secret) ) {
						$sess_data = array(
					      	'iabs_user'  =>	$fetch->row()->uid,
					      	'iabs_uname' =>	$fetch->row()->user_name
						);

						$this->ci->session->set_userdata( $sess_data );

						return true;
					} else {
						setcookie( "iabs_user", '', strtotime( '-150 days' ), "/", "", "", TRUE );
						setcookie( "iabs_access", '', strtotime( '-150 days' ), "/", "", "", TRUE );
					}
				} else {
					setcookie( "iabs_user", '', strtotime( '-150 days' ), "/", "", "", TRUE );
					setcookie( "iabs_access", '', strtotime( '-150 days' ), "/", "", "", TRUE );
				}
			} else {
				return false;
			}
		}
	}