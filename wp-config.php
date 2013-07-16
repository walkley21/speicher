<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress_speicher');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

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
define('AUTH_KEY',         '^4!8f;FGk8C_ry,e7k5-Zq4.6;_ai_J3EFVv59} hj2u@%BMeYWZw eZbwSm*UiY');
define('SECURE_AUTH_KEY',  'P%.nWLO;x1yD)$E>A;,0cnZR2k`xgD$y+(UjeXy#nBZtqy54;8>_GXkZ=Ss9a![)');
define('LOGGED_IN_KEY',    'PE@yl$t,(f7)P3#0)`^_,j.1H.O&y*RwtH}ZhMdeeyDq#c^EYe@$z/ +.I]u%Mws');
define('NONCE_KEY',        'z*l59W]_]m^sIOM*cn8>bIf{R,JDJ:O:#!G]O8Dg|<[6_SOf8aBUt~u1Cz#dXV[6');
define('AUTH_SALT',        '@gVhNP5:.`HiYa<WcZ49=J~p>.3OQg8G@*JtF(te^ye@k}&1B1/Cc% d[=|gDeS+');
define('SECURE_AUTH_SALT', '*:t}tfLa{L2 WZJ&:;<Dn3aFLQw%RNj(u7CW7YuxrSP-N1T#&2^Zk%.cT2{hAQNU');
define('LOGGED_IN_SALT',   '02i`f{rGz>=49H~s/.R8 Vw}3y_^9w@,hic`@r[!bta!P|.+4CYOX}PY{21:BYU:');
define('NONCE_SALT',       'HdqXSfFXxdcB^[a4{+.|C1&-B1jF5#s|&rz~yg$*g{e;|.r3CzUf03^p% yS[^%u');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
