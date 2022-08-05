<?php
/*
Plugin Name: Questions Moodle Integration
Plugin URI: https://decodecms.com
Description: Plugin integration Moodle questions in WordPress
Version: 1.0
Author: Jhon Marreros Guzmán
Author URI: https://decodecms.com
Text Domain: questions-moodle
Domain Path: languages
License: GPL-2.0+
License URI: http://www.gnu.org/licenses/gpl-2.0.txt
*/

namespace dcms\questions;

use dcms\questions\includes\Plugin;
use dcms\questions\includes\Submenu;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Plugin class to handle settings constants and loading files
**/
final class Loader{

	// Define all the constants we need
	public function define_constants(){
		define ('DCMS_QUESTIONS_VERSION', '1.0');
		define ('DCMS_QUESTIONS_PATH', plugin_dir_path( __FILE__ ));
		define ('DCMS_QUESTIONS_URL', plugin_dir_url( __FILE__ ));
		define ('DCMS_QUESTIONS_BASE_NAME', plugin_basename( __FILE__ ));
		define ('DCMS_QUESTIONS_SUBMENU', 'tools.php');
	}

	// Load all the files we need
	public function load_includes(){
		include_once ( DCMS_QUESTIONS_PATH . '/helpers/functions.php');
		include_once ( DCMS_QUESTIONS_PATH . '/helpers/moodle-conection.php');
		include_once ( DCMS_QUESTIONS_PATH . '/database/db-moodle.php');
		include_once ( DCMS_QUESTIONS_PATH . '/database/db-wordpress.php');
		include_once ( DCMS_QUESTIONS_PATH . '/includes/plugin.php');
		include_once ( DCMS_QUESTIONS_PATH . '/includes/submenu.php');
	}

	// Load tex domain
	public function load_domain(){
		add_action('plugins_loaded', function(){
			$path_languages = dirname(DCMS_QUESTIONS_BASE_NAME).'/languages/';
			load_plugin_textdomain('questions-moodle', false, $path_languages );
		});
	}

	// Add link to plugin list
	public function add_link_plugin(){
		add_action( 'plugin_action_links_' . plugin_basename( __FILE__ ), function( $links ){
			return array_merge( array(
				'<a href="' . esc_url( admin_url( DCMS_QUESTIONS_SUBMENU . '?page=questions-moodle' ) ) . '">' . __( 'Settings', 'questions-moodle' ) . '</a>'
			), $links );
		} );
	}

	// Initialize all
	public function init(){
		$this->define_constants();
		$this->load_includes();
		$this->load_domain();
		$this->add_link_plugin();
		new Plugin;
		new SubMenu;
	}

}

$dcms_questions_process = new Loader();
$dcms_questions_process->init();


