<?php defined('BASEPATH') OR exit('Missed a step, right?');


/**
 * IABS Backup Class
 *
 * Contains methods for system backups and plugin backups
 *
 * @package		IABS Backup
 * @since		1.0
 * @license 	MIT
 * @link 		https://github.com/iabs/iabs-ci-backup-library
 */
class Iabs_Backup {

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
	private $options;

	/**
	 * Constructor
    */
	function __construct()
	{
		// Assign CodeIgniter object to $this->ci
		$this->ci =& get_instance();

		// Load required system library
		$this->ci->load->library('zip');

		// Load the required system helper
		$this->ci->load->helper('file');

		// Check if config file exists
     	if (file_exists(APPPATH.'config/iabs-config.php')) {
         // Grab the array guy
         $this->ci->load->helper('array');
         
         // Initialize the configuration file
         $this->ci->config->load('iabs-config', FALSE, TRUE);
         $iabs_config = $this->ci->config->item('iabs');    

         // Set config items
         $this->options 	= array(
         	'backup'			=>	(is_array($iabs_config)) ? element('auto_backup', $iabs_config) : '',
         	'cloud'			=>	(is_array($iabs_config)) ? element('use_cloud', $iabs_config) : '',
         	'backup_dir'	=>	APPPATH.'backup',
         	'backup_freq'	=>	(is_array($iabs_config)) ? element('backup_frequency', $iabs_config) : ''
         );
      }
	}


	/**
	 * Folder/File Backup
	 *
	 * @access	public
	 * @param	string [$type] 	| States whether we're zipping a file or folder
	 * @param	array [$options] 	| An array of backup options 
	 * @return	boolean
	 * @since 	1.0
	 */
	public function save($type, $options) 
	{
		switch ($type) {
			case 'folder':
				if (is_array($options)) 
				{
					$path = (array_key_exists('path', $options)) ? $options['path'] : exit('File path must be set in order to Zip') ;
					$zipped_name = (array_key_exists('zipped_name', $options)) ? $options['zipped_name'].date('Y-m-d') : 'backup_'.date('Y-m-d');
					$compress = $this->ci->zip->read_dir($path,FALSE);

			      if ($compress) 
			      {
			      	$this->ci->zip->archive(APPPATH."backup/_archives/$zipped_name.zip");

			      	return true;
			      }
				}
				break;
			case 'file':
			default:
				$compress = $this->ci->zip->read_file($options['path']);
				$zipped_name = (array_key_exists('zipped_name', $options)) ? $options['zipped_name'].date('Y-m-d') : 
				'backup_'.date('Y-m-d');
				if ($compress) {	
					$this->ci->zip->archive(APPPATH."backup/_archives/$zipped_name.zip");

					return true;
				}
				break;
		}
	}

	/**
	 * Folder/File Restore
	 * Restores backed up file(s) to previous location(s) 
	 *
	 * @access	public
	 * @param	array [$options] | An array of restoration options
	 * @return	boolean
	 * @since 	1.0
	 */
	public function restore() {
		//Todo
	}
}