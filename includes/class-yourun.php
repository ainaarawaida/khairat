<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       yourun
 * @since      1.0.0
 *
 * @package    Yourun
 * @subpackage Yourun/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Yourun
 * @subpackage Yourun/includes
 * @author     yourun <yourun>
 */
class Yourun {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Yourun_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'YOURUN_VERSION' ) ) {
			$this->version = YOURUN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'yourun';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Yourun_Loader. Orchestrates the hooks of the plugin.
	 * - Yourun_i18n. Defines internationalization functionality.
	 * - Yourun_Admin. Defines all hooks for the admin area.
	 * - Yourun_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-yourun-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-yourun-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-yourun-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-yourun-public.php';

		$this->loader = new Yourun_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Yourun_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Yourun_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Yourun_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Yourun_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );

		$this->loader->add_action( 'template_redirect', $plugin_public, 'yourun_template_redirect', 99 );

		//woo register
		$this->loader->add_action( 'woocommerce_register_form', $plugin_public, 'yourun_woocommerce_register_form' );
		$this->loader->add_action( 'woocommerce_created_customer', $plugin_public, 'yourun_woocommerce_created_customer', 10, 3 );


		//hideadmintoolbar
		$this->loader->add_action('init', $plugin_public, 'yourun_init', 9);

		//woo my account
		$this->loader->add_filter( 'woocommerce_account_menu_items', $plugin_public, 'yourun_woocommerce_account_menu_items' );
		$this->loader->add_action( 'woocommerce_account_dashboard', $plugin_public, 'yourun_woocommerce_account_dashboard' );



		//woo my account menu additional
		$this->loader->add_action( 'woocommerce_account_daftarkariah_endpoint', $plugin_public, 'yourun_woocommerce_account_daftarkariah_endpoint' );
		$this->loader->add_action( 'woocommerce_account_daftarahli_endpoint', $plugin_public, 'yourun_woocommerce_account_daftarahli_endpoint' );
		$this->loader->add_action( 'woocommerce_account_maklumatahli_endpoint', $plugin_public, 'yourun_woocommerce_account_maklumatahli_endpoint' );
		$this->loader->add_action( 'woocommerce_after_edit_account_form', $plugin_public, 'yourun_woocommerce_after_edit_account_form' );
		

		//wo login redirect
		$this->loader->add_filter( 'woocommerce_registration_redirect', $plugin_public, 'yourun_woocommerce_registration_redirect', 10, 1 );
		$this->loader->add_filter( 'woocommerce_login_redirect', $plugin_public, 'yourun_woocommerce_login_redirect', 9999, 2 );


	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Yourun_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}











