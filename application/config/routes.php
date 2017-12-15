<?php defined('BASEPATH') OR exit('Missed a step, right?');

$route['default_controller'] = 'welcome';
$route['404_override'] = '';
$route['translate_uri_dashes'] = TRUE;

// Installation and activation routes
$route['ignite'] = 'Setup/index';
$route['activate'] = 'License/index';

// Auth routes
$route['login'] = 'Auth/login';
$route['logout'] = 'Auth/logout';
$route['signup'] = 'Auth/register';
$route['signup/do_signup'] = 'Auth/do_register';

// App routes
$route['plugins'] = 'Plugins/index';
$route['plugins/install'] = 'Plugins/install';
$route['plugins/(:any)'] = 'Plugins/show_page/$1';


// Container routes
$route['containers'] = 'Containers/index';
$route['containers/add'] = 'Containers/add';
$route['containers/view/(:any)'] = 'Containers/view/$1';

// Settings routes
$route['settings'] = 'Settings/index';