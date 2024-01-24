<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'RoslynElatedWelcomePage' ) ) {
	class RoslynElatedWelcomePage {
		
		/**
		 * Singleton class
		 */
		private static $instance;
		
		/**
		 * Get the instance of RoslynElatedWelcomePage
		 *
		 * @return self
		 */
		public static function getInstance() {
			if ( ! ( self::$instance instanceof self ) ) {
				self::$instance = new self();
			}
			
			return self::$instance;
		}
		
		/**
		 * Constructor
		 */
		private function __construct() {
			
			// Theme activation hook
			add_action( 'after_switch_theme', array( $this, 'initActivationHook' ) );
			
			// Welcome page redirect on theme activation
			add_action( 'admin_init', array( $this, 'welcomePageRedirect' ) );
			
			// Add welcome page into theme options
			add_action( 'admin_menu', array( $this, 'addWelcomePage' ), 12 );
			
			//Enqueue theme welcome page scripts
			add_action( 'roslyn_elated_admin_scripts_init', array( $this, 'enqueueStyles' ) );
		}
		
		/**
		 * Init hooks on theme activation
		 */
		function initActivationHook() {
			
			if ( ! is_network_admin() ) {
				set_transient( '_roslyn_elated_welcome_page_redirect', 1, 30 );
			}
		}
		
		/**
		 * Redirect to welcome page on theme activation
		 */
		function welcomePageRedirect() {
			
			// If no activation redirect, bail
			if ( ! get_transient( '_roslyn_elated_welcome_page_redirect' ) ) {
				return;
			}
			
			// Delete the redirect transient
			delete_transient( '_roslyn_elated_welcome_page_redirect' );
			
			// If activating from network, or bulk, bail
			if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
				return;
			}
			
			// Redirect to welcome page
			wp_safe_redirect( add_query_arg( array( 'page' => 'roslyn_elated_welcome_page' ), esc_url( admin_url( 'themes.php' ) ) ) );
			exit;
		}
		
		/**
		 * Add welcome page
		 */
		function addWelcomePage() {
			
			add_theme_page(
				esc_html__( 'About', 'roslyn' ),
				esc_html__( 'About', 'roslyn' ),
				current_user_can( 'edit_theme_options' ),
				'roslyn_elated_welcome_page',
				array( $this, 'welcomePageContent' )
			);
			
			remove_submenu_page( 'themes.php', 'roslyn_elated_welcome_page' );
		}
		
		/**
		 * Print welcome page content
		 */
		function welcomePageContent() {
			$eltdf_theme              = wp_get_theme();
			$eltdf_theme_name         = esc_html( $eltdf_theme->get( 'Name' ) );
			$eltdf_theme_description  = esc_html( $eltdf_theme->get( 'Description' ) );
			$eltdf_theme_version      = $eltdf_theme->get( 'Version' );
			$eltdf_theme_screenshot   = file_exists( ELATED_ROOT_DIR . '/screenshot.png' ) ? ELATED_ROOT . '/screenshot.png' : ELATED_ROOT . '/screenshot.jpg';
			$eltdf_welcome_page_class = 'eltdf-welcome-page-' . ELATED_PROFILE_SLUG;
			?>
			<div class="wrap about-wrap eltdf-welcome-page <?php echo esc_attr( $eltdf_welcome_page_class ); ?>">
				<div class="eltdf-welcome-page-content">
					<div class="eltdf-welcome-page-logo">
						<img src="<?php echo esc_url( roslyn_elated_get_skin_uri() . '/assets/img/logo.png' ); ?>" alt="<?php esc_attr_e( 'Profile Logo', 'roslyn' ); ?>" />
					</div>
					<h1 class="eltdf-welcome-page-title">
						<?php echo sprintf( esc_html__( 'Welcome to %s', 'roslyn' ), $eltdf_theme_name ); ?>
						<small><?php echo esc_html( $eltdf_theme_version ) ?></small>
					</h1>
					<div class="about-text eltdf-welcome-page-text">
						<?php echo sprintf( esc_html__( 'Thank you for installing %s - %s! Everything in %s is streamlined to make your website building experience as simple and fun as possible. We hope you love using it to make a spectacular website.', 'roslyn' ),
							$eltdf_theme_name,
							$eltdf_theme_description,
							$eltdf_theme_name
						); ?>
						<img src="<?php echo esc_url( $eltdf_theme_screenshot ); ?>" alt="<?php esc_attr_e( 'Theme Screenshot', 'roslyn' ); ?>" />
						
						<h4><?php esc_html_e( 'Useful Links:', 'roslyn' ); ?></h4>
						<ul class="eltdf-welcome-page-links">
							<li>
								<a href="<?php echo sprintf('https://%s.ticksy.com/', ELATED_PROFILE_SLUG ); ?>" target="_blank"><?php esc_html_e( 'Support Forum', 'roslyn' ); ?></a>
							</li>
							<li>
								<a href="<?php echo sprintf('http://roslyn.%s-themes.com/documentation/', ELATED_PROFILE_SLUG ); ?>" target="_blank"><?php esc_html_e( 'Theme Documentation', 'roslyn' ); ?></a>
							</li>
							<li>
								<a href="<?php echo sprintf('https://themeforest.net/user/%s-themes/portfolio/', ELATED_PROFILE_SLUG ); ?>" target="_blank"><?php esc_html_e( 'All Our Themes', 'roslyn' ); ?></a>
							</li>
							<li>
								<a href="<?php echo add_query_arg( array( 'page' => 'install-required-plugins&plugin_status=install' ), esc_url( admin_url( 'themes.php' ) ) ); ?>"><?php esc_html_e( 'Install Required Plugins', 'roslyn' ); ?></a>
							</li>
						</ul>
					</div>
				</div>
			</div>
			<?php
		}
		
		/**
		 * Enqueue theme welcome page scripts
		 */
		function enqueueStyles() {
			wp_enqueue_style( 'roslyn-elated-welcome-page-style', ELATED_FRAMEWORK_ADMIN_ASSETS_ROOT . '/css/eltdf-welcome-page.css' );
		}
	}
}

RoslynElatedWelcomePage::getInstance();