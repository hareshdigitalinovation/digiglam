<?php
/*
  Plugin Name: WPCS - WordPress Currency Switcher
  Plugin URI: https://wp-currency.com/
  Description: Currency Switcher for WordPress - plugin that allows to switch currencies and get their rates converted in the real time on your site!
  Author: realmag777
  Version: 1.2.0.1
  Requires at least: WP 3.5.0
  Tested up to: WP 6.4
  Text Domain: currency-switcher
  Domain Path: /languages
  Forum URI: https://pluginus.net/support/forum/wpcs-wordpress-currency-switcher/
  Author URI: https://pluginus.net/
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

//***
define('WPCS_VERSION', '1.2.0.1');
//define('WPCS_VERSION', uniqid('wpcs-')); //for dev
define('WPCS_PATH', plugin_dir_path(__FILE__));
define('WPCS_LINK', plugin_dir_url(__FILE__));
define('WPCS_PLUGIN_NAME', plugin_basename(__FILE__));

//classes and libs
include_once WPCS_PATH . 'lib/geo-ip/geoip.inc';
include_once WPCS_PATH . 'classes/storage.php';
include_once WPCS_PATH . 'classes/auto_switcher.php';
include_once WPCS_PATH . 'classes/smart-designer.php';
include_once WPCS_PATH . 'classes/world_currencies.php';

//05-10-2023
final class WPCS {

    public $storage = null;
    public $options = array();
    public $default_currency = 'USD';
    public $current_currency = 'USD';
    public $currency_positions = array();
    public $currency_symbols = array();
    public $is_multiple_allowed = false; //from options
    public $decimal_sep = '.';
    public $thousands_sep = ',';
    public $rate_auto_update = ''; //from options
    public $shop_is_cached = true;
    private $is_first_unique_visit = false;
    public $no_cents = array('JPY', 'TWD'); //recount price without cents always!!
    public $bones = array(
        'reset_in_multiple' => false//normal is false
    ); //just for some setting for current wp theme adapting - for support only - it is logic hack - be care!!
    public $show_notes = true;
    public $world_currencies = null;

    public function __construct() {
        $this->options = get_option('wpcs_settings', array());
        $this->storage = new WPCS_STORAGE($this->get_option('wpcs_storage', 'transient'));
        $this->world_currencies = new WPCS_World_Currencies();

        $this->init_no_cents();
        if (!defined('DOING_AJAX')) {
            //we need it if shop uses cache plugin, in such way prices will be redraw by AJAX
            $this->shop_is_cached = $this->get_option('wpcs_shop_is_cached', 0);
        }
        //+++
        //auto switcher
        if (isset($this->options['is_auto_switcher']) AND $this->options['is_auto_switcher']) {
            $auto_switcher = new WPCS_AUTO_SWITCHER($this->options);
            $auto_switcher->init();
        }


        $currencies = $this->get_currencies();
        if (!empty($currencies) AND is_array($currencies)) {
            foreach ($currencies as $key => $currency) {
                if ($currency['is_etalon']) {
                    $this->default_currency = $key;
                    break;
                }
            }
        }

        //+++
        /*
          if (!$this->storage->is_isset('wpcs_first_unique_visit'))
          {
          $this->storage->set_val('wpcs_first_unique_visit', 0);
          }
         */

        $this->is_multiple_allowed = $this->get_option('wpcs_is_multiple_allowed', 0);
        $this->rate_auto_update = $this->get_option('wpcs_currencies_rate_auto_update', 0);
        //+++
        $this->currency_positions = array('left', 'right', 'left_space', 'right_space');
        $this->init_currency_symbols();

        $this->decimal_sep = $this->get_option('wpcs_decimal_separator', '.');
        $this->thousands_sep = $this->get_option('wpcs_thousandth_separator', ',');
        //+++
        $is_first_activation = (int) get_option('wpcs_first_activation', 0);
        if (!$is_first_activation) {
            update_option('wpcs_first_activation', 1);
            //maybe I will need it
        }

        //WELCOME USER CURRENCY ACTIVATION
        if ((int) $this->storage->get_val('wpcs_first_unique_visit') === 0) {
            $this->is_first_unique_visit = true;
            $this->storage->set_val('wpcs_current_currency', $this->get_welcome_currency());
            $this->storage->set_val('wpcs_first_unique_visit', 1);
        }

        //+++
        if (isset($_REQUEST['currency-switcher'])) {
            if (array_key_exists($_REQUEST['currency-switcher'], $currencies)) {
                $this->storage->set_val('wpcs_current_currency', $this->escape($_REQUEST['currency-switcher']));
            } else {
                $this->storage->set_val('wpcs_current_currency', $this->default_currency);
            }
        }
        //+++
        //*** check currency in browser link
        if (isset($_GET['currency']) AND!empty($_GET['currency'])) {
            if (array_key_exists(strtoupper($_GET['currency']), $currencies)) {
                $this->storage->set_val('wpcs_current_currency', strtoupper($this->escape($_GET['currency'])));
            }
        }
        //+++
        if ($this->storage->is_isset('wpcs_current_currency')) {
            $this->current_currency = $this->storage->get_val('wpcs_current_currency');
        } else {

            $this->current_currency = $this->default_currency;
        }
        //$this->storage->set_val('wpcs_default_currency', $this->default_currency);
        //+++ AJAX ACTIONS
        add_action('wp_ajax_wpcs_save_etalon', array($this, 'save_etalon'));
        add_action('wp_ajax_wpcs_get_rate', array($this, 'get_rate'));

        add_action('wp_ajax_wpcs_add_currencies', array($this, 'add_currencies_ajax'));

        add_action('wp_ajax_wpcs_convert_currency', array($this, 'wpcs_convert_currency'));
        add_action('wp_ajax_nopriv_wpcs_convert_currency', array($this, 'wpcs_convert_currency'));

        add_action('wp_ajax_wpcs_rates_current_currency', array($this, 'wpcs_rates_current_currency'));
        add_action('wp_ajax_nopriv_wpcs_rates_current_currency', array($this, 'wpcs_rates_current_currency'));

        add_action('wp_ajax_wpcs_get_prices_html', array($this, 'wpcs_get_prices_html'));
        add_action('wp_ajax_nopriv_wpcs_get_prices_html', array($this, 'wpcs_get_prices_html'));

        add_action('wp_ajax_wpcs_recalculate_order_data', array($this, 'wpcs_recalculate_order_data'));

        add_action('wp_ajax_wpcs_set_currency_ajax', array($this, 'wpcs_set_currency_ajax'));
        add_action('wp_ajax_nopriv_wpcs_set_currency_ajax', array($this, 'wpcs_set_currency_ajax'));
        //+++


        add_action('widgets_init', array($this, 'widgets_init'));
        add_action('wp_head', array($this, 'wp_head'), 1);
        add_action('wp_footer', array($this, 'wp_footer'), 9999);
        add_action('body_class', array($this, 'body_class'), 9999);
        //***
        add_action('admin_enqueue_scripts', array($this, 'admin_enqueue_scripts'));
        //*** additional
        add_action('wpcs_exchange_value', array($this, 'wpcs_exchange_value'), 1);

        //*************************************
        add_shortcode('wpcs', array($this, 'wpcs_shortcode'));
        add_shortcode('wpcs_code_rate', array($this, 'wpcs_code_rate'));
        add_shortcode('wpcs_converter', array($this, 'wpcs_converter'));
        add_shortcode('wpcs_rates', array($this, 'wpcs_rates'));
        add_shortcode('wpcs_current_currency', array($this, 'wpcs_current_currency'));
        add_shortcode('wpcs_price', array($this, 'wpcs_price'));
        add_shortcode('wpcs_check_country', array($this, 'wpcs_check_country'));

        //+++SHEDULER
        add_filter('cron_schedules', array($this, 'cron_schedules'), 10, 1);
        if ($this->rate_auto_update != 'no' AND!empty($this->rate_auto_update)) {
            //wp_clear_scheduled_hook('wpcs_currencies_rate_auto_update'); - just for test
            add_action('wpcs_currencies_rate_auto_update', array($this, 'rate_auto_update'));
            if (!wp_next_scheduled('wpcs_currencies_rate_auto_update')) {
                wp_schedule_event(time(), $this->rate_auto_update, 'wpcs_currencies_rate_auto_update');
            }
        }
        //***
        add_action('admin_head', array($this, 'admin_head'), 1);

        if (is_admin()) {
            //$this->rate_alert = new WPCS_RATE_ALERT($this->show_notes);
        }
    }

    public function get_option($key, $default = '') {

        $result = $default;

        if (isset($this->options[$key])) {
            $result = $this->options[$key];
        }


        return $result;
    }

    public function body_class($classes) {
        $classes[] = 'currency-' . strtolower($this->current_currency);
        return $classes;
    }

    public function init() {
        add_action('admin_menu', array($this, 'admin_menu'));

        wp_enqueue_script('jquery');
        load_plugin_textdomain('currency-switcher', false, dirname(plugin_basename(__FILE__)) . '/languages');

        //filters
        add_filter('plugin_action_links_' . WPCS_PLUGIN_NAME, array($this, 'plugin_action_links'));

        //***
        //if we use GeoLocation
        $this->init_geo_currency();
        //set default cyrrency for wp-admin of the site
        if (is_admin() AND!(defined('DOING_AJAX') && DOING_AJAX)) {
            $this->current_currency = $this->default_currency;
        } else {
            //if we are in the a product backend and loading its variations
            if ((defined('DOING_AJAX') && DOING_AJAX)) {
                //***
            }
        }

        //***
        //SHOW BUTTON ON THE TOP OF ADMIN PANEL
        add_action('admin_bar_menu', function ($wp_admin_bar) {
            if (current_user_can('manage_options')) {
                if ($this->get_option('wpcs_show_top_button', 1)) {
                    $args = array(
                        'id' => 'wpcs-btn',
                        'title' => __('Currency Options', 'currency-switcher'),
                        'href' => admin_url('options-general.php?page=currency-switcher-settings'),
                        'meta' => array(
                            'class' => 'wp-admin-bar-wpcs-btn',
                            'title' => __('Currency Switcher', 'currency-switcher')
                        )
                    );
                    $wp_admin_bar->add_node($args);
                }
            }
        }, 250);

        $this->ask_favour();
    }

    public function admin_menu() {
        add_submenu_page('options-general.php', "Currency Switcher", "Currency Switcher", 'edit_pages', "currency-switcher-settings", array($this, 'print_plugin_options'));
    }

    public function admin_head() {
        if (isset($_GET['page']) AND $_GET['page'] == 'currency-switcher-settings') {

            wp_enqueue_media();
            wp_enqueue_script('media-upload');
            wp_enqueue_style('thickbox');
            wp_enqueue_script('thickbox');

            wp_enqueue_script('jquery');
            wp_enqueue_script('jquery-ui-core');
            //***
            wp_enqueue_script('chosen-drop-down', WPCS_LINK . 'js/chosen/chosen.jquery.min.js', array('jquery'), [], WPCS_VERSION);
            wp_enqueue_style('chosen-drop-down', WPCS_LINK . 'js/chosen/chosen.min.css', [], WPCS_VERSION);
            wp_enqueue_style('wpcs-fontello', WPCS_LINK . 'css/fontello.css', array(), WPCS_VERSION);
            wp_enqueue_script('wpcs-options', WPCS_LINK . 'js/plugin_options.js', array('jquery', 'jquery-ui-core', 'jquery-ui-sortable'), WPCS_VERSION);
            wp_enqueue_script('wpcs-sd-popup23', WPCS_LINK . 'js/popup23.js', [], WPCS_VERSION);
            wp_enqueue_style('wpcs-popup-23', WPCS_LINK . 'css/popup23.css', array(), WPCS_VERSION);
            wp_enqueue_style('wpcs-options', WPCS_LINK . 'css/plugin_options.css', [], WPCS_VERSION);
            wp_enqueue_style('data-table-23', WPCS_LINK . 'css/data-table-23.css', [], WPCS_VERSION);
        }
    }

    public function print_plugin_options() {
        if (isset($_POST['wpcs_settings']) AND!empty($_POST['wpcs_settings'])) {
            check_admin_referer("wpcs_save");
            $result = array();
            update_option('wpcs_settings', $_POST['wpcs_settings']);
            $this->options = $_POST['wpcs_settings'];
            //***
            //sanitize
            $sanitized_field = array('wpcs_aggregator_key', 'wpcs_customer_signs', 'wpcs_customer_price_format', 'wpcs_decimal_separator', 'wpcs_thousandth_separator');
            foreach ($sanitized_field as $field_name) {
                if (isset($_POST['wpcs_settings'][$field_name])) {
                    $_POST['wpcs_settings'][$field_name] = sanitize_text_field($_POST['wpcs_settings'][$field_name]);
                }
            }

            if (isset($_POST['wpcs_settings']['wpcs_geo_rules'])) {
                if (!empty($_POST['wpcs_settings']['wpcs_geo_rules'])) {
                    $wpcs_geo_rules = array();
                    foreach ($_POST['wpcs_settings']['wpcs_geo_rules'] as $curr_key => $countries) {
                        $wpcs_geo_rules[$this->escape($curr_key)] = array();
                        if (!empty($countries)) {
                            foreach ($countries as $curr) {
                                $wpcs_geo_rules[$this->escape($curr_key)][] = $this->escape($curr);
                            }
                        }
                    }
                }
                update_option('wpcs_geo_rules', $wpcs_geo_rules);
            } else {
                update_option('wpcs_geo_rules', '');
            }

            //***
            $cc = '';
            foreach ($_POST['wpcs_name'] as $key => $name) {
                if (!empty($name)) {
                    $symbol = $this->escape($_POST['wpcs_symbol'][$key]); //md5 encoded

                    foreach ($this->currency_symbols as $s) {
                        if (md5($s) == $symbol) {
                            $symbol = $s;
                            break;
                        }
                    }

                    $d = array(
                        'name' => $name,
                        'rate' => floatval($_POST['wpcs_rate'][$key]),
                        'interest' => floatval($_POST['wpcs_interest'][$key]),
                        'symbol' => $symbol,
                        'position' => (in_array($this->escape($_POST['wpcs_position'][$key]), $this->currency_positions) ? $this->escape($_POST['wpcs_position'][$key]) : $this->currency_positions[0]),
                        'is_etalon' => (int) $_POST['wpcs_is_etalon'][$key],
                        'description' => $this->escape($_POST['wpcs_description'][$key]),
                        'flag' => $this->escape($_POST['wpcs_flag'][$key]),
                    );

                    if (isset($_POST['wpcs_hide_cents'][$key])) {
                        $d['hide_cents'] = (int) $_POST['wpcs_hide_cents'][$key];
                    } else {
                        $d['hide_cents'] = 0;
                    }

                    $result[strtoupper($name)] = $d;

                    if ($_POST['wpcs_rate'][$key] == 1) {
                        $cc = $name;
                    }
                }
            }

            update_option('wpcs', $result);

            $this->init_currency_symbols();
            $this->init_no_cents();

            $this->storage->set_val('wpcs_first_unique_visit', 0); //reset front initions
        }
        //+++
        wp_enqueue_script('media-upload');
        wp_enqueue_style('thickbox');
        wp_enqueue_script('thickbox');
        wp_enqueue_script('jquery');
        wp_enqueue_script('jquery-ui-core');

        $args = array();
        $args['currencies'] = $this->get_currencies();
        if ($this->is_use_geo_rules()) {
            $args['geo_rules'] = $this->get_geo_rules();
        }

        //$this->rate_alert->show_alert();

        echo $this->render_html(WPCS_PATH . 'views/plugin_options.php', $args);
    }

    public function cron_schedules($schedules) {
        // $schedules stores all recurrence schedules within WordPress
        $schedules['week'] = array(
            'interval' => WEEK_IN_SECONDS,
            'display' => sprintf(__("each %s week", 'currency-switcher'), 1)
        );

        $schedules['month'] = array(
            'interval' => WEEK_IN_SECONDS * 4,
            'display' => sprintf(__("each %s month", 'currency-switcher'), 1)
        );

        return (array) $schedules;
    }

    public function init_currency_symbols() {
        $this->currency_symbols = array(
            '&#36;', '&euro;', '&yen;', '&#1088;&#1091;&#1073;.', '&#1075;&#1088;&#1085;.', '&#8361;',
            '&#84;&#76;', 'د.إ', '&#2547;', '&#82;&#36;', '&#1083;&#1074;.',
            '&#107;&#114;', '&#82;', '&#75;&#269;', '&#82;&#77;', 'kr.', '&#70;&#116;',
            'Rp', 'Rs', 'Kr.', '&#8362;', '&#8369;', '&#122;&#322;', '&#107;&#114;',
            '&#67;&#72;&#70;', '&#78;&#84;&#36;', '&#3647;', '&pound;', 'lei', '&#8363;',
            '&#8358;', 'Kn', '-----'
        );

        $this->currency_symbols = apply_filters('wpcs_currency_symbols', array_merge($this->currency_symbols, $this->get_customer_signs()));
    }

    private function init_no_cents() {
        $currencies = $this->get_currencies();

        foreach ($currencies as $c) {
            if (isset($c['hide_cents']) AND $c['hide_cents']) {
                $no_cents[] = $c['name'];
            }
        }

        //***
        if (!empty($currencies) AND is_array($currencies)) {
            $currencies = array_keys($currencies);
            $currencies = array_map('strtolower', $currencies);
            if (!empty($no_cents)) {
                if (!empty($no_cents) AND is_array($no_cents)) {
                    foreach ($no_cents as $value) {
                        if (in_array(strtolower($value), $currencies)) {
                            $this->no_cents[] = $value;
                        }
                    }
                }
            }
        }


        return $this->no_cents;
    }

    //for auto rate update sheduler
    public function rate_auto_update() {
        $currencies = $this->get_currencies();
        //***
        $_REQUEST['no_ajax'] = TRUE;
        $request = array();
        foreach ($currencies as $key => $currency) {
            if ($currency['is_etalon'] == 1) {
                continue;
            }
            $_REQUEST['currency_name'] = $currency['name'];
            $request[$key] = (float) $this->get_rate();
        }
        //*** checking and assigning data
        foreach ($currencies as $key => $currency) {
            if ($currency['is_etalon'] == 1) {
                continue;
            }
            if (isset($request[$key]) AND!empty($request[$key]) AND $request[$key] > 0) {
                $currencies[$key]['rate'] = $request[$key];
            }
        }

        update_option('wpcs', $currencies);
    }

    public function wpcs_set_currency_ajax() {
        if (isset($_REQUEST['currency'])) {
            $currency = sanitize_text_field($_REQUEST['currency']);
            $this->storage->set_val('wpcs_current_currency', $currency);
            $this->current_currency = $currency;
        }
    }

    public function get_geoip_object() {
        $gi = geoip_open(WPCS_PATH . 'lib/GeoIP.dat', GEOIP_MEMORY_CACHE);
        return $gi;
    }

    public function add_currencies_ajax() {
        if (!wp_doing_ajax() OR!current_user_can('manage_options')) {
//we need it just only for ajax update
            return "";
        }
        $currencies = $this->get_currencies();
        $custom_signs = array();
        $new_currencies = array(); //wc_clean($_REQUEST['new_currencies']);
        if (is_array($_REQUEST['new_currencies'])) {
            foreach ($_REQUEST['new_currencies'] as $new_currency) {
                $new_currencies[] = sanitize_text_field($new_currency);
            }
        }
        $new_currencies_data = $this->world_currencies->get_currencies_data($new_currencies);
        $_REQUEST['no_ajax'] = TRUE;
        foreach ($new_currencies_data as $key => $currency) {
            $_REQUEST['currency_name'] = $currency['name'];
            $new_currencies_data[$key]['rate'] = $this->get_rate();

            if (!in_array($new_currencies_data[$key]['symbol'], $this->currency_symbols)) {
                $custom_signs[] = $new_currencies_data[$key]['symbol'];
            }
            if (isset($new_currencies_data[$key]['flag']) && $new_currencies_data[$key]['flag']) {
                $f_url = $this->download_flags($new_currencies_data[$key]['flag']);
                if ($f_url) {
                    $new_currencies_data[$key]['flag'] = $f_url;
                } else {
                    $new_currencies_data[$key]['flag'] = '';
                }
            }
        }

        $currencies = array_merge($currencies, $new_currencies_data);

        update_option('wpcs', $currencies);
        if (count($custom_signs)) {
            $all_settings = get_option('wpcs_settings', array());
            if (isset($all_settings['wpcs_customer_signs']) && !empty($all_settings['wpcs_customer_signs'])) {
                $all_settings['wpcs_customer_signs'] .= ',' . implode(',', $custom_signs);
            } else {
                $all_settings['wpcs_customer_signs'] = implode(',', $custom_signs);
            }

            update_option('wpcs_settings', $all_settings);
        }
        exit;
    }

    public function download_flags($key) {
        if (empty($key)) {
            return false;
        }
        //$image_link = 'https://countryflagsapi.com/png/' . $key;
        $image_link = 'https://flagcdn.com/w80/' . $key . '.png';
        //$image_url ='https://www.countryflagicons.com/FLAT/64/' . strtoupper($key) . '.png';
        $image_url = 'http://www.geognos.com/api/en/countries/flag/' . strtoupper($key) . '.png';

        $no_download = false;
        if ($no_download) {
            return $image_link;
        }

        $upload_dir = wp_upload_dir();

        $image_data = file_get_contents($image_url);
        if ($image_data === false) {
            return $image_link;
        }
        $filename = basename($image_url);

        if (wp_mkdir_p($upload_dir['path'])) {
            $file = $upload_dir['path'] . '/' . $filename;
        } else {
            $file = $upload_dir['basedir'] . '/' . $filename;
        }

        file_put_contents($file, $image_data);

        $wp_filetype = wp_check_filetype($filename, null);

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => sanitize_file_name($filename),
            'post_content' => '',
            'post_status' => 'inherit'
        );

        $attach_id = wp_insert_attachment($attachment, $file);
        require_once( ABSPATH . 'wp-admin/includes/image.php' );
        $attach_data = wp_generate_attachment_metadata($attach_id, $file);
        wp_update_attachment_metadata($attach_id, $attach_data);

        return wp_get_attachment_image_url($attach_id);
    }

    public function init_geo_currency() {

        $done = false;
        if ($this->is_use_geo_rules()) {
            try {
                $gi = $this->get_geoip_object();
                $pd = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
                geoip_close($gi);
                if (isset($_SERVER["HTTP_CF_IPCOUNTRY"])) {
                    $pd = $_SERVER["HTTP_CF_IPCOUNTRY"];
                }
            } catch (Exception $e) {
                $pd = '';
            }

            $rules = $this->get_geo_rules();
            $this->storage->set_val('wpcs_user_country', $pd);
            $is_allowed = $this->is_first_unique_visit AND function_exists('wp_validate_redirect');

            if ($is_allowed) {

                if (isset($pd) AND!empty($pd)) {

                    if (!empty($rules)) {
                        foreach ($rules as $curr => $countries) {
                            if (!empty($countries) AND is_array($countries)) {
                                foreach ($countries as $country) {
                                    if ($country == $pd) {
                                        $this->storage->set_val('wpcs_current_currency', $curr);
                                        $this->current_currency = $curr;
                                        $done = true;
                                        break(2);
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }

        $this->storage->set_val('wpcs_first_unique_visit', 1);

        return $done;
    }

    public function get_currency_by_country($country_code) {
        $rules = $this->get_geo_rules();
        if (!empty($rules)) {
            foreach ($rules as $currency => $countries) {
                if (!empty($countries) AND is_array($countries)) {
                    foreach ($countries as $country) {
                        if ($country == $country_code) {
                            return $currency;
                        }
                    }
                }
            }
        }

        return '';
    }

    /**
     * Show action links on the plugin screen
     */
    public function plugin_action_links($links) {
        return array_merge(array(
            '<a href="' . admin_url('options-general.php?page=currency-switcher-settings') . '">' . __('Settings', 'currency-switcher') . '</a>',
            '<a target="_blank" href="' . esc_url('https://currency-switcher.com/documentation/') . '">' . __('Documentation', 'currency-switcher') . '</a>'
                ), $links);

        return $links;
    }

    public function widgets_init() {
        require_once WPCS_PATH . 'classes/widgets/widget-wpcs-selector.php';
        require_once WPCS_PATH . 'classes/widgets/widget-currency-rates.php';
        require_once WPCS_PATH . 'classes/widgets/widget-currency-converter.php';
        register_widget('WPCS_SELECTOR');
        register_widget('WPCS_RATES');
        register_widget('WPCS_CONVERTER');
    }

    public function admin_enqueue_scripts() {

        if (isset($_GET['tab']) AND $_GET['tab'] == 'wpcs') {
            wp_enqueue_style('currency-switcher-options', WPCS_LINK . 'css/options.css', [], WPCS_VERSION);
        }
        wp_enqueue_style('wp-color-picker');
        wp_enqueue_script('wp-color-picker');
    }

    public function wp_head() {
        //*** if the site is visited for the first time lets execute geo ip conditions
        $this->init_geo_currency();
        //***
        wp_enqueue_script('jquery');
        $currencies = $this->get_currencies();
        ?>
        <script type="text/javascript">
            var wpcs_is_mobile = <?php echo (int) wp_is_mobile() ?>;
            var wpcs_drop_down_view = "<?php echo $this->get_drop_down_view(); ?>";
            var wpcs_current_currency = <?php echo json_encode((isset($currencies[$this->current_currency]) ? $currencies[$this->current_currency] : $currencies[$this->default_currency])) ?>;
            var wpcs_default_currency = <?php echo json_encode($currencies[$this->default_currency]) ?>;
            var wpcs_array_of_get = '{}';
        <?php if (!empty($_GET)): ?>
            <?php
            //sanitization of $_GET array
            $sanitized_get_array = $this->array_map_r($_GET);
            ?>
                wpcs_array_of_get = '<?php echo str_replace("'", "", json_encode($sanitized_get_array)); ?>';
        <?php endif; ?>

            wpcs_array_no_cents = '<?php echo json_encode($this->no_cents); ?>';

            var wpcs_ajaxurl = "<?php echo admin_url('admin-ajax.php'); ?>";
            var wpcs_lang_loading = "<?php _e('loading', 'currency-switcher') ?>";
            var wpcs_shop_is_cached =<?php echo (int) $this->shop_is_cached ?>;
            var wpcs_special_ajax_mode = <?php echo (int) $this->get_option('wpcs_special_ajax_mode', 0) ?>;
        </script>
        <?php
        if ($this->get_drop_down_view() == 'ddslick') {
            wp_enqueue_script('jquery.ddslick.min', WPCS_LINK . 'js/jquery.ddslick.min.js', array('jquery'), WPCS_VERSION);
        }

        if ($this->get_drop_down_view() == 'chosen' OR $this->get_drop_down_view() == 'chosen_dark') {
            wp_enqueue_script('chosen-drop-down', WPCS_LINK . 'js/chosen/chosen.jquery.min.js', array('jquery'), WPCS_VERSION);
            wp_enqueue_style('chosen-drop-down', WPCS_LINK . 'js/chosen/chosen.min.css', [], WPCS_VERSION);
            //dark chosen
            if ($this->get_drop_down_view() == 'chosen_dark') {
                wp_enqueue_style('chosen-drop-down-dark', WPCS_LINK . 'js/chosen/chosen-dark.css', [], WPCS_VERSION);
            }
        }

        if ($this->get_drop_down_view() == 'wselect') {
            wp_enqueue_script('wpcs_wselect', WPCS_LINK . 'js/wselect/wSelect.min.js', array('jquery'), WPCS_VERSION);
            wp_enqueue_style('wpcs_wselect', WPCS_LINK . 'js/wselect/wSelect.css', [], WPCS_VERSION);
        }

        //+++
        wp_enqueue_style('currency-switcher', WPCS_LINK . 'css/front.css', [], WPCS_VERSION);
        wp_enqueue_script('currency-switcher', WPCS_LINK . 'js/front.js', array('jquery'), WPCS_VERSION);
        //+++
    }

    function array_map_r($arr) {
        $newArr = array();

        foreach ($arr as $key => $value) {
            $newArr[$this->escape($key)] = ( is_array($value) ) ? $this->array_map_r($value) : $this->escape($value);
        }

        return $newArr;
    }

    public function get_drop_down_view() {
        return apply_filters('wpcs_drop_down_view', $this->get_option('wpcs_drop_down_view', 'ddslick'));
    }

    public function get_currencies() {

        $default = array(
            'USD' => array(
                'name' => 'USD',
                'rate' => 1,
                'interest' => '',
                'symbol' => '&#36;',
                'position' => 'right',
                'is_etalon' => 1,
                'description' => 'USA dollar',
                'hide_cents' => 0,
                'flag' => '',
            ),
            'EUR' => array(
                'name' => 'EUR',
                'rate' => 0.89,
                'interest' => '',
                'symbol' => '&euro;',
                'position' => 'left_space',
                'is_etalon' => 0,
                'description' => 'Europian Euro',
                'hide_cents' => 0,
                'flag' => '',
            )
        );

        $currencies = get_option('wpcs', $default);
        if (is_array($currencies)) {
            foreach ($currencies as $key => $currency) {
                $is_admin_page = false;
                if (isset($_GET['page'])) {
                    if ($_GET['page'] === 'currency-switcher-settings') {
                        $is_admin_page = TRUE;
                    }
                }

                if (isset($currency['rate']) && isset($currency['interest']) && !$is_admin_page) {
                    $currencies[$key]['rate'] = (float) $currency['rate'] + floatval($currency['interest']);
                }
            }
        }

        $currencies = apply_filters('wpcs_currency_data_manipulation', $currencies);

        if (empty($currencies) OR!is_array($currencies)) {
            $currencies = $default;
        }

        if ($this->show_notes) {
            if (count($currencies) > 2) {
                $currencies = array_slice($currencies, 0, 2);
            }
        }

        if (count($currencies) < 2) {
            $currencies = $default;
        }

        //fix if curreny was removed
        if (!isset($currencies[$this->current_currency])) {
            $this->current_currency = $this->default_currency;
        }

        return $currencies;
    }

    public function get_geo_rules() {
        return $this->get_option('wpcs_geo_rules', array());
    }

    public function is_use_geo_rules() {
        //$is = $this->get_option('wpcs_use_geo_rules', 0);
        $is = true;
        $isset = file_exists(WPCS_PATH . 'lib/geo-ip/geoip.inc');

        return ($isset && $is);
    }

    public function price($price, $currency = '') {

        if (isset($_REQUEST['wpcs_block_price_hook'])) {
            return $price;
        }

        if (empty($currency)) {
            $currency = $this->current_currency;
        }


        $currencies = $this->get_currencies();

        $precision = 2;
        if (in_array($currency, $this->no_cents) OR $currencies[$currency]['hide_cents'] == 1) {
            $precision = 0;
        }

        if ($currency != $this->default_currency) {
            if ($currencies[$currency] != NULL) {
                $price = number_format(floatval($price) * floatval($currencies[$currency]['rate']), $precision, $this->decimal_sep, $this->thousands_sep);
            } else {
                $price = number_format(floatval($price) * floatval($currencies[$this->default_currency]['rate']), $precision, $this->decimal_sep, $this->thousands_sep);
            }
        } else {
            $price = number_format(floatval($price), $precision, $this->decimal_sep, $this->thousands_sep);
        }

        //http://stackoverflow.com/questions/11692770/rounding-to-nearest-50-cents
        //$price = round($price * 2, 0) / 2;
        //return round ( $price , 0 ,PHP_ROUND_HALF_EVEN );
        return apply_filters('wpcs_price', $price);
    }

    public function get_welcome_currency() {
        return $this->get_option('wpcs_welcome_currency', $this->default_currency);
    }

    public function get_customer_signs() {
        $signs = array();
        $data = $this->get_option('wpcs_customer_signs', '');
        if (!empty($data)) {
            $data = explode(',', $data);
            if (!empty($data) AND is_array($data)) {
                $signs = $data;
            }
        }
        return $signs;
    }

    public function price_format($currency = '') {
        $currencies = $this->get_currencies();
        if (empty($currency)) {
            $currency = $this->current_currency;
        }
        $currency_pos = $currencies[$this->current_currency]['position'];
        $format = '%1$s%2$s';
        switch ($currency_pos) {
            case 'left' :
                $format = '%1$s%2$s';
                break;
            case 'right' :
                $format = '%2$s%1$s';
                break;
            case 'left_space' :
                $format = '%1$s&nbsp;%2$s';
                break;
            case 'right_space' :
                $format = '%2$s&nbsp;%1$s';
                break;
        }

        return $format;
    }

    //[wpcs]
    public function wpcs_shortcode($args) {
        if (empty($args)) {
            $args = array();
        }


        if (isset($args['sd']) AND intval($args['sd']) > 0) {
            wp_enqueue_style('wpcs-sd-selectron23', WPCS_LINK . 'css/sd/selectron23.css', [], WPCS_VERSION);
            wp_enqueue_script('wpcs-sd-selectron23', WPCS_LINK . 'js/sd/selectron23.js', [], WPCS_VERSION);
            wp_enqueue_script('wpcs-sd-front', WPCS_LINK . 'js/sd/front.js', ['wpcs-sd-selectron23'], WPCS_VERSION);

            if ($this->shop_is_cached) {
                //commented on 07-07-2022 - day of implementation SD
                //wp_enqueue_script('wpcs-sd-front-cache', WPCS_LINK . 'js/sd/front-cache.js', ['wpcs-sd-front'], WPCS_VERSION);
            }

            global $WPCS_SD;
            $args['sd_id'] = intval($args['sd']);
            $args['sd_settings'] = $WPCS_SD->get(intval($args['sd']));
        }

        return $this->render_html(WPCS_PATH . 'views/shortcodes/wpcs.php', $args);
    }

    //[wpcs_converter exclude="GBP,AUD" precision=2]
    public function wpcs_converter($args) {
        if (empty($args)) {
            $args = array();
        }
        return $this->render_html(WPCS_PATH . 'views/shortcodes/wpcs_converter.php', $args);
    }

    //[wpcs_rates exclude="GBP,AUD" precision=2]
    public function wpcs_rates($args) {
        if (empty($args)) {
            $args = array();
        }
        return $this->render_html(WPCS_PATH . 'views/shortcodes/wpcs_rates.php', $args);
    }

    //[wpcs_current_currency text="" currency="" flag=1 code=1]
    public function wpcs_current_currency($atts) {
        $currencies = $this->get_currencies();
        extract(shortcode_atts(array(
            'text' => __('Current currency is:', 'currency-switcher'),
            'currency' => $this->current_currency,
            'flag' => 1,
            'code' => 1,
                        ), $atts));

        $data = array();
        $data['currencies'] = $currencies;
        if ($text == 'none') {
            $data['text'] = '';
        } else {
            $data['text'] = $text;
        }

        $data['currency'] = $currency;
        $data['flag'] = $flag;
        $data['code'] = $code;
        return $this->render_html(WPCS_PATH . 'views/shortcodes/wpcs_current_currency.php', $data);
    }

    //[wpcs_price value=20 meta_value=my_price_field] -> value should be in default currency
    public function wpcs_price($atts) {
        extract(shortcode_atts(array('value' => 0, 'meta_value' => '', 'type' => 'notfixed', 'post_id' => 0, 'fix_currency' => ''), $atts));
        //add price from meta field

        if (empty($post_id) || $post_id == 0) {
            $post_id = get_the_ID();
        } elseif (empty($meta_value)) {
            $meta_value = 'wpcs_price';
        }

        if (!empty($meta_value)) {
            $value = get_post_meta($post_id, $meta_value, true);
        }

        //***
        $tmp_currency = $this->current_currency;
        $all_currencies = $this->get_currencies();
        
        if ($fix_currency && isset($all_currencies[$fix_currency])) {
            $this->storage->set_val('wpcs_current_currency', $fix_currency);
            $this->current_currency = $fix_currency;
        }

        if ($type === 'fixed') {
            //if we doesn want to convert prices and for each currency show its own fixed amount
            $values = explode(',', $value);
            if (!empty($values)) {
                $fixed_values = array();
                foreach ($values as $v) {
                    $tmp = explode(':', $v);
                    $fixed_values[$tmp[0]] = $tmp[1];
                }

                return $this->price_html(isset($fixed_values[$this->current_currency]) ? $this->price($fixed_values[$this->current_currency]) : 'none', array('amount' => $value, 'as_is' => true, 'fixed_values' => $fixed_values));
            } else {
                return 'none';
            }
        }
        if (!$value) {
            return apply_filters('wpcs_price_free_text', "");
        }
        //+++
        $price_html = $this->price_html($this->price($value), array('amount' => $value));

        if ($tmp_currency != $this->current_currency) {
            $this->storage->set_val('wpcs_current_currency', $tmp_currency);
            $this->current_currency = $tmp_currency;
        }
        return $price_html;
    }

    //[wpcs_check_country]
    public function wpcs_check_country() {
        $data = array();
        try {
            $gi = $this->get_geoip_object();
            $data['code'] = geoip_country_code_by_addr($gi, $_SERVER['REMOTE_ADDR']);
            $data['name'] = geoip_country_name_by_addr($gi, $_SERVER['REMOTE_ADDR']);
            geoip_close($gi);
        } catch (Exception $e) {
            $pd = '';
        }

        return $this->render_html(WPCS_PATH . 'views/shortcodes/wpcs_check_country.php', $data);
    }

    //http://stackoverflow.com/questions/6918623/curlopt-followlocation-cannot-be-activated
    public function file_get_contents_curl($url) {
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_AUTOREFERER, TRUE);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $url);
        @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);

        $data = curl_exec($ch);
        curl_close($ch);

        return $data;
    }

    //ajax
    public function get_rate() {
        $is_ajax = true;
        if (isset($_REQUEST['no_ajax'])) {
            $is_ajax = false;
        }

        //***
        //http://en.wikipedia.org/wiki/ISO_4217
        $mode = $this->get_option('wpcs_currencies_aggregator', 'yahoo');
        $request = "";
        //$wpcs_use_curl = (int) $this->get_option('wpcs_use_curl', 0);
        $wpcs_use_curl = true;
        switch ($mode) {
            case 'yahoo':
                $date = current_time('timestamp', true);
                $yql_query_url = 'https://query1.finance.yahoo.com/v8/finance/chart/' . $this->default_currency . $this->escape($_REQUEST['currency_name']) . '=X?symbol=' . $this->default_currency . $this->escape($_REQUEST['currency_name']) . '%3DX&period1=' . ( $date - 60 * 86400 ) . '&period2=' . $date . '&interval=1d&includePrePost=false&events=div%7Csplit%7Cearn&lang=en-US&region=US&corsDomain=finance.yahoo.com';
                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($yql_query_url);
                } else {
                    $res = file_get_contents($yql_query_url);
                }
                //$yql_query_url="http://query.yahooapis.com/v1/public/yql?q=select+%2A+from+yahoo.finance.xchange+where+pair+in+EURGBP&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
//***
                $data = json_decode($res, true);
                $result = isset($data['chart']['result'][0]['indicators']['quote'][0]['open']) ? $data['chart']['result'][0]['indicators']['quote'][0]['open'] : ( isset($data['chart']['result'][0]['meta']['previousClose']) ? array($data['chart']['result'][0]['meta']['previousClose']) : array() );

                if (count($result) && is_array($result)) {
                    $request = end($result);
                }
                break;

            case 'google':
                $amount = urlencode(1);
                $from_Currency = urlencode($this->default_currency);
                $to_Currency = urlencode($this->escape($_REQUEST['currency_name']));
                if ($to_Currency == $from_Currency) {
                    $request = 1;
                    break;
                }
                $url = 'https://www.google.com/async/currency_update?yv=2&async=source_amount:1,source_currency:' . $from_Currency . ',target_currency:' . $to_Currency . ',chart_width:270,chart_height:94,lang:en,country:vn,_fmt:jspb';
                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $html = $this->file_get_contents_curl($url);
                } else {
                    $html = file_get_contents($url);
                }

                if ($html) {
                    preg_match('/CurrencyUpdate\":\[\[(.+?)\,/', $html, $matches);

                    if (count($matches) > 0) {
                        $request = isset($matches[1]) ? $matches[1] : 1;
                    } else {
                        $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                    }
                }
                break;

            case 'appspot':
                $url = 'http://rate-exchange.appspot.com/currency?from=' . $this->default_currency . '&to=' . $this->escape($_REQUEST['currency_name']);

                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }


                $res = json_decode($res);
                if (isset($res->rate)) {
                    $request = floatval($res->rate);
                } else {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;

            case 'privatbank':
                //https://api.privatbank.ua/#p24/exchange
                $url = 'https://api.privatbank.ua/p24api/pubinfo?json&exchange&coursid=4'; //4,5

                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }

                $currency_data = json_decode($res, true);
                $rates = array();

                if (!empty($currency_data)) {
                    foreach ($currency_data as $c) {
                        if ($c['base_ccy'] == 'UAH') {
                            $rates[$c['ccy']] = floatval($c['sale']);
                        }
                    }
                }


                //***

                if (!empty($rates)) {

                    if ($this->default_currency != 'UAH') {
                        if ($_REQUEST['currency_name'] != 'UAH') {
                            if (isset($_REQUEST['currency_name'])) {
                                $request = floatval($rates[$this->default_currency] / ($rates[$this->escape($_REQUEST['currency_name'])]));
                            } else {
                                $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                            }
                        } else {
                            $request = 1 / (1 / $rates[$this->default_currency]);
                        }
                    } else {
                        if ($_REQUEST['currency_name'] != 'UAH') {
                            $request = 1 / $rates[$_REQUEST['currency_name']];
                        } else {
                            $request = 1;
                        }
                    }
                } else {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }

                //***

                if (!$request) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }


                break;

            case 'ecb':
                $url = 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml';

                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }

                $currency_data = simplexml_load_string($res);
                $rates = array();
                if (empty($currency_data->Cube->Cube)) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                    break;
                }



                foreach ($currency_data->Cube->Cube->Cube as $xml) {
                    $att = (array) $xml->attributes();
                    $rates[$att['@attributes']['currency']] = floatval($att['@attributes']['rate']);
                }


                //***

                if (!empty($rates)) {

                    if ($this->default_currency != 'EUR') {
                        if ($_REQUEST['currency_name'] != 'EUR') {
                            if (isset($_REQUEST['currency_name'])) {
                                $request = floatval($rates[$this->escape($_REQUEST['currency_name'])] / $rates[$this->default_currency]);
                            } else {
                                $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                            }
                        } else {
                            $request = 1 / $rates[$this->default_currency];
                        }
                    } else {
                        if ($_REQUEST['currency_name'] != 'EUR') {
                            if ($rates[$_REQUEST['currency_name']] < 1) {
                                $request = 1 / $rates[$_REQUEST['currency_name']];
                            } else {
                                $request = $rates[$_REQUEST['currency_name']];
                            }
                        } else {
                            $request = 1;
                        }
                    }
                } else {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }

                //***

                if (!$request) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }


                break;
            case 'free_ecb':
