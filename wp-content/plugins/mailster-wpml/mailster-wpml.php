<?php
/*
Plugin Name: Mailster WPML
Plugin URI: https://mailster.co/?utm_campaign=wporg&utm_source=Mailster+WPML&utm_medium=plugin
Description: This add on helps to integrate the Mailster with WPML
Version: 0.4
Author: EverPress
Author URI: https://mailster.co
Text Domain: mailster-wpml
License: GPLv2 or later
*/

define( 'MAILSTER_WPML_VERSION', '0.4' );
define( 'MAILSTER_WPML_REQUIRED_VERSION', '2.4.3' );
define( 'MAILSTER_WPML_FILE', __FILE__ );

require_once dirname( __FILE__ ) . '/classes/wpml.class.php';
new MailsterWPML();
