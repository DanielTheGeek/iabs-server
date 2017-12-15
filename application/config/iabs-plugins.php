<?php

/**
 * PLUGIN CONFIGURATION
 *
 * @since 1.0
 * @link https://iabs.scriptorigin.com/documentation/config/plugins
 * 'plugin_dir'   = Path to the plugin directory
 *
 * WARNING: Do not change unless you understand the implications
 */

$config['plugin_dir'] = APPPATH . '_plugins/';
define('PLUGIN_DIR', $config['plugin_dir']);

require_once( APPPATH . 'libraries/abstract.plugins.php' );
require_once( APPPATH . 'libraries/trait.plugins.php' );