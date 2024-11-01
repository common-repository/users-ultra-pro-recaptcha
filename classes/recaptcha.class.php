<?php
class UUPro20ReCaptcha
{
	var $RECAPTCHA_SITE_KEY;
	var $RECAPTCHA_SECRET_KEY;
		
	public function __construct()
	{		
		/* Plugin slug and version */
		$this->slug = 'userultra';
		$this->subslug = 'uupro20-recaptcha';
		require_once( ABSPATH . 'wp-admin/includes/plugin.php' );
		$this->plugin_data = get_plugin_data( uupro20_recaptcha_path . 'index.php', false, false);
		$this->version = $this->plugin_data['Version'];						
		add_action('wp_enqueue_scripts', array(&$this, 'add_front_end_scripts'), 12);	
		add_action('admin_enqueue_scripts', array(&$this, 'add_styles'), 9);
		add_action('admin_menu', array(&$this, 'add_menu'), 11);
		add_action('admin_init', array(&$this, 'admin_init'), 9);
		
		
    }
	
	function add_styles(){
	
		wp_register_script( 'uupro20_recaptcha_js', uupro20_recaptcha_url . 'admin/scripts/admin.js', array( 
			'jquery'
		) );
		wp_enqueue_script( 'uupro20_recaptcha_js' );
	
		wp_register_style('uupro20_recaptcha_css',uupro20_recaptcha_url . 'admin/css/admin.css');
		wp_enqueue_style('uupro20_recaptcha_css');
		
	}
	
	function admin_init() 
	{
	
		$this->tabs = array(
			'settings' => __('Settings','users-ultra-pro-recaptcha')
			
		);
		$this->default_tab = 'settings';		
		
	}
	
	
	function add_menu()
	{
		add_submenu_page( 'userultra', __('reCaptcha','users-ultra-pro-recaptcha'), __('reCaptcha','users-ultra-pro-recaptcha'), 'manage_options', 'uupro20-recaptcha', array(&$this, 'admin_page') );
		
		
	}

	function admin_tabs( $current = null ) {
			$tabs = $this->tabs;
			$links = array();
			if ( isset ( $_GET['tab'] ) ) {
				$current = $_GET['tab'];
			} else {
				$current = $this->default_tab;
			}
			foreach( $tabs as $tab => $name ) :
				if ( $tab == $current ) :
					$links[] = "<a class='nav-tab nav-tab-active' href='?page=".$this->subslug."&tab=$tab'>$name</a>";
				else :
					$links[] = "<a class='nav-tab' href='?page=".$this->subslug."&tab=$tab'>$name</a>";
				endif;
			endforeach;
			foreach ( $links as $link )
				echo $link;
	}

	function get_tab_content() {
		$screen = get_current_screen();
		if( strstr($screen->id, $this->subslug ) ) {
			if ( isset ( $_GET['tab'] ) ) {
				$tab = $_GET['tab'];
			} else {
				$tab = $this->default_tab;
			}
			require_once uupro20_recaptcha_path.'admin/tabs/'.$tab.'.php';
		}
	}
	
	
	
	function admin_page() {
		
		
		global $xoouserultra;		
		
		if (isset($_POST['update_settings']) &&  $_POST['reset_email_template']=='') {
            $xoouserultra->xoouseradmin->update_settings();
        }
		
			
				
	?>
	
		<div class="wrap <?php echo $this->slug; ?>-admin">
        
           <h2>USERS ULTRA PRO 2.0 - <?php _e('reCaptcha','users-ultra-pro-recaptcha'); ?></h2>
           
           <div id="icon-users" class="icon32"></div>
			
						
			<h2 class="nav-tab-wrapper"><?php $this->admin_tabs(); ?></h2>

			<div class="<?php echo $this->slug; ?>-admin-contain">
            
				<?php $this->get_tab_content(); ?>                
				
				<div class="clear"></div>
				
			</div>
			
		</div>

	<?php }
	
	function add_front_end_scripts() {
		
		wp_enqueue_script( 'uupro20_recaptcha_js', 'https://www.google.com/recaptcha/api.js' );
		
	}
	
	function recaptcha_field() {
		
		global  $xoouserultra;
		
		$RECAPTCHA_SITE_KEY = $xoouserultra->get_option('recaptcha_site_key');
		$RECAPTCHA_SECRET_KEY= $xoouserultra->get_option('recaptcha_secret_key');
    
		$html = '
		<fieldset>
			<label>'.__( "Are you human?", "users-ultra-pro-recaptcha" ).'</label>
			<div class="field">
				<div class="g-recaptcha" data-sitekey="'.$RECAPTCHA_SITE_KEY.'"></div>
			</div>
		</fieldset>';
		
		return $html;
	
	}
	
	function validate_recaptcha_field($grecaptcharesponse) {		
		
		global  $xoouserultra;
		
		$RECAPTCHA_SITE_KEY = $xoouserultra->get_option('recaptcha_site_key');
		$RECAPTCHA_SECRET_KEY= $xoouserultra->get_option('recaptcha_secret_key');    
		
		$response = wp_remote_get( add_query_arg( array(
			'secret'   => $RECAPTCHA_SECRET_KEY,
			'response' => $grecaptcharesponse,
			'remoteip' => isset( $_SERVER['HTTP_X_FORWARDED_FOR'] ) ? $_SERVER['HTTP_X_FORWARDED_FOR'] : $_SERVER['REMOTE_ADDR']
		), 'https://www.google.com/recaptcha/api/siteverify' ) );
		
		if ( is_wp_error( $response ) || empty( $response['body'] ) || ! ( $json = json_decode( $response['body'] ) ) || ! $json->success ) {
						
			$result = false;
			
		}else{
			
			$result = true;
			
		}
		
		return $result;
	}

}
?>