<?php
if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
global $xoouserultra;

?>
<h3><?php _e('Plugin Settings','users-ultra-pro-recaptcha'); ?></h3>
<form method="post" action="">
<input type="hidden" name="update_settings" />
<?php wp_nonce_field( 'update_settings', 'uultra_nonce_check' ); ?>


<div class="uu20recaptcha-sect  uu20recaptcha-welcome-panel">
  
    
    <p><?php _e("You can get the Site Key and Secret Key on Google reCaptcha Dashboard",'users-ultra-pro-recaptcha'); ?>. <a href="https://www.google.com/recaptcha/admin" target="_blank"> <?php _e("Click here",'users-ultra-pro-recaptcha'); ?> </a> </p>
    
    <p><?php _e("You may check the reCaptcha setup tutorial as well. ",'users-ultra-pro-recaptcha'); ?> <a href="http://docs.usersultra.com/installing-recaptcha/" target="_blank"> <?php _e("Click here",'users-ultra-pro-recaptcha'); ?> </a> </p>
    
     
  
  <table class="form-table">
<?php


	$xoouserultra->xoouseradmin->create_plugin_setting(
			'input',
			'recaptcha_site_key',
			__('Site Key:','xoousers'),array(),
			__('Enter your site key here.','users-ultra-pro-recaptcha'),
			__('Enter your site key here.','users-ultra-pro-recaptcha')
	);
	
	$xoouserultra->xoouseradmin->create_plugin_setting(
			'input',
			'recaptcha_secret_key',
			__('Secret Key:','xoousers'),array(),
			__('Enter your site secret here.','users-ultra-pro-recaptcha'),
			__('Enter your site secret here.','users-ultra-pro-recaptcha')
	);

	
?>
</table>
</div>


<div class="uu20recaptcha-sect  uu20recaptcha-welcome-panel">
  <h3><?php _e('Protect WordPress Default Pages','users-ultra-pro-recaptcha'); ?></h3>
  
    
  <p><?php _e('Select what pages will be protected by reCaptcha','users-ultra-pro-recaptcha'); ?></p>
  
  <table class="form-table">
<?php


	$xoouserultra->xoouseradmin->create_plugin_setting(
                'checkbox',
                'recaptcha_display_registration_native',
                __('Registration Form','users-ultra-pro-recaptcha'),
                '1',
                __('If checked, the reCaptcha will be displayed in the registration form.','users-ultra-pro-recaptcha'),
                __('If checked, the reCaptcha will be displayed in the registration form.','users-ultra-pro-recaptcha')
        );
		
	$xoouserultra->xoouseradmin->create_plugin_setting(
                'checkbox',
                'recaptcha_display_loginform_native',
                __('Login Form','users-ultra-pro-recaptcha'),
                '1',
                __('If checked, the reCaptcha will be displayed in the login form.','users-ultra-pro-recaptcha'),
                __('If checked, the reCaptcha will be displayed in the login form.','users-ultra-pro-recaptcha')
        );
		
	
	$xoouserultra->xoouseradmin->create_plugin_setting(
                'checkbox',
                'recaptcha_display_forgot_password_native',
                __('Forgot Password Form','users-ultra-pro-recaptcha'),
                '1',
                __('If checked, the reCaptcha will be displayed in the forgot password form.','users-ultra-pro-recaptcha'),
                __('If checked, the reCaptcha will be displayed in the forgot password form.','users-ultra-pro-recaptcha')
        ); 
		
		
		$xoouserultra->xoouseradmin->create_plugin_setting(
                'checkbox',
                'recaptcha_display_comments_native',
                __('Comments','xoousers'),
                '1',
                __('If checked, the reCaptcha will be displayed in the forgot password form.','users-ultra-pro-recaptcha'),
                __('If checked, the reCaptcha will be displayed in the forgot password form.','users-ultra-pro-recaptcha')
        ); 
		
	
		
?>
</table>
</div>



<div class="uu20recaptcha-sect  uu20recaptcha-welcome-panel">
  <h3><?php _e('Custom Pages','users-ultra-pro-recaptcha'); ?></h3>
  
    
  <p><?php _e('Select what pages will be protected by reCaptcha','users-ultra-pro-recaptcha'); ?></p>
  
  <table class="form-table">
<?php


	$xoouserultra->xoouseradmin->create_plugin_setting(
                'checkbox',
                'recaptcha_display_registration',
                __('Registration Form','users-ultra-pro-recaptcha'),
                '1',
                __('If checked, the reCaptcha will be displayed in the registration form.','users-ultra-pro-recaptcha'),
                __('If checked, the reCaptcha will be displayed in the registration form.','users-ultra-pro-recaptcha')
        );
		
	$xoouserultra->xoouseradmin->create_plugin_setting(
                'checkbox',
                'recaptcha_display_loginform',
                __('Login Form','xoousers'),
                '1',
                __('If checked, the reCaptcha will be displayed in the login form.','users-ultra-pro-recaptcha'),
                __('If checked, the reCaptcha will be displayed in the login form.','users-ultra-pro-recaptcha')
        );
		
	
	/*$xoouserultra->xoouseradmin->create_plugin_setting(
                'checkbox',
                'recaptcha_display_forgot_password',
                __('Forgot Password Form','xoousers'),
                '1',
                __('If checked, the reCaptcha will be displayed in the forgot password form.','xoousers'),
                __('If checked, the reCaptcha will be displayed in the forgot password form.','xoousers')
        ); */
		
	
		
?>
</table>
</div>



<p class="submit">
	<input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e('Save Changes','users-ultra-pro-recaptcha'); ?>"  />
</p>

  





</form>