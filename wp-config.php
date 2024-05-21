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
define( 'DB_NAME', 'civicrm' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

/** Database hostname */
define( 'DB_HOST', '127.0.0.1' );

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
define( 'AUTH_KEY',          '+[9CEm&.C/}Ci$K?>N#{I Va+*~{&<HqTe~|&!e8;ckCs5;Wt)8HPZ7)=%K3@jH1' );
define( 'SECURE_AUTH_KEY',   'W1C4&yn[Ut$*nY!_TqgSjJxtm0C*mpBA2)$v1]Oo}sV=nGZQbNg3r<y3{=K]j/D.' );
define( 'LOGGED_IN_KEY',     '$FG*bW@~+[>*S9>KTkTP9z`~2*lh4`0rbo8-%ZO7qjRl{|BHE]}JmdWV,rz}O;c>' );
define( 'NONCE_KEY',         'z9a~rhBWe//YoA~kpuG35eA #sWz.9gMIp3wz]R8a5_(HkaLxK*^XvXeJ]4K,*&l' );
define( 'AUTH_SALT',         '#P]+!k0huHrcP.1UpKz3VOea95_:Fs_q:4R2o+Ku5og~ANq?v!2Ct|2T$X7rLEB?' );
define( 'SECURE_AUTH_SALT',  '5DllE|fFol5xhS]Y/`& #}L+}t:^M;T]sv#e+jw#<OmE=P95?mn7XUo|fgJ236I<' );
define( 'LOGGED_IN_SALT',    'va@AhbXXFSG7:OvP*/e+.n*$-nUaln`ZEd-xS}>xMwLaGV+/;+D1/uPR*1Zxa~DU' );
define( 'NONCE_SALT',        '_B)<-NTSk{]5}d+c&g#Efvwfw3Z(9rUmstCvuryH;$2$8(4x7|WQKmCJ5GcE8j`1' );
define( 'WP_CACHE_KEY_SALT', 'aoPXS2TMkdfm89z4l`jIxqriRKwM]=^:c^>r4QdE0-,Eu;S~Y4@nHqD5sj>@1h21' );


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

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
