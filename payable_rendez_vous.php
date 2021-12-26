<?php
/**
 * Plugin Name: Rendez-Vous
 * Plugin URI: https://github.com/champix56/payable_rdv_plugin
 * Description: Make payable rendez vous for customers and follow for admin
 * Version: 1.0
 * Author: champix56
 * Author URI: http://github.com/champix56
 */
include_once(plugin_dir_path( __FILE__).'constant.php');
include($PLUGIN_DIR.'/install/install.php');
include($PLUGIN_DIR.'/menus/menus.php');
register_activation_hook(__FILE__, 'rdv_install_all');
register_deactivation_hook(__FILE__, 'rdv_uninstall_all');


?>