//***           https://api.exchangeratesapi.io/latest?base=USD&symbols=GBP
                $ex_currency = $this->escape($_REQUEST['currency_name']);
                $query_url = 'https://api.exchangeratesapi.io/latest?base=' . $this->default_currency . '&symbols=' . $ex_currency;
                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($query_url);
                } else {
                    $res = file_get_contents($query_url);
                }
//***
                $data = json_decode($res, true);
                $request = isset($data['rates'][$ex_currency]) ? $data['rates'][$ex_currency] : 0;

                if (!$request) {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case 'micro':
                //https://ratesapi.io/api/latest?base=USD&symbols=INR
                $ex_currency = $this->escape($_REQUEST['currency_name']);
                $query_url = 'https://ratesapi.io/api/latest?base=' . $this->default_currency . '&symbols=' . $ex_currency;
                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($query_url);
                } else {
                    $res = file_get_contents($query_url);
                }
//***
                $data = json_decode($res, true);
                $request = isset($data['rates'][$ex_currency]) ? $data['rates'][$ex_currency] : 0;

                if (!$request) {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case 'rf':
                //http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req=21/08/2015
                $xml_url = 'http://www.cbr.ru/scripts/XML_daily_eng.asp?date_req='; //21/08/2015
                $date = date('d/m/Y');
                $xml_url .= $date;
                if (function_exists('curl_init')) {
                    $res = $this->file_get_contents_curl($xml_url);
                } else {
                    $res = file_get_contents($xml_url);
                }
//***
                $xml = simplexml_load_string($res) or die("Error: Cannot create object");
                $xml = $this->object2array($xml);
                $rates = array();
                $nominal = array();
//***
                if (isset($xml['Valute'])) {
                    if (!empty($xml['Valute'])) {
                        foreach ($xml['Valute'] as $value) {
                            $rates[$value['CharCode']] = floatval(str_replace(',', '.', $value['Value']));
                            $nominal[$value['CharCode']] = $value['Nominal'];
                        }
                    }
                }
//***
                if (!empty($rates)) {
                    if ($this->default_currency != 'RUB') {
                        if ($_REQUEST['currency_name'] != 'RUB') {
                            if (isset($_REQUEST['currency_name'])) {
                                $request = $nominal[$this->escape($_REQUEST['currency_name'])] * floatval($rates[$this->default_currency] / $rates[$this->escape($_REQUEST['currency_name'])] / $nominal[$this->escape($this->default_currency)]);
                            } else {
                                $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                            }
                        } else {
                            if ($nominal[$this->default_currency] == 10) {
                                $request = (1 / (1 / $rates[$this->default_currency])) / $nominal[$this->default_currency];
                            } else {
                                $request = 1 / (1 / $rates[$this->default_currency]);
                            }
                        }
                    } else {
                        if ($_REQUEST['currency_name'] != 'RUB') {
                            $request = $nominal[$this->escape($_REQUEST['currency_name'])] / $rates[$_REQUEST['currency_name']];
                        } else {
                            $request = 1;
                        }
                    }
                } else {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }

                //***

                if (!$request) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }

                break;

            case 'bank_polski':
                //http://api.nbp.pl/en.html
                $url = 'http://api.nbp.pl/api/exchangerates/tables/A'; //A,B

                if (function_exists('curl_init')) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }

                $currency_data = json_decode($res, TRUE);
                $rates = array();
                if (!empty($currency_data[0])) {
                    foreach ($currency_data[0]['rates'] as $c) {
                        $rates[$c['code']] = floatval($c['mid']);
                    }
                }

                //***

                if (!empty($rates)) {

                    if ($this->default_currency != 'PLN') {
                        if ($_REQUEST['currency_name'] != 'PLN') {
                            if (isset($_REQUEST['currency_name'])) {
                                $request = floatval($rates[$this->default_currency] / ($rates[$this->escape($_REQUEST['currency_name'])]));
                            } else {
                                $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                            }
                        } else {
                            $request = 1 / (1 / $rates[$this->default_currency]);
                        }
                    } else {
                        if ($_REQUEST['currency_name'] != 'PLN') {
                            $request = 1 / $rates[$_REQUEST['currency_name']];
                        } else {
                            $request = 1;
                        }
                    }
                } else {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }

                //***

                if (!$request) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }


                break;

            case 'free_converter':
                $from_Currency = urlencode($this->default_currency);
                $to_Currency = urlencode($this->escape($_REQUEST['currency_name']));
                $query_str = sprintf("%s_%s", $from_Currency, $to_Currency);
                $key = $this->get_option('wpcs_aggregator_key', '');
                if (!$key) {
                    $request = esc_html__("Please use the API key", 'currency-switcher');
                    break;
                }
                $url = "http://free.currencyconverterapi.com/api/v3/convert?q={$query_str}&compact=y&apiKey={$key}";

                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }

                $currency_data = json_decode($res, true);

                if (!empty($currency_data[$query_str]['val'])) {
                    $request = $currency_data[$query_str]['val'];
                } else {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }

                //***

                if (!$request) {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case 'fixer':
                $from_Currency = urlencode($this->default_currency);
                $to_Currency = urlencode($this->escape($_REQUEST['currency_name']));

                $key = $this->get_option('wpcs_aggregator_key', '');
                if (!$key) {
                    $request = esc_html__("Please use the API key", 'currency-switcher');
                    break;
                }
                $url = "http://data.fixer.io/api/latest?base={$from_Currency}&symbolst={$to_Currency}&access_key={$key}";

                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }

                $currency_data = json_decode($res, true);

                $request = isset($currency_data['rates'][$to_Currency]) ? $currency_data['rates'][$to_Currency] : 0;

                if (!$request) {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case"cryptocompare":
                $from_Currency = urlencode($this->default_currency);
                $to_Currency = urlencode($this->escape($_REQUEST['currency_name']));
                //https://min-api.cryptocompare.com/data/price?fsym=ETH&tsyms=BTC
                $query_str = sprintf("?fsym=%s&tsyms=%s", $from_Currency, $to_Currency);
                $url = "https://min-api.cryptocompare.com/data/price" . $query_str;
                if (function_exists('curl_init')) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }
                $currency_data = json_decode($res, true);
                if (!empty($currency_data[$to_Currency])) {
                    $request = $currency_data[$to_Currency];
                } else {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                //***
                if (!$request) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case 'xe':
                $amount = urlencode(1);
                $from_Currency = urlencode($this->default_currency);
                $to_Currency = urlencode($this->escape($_REQUEST['currency_name']));
                //http://www.xe.com/currencyconverter/convert/?Amount=1&From=ZWD&To=CUP
                $url = "https://www.xe.com/currencyconverter/convert/?Amount=1&From=" . $from_Currency . "&To=" . $to_Currency;
                if (function_exists('curl_init')) {
                    $html = $this->file_get_contents_curl($url);
                } else {
                    $html = file_get_contents($url);
                }
                //test
                var_dump($html);
                preg_match_all('/<span class="converterresult-toAmount">(.*?)<\/span>/s', $html, $matches);
                if (isset($matches[1][0])) {
                    $request = floatval(str_replace(",", "", $matches[1][0]));
                } else {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }

                break;
            case 'ron':
                // thank you, Maleabil
                $url = 'https://www.bnr.ro/nbrfxrates.xml';
                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }
                $currency_data = simplexml_load_string($res);
                $rates = array();
                if (empty($currency_data->Body->Cube)) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                    break;
                }
                foreach ($currency_data->Body->Cube->Rate as $xml) {
                    $att = (array) $xml->attributes();
                    $final['rate'] = (string) $xml;
                    $rates[$att['@attributes']['currency']] = floatval($final['rate']);
                }
                //***
                if (!empty($rates)) {
                    if ($this->default_currency != 'RON') {
                        if ($_REQUEST['currency_name'] != 'RON') {
                            if (isset($_REQUEST['currency_name'])) {
                                $request = 1 / floatval($rates[$this->escape($_REQUEST['currency_name'])] / $rates[$this->default_currency]);
                            } else {
                                $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                            }
                        } else {
                            $request = 1 * ($rates[$this->default_currency]);
                        }
                    } else {
                        if ($_REQUEST['currency_name'] != 'RON') {
                            if ($rates[$_REQUEST['currency_name']] < 1) {
                                $request = 1 / $rates[$_REQUEST['currency_name']];
                            } else {
                                $request = $rates[$_REQUEST['currency_name']];
                            }
                        } else {
                            $request = 1;
                        }
                    }
                } else {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                //***

                if (!$request) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case 'currencylayer':
                $from_Currency = urlencode($this->default_currency);
                $to_Currency = urlencode($this->escape($_REQUEST['currency_name']));

                $key = $this->get_option('wpcs_aggregator_key', '');
                if (!$key) {
                    $request = esc_html__("Please use the API key", 'currency-switcher');
                    break;
                }


                $url = "http://apilayer.net/api/live?source={$from_Currency}&currencies={$to_Currency}&access_key={$key}&format=1";

                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }

                $currency_data = json_decode($res, true);

                $rates = isset($currency_data['quotes']) ? $currency_data['quotes'] : 0;
                $request = isset($rates[$from_Currency . $to_Currency]) ? $rates[$from_Currency . $to_Currency] : 0;
                if (!$request) {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case 'openexchangerates':
                $from_Currency = urlencode($this->default_currency);
                $to_Currency = urlencode($this->escape($_REQUEST['currency_name']));

                $key = $this->get_option('wpcs_aggregator_key', '');
                if (!$key) {
                    $request = esc_html__("Please use the API key", 'currency-switcher');
                    break;
                }

                $url = "https://openexchangerates.org/api/latest.json?base={$from_Currency}&symbolst={$to_Currency}&app_id={$key}";

                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }

                $currency_data = json_decode($res, true);

                $request = isset($currency_data['rates'][$to_Currency]) ? $currency_data['rates'][$to_Currency] : 0;

                if (!$request) {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case 'ukrnatsbank':
//***
                $natbank_url = 'https://bank.gov.ua/NBUStatService/v1/statdirectory/exchange?json';
                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($natbank_url);
                } else {
                    $res = file_get_contents($natbank_url);
                }

