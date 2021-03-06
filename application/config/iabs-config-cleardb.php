<?php  if ( ! defined('BASEPATH')) exit('Missed a step, right?');


/**
 * BASIC CONFIGURATION
 *
 * @since 1.0
 * @link https://iabs.scriptorigin.com/documentation/config/basic
 * 'installed'   = If set to TRUE, installation dialog will be displayed (Change this only if you know what you're doing)
 * 'frontend'    = The URL of the frontend application (must be a valid URL else may not work as expected) 
 */
$config['iabs']['installed'] = TRUE;
$config['iabs']['frontend']  = '';

/**
 * IP CONFIGURATION
 *
 * @since 1.0
 * @link https://iabs.scriptorigin.com/documentation/config/ip
 * 'blocked_ips' = List of I.P's to be restricted from accessing the IABS (can accept an array of values)
 * 'allowed_ips' = List of I.P's to be allowed from accessing the IABS (can accept an array of values)
 * NOTE: Leave allowed_ips empty to allow all I.P's, else all I.P's except what you set will be restricted  
 */
$config['iabs']['blocked_ips'] = '';
$config['iabs']['allowed_ips'] = '';

/**
 * APP CREDENTIALS
 *
 * @since 1.0
 * @link https://iabs.scriptorigin.com/documentation/config/credentials
 * 'envato_key' 		= Your envato purchase code, can be obtained via codecanyon //ToDo: Update this
 * 'envato_username' = Your envato username
 * 'use_cloud' 		= If set to TRUE, cloud storage is made available to the IABS // Service is currently unavailable
 * 'cloud_id' 			= Your Site Origin Cloud ID (only works if use_cloud is set to TRUE)
 * 'cloud_key' 		= Your Site Origin Cloud Key (only works if use_cloud is set to TRUE)   
 */
$config['iabs']['envato_key'] = "TEST"; //			=	'';
$config['iabs']['envato_username'] = "TEST"; //		=	'';
$config['iabs']['use_cloud'] 			= 	FALSE;
$config['iabs']['cloud_id'] 			= 	'YOUR-CLOUD-ID';
$config['iabs']['cloud_key']			=	'YOUR-CLOUD-KEY';

/**
 * AUTOMATIC UPDATE/BACKUP
 *
 * @since 1.0
 * @link https://iabs.scriptorigin.com/documentation/config/auto-update-backup 
 * 'auto-update' = The IABS will automatically update if set to TRUE
 * 'auto-backup' = Enables automatic back up of the IABS, this only works with a valid
 * Site Origin Cloud credential.
 * 'backup-frequency' = This defines how often the IABS should be backed up   
 */
$config['iabs']['auto_update']		=	FALSE;
$config['iabs']['auto_backup']		=	FALSE;
$config['iabs']['backup_frequency']	=	'MONTHLY'; // WEEKLY | MONTHLY | YEARLY

/**
 * DATABASE CONFIGURATION
 *
 * @since 1.0
 * @link https://iabs.scriptorigin.com/documentation/config/database
*/
$config['iabs']['database'] = array(
    'dbdriver' => 	'mysqli',
    'hostname' 	=> 	env('DB_HOST', 'us-cdbr-iron-east-02.cleardb.net'),
    'database' 	=> 	env('DB_DATABASE', 'heroku_5d299d9c8ebb0a5'),
    'port'		=>	'3306',
    'username' 	=> 	env('DB_USERNAME', 'be65bb8b6545e9'),
    'password'	=>	env('DB_PASSWORD', '297da109'),
    'dbprefix'  =>  'iabs_'
);

/**
 * CUSTOM AUTOLOADING
 * 
 * WARNING: Only change these values if you understand what you're doing
 * Autoload your files without hacking IABS/CodeIgniter
 * Seperate values with a comma
*/
$config['iabs']['autoload_libraries'] 	= 'database';
$config['iabs']['autoload_library'] 	= 'plugins_lib';
$config['iabs']['autoload_models']		= 'plugins_model';