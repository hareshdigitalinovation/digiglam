<?php

class MailsterWPML {

	private $plugin_path;
	private $plugin_url;
	private $temp_lang = null;

	public function __construct() {

		$this->plugin_path = plugin_dir_path( MAILSTER_WPML_FILE );
		$this->plugin_url  = plugin_dir_url( MAILSTER_WPML_FILE );

		register_activation_hook( MAILSTER_WPML_FILE, array( &$this, 'activate' ) );
		register_deactivation_hook( MAILSTER_WPML_FILE, array( &$this, 'deactivate' ) );

		load_plugin_textdomain( 'mailster-wpml' );

		add_action( 'init', array( &$this, 'init' ) );
	}


	/**
	 *
	 *
	 * @param unknown $network_wide
	 */
	public function activate( $network_wide ) {

		if ( function_exists( 'mailster' ) ) {

			$defaults = array(
				'_flush_rewrite_rules' => true,
			);

			$mailster_options = mailster_options();

			foreach ( $defaults as $key => $value ) {
				if ( ! isset( $mailster_options[ $key ] ) ) {
					mailster_update_option( $key, $value );
				}
			}
		}
	}


	/**
	 *
	 *
	 * @param unknown $network_wide
	 */
	public function deactivate( $network_wide ) {

		if ( function_exists( 'mailster' ) ) {
		}

	}


	/**
	 * init function.
	 *
	 * init the plugin
	 *
	 * @access public
	 * @return void
	 */
	public function init() {

		if ( ! function_exists( 'mailster' ) || ! defined( 'ICL_LANGUAGE_CODE' ) ) {

		} else {

			add_filter( 'mailster_redirect_to', array( &$this, 'redirect_to' ), 1, 3 );
			add_filter( 'is_mailster_newsletter_homepage', array( &$this, 'is_mailster_newsletter_homepage' ), 10, 2 );
			add_filter( 'mailster_rewrite_rules', array( &$this, 'mailster_rewrite_rules' ) );
			add_filter( 'admin_enqueue_scripts', array( &$this, 'wp_dequeue_script' ) );
			add_filter( 'mailster_section_tab_texts', array( &$this, 'text_tab' ) );
			add_action( 'mailster_text', array( &$this, 'mailster_text' ), 1, 3 );

			add_filter( 'mailster_setting_sections', array( &$this, 'settings_tab' ), 1 );
			add_action( 'mailster_section_tab_wpml_texts', array( &$this, 'text_tab' ) );
			add_action( 'admin_enqueue_scripts', array( &$this, 'admin_enqueue_scripts' ) );
			add_action( 'mailster_verify_subscriber', array( &$this, 'add_language' ) );

			add_filter( 'mailster_placeholder_custom', array( &$this, 'replace_campaign_strings' ), 1, 3 );

			add_action( 'mailster_frontpage', array( &$this, 'frontpage' ) );
			add_action( 'mailster_subscriber_after_meta', array( &$this, 'after_meta' ) );
			add_action( '_mailster_get_last_post_args', array( &$this, 'get_last_post_args' ), 10, 6 );

		}

	}


	public function get_last_post_args( $args, $offset, $post_type, $term_ids, $campaign_id, $subscriber_id ) {

		global $sitepress;
		if ( $campaign_id ) {
			$language = apply_filters( 'wpml_post_language_details', null, $campaign_id );
			if ( ! is_wp_error( $language ) ) {
				$sitepress->switch_lang( $language['language_code'] );
			}
		}

		$args['suppress_filters'] = false;

		return $args;
	}

	public function add_language( $entry ) {

		// add current language only on the front end
		if ( ! is_admin() ) {
			$entry['lang'] = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : mailster_get_lang();
		}

		return $entry;

	}

	public function admin_enqueue_scripts( $settings ) {
		$screen = get_current_screen();

		if ( $screen && $screen->id == 'newsletter' ) {
			wp_enqueue_script( 'mailster-wpml-newsletter', $this->plugin_url . '/assets/js/newsletter-script.js', array( 'jquery' ), MAILSTER_WPML_VERSION, true );
			wp_enqueue_style( 'mailster-wpml-newsletter', $this->plugin_url . '/assets/css/newsletter-style.css', array(), MAILSTER_WPML_VERSION );
			wp_add_inline_style( 'mailster-newsletter', '[id^="icl_"].postbox{display:inherit;}' );
		}

	}

