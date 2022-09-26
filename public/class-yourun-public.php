<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       yourun
 * @since      1.0.0
 *
 * @package    Yourun
 * @subpackage Yourun/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Yourun
 * @subpackage Yourun/public
 * @author     yourun <yourun>
 */
class Yourun_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Yourun_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Yourun_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/yourun-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Yourun_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Yourun_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/yourun-public.js', array( 'jquery' ), $this->version, false );

	}

	public function yourun_template_redirect(){
		global $wp ;

	
		if(isset($wp->query_vars) && isset($wp->query_vars['pagename']) && $wp->query_vars['pagename'] === 'my-account'){
			require_once YOURUN_PATH . '/public/my_account.php' ;

		}



	}


	public function yourun_woocommerce_register_form(){
		require_once YOURUN_PATH . '/public/yourun_woocommerce_register_form.php' ;

	}


	public function yourun_woocommerce_created_customer($customer_id, $new_customer_data, $password_generated){
		
		if($_POST['type_reg'] === 'pentadbir'){
			$updated = update_user_meta( $customer_id, 'wp_capabilities', array('pentadbir' => 1) );
			$updated = update_user_meta( $customer_id, 'stage_daftar', 0 );
		}

		if($_POST['type_reg'] === 'ahli'){
			$updated = update_user_meta( $customer_id, 'wp_capabilities', array('ahli' => 1) );
			$updated = update_user_meta( $customer_id, 'stage_daftar', 0 );
			$updated = update_user_meta( $customer_id, 'select_kariah', $_POST['select_kariah'] );
		}

	}

	public function yourun_init(){
			if(current_user_can('pentadbir') || current_user_can('ahli'))
		{
			add_filter( 'show_admin_bar', '__return_false' );

		}
		add_rewrite_endpoint( 'daftarkariah', EP_PAGES );
		add_rewrite_endpoint( 'daftarahli', EP_PAGES );
		add_rewrite_endpoint( 'maklumatahli', EP_PAGES );

	}


	public function yourun_woocommerce_account_daftarkariah_endpoint() {
		require_once YOURUN_PATH . '/public/daftarkariah.php' ;
	}
	public function yourun_woocommerce_account_daftarahli_endpoint() {
		require_once YOURUN_PATH . '/public/daftarahli.php' ;
	}
	public function yourun_woocommerce_account_maklumatahli_endpoint() {
		require_once YOURUN_PATH . '/public/maklumatahli.php' ;
	}

	public function yourun_woocommerce_account_menu_items( $menu_links ){
		$current_user = wp_get_current_user() ; 
		$stage_daftar = get_user_meta( get_current_user_id(), 'stage_daftar', true ) ;
		// Check if the role you're interested in, is present in the array.
		
		
		if ( array_key_exists('pentadbir', $current_user->allcaps)){
			
			if($stage_daftar == 0){
				
				unset( $menu_links[ 'dashboard' ] );
				unset( $menu_links[ 'edit-address' ] ); // Addresses
				unset( $menu_links[ 'downloads' ] ); // Disable Downloads
				unset( $menu_links[ 'orders' ] );
				$menu_links = array( 'daftarkariah' => 'Daftar Kariah' ) + $menu_links ; 
				
			}else if($stage_daftar == 1 || $stage_daftar == 2){
				unset( $menu_links[ 'edit-address' ] ); // Addresses
				unset( $menu_links[ 'downloads' ] ); // Disable Downloads
				unset( $menu_links[ 'orders' ] );
				
				$menu_links = array_slice( $menu_links, 0, 1, true ) 
				+ array( '?luqpage=kariah_senaraiahli' => 'Senarai Ahli' )
			+ array( '?luqpage=kariah_maklumatkariah' => 'Maklumat Kariah' )
			
			+ array_slice( $menu_links, 1, NULL, true );

			

				
			}

			return $menu_links;

		}else if ( array_key_exists('ahli', $current_user->allcaps)){
			
			if($stage_daftar == 0){
				
				unset( $menu_links[ 'dashboard' ] );
				unset( $menu_links[ 'edit-address' ] ); // Addresses
				unset( $menu_links[ 'downloads' ] ); // Disable Downloads
				unset( $menu_links[ 'orders' ] );
				$menu_links = array( 'daftarahli' => 'Daftar Ahli' ) + $menu_links ; 
				
			}
			if($stage_daftar == 1 || $stage_daftar == 2){
				unset( $menu_links[ 'edit-address' ] ); // Addresses
				unset( $menu_links[ 'downloads' ] ); // Disable Downloads
				unset( $menu_links[ 'orders' ] );
				
				$menu_links = array_slice( $menu_links, 0, 1, true ) 
			+ array( 'maklumatahli' => 'Maklumat Ahli' )
			+ array_slice( $menu_links, 1, NULL, true );


				
			}


			return $menu_links;

		}else if ( !in_array( 'customer', $current_user->roles, true ) &&  !in_array( 'administrator', $current_user->roles, true ) ) {
			unset( $menu_links[ 'edit-address' ] ); // Addresses
			unset( $menu_links[ 'downloads' ] ); // Disable Downloads
			unset( $menu_links[ 'orders' ] );
			
			$menu_links = array_slice( $menu_links, 0, 1, true ) 
			+ array( 'daftarkariah' => 'Daftar Kariah' )
			+ array_slice( $menu_links, 1, NULL, true );

			
			
			return $menu_links;	
			

		}

		
		

		// deb($current_user->roles);exit();
		//unset( $menu_links[ 'dashboard' ] ); // Remove Dashboard
		//unset( $menu_links[ 'payment-methods' ] ); // Remove Payment Methods
		//unset( $menu_links[ 'orders' ] ); // Remove Orders
		//unset( $menu_links[ 'downloads' ] ); // Disable Downloads
		//unset( $menu_links[ 'edit-account' ] ); // Remove Account details tab
		//unset( $menu_links[ 'customer-logout' ] ); // Remove Logout link
		
		return $menu_links;
		
	}

	public function yourun_woocommerce_registration_redirect( $redirection_url ){
		
		$current_user = wp_get_current_user() ; 
		$stage_daftar = get_user_meta( get_current_user_id(), 'stage_daftar', true ) ;
		
	
		// deb(array_key_exists('pentadbir', $current_user->allcaps));
		// deb($stage_daftar);exit();
	
		if ( array_key_exists('pentadbir', $current_user->allcaps)){
	
			if($stage_daftar == 0){
				
					// Change the redirection Url
					$redirection_url = get_home_url()."/my-account/daftarkariah";
					
			}
		}

		if ( array_key_exists('ahli', $current_user->allcaps)){
	
			if($stage_daftar == 0){
					// Change the redirection Url
					$redirection_url = get_home_url()."/my-account/daftarahli"; 
			}
		}
		
	
		return $redirection_url; // Always return something
	}

	public function yourun_woocommerce_after_edit_account_form(){
		require_once YOURUN_PATH . '/public/yourun_woocommerce_after_edit_account_form.php' ;
	}
	

	public function yourun_woocommerce_login_redirect( $redirection_url, $user ) {
		$current_user = wp_get_current_user() ; 
		$stage_daftar = get_user_meta( get_current_user_id(), 'stage_daftar', true ) ;
	
		if ( array_key_exists('pentadbir', $current_user->allcaps)){
	
			if($stage_daftar == 0){
					// Change the redirection Url
					$redirection_url = get_home_url()."/my-account/daftarkariah"; 
			}
		}

		if ( array_key_exists('ahli', $current_user->allcaps)){
	
			if($stage_daftar == 0){
					// Change the redirection Url
					$redirection_url = get_home_url()."/my-account/daftarahli"; 
			}
		}
		
	
		return $redirection_url;
	}


	public function yourun_woocommerce_account_dashboard(){
		global $wp , $wpdb ; 
		$current_user = wp_get_current_user() ; 

		if ( array_key_exists('pentadbir', $current_user->allcaps)){
			$check_author_site_name = $wpdb->get_results( 
				$wpdb->prepare("SELECT ID,post_name,post_title FROM {$wpdb->prefix}posts WHERE post_type =%s AND post_author = %d", array('yourun_page_name', get_current_user_id())) 
			);

		}

		// require_once YOURUN_PATH . '/public/clearDashboard.php' ;

		if($_GET['luqpage'] && str_contains($_GET['luqpage'], 'kariah_maklumatkariah')){
			require_once YOURUN_PATH . '/public/kariah_maklumatkariah.php' ;

		}else if($_GET['luqpage'] && str_contains($_GET['luqpage'], 'kariah_senaraiahli')){
			if($_GET['kariah_senaraiahli_edit']){
				require_once YOURUN_PATH . '/public/kariah_senaraiahli_edit.php' ;
			}else if($_GET['kariah_daftarahli']){
				require_once YOURUN_PATH . '/public/kariah_daftarahli.php' ;
			}else if($_GET['kariah_senaraiahlixaktif']){
				require_once YOURUN_PATH . '/public/kariah_senaraiahlixaktif.php' ;
			}else{
				
				require_once YOURUN_PATH . '/public/kariah_senaraiahli.php' ;
			}
			

		}else{
			if ( array_key_exists('pentadbir', $current_user->allcaps)){
				require_once YOURUN_PATH . '/public/kariah_dashboard.php' ;
			}else{
				require_once YOURUN_PATH . '/public/ahli_dashboard.php' ;
			}
			

		}
		


	}


}
