<?php
/*
Plugin Name: Users Ultra Pro 3.0 reCaptcha (Add-on)
Plugin URI: https://usersultra.com
Description: Add-on for Users Ultra Pro 3.0
Version: 1.0.1
Author: Users Ultra Pro
Text Domain: uultra20-recaptcha
Domain Path: /languages
Author URI: https://usersultra.com/
*/

/**
 * Detect plugin. For use on Front End only.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
 
// check for plugin using plugin name
if ( is_plugin_active( 'users-ultra-pro/xoousers.php' ) || is_plugin_active( 'users-ultra/xoousers.php' ) ) {
    //plugin is activated
	
	
	if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
	
	define('uupro20_recaptcha_url',plugin_dir_url(__FILE__ ));
	define('uupro20_recaptcha_path',plugin_dir_path(__FILE__ ));
	
	$plugin = plugin_basename(__FILE__);
	
	/* Master Class  */
	require_once (uupro20_recaptcha_path . 'classes/recaptcha.class.php');
	register_activation_hook( __FILE__, 'uupro20_recaptcha');
	
	function  uupro20_recaptcha( $network_wide ) 
	{
		$plugin = "uultra20-recaptcha/index.php";
		$plugin_path = '';	
		
		if ( is_multisite() && $network_wide ) // See if being activated on the entire network or one blog
		{ 
			activate_plugin($plugin_path,NULL,true);			
			
		} else { // Running on a single blog		   	
				
			activate_plugin($plugin_path,NULL,false);		
			
		}
	}
	global $uupro20_recaptcha;
	$uupro20_recaptcha = new UUPro20ReCaptcha();

} 