	public function settings_tab( $settings ) {

		if ( isset( $settings['texts'] ) ) {
			unset( $settings['texts'] );
		}
		$position = 5;
		$settings = array_slice( $settings, 0, $position, true ) +
					array( 'wpml_texts' => 'Text Strings' ) +
					array_slice( $settings, $position, null, true );

		return $settings;
	}


	public function frontpage() {

		if ( $lang = apply_filters( 'wpml_post_language_details', null, null ) ) {
			$this->temp_lang = $lang['language_code'];
		}
	}


	public function mailster_text( $string, $option, $fallback ) {

		global $mailster_wpml_texts;
		if ( empty( $mailster_wpml_texts ) ) {
			$mailster_wpml_texts = get_option( 'mailster_wpml_texts', get_option( 'mailster_texts', array() ) );
		}
		if ( $this->temp_lang && isset( $mailster_wpml_texts[ $this->temp_lang ] ) ) {
			$lang = $this->temp_lang;
		} else {
			$lang = defined( 'ICL_LANGUAGE_CODE' ) ? ICL_LANGUAGE_CODE : $this->get_default_language();
		}

		$string = isset( $mailster_wpml_texts[ $lang ][ $option ] ) ? $mailster_wpml_texts[ $lang ][ $option ] : $fallback;

		return apply_filters( 'mailster_wpml_text', $string, $option, $fallback );

	}

	public function replace_campaign_strings( $args, $campaign_id, $subscriber_id ) {

		if ( $subscriber_id && $lang = $this->get_subscriber_lang( $subscriber_id ) ) {
			$this->temp_lang            = $lang;
			$args['webversionlinktext'] = mailster_text( 'webversion' );
			$args['unsublinktext']      = mailster_text( 'unsubscribelink' );
			$args['forwardlinktext']    = mailster_text( 'forward' );
			$args['profilelinktext']    = mailster_text( 'profile' );
			$this->temp_lang            = null;
		}

		return $args;
	}

	public function get_default_language() {
		global $sitepress;
		return $sitepress->get_default_language();
	}

	public function wp_dequeue_script() {
		$screen = get_current_screen();
		if ( ! $screen ) {
			return;
		}

		if ( $screen->post_type != 'newsletter' || $screen->id == 'edit-newsletter' ) {
			return;
		}

		wp_dequeue_script( 'post-edit-languages' );
	}


	public function after_meta( $subscriber ) {

		$lang = mailster( 'subscribers' )->meta( $subscriber->ID, 'lang' );

		?>
		<div class="detail">
		<label for="mailster_lang"><?php esc_html_e( 'Language', 'mailster-wpml' ); ?>:</label>
		<select name="mailster_data[lang]" id="mailster_lang">
			<option value=""><?php esc_html_e( 'not defined', 'mailster-wpml' ); ?></option>
		<?php
		$languages = icl_get_languages();
		foreach ( $languages as $id => $language ) {
			?>
			<option value="<?php echo $language['code']; ?>" <?php selected( $language['code'], $lang ); ?> ><?php echo $language['translated_name']; ?> (<?php echo $language['code']; ?>)</option>
		<?php } ?>
		</select>
		</div>
		<?php
	}

	public function text_tab() {

		$languages = icl_get_languages();

		wp_enqueue_script( 'mailster-wpml-settings', $this->plugin_url . '/assets/js/settings-script.js', array( 'jquery' ), MAILSTER_WPML_VERSION, true );

		echo '<div class="hidden">';
		include MAILSTER_DIR . '/views/settings/texts.php';
		echo '</div>';

		echo '<div id="wpml-text-nav" class="nav-tab-wrapper hide-if-no-js">';
		echo '<style>.language-switcher-field{display:none}</style>';
		foreach ( $languages as $code => $language ) {
			echo '<a class="nav-tab" href="#lang-' . $code . '">' . $language['translated_name'] . '</a>';
		}
		echo '</div>';

		foreach ( $languages as $code => $language ) {

			$this->current_tab_language = $code;
			ob_start();

			add_action( 'mailster_text', array( &$this, 'text_tab_translations' ), 1, 3 );

			echo '<div class="wpml-text-tab" id="tab-lang-' . $code . '">';
			echo '<div class="error inline"><h4>' . esc_html__( sprintf( 'Please define the texts for the %s Language!', $language['translated_name'] ), 'mailster-wpml' ) . '</h4></div>';
			include MAILSTER_DIR . '/views/settings/texts.php';
			echo '</div>';

			$output = ob_get_contents();

			ob_end_clean();

			$output = str_replace( 'name="mailster_texts[', 'name="mailster_texts[' . $code . '][', $output );

			echo $output;
			remove_action( 'mailster_text', array( &$this, 'text_tab_translations' ), 1, 3 );

		}

	}

