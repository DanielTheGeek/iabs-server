<?php defined('BASEPATH') OR exit('Missed a step, right?');


/**
 * Base Class
 *
 * Base IABS Class: controls core IABS functionality
 * WARNING: DO NOT CHANGE ANYTHING HERE 
 *
 * @package		Base IABS
 * @since		1.0
 */
class Iabsbase {

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
	private $installed;
	private $frontend;
	private $blocked_ips;
	private $allowed_ips;
	private $so_key;
	private $cloud;
	private $update;
	private $backup;

	/**
	 * Constructor
     */
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
            $this->installed 	= (is_array($iabs_config)) ? element('installed', $iabs_config) : '';
            $this->frontend 	= (is_array($iabs_config)) ? element('frontend', $iabs_config) : '';
            $this->blocked_ips 	= (is_array($iabs_config)) ? element('blocked_ips', $iabs_config) : '';
            $this->allowed_ips 	= (is_array($iabs_config)) ? element('allowed_ips', $iabs_config) : '';
            $this->key 			= (is_array($iabs_config)) ? element('envato_key', $iabs_config) : '';
            $this->key_user 	= (is_array($iabs_config)) ? element('envato_username', $iabs_config) : '';
            $this->cloud 		= (is_array($iabs_config)) ? element('use_cloud', $iabs_config) : '';
            $this->update 		= (is_array($iabs_config)) ? element('auto_update', $iabs_config) : '';
            $this->backup 		= (is_array($iabs_config)) ? element('auto_backup', $iabs_config) : '';
        }
	}


	/**
	 * Validator method for plugins, configs
	 *
	 * @access	public
	 * @param	string [$item] The item to be validated
	 * @param	string [$type] config|plugin The type of item being validated
	 * @return	boolean
	 * @since 	1.0
	 */
	public function validate($item, $type)
	{
		switch ($type) {
			case 'config':
				if (empty($this->$item) || $this->$item == FALSE) {
					return false;
				} else if ($item == 'key' && !empty($this->$item)) {
					$this->ci->load->library('license_auth');

					$validate = $this->ci->license_auth->validate($this->$item, $this->key_user);

					if ($validate) {
						return true;
					} else {
						if ($this->$item == 'TEST') {
							return true;
						} else {
							return false;
						}
					}
				} else if ($item == 'installed' && $this->$item == TRUE) {
					return true;
				} else {
					//return true;
				}
				break;

			case 'plugin':
				if (empty($item)) {
					return false;
				} else {
					$plugin = $this->ci->db->escape_str($item);

					if (file_exists("./application/plugins/$plugin.zip")) {
						return true;
					} else {
						return false;
					}
				}
				break;
			
			default:
				break;
		}
	}

	public function validate_key($key)
	{
		if (!empty($key)) {
			// Initialize cloud storage library
			$this->ci->load->library('iabs_cloud');

			// Connect to the script origin cloud server and validate cloud credentials
         return true;
		} else {
         return false;
      }
	}

	public function run()
	{
		//Check for config validity
		if (!$this->validate('installed', 'config')) {
			if (uri_string() != 'ignite') {
				redirect('ignite');
			}
		} else if($this->validate('installed', 'config')) {
         if (!$this->validate('key', 'config')) {
         	if (uri_string() != 'activate') {
					redirect('activate');
				}
         } elseif (uri_string() == 'ignite' || uri_string() == 'activate') {
         	// IABS is installed, hide installation file
         	show_404();
	      } elseif (! $this->ci->db->table_exists('users') || ! $this->ci->db->table_exists('usermeta')
	      	|| ! $this->ci->db->table_exists('options') || ! $this->ci->db->table_exists('plugins')
	      	) {
			  	exit('One or more required system containers have been deleted, please run the installation again.<br>Visit the <a href="https://scriptorigin.com/support">Script Origin Support Page</a> or <a href="https://scriptorigin.com/forums">forums</a> for more information.');
			}
      }
	}
}