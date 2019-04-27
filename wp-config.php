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
define( 'DB_NAME', 'midCanberra' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', 'root' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'u&C40-@uINe]FAx*2L:ifflj*zOWk}-&]*Jiqf0qh.cuuS6aHg18yjDKvNUSdxx3' );
define( 'SECURE_AUTH_KEY',  'pIZacWzH[kQ`.nf&d9*X)jgkR683!7uvDDr.?|{44Ngip$1&b[j~d*`Gy-W91vj]' );
define( 'LOGGED_IN_KEY',    '6}!`D$nBM/rYJD+POl:4;@G%)IoN&O6spXk&KpLv.U<*zi`V*[kLX7PK&99fe. 7' );
define( 'NONCE_KEY',        'r@Y;h/=q3U/=|IvMkACc9Qb:{w]1taav@6}yOdmD1sU$?lLrlra#*Fg<{)ynHS[y' );
define( 'AUTH_SALT',        'J!(#Z@f[/^lp-(N3{R}P%u&MjQT+@,To#*AY}+N7lr#D_TA)f0/5c!=er,F}8W@4' );
define( 'SECURE_AUTH_SALT', ':Xeo]es>OCz0N$-r(FrP#&+*%nCJUov&jf8~~L$;H6 |A5W.xNSyQ!S^zA*Lnbwm' );
define( 'LOGGED_IN_SALT',   'sfnz9E^*OnWpPI,Sxvne9I:{Vp9zcIPNjiGRa|>)+MUU4VZYo1Q>u]}Y*6:X*wP;' );
define( 'NONCE_SALT',       '_WKNCsHEUBN/Ao91s|vLu[Y2~iQ107yg,jEtD^y^t6|#LLKD^CyG~Y-L=W.Ez EF' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
