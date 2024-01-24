<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'u778916805_digiglam' );

/** Database username */
define( 'DB_USER', 'u778916805_digiglam' );

/** Database password */
define( 'DB_PASSWORD', 'Ovc9]0Rr' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'NA{}TKz(S~t[vc<`>`6q=27ve1FMOejK00`l[]s&x6&5=mUk$A#P>rO|8GHPmK+|' );
define( 'SECURE_AUTH_KEY',  '(-PUxyB2u9YH:?ESlyBd=l!n4qa|],n.m[:-<j%v~@`&rUR }WQ>=VEo:QPj{ 64' );
define( 'LOGGED_IN_KEY',    'A,-Bx.t4KwI>dW{j]9vq2:`]~#ot#~br42kS)meL!OVC}OHwwjB;r@:YKme7F?M_' );
define( 'NONCE_KEY',        'w+>c4&1p98|Wn$acA*gl#EyMWtu:&$KUvs9=QL_@mN$kubgQnp}{]q3q?=gt|k8B' );
define( 'AUTH_SALT',        '0tI0~EfK$pIm&_zdVoOmrlgZ42O_3% +Dzs) T]C[5=9*0I5yA|}bU9uviUAgwf~' );
define( 'SECURE_AUTH_SALT', ':20zzm`asV@EAEAY`N=Dd?% r? Ai|nxyJN6@S?z[S/2fGlz J@BD%XJSg2]{aEM' );
define( 'LOGGED_IN_SALT',   'DA?=>?x3e.SJ/?UBX]bC>ETEEj%)d*:]6*#-auO}[Ze$q.?g*:<SEbn}/Wmi@SW!' );
define( 'NONCE_SALT',       '`a`_*M)!b{/qESY4-o[/Z{J3qm!!Pm$d]d%m1xj6Qe5n;&N-&#wJE0Y)78 *^U>6' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';



/** errors */

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);
