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
define( 'DB_NAME', 'websell_v1' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         'Tzpc~zWCw)sgdpCVcP4b]:zOeNH>aB$k8d @G7ln}:fY#nW|X8a(uxiKAbO}YD$1' );
define( 'SECURE_AUTH_KEY',  '+Nc_5g*rB;f|9KGP~xK@x~A(wQU38@mhZ1{)/E=EtAO*xqL)m;o=ieqBj*aK_5g8' );
define( 'LOGGED_IN_KEY',    '8#F/WsU{x{Hu+voslZ/dJkkW8d_nx4/d,$nH-?ZfNX9(hIL1<GjnHZCIuQD?cRyf' );
define( 'NONCE_KEY',        'vF<VVLt/Lq~ hy,aLr;^#}Hon3kUVl&YC<yJTv:^0Yd:gp2A.2[yjx]!*7l]+Q!C' );
define( 'AUTH_SALT',        '91=v`^HYm6.%qO0sMBj<Q_DA;VLm_ks k#Y(sMEgE^QOr<nf99ug09J`VP@x~k{U' );
define( 'SECURE_AUTH_SALT', '4O{md,(&h2$_<{2)MQK5P4mK<j@1UVmkF5z25kdy5q,]R 0]GSDDp68`8Qu;CESB' );
define( 'LOGGED_IN_SALT',   'MU&,cuY-ILy*{CznBGN3XO!b]({K,Qoi:F^(C5C7A-1<B&v)O03txQH,[Y#dF7q}' );
define( 'NONCE_SALT',       '120[#8YWsh4<r8wncr&l-o~o*D]5K;OOQE*[f2IN9[c[12}2jWzcs]tJ1OnHs)N{' );

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
