<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/Schuelerzeitung-das-Netz/Schuelerzeitung-Plugin
 * @package           Schuelerzeitung
 *
 * @wordpress-plugin
 * Plugin Name:       Schuelerzeitung
 * Plugin URI:        https://github.com/Schuelerzeitung-das-Netz/Schuelerzeitung-Plugin
 * Description:       This plugin extends the theme to support the autor list
 * Version:           1.0.5
 * Author:            Schuelerzeitung
 * GitHub Plugin URI: Schuelerzeitung-das-Netz/Schuelerzeitung-Plugin
 * Primary Branch: main
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'SCHUELERZEITUNG_VERSION', '1.0.4' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-schuelerzeitung-activator.php
 */
function activate_schuelerzeitung() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-schuelerzeitung-activator.php';
	Schuelerzeitung_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-schuelerzeitung-deactivator.php
 */
function deactivate_schuelerzeitung() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-schuelerzeitung-deactivator.php';
	Schuelerzeitung_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_schuelerzeitung' );
register_deactivation_hook( __FILE__, 'deactivate_schuelerzeitung' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-schuelerzeitung.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_schuelerzeitung() {

	$plugin = new Schuelerzeitung();
	$plugin->run();

}
run_schuelerzeitung();


function authors_list($atts) {


	$Content = "<h1>Autoren</h1>";
									 
				$tags = get_tags(array(
			  'hide_empty' => true,
			'orderby' => 'count',
			'order' => 'DESC'
			));
			
				
		foreach ($tags as $tag) {
			
			$tag_link = get_tag_link( $tag->term_id );
			
			$Content .= nl2br("<article class=\"d-md-flex mg-posts-sec-post\">" .  "<span style=\"display:block;margin-left: 12px;\" class=\"autorenlist\"><a class=\"entry-title title\" href=\"" . $tag_link ."\">" . $tag->name . "</a>");
			?>
			
			
			
			<?php
		  $Content .= ("<div style=\"position: absolute;right: 50px;display: inline-block;\">Beitr??ge: ".$tag->count."</div> " . tag_description($tag)  ." ". " ");
		  
		  
		  $Content .= ("</span>"." </article>");
			
		}
	 
	return $Content;
}

add_shortcode('schuelerzeitung_author', 'authors_list');

