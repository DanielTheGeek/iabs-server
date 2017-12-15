<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/
$hook['pre_controller'][] = [
	'class'		=>		'Iabs_Ip',
	'function'	=>		'blockRequest',
	'filename'	=>		'Iabs_Ip.php',
	'filepath'	=>		'hooks'
];

$hook['post_controller_constructor'][] = [
	'class'		=>		'Iabsbase',
	'function'	=>		'run',
	'filename'	=>		'Iabsbase.php',
	'filepath'	=>		'libraries',
	'params'		=>		''
];

$hook['post_controller_constructor'][] = [
	'class'		=>		'Monitor',
	'function'	=>		'redirect',
	'filename'	=>		'monitor.php',
	'filepath'	=>		'hooks'
];