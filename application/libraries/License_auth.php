<?php defined('BASEPATH') OR exit('Missed a step, right?');


	/**
	 * License Authentication
	 *
	 * WARNING: DO NOT CHANGE ANYTHING HERE
	 *
	 * @package		Base IABS
	 * @since		1.0
	 */
	class License_auth
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
		private $username;
		private $key;

		function __construct()
		{
			// Assign CodeIgniter object to $this->ci
			$this->ci =& get_instance();

			// Check if config file exists
	      if (file_exists(APPPATH.'config/iabs-config.php')) {
            // Grab the array guy
            $this->ci->load->helper('array');
            
            // Initialize the configuration file
            $this->ci->config->load('iabs-config', FALSE, TRUE);
            $iabs_config = $this->ci->config->item('iabs');    

            // Set config items
            $this->key 			= (is_array($iabs_config)) ? element('envato_key', $iabs_config) : '';
            $this->username 	= (is_array($iabs_config)) ? element('envato_username', $iabs_config) : '';
	      }	
		}

		public function validate($key='',$user='') {
			// Get the envato key and username
			$en_key = (empty($key)) ? $this->key : $key;
			$username = (empty($user)) ? $this->username : $user;

			// Access the envato API. *Needs to be reviewed
			$license_data = $this->api_verify( $en_key, $username );

			if( isset($purchase_data['verify-purchase']['buyer']) ) {
				// return $purhase_data;
				if ($purchase_data) {
					$text_data = (file_exists(APPPATH.'config/iabs-config.php')) ? file_get_contents(APPPATH.'config/iabs-config.php') : exit('An error occurred. e_UTGC');

					$set = str_replace('$config[\'iabs\'][\'envato_key\']', '$config[\'iabs\'][\'envato_key\'] = "'.$en_key.'"; // previous value:', $text_data);
					$do = file_put_contents(APPPATH.'config/iabs-config.php', $set);

					$text_data = (file_exists(APPPATH.'config/iabs-config.php')) ? file_get_contents(APPPATH.'config/iabs-config.php') : exit('An error occurred. e_UTGC');

					$set = str_replace('$config[\'iabs\'][\'envato_username\']', '$config[\'iabs\'][\'envato_username\'] = "'.$username.'"; // previous value:', $text_data);
	           	$do = file_put_contents(APPPATH.'config/iabs-config.php', $set);

	           	if ($do) {
	           		return true;
	           	}
				}
			} else {
				if (empty($this->key) && $en_key == 'TEST') {
					$text_data = (file_exists(APPPATH.'config/iabs-config.php')) ? file_get_contents(APPPATH.'config/iabs-config.php') : exit('An error occurred. e_UTGC');

					$set = str_replace('$config[\'iabs\'][\'envato_key\']', '$config[\'iabs\'][\'envato_key\'] = "'.$en_key.'"; //', $text_data);
					$do = file_put_contents(APPPATH.'config/iabs-config.php', $set);

					$text_data = (file_exists(APPPATH.'config/iabs-config.php')) ? file_get_contents(APPPATH.'config/iabs-config.php') : exit('An error occurred. e_UTGC');
					$set = str_replace('$config[\'iabs\'][\'envato_username\']', '$config[\'iabs\'][\'envato_username\'] = "'.$username.'"; //', $text_data);
	           	$do2 = file_put_contents(APPPATH.'config/iabs-config.php', $set);

	           	if ($do && $do2) {
	           		define('DEMO_DONE', '1');
	           		return true;
	           	}	
				}
           	//return false; Modified for demo purposes
			}
		} 
		
		private function api_verify($key, $user) {
			// Set API Key
			$api_key = $key;

			// Open cURL channel
			//$ch = curl_init();

			// Set cURL options
			//curl_setopt($ch, CURLOPT_URL, "https://marketplace.envato.com/api/edge/". $user ."/". 
				//$api_key ."/verify-purchase:". $key .".json");
			//curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

			//Set the user agent
			//$agent = 'Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1; SV1)';
			//curl_setopt($ch, CURLOPT_USERAGENT, $agent);

			// Decode returned JSON
			//$output = json_decode(curl_exec($ch), true);

			// Close Channel
			//curl_close($ch);

			// Return output
			//return $output;

			return false;
		}
	}
?>
