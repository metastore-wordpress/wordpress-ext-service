<?php
/**
 * Plugin Name:     (WP-EXT) Service
 * Plugin URI:      https://metastore.pro/
 *
 * Description:     Service post type and more.
 *
 * Author:          Kitsune Solar
 * Author URI:      https://kitsune.solar/
 *
 * Version:         1.0.0
 *
 * Text Domain:     wp-ext-service
 * Domain Path:     /languages
 *
 * License:         GPLv3
 * License URI:     https://www.gnu.org/licenses/gpl-3.0.html
 */

/**
 * Loading `WP_EXT_Service`.
 */

function run_wp_ext_service() {
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service_Post_Type.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service_Post_Field.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service_Taxonomy.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service_User_Role.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service_Theme.class.php' );
//	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service_Template.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service_ShortCode.class.php' );
	require_once( plugin_dir_path( __FILE__ ) . 'includes/WP_EXT_Service_Widget.class.php' );
}

run_wp_ext_service();
