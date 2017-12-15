<?php  if ( ! defined('BASEPATH')) exit('Missed a step, right?');


/**
 * BASIC CONFIGURATION
 *
 * @since 1.0
 * @link https://iabs.scriptorigin.com/documentation/config/basic
 * 'installed'   = If set to TRUE, installation dialog will be displayed (Change this only if you know what you're doing)
 * 'frontend'    = The URL of the frontend application (must be a valid URL else may not work as expected) 
 */
$config['iabs']['installed'] = FALSE;
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
 * SITE ORIGIN CREDENTIALS
 *
 * @since 1.0
 * @link https://iabs.scriptorigin.com/documentation/config/credentials
 * 'so_key' = This key can be obtained via codecanyon //ToDo: Update this
 * 'use_cloud' = If set to TRUE, cloud storage is made available to the IABS
 * 'cloud_id' = Your Site Origin Cloud ID (only works if use_cloud is set to TRUE)
 * 'cloud_key' = Your Site Origin Cloud Key (only works if use_cloud is set to TRUE)   
 */
$config['iabs']['envato_key']			=	'39403094';
$config['iabs']['envato_username']	=	'39403094';
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
 * Site Origin Cloud credential
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
    'hostname' 	=> 	'localhost',
    'database' 	=> 	'iabs',
    'username' 	=> 	'root',
    'password'	=>	'',
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