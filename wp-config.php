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
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

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
define( 'AUTH_KEY',          '!JWmK@f4S*HZ0*b.6G-^P`!K37AF=SASHh 0.epg&N0(zo2pZVX,}z:t3@q`h9Y4' );
define( 'SECURE_AUTH_KEY',   'ZFENF}]WjuW[^Y}i.Bg3r!7=mIhIAsT[puMP7^2Jz)TpsM dt_p7(/OXXun/MXm{' );
define( 'LOGGED_IN_KEY',     '5Mer.f1fxYE9k;{1yze=JUhSr($N`<oPLmR[15FA~X4sqC5;q#34rLF#hb:]4T:g' );
define( 'NONCE_KEY',         'Rt|h>;+in}k4B!mH5Q(*d^ykWFqZ$lFQg-fj0e(EYE5Pn&HhU:FWA`DS5]&KXma^' );
define( 'AUTH_SALT',         '{ESMKveZ m{iFclfL8ROmO*`cj. tB` _T-?H~=UPhHgsfcbsla1NeOm<wLij{/{' );
define( 'SECURE_AUTH_SALT',  ';WlylfIB&/oX!/bC&|cVn:p@b+`NVJ (uAfw0Y+xjF1dL]za<s|z`e~4t]F,grC*' );
define( 'LOGGED_IN_SALT',    '`]rl*%wm}vKt6iPgVFYzwn[)5_5{v5h[LT$*`R#7-=/Ph>5yd93o&,R|4tt|#Vuu' );
define( 'NONCE_SALT',        'KG-SQt?#LJ^1I}oBR.8@zKrEb@4-*M}/j^L_1RA*yRDNRQd$IIJ}3ar[~@SPshes' );
define( 'WP_CACHE_KEY_SALT', '7fMM,ah:U{{j 9-j$mB3c_%*^@d3[fF1 g(iAh#;punWuW6>59kEkq)yCy?1rosj' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