	public function text_tab_translations( $string, $option, $fallback ) {

		global $mailster_wpml_texts;
		if ( empty( $mailster_wpml_texts ) ) {
			$mailster_wpml_texts = get_option( 'mailster_wpml_texts', array() );
		}
		$default = $this->current_tab_language;
		if ( ! isset( $mailster_wpml_texts[ $default ] ) ) {
			$mailster_wpml_texts[ $default ] = get_option( 'mailster_texts', array() );
		}

		$string = isset( $mailster_wpml_texts[ $default ][ $option ] ) ? $mailster_wpml_texts[ $default ][ $option ] : $fallback;

		return $string;

	}

	public function get_translation_post_ids( $post ) {
		global $sitepress;
		$post         = get_post( $post );
		$trid         = $sitepress->get_element_trid( $post->ID );
		$translations = $sitepress->get_element_translations( $trid );
		$ids          = wp_list_pluck( $translations, 'element_id' );
		return $ids;
	}

	public function mailster_rewrite_rules( $rules ) {

		$slugs = implode( '|', (array) mailster_option( 'slugs', array( 'confirm', 'subscribe', 'unsubscribe', 'profile' ) ) );

		$homepage                  = mailster_option( 'homepage' );
		$language_negotiation_type = apply_filters( 'wpml_setting', false, 'language_negotiation_type' );
		$translations              = $this->get_translation_post_ids( $homepage );

		foreach ( $translations as $lang => $post_id ) {
			if ( $homepage == $post_id ) {
				continue;
			}
			$pagename = get_page_uri( $post_id );
			if ( 3 == $language_negotiation_type ) {
				$pagename = untrailingslashit( remove_query_arg( 'lang', $pagename ) );
				$rules[ '(index\.php/)?(' . preg_quote( $pagename ) . ')/(' . $slugs . ')?/?([a-f0-9]{32})?/?([a-z0-9]*)?' ] = 'index.php?pagename=' . preg_replace( '#\.html$#', '', $pagename ) . '&_mailster_page=$matches[3]&_mailster_hash=$matches[4]&_mailster_extra=$matches[5]';

			} elseif ( 2 == $language_negotiation_type ) {

			} elseif ( 1 == $language_negotiation_type ) {
				$pagename = ltrim( $pagename, $lang . '/' );
				$rules[ '(index\.php/)?(' . preg_quote( $pagename ) . ')/(' . $slugs . ')?/?([a-f0-9]{32})?/?([a-z0-9]*)?' ] = 'index.php?pagename=' . preg_replace( '#\.html$#', '', $pagename ) . '&_mailster_page=$matches[3]&_mailster_hash=$matches[4]&_mailster_extra=$matches[5]';
			} else {
				break;
			}
		}

		return $rules;
	}

	public function is_mailster_newsletter_homepage( $is_homepage, $post ) {

		if ( $is_homepage ) {
			return true;
		}
		$homepage     = mailster_option( 'homepage' );
		$translations = $this->get_translation_post_ids( $homepage );
		return $post && in_array( $post->ID, $translations );
	}

	public function redirect_to( $redirect_to, $campaign_id, $subscriber_id ) {

		$org_redirect_to = $redirect_to;

		if ( $subscriber_id && $lang = $this->get_subscriber_lang( $subscriber_id ) ) {
			$languages = icl_get_languages();
			if ( isset( $languages[ $lang ] ) ) {
				$redirect_to = apply_filters( 'wpml_permalink', $redirect_to, $lang );
			}
		}

		return $redirect_to;

	}


	private function get_subscriber_lang( $subscriber_id, $fallback_lang = null ) {
		if ( $subscriber_id && $lang = mailster( 'subscribers' )->meta( $subscriber_id, 'lang' ) ) {
			return $lang;
		}

		if ( is_null( $fallback_lang ) ) {
			$fallback_lang = $this->get_default_language();
		}

		return $fallback_lang;

	}

}
