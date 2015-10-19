<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', '012_wordpress');
//define('DB_NAME', '445612_012_staging');

/** MySQL database username */
define('DB_USER', 'root');
//define('DB_USER', '445612_012user');

/** MySQL database password */
define('DB_PASSWORD', '');
//define('DB_PASSWORD', 'ckU!t05KM83MdlHp');

/** MySQL hostname */
define('DB_HOST', 'localhost');
//define('DB_HOST', 'mysql51-004.wc2.dfw1.stabletransit.com');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'z_-WEX_+IG(2.n3/M~mE5wT<WLImAhjj~|pW,L5[l-78^08ZP!fWKU3#s}By>[BB');
define('SECURE_AUTH_KEY',  'N@D=BSBi5lM>ndF{|12J|[DN<gfvs7xZ{1kH>.N0@Pr$[46+RB+2bJ< >66|o%So');
define('LOGGED_IN_KEY',    'aD SU{,{0!5pZ)26woA<_L^hUJQ#ce>7~l8={{Pu13k89r$|:x&2w;,J&_N2IUs<');
define('NONCE_KEY',        ']M.l~UE-+9_9>8~AI43aj,wB.cdcUuwo-n2,M[s{~K}F.iXF<KLi7+9r}u{[7[Q+');
define('AUTH_SALT',        '0Fk.`M2>*WS`>noE]J(.${kVXsM6^/v_%bfRfa6t1/!$~v7G!,u!h5zm^P.+Y:oE');
define('SECURE_AUTH_SALT', ')WBwLhl$.2y[#P4hD-+R|t^_<z4u,.tA; USwdo&MH5:vOLRkiK*w%-ZJsk0np|B');
define('LOGGED_IN_SALT',   'FK..;w_|1w9#8^bMDY]rTU~7-|r/f(ilOI+%CMGk){BIz0Gpgv`+jM-qoxxoL17a');
define('NONCE_SALT',       'y6t!kLXC>)s2/+cK-B(S{g57&[2tHjr5E#~(3/*_j7Xc-+veUw~ryB0I.|oO?9<$');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
