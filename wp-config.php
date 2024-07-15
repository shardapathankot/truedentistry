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
define( 'AUTH_KEY',          '#{_8_Wc]u(zAWBrUPHJs;0scF&?)O=[DS@lBsEj@Si@pJBJh?f=(=q:6a)BSUY:u' );
define( 'SECURE_AUTH_KEY',   '_G`4*wK#44q?Jd^WY}XWoE_c,l/1b6JFh:Ilqb}:no3n9/7xp{c&e@TDiE7%:c=q' );
define( 'LOGGED_IN_KEY',     '-R))B`O^-+gw]QVHi&NqMDO$Y%0$p`2T4,`e UypG9j*cvIo5#G}(o3;e:%L }z/' );
define( 'NONCE_KEY',         '|VlWN>@<H-_3KB1cdYvcB[fks[UHoiw*1F@k-,=(K6h5$W,/Y=cOVJi<i,kuI_5l' );
define( 'AUTH_SALT',         '#[I0F+ALHW}plw2Ux1gNAHE=tv*_VVyW%SB(h$NcQ[)5YrGm7|A+=$XvCld-mcx;' );
define( 'SECURE_AUTH_SALT',  '4y41~]l!}rmgQgebMf016L2f|hw@18@Pfg4]co<VRX/7%n=|@=mzF  yery[&>0/' );
define( 'LOGGED_IN_SALT',    '$80jb9UmEi.,7O]Gm:8Eh3%QXp;F$K%/9?Tq/l,ZVuLuZ%6L .Vvtg$K>te5a))|' );
define( 'NONCE_SALT',        '8970v;{LPPP4dWvB%V/qex7 =b1+}AvME>fa7bn=&.>Bt5&yWX<s^E_-XcN&>CJY' );
define( 'WP_CACHE_KEY_SALT', '}3nr5nMSG7ALSFl4 Sue){$)]u|*Oc8cccw4brE,?tCp<BP`;8%ue+X(|g!0=/OC' );


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