//***
                $data = json_decode($res, true);

                if (!empty($data)) {
                    if ($this->default_currency != 'UAH') {

                        $def_cur_rate = 0;
                        foreach ($data as $item) {
                            if ($item["cc"] == $this->default_currency) {
                                $def_cur_rate = $item["rate"];
                                break;
                            }
                        }
                        if (!$def_cur_rate) {
                            $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                            break;
                        } elseif ($_REQUEST['currency_name'] == 'UAH') {
                            $request = 1 * $def_cur_rate;
                        }
                        foreach ($data as $item) {
                            if ($item["cc"] == $_REQUEST['currency_name']) {
                                if ($_REQUEST['currency_name'] != 'UAH') {
                                    if (isset($_REQUEST['currency_name'])) {
                                        $request = 1 / floatval($item["rate"] / $def_cur_rate);
                                    } else {
                                        $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                                    }
                                } else {
                                    $request = 1 * $def_cur_rate;
                                }
                            }
                        }
                    } else {
                        if ($_REQUEST['currency_name'] != 'UAH') {
                            foreach ($data as $item) {
                                if ($item["cc"] == $_REQUEST['currency_name']) {
                                    $request = 1 / $item["rate"];
                                    break;
                                }
                            }
                        } else {
                            $request = 1;
                        }
                    }
                }
                if (!$request) {
                    $request = sprintf(__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }
                break;
            case 'bnm':
                $url = sprintf('http://www.bnm.md/en/official_exchange_rates?get_xml=1&date=%s', date('d.m.Y'));

                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($url);
                } else {
                    $res = file_get_contents($url);
                }

                $currencies_data = simplexml_load_string($res);
                if (isset($currencies_data->Valute)) {

                    $rate1 = 0;
                    $rate2 = 0;
                    if ('MDL' == $_REQUEST['currency_name']) {
                        $rate2 = 1;
                    }
                    foreach ($currencies_data->Valute as $xml_item) {
                        if ($xml_item->CharCode == $_REQUEST['currency_name'] && 'MDL' != $_REQUEST['currency_name']) {
                            $rate2 = $xml_item->Nominal / $xml_item->Value;
                        }
                        if ($xml_item->CharCode == $this->default_currency && 'MDL' != $this->default_currency) {
                            $rate1 = $xml_item->Nominal / $xml_item->Value;
                        }
                    }
                    if ('MDL' == $this->default_currency && $rate2) {
                        $request = $rate2;
                    } elseif ($rate2 && $rate1) {
                        $request = $rate2 / $rate1;
                    } else {
                        $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                    }
                }
                break;
            case 'mnb':
                $client = new SoapClient('http://www.mnb.hu/arfolyamok.asmx?wsdl');
                $xml = simplexml_load_string($client->GetCurrentExchangeRates(null)->GetCurrentExchangeRatesResult);
                $rate_base = 0;
                $rate_curr = 0;
                if ('HUF' == $_REQUEST['currency_name']) {
                    $rate_curr = 1;
                }
                foreach ($xml->Day->Rate as $rate) {
                    if ((string) $rate->attributes()->curr == $this->default_currency && 'HUF' != $this->default_currency) {
                        $rate_base = (int) $rate->attributes()->unit / (float) str_replace(',', '.', $rate);
                    }
                    if ((string) $rate->attributes()->curr == $_REQUEST['currency_name'] && 'HUF' != $_REQUEST['currency_name']) {
                        $rate_curr = (int) $rate->attributes()->unit / (float) str_replace(',', '.', $rate);
                    }
                }
                if ('HUF' == $this->default_currency && $rate_curr) {
                    $request = $rate_curr;
                } elseif ($rate_base && $rate_curr) {
                    $request = $rate_curr / $rate_base;
                } else {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $this->escape($_REQUEST['currency_name']));
                }

                break;
            case 'currencyapi':
                $key = $this->get_option('wpcs_aggregator_key', '');

                $from_Currency = urlencode($this->default_currency);
                $to_Currency = urlencode($this->escape($_REQUEST['currency_name']));
                if (!$key) {
                    $request = esc_html__("Please use the API key", 'currency-switcher');
                    break;
                }
                $curr_url = 'https://api.currencyapi.com/v3/latest?apikey=' . $key . '&base_currency=' . $from_Currency . '&currencies=' . $to_Currency;
                if (function_exists('curl_init') AND $wpcs_use_curl) {
                    $res = $this->file_get_contents_curl($curr_url);
                } else {
                    $res = file_get_contents($curr_url);
                }

                $data = json_decode($res, true);

                if (isset($data['data']) && isset($data['data'][$to_Currency])) {
                    $request = $data['data'][$to_Currency]['value'];
                }
                if (!$request) {
                    $request = sprintf(esc_html__("no data for %s", 'currency-switcher'), $to_Currency);
                }
                break;
            default:

                $request = apply_filters('wpcs_add_aggregator_processor', $mode, $this->escape($_REQUEST['currency_name']));

                break;
        }


        //***
        if ($is_ajax) {
            echo $request;
            exit;
        } else {
            return $request;
        }
    }

    private function object2array($object) {
        return @json_decode(@json_encode($object), 1);
    }

    //ajax
    public function save_etalon() {
        if (!(defined('DOING_AJAX') && DOING_AJAX)) {
            //we need it just only for ajax update
            return "";
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        $currencies = $this->get_currencies();
        $currency_name = $this->escape($_REQUEST['currency_name']);
        foreach ($currencies as $key => $currency) {
            if ($currency['name'] == $currency_name) {
                $currencies[$key]['is_etalon'] = 1;
            } else {
                $currencies[$key]['is_etalon'] = 0;
            }
        }
        update_option('wpcs', $currencies);
        //+++ get curr updated values back
        $request = array();
        $this->default_currency = strtoupper($this->escape($_REQUEST['currency_name']));
        $_REQUEST['no_ajax'] = TRUE;
        foreach ($currencies as $key => $currency) {
            if ($currency_name != $currency['name']) {
                $_REQUEST['currency_name'] = $currency['name'];
                $request[$key] = $this->get_rate();
            } else {
                $request[$key] = 1;
            }
        }

        echo json_encode($request);
        exit;
    }

    //********************************************************************************

    public function wp_footer() {
        
    }

    //********************************************************************************

    public function render_html($pagepath, $data = array()) {
        if (isset($data['pagepath'])) {
            unset($data['pagepath']);
        }
        @extract($data);
        ob_start();
        include($pagepath);
        return ob_get_clean();
    }

    public function wpcs_code_rate($atts) {
        $code = strtoupper($atts['code']);
        $currencies = $this->get_currencies();
        $rate = 0;
        if (isset($currencies[$code])) {
            $rate = $currencies[$code]['rate'];
        }

        return $rate;
    }

    public function price_html($price, $data_attributes = array()) {

        $currency = $this->current_currency;
        $currencies = $this->get_currencies();
        $price_format = $this->price_format();

        $price_text = str_replace(array('%1$s', '%2$s'), array('<span class="wpcs_price_symbol">' . trim($currencies[$currency]['symbol']) . '</span>', $price), $price_format);
        $custom_price_format = $this->get_option('wpcs_customer_price_format', '__PRICE__');
        if (empty($custom_price_format)) {
            $custom_price_format = '__PRICE__';
        }
        $price_text = str_replace('__PRICE__', $price_text, $custom_price_format);
        $price_text = str_replace('__CODE__', $currency, $price_text);

        $data_attributes_txt = '';
        //look for fixed prices
        if (isset($data_attributes['fixed_values'])) {
            $fixed_values = $data_attributes['fixed_values'];
            unset($data_attributes['fixed_values']);
        }

        if (!empty($data_attributes)) {
            foreach ($data_attributes as $k => $v) {
                $data_attributes_txt .= 'data-' . $k . '=' . $v . ' ';
            }
        }

        //***

        $price_html = '<span class="wpcs_price" id="' . uniqid('wpcs_') . '" ' . $data_attributes_txt . '>' . $price_text;
        $price_html = apply_filters('wpcs_price_html_tail', $price_html);

        //add additional info in price html
        if ($this->get_option('wpcs_price_info', 0) AND!(is_admin() AND!isset($_REQUEST['get_product_price_by_ajax']))) {

            $info = "<ul class='wpcs_price_info_list'>";
            $price = str_replace($this->thousands_sep, "", $price);
            $price = str_replace($this->decimal_sep, ".", $price);
            $price_in_default_curr = $this->back_convert($price, $currencies[$this->current_currency]['rate'], 2);

            foreach ($currencies as $сurr) {
                if ($сurr['name'] == $this->current_currency) {
                    continue;
                }

                //***

                if (!isset($fixed_values)) {
                    if ($сurr['name'] != $this->default_currency) {
                        $val = $this->price($price_in_default_curr, $сurr['name']);
                    } else {
                        // $val = $price_in_default_curr;
                        $val = $this->price($price_in_default_curr, $сurr['name']);
                    }
                } else {
                    $val = isset($fixed_values[$сurr['name']]) ? $fixed_values[$сurr['name']] : 'none'; //fixed price
                }

                $info .= "<li><span>" . $сurr['name'] . "</span>: " . $val . "</li>";
            }
            $info .= "</ul>";
            $info = '<div class="wpcs_price_info"><span class="wpcs_price_info_icon"></span>' . $info . '</div>';
            $price_html .= $info;
        }
        //***
        $price_html .= '</span>'; //closing price container
        return $price_html;
    }

    //wp filter for values which is in basic currency and no possibility do it automatically
    public function wpcs_exchange_value($value) {
        $currencies = $this->get_currencies();
        $value = $value * $currencies[$this->current_currency]['rate'];
        $value = number_format($value, 2, $this->decimal_sep, '');
        return $value;
    }

    //set it to default
    public function reset_currency() {
        $this->storage->set_val('wpcs_current_currency', $this->default_currency);
        $this->current_currency = $this->default_currency;
    }

    //ajax
    public function wpcs_convert_currency() {
        wp_die($this->convert_currency($_REQUEST['from'], $_REQUEST['to'], $_REQUEST['amount'], $_REQUEST['precision']));
    }

    public function convert_currency($from, $to, $amount, $precision) {
        $currencies = $this->get_currencies();
        $v = $currencies[$to]['rate'] / $currencies[$from]['rate'];
        if (in_array($to, $this->no_cents)) {
            $precision = 0;
        }
        return number_format($v * $amount, intval($precision), $this->decimal_sep, $this->thousands_sep);
    }

    //ajax
    public function wpcs_rates_current_currency() {
        wp_die(do_shortcode('[wpcs_rates exclude="' . $this->escape($_REQUEST['exclude']) . '" precision="' . $this->escape($_REQUEST['precision']) . '" current_currency="' . $this->escape($_REQUEST['current_currency']) . '"]'));
    }

    //ajax
    //for price redrawing on front if site using cache plugin functionality
    public function wpcs_get_prices_html() {
        $result = array();
        if (isset($_REQUEST['prices_data'])) {
            $this->init_geo_currency();

            $_REQUEST['get_product_price_by_ajax'] = 1;
            $prices_data = $_REQUEST['prices_data'];
            //***
            if (!empty($prices_data) AND is_array($prices_data)) {
                foreach ($prices_data as $d) {

                    $is_fixed = false;
                    $fixed_values = array();
                    if (!is_numeric($d['price'])) {
                        $values = explode(',', $d['price']);
                        if (!empty($values)) {
                            foreach ($values as $v) {
                                $tmp = explode(':', $v);
                                if (isset($tmp[1])) {
                                    $fixed_values[$tmp[0]] = $tmp[1];
                                    $is_fixed = true;
                                }
                            }
                        }
                    }
                    if ($is_fixed) {
                        $precision = 2;
                        $currencies = $this->get_currencies();
                        if (in_array($this->current_currency, $this->no_cents) OR $currencies[$this->current_currency]['hide_cents'] == 1) {
                            $precision = 0;
                        }
                        $result[$d['id']] = $this->price_html(isset($fixed_values[$this->current_currency]) ? number_format(floatval($fixed_values[$this->current_currency]), $precision, $this->decimal_sep, $this->thousands_sep) : 'none', array('amount' => $d['price'], 'as_is' => true, 'fixed_values' => $fixed_values));
                    } else {
                        $result[$d['id']] = $this->price_html($this->price($d['price']), array('amount' => $d['price']));
                    }
                }
            }
        }
        //***
        $data = array();
        $data['prices'] = $result;
        $data['current_currency'] = $this->current_currency;
        wp_die(json_encode($data));
    }

    //count amount in basic currency from any currency
    public function back_convert($amount, $rate, $precision = 4) {
        if ($rate > 0) {
            return number_format((1 / $rate) * floatval($amount), $precision, '.', '');
        }

        return 0;
    }

    public function escape($value) {
        return sanitize_text_field(esc_html($value));
    }

    public function write_log($message) {
        $path = WPCS_PATH . 'wpcs.log';
        $data_log = date("Y-m-d H:i:s") . " - " . $message . PHP_EOL;
        file_put_contents($path, $data_log, FILE_APPEND);
    }

    public function ask_favour() {
        if (intval(get_option('wpcs_manage_rate_alert', 0)) === -2) {
            //old rate system mark for already set review users
            //return;//commented 07-07-2022
        }

        $slug = strtolower(get_class($this));

        add_action("wp_ajax_{$slug}_dismiss_rate_alert", function () use ($slug) {
            update_option("{$slug}_dismiss_rate_alert", 2);
        });

        add_action("wp_ajax_{$slug}_later_rate_alert", function () use ($slug) {
            update_option("{$slug}_later_rate_alert", time() + 2 * 7 * 24 * 60 * 60); //14 days after refuse
        });

        //+++

        add_action('admin_notices', function () use ($slug) {

            if (!current_user_can('manage_options')) {
                return; //show to admin only
            }

            if (intval(get_option("{$slug}_dismiss_rate_alert", 0)) === 2) {
                return;
            }

            if (intval(get_option("{$slug}_later_rate_alert", 0)) === 0) {
                update_option("{$slug}_later_rate_alert", time() + 2 * 24 * 60 * 60); //2 days after install
                return;
            }

            if (intval(get_option("{$slug}_later_rate_alert", 0)) > time()) {
                return;
            }

            $link = 'https://codecanyon.net/downloads#item-17450674';
            $on = 'CodeCanyon';
            if ($this->show_notes) {
                $link = 'https://wordpress.org/support/plugin/currency-switcher/reviews/#new-post';
                $on = 'WordPress';
            }
            ?>
            <div class="notice notice-info" id="pn_<?php echo $slug ?>_ask_favour" style="position: relative;">
                <button onclick="javascript: pn_<?php echo $slug ?>_dismiss_review(1); void(0);" title="<?php _e('Later', 'currency-switcher'); ?>" class="notice-dismiss"></button>
                <div id="pn_<?php echo $slug ?>_review_suggestion">
                    <p><?php _e('Hi! Are you enjoying using <i>WPCS - WordPress Currency Switcher</i>?', 'currency-switcher'); ?></p>
                    <p><a href="javascript: pn_<?php echo $slug ?>_set_review(1); void(0);"><?php _e('Yes, I love it', 'currency-switcher'); ?></a> 🙂 | <a href="javascript: pn_<?php echo $slug ?>_set_review(0); void(0);"><?php _e('Not really...', 'currency-switcher'); ?></a></p>
                </div>

                <div id="pn_<?php echo $slug ?>_review_yes" style="display: none;">
                    <p><?php printf(__('That\'s awesome! Could you please do us a BIG favor and give it a 5-star rating on %s to help us spread the word and boost our motivation?', 'currency-switcher'), $on) ?></p>
                    <p style="font-weight: bold;">~ PluginUs.NET developers team</p>
                    <p>
                        <a href="<?php echo $link ?>" style="display: inline-block; margin-right: 10px;" onclick="pn_<?php echo $slug ?>_dismiss_review(2)" target="_blank"><?php esc_html_e('Okay, you deserve it', 'currency-switcher'); ?></a>
                        <a href="javascript: pn_<?php echo $slug ?>_dismiss_review(1); void(0);" style="display: inline-block; margin-right: 10px;"><?php esc_html_e('Nope, maybe later', 'currency-switcher'); ?></a>
                        <a href="javascript: pn_<?php echo $slug ?>_dismiss_review(2); void(0);"><?php esc_html_e('I already did', 'currency-switcher'); ?></a>
                    </p>
                </div>

                <div id="pn_<?php echo $slug ?>_review_no" style="display: none;">
                    <p><?php _e('We are sorry to hear you aren\'t enjoying WPCS. We would love a chance to improve it. Could you take a minute and let us know what we can do better?', 'currency-switcher'); ?></p>
                    <p>
                        <a href="https://pluginus.net/contact-us/" onclick="pn_<?php echo $slug ?>_dismiss_review(2)" target="_blank"><?php esc_html_e('Give Feedback', 'currency-switcher'); ?></a>&nbsp;
                        |&nbsp;<a href="javascript: pn_<?php echo $slug ?>_dismiss_review(2); void(0);"><?php esc_html_e('No thanks', 'currency-switcher'); ?></a>
                    </p>
                </div>


                <script>
                    //dynamic script
                    function pn_<?php echo $slug ?>_set_review(yes) {
                        document.getElementById('pn_<?php echo $slug ?>_review_suggestion').style.display = 'none';
                        if (yes) {
                            document.getElementById('pn_<?php echo $slug ?>_review_yes').style.display = 'block';
                        } else {
                            document.getElementById('pn_<?php echo $slug ?>_review_no').style.display = 'block';
                        }
                    }

                    function pn_<?php echo $slug ?>_dismiss_review(what = 1) {
                        //1 maybe later, 2 do not ask more
                        jQuery('#pn_<?php echo $slug ?>_ask_favour').fadeOut();

                        if (what === 1) {
                            jQuery.post(ajaxurl, {
                                action: '<?php echo $slug ?>_later_rate_alert'
                            });
                        } else {
                            jQuery.post(ajaxurl, {
                                action: '<?php echo $slug ?>_dismiss_rate_alert'
                            });
                        }

                        return true;
                    }
                </script>
            </div>
            <?php
        });
    }

}

//+++
$WPCS = new WPCS();
$GLOBALS['WPCS'] = $WPCS;
add_action('init', array($WPCS, 'init'), 1);

