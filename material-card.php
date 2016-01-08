<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://example.com
 * @since             1.0.0
 * @package           Plugin_Name
 *
 * @wordpress-plugin
 * Plugin Name:       Material Card
 * Plugin URI:        http://geekhub.it/
 * Description:       Widget for material card components
 * Version:           1.0.0
 * Author:            Chris Piemonte
 * Author URI:        https://plus.google.com/+ChrisPiemonte/about
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       Material Card
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-plugin-name-activator.php
 */
function activate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-activator.php';
	Plugin_Name_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-plugin-name-deactivator.php
 */
function deactivate_plugin_name() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name-deactivator.php';
	Plugin_Name_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_plugin_name' );
register_deactivation_hook( __FILE__, 'deactivate_plugin_name' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-plugin-name.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_plugin_name() {

	$plugin = new Plugin_Name();
	$plugin->run();

}
run_plugin_name();


/*----------------------------------------------------------------------------------------------------*/

class wp_my_plugin extends WP_Widget {
 
    // constructor
    function wp_my_plugin() {
        parent::WP_Widget(false, $name = __('Material Card', 'wp_widget_plugin') );
    }

    // widget form creation
    function form($instance) {
	    
		// Check values
		if( $instance) {
		    $title = esc_attr($instance['title']);
		    $text = esc_attr($instance['text']);
		    $textarea = esc_textarea($instance['textarea']);
		    $image = esc_textarea($instance['image']);
		    $button = esc_textarea($instance['button']);
		    $buttonlink = esc_textarea($instance['buttonlink']);
		} else {
		    $title = '';
		    $text = '';
		    $textarea = '';
			$image = '';
		    $button = '';
		    $buttonlink = '';
		}
		?>

		<p>
			<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Widget Title', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo $title; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('text'); ?>"><?php _e('Card Title:', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('text'); ?>" name="<?php echo $this->get_field_name('text'); ?>" type="text" value="<?php echo $text; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('textarea'); ?>"><?php _e('Text Area:', 'wp_widget_plugin'); ?></label>
			<textarea class="widefat" id="<?php echo $this->get_field_id('textarea'); ?>" name="<?php echo $this->get_field_name('textarea'); ?>"><?php echo $textarea; ?></textarea>
		</p>



		<p>
			<label for="<?php echo $this->get_field_id('image'); ?>"><?php _e('Image URL', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('image'); ?>" name="<?php echo $this->get_field_name('image'); ?>" type="text" value="<?php echo $image; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('button'); ?>"><?php _e('Button', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('button'); ?>" name="<?php echo $this->get_field_name('button'); ?>" type="text" value="<?php echo $button; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('buttonlink'); ?>"><?php _e('Button Link', 'wp_widget_plugin'); ?></label>
			<input class="widefat" id="<?php echo $this->get_field_id('buttonlink'); ?>" name="<?php echo $this->get_field_name('buttonlink'); ?>" type="text" value="<?php echo $buttonlink; ?>" />
		</p>

		<?php
    }

    // widget update
    function update($new_instance, $old_instance) {
    	$instance = $old_instance;
    	// Fields
    	$instance['title'] = strip_tags($new_instance['title']);
    	$instance['text'] = strip_tags($new_instance['text']);
    	$instance['textarea'] = strip_tags($new_instance['textarea']);
    	$instance['image'] = strip_tags($new_instance['image']);
    	$instance['button'] = strip_tags($new_instance['button']);
    	$instance['buttonlink'] = strip_tags($new_instance['buttonlink']);
    	return $instance;
    }

    // widget display
    function widget($args, $instance) {
    	extract( $args );
    	// these are the widget options
    	$title = apply_filters('widget_title', $instance['title']);
    	$text = $instance['text'];
    	$textarea = $instance['textarea'];
    	$image = $instance['image'];
    	$button = $instance['button'];
    	$buttonlink = $instance['buttonlink'];
    	echo $before_widget;
    	// Display the widget
    	echo '<div class="widget-text wp_widget_plugin_box">';

    	// Check if title is set
    	if ( $title ) {
    		echo $before_title . $title . $after_title;
    	}

    	// Check if text is set
    	if( $text ) {
    		echo '<style>
				.demo-card-wide.mdl-card {
				  width: 100%;
				}
				.demo-card-wide > .mdl-card__title {
				  color: #fff;
				  height: 176px;
				  background: url("'.$image.'") center / cover;
				}
				.demo-card-wide > .mdl-card__menu {
				  color: #fff;
				}
				</style>

				<div class="demo-card-wide mdl-card mdl-shadow--2dp">
				  <div class="mdl-card__title">
				    <h2 class="mdl-card__title-text">'. $text .'</h2>
				  </div>
				  <div class="mdl-card__supporting-text">
				    '.$textarea.'
				  </div>
				  <div class="mdl-card__actions mdl-card--border">
				    <a href="'.$buttonlink.'" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
				      '.$button.'
				    </a>
				  </div>
				  <div class="mdl-card__menu">
				  </div>
				</div>';
    	}
    	// Check if textarea is set
    	if( $textarea ) {
    		//echo '<p class="wp_widget_plugin_textarea">'.$textarea.'</p>';
    	}
    	echo '</div>';
    	echo $after_widget;
    }
}

// register widget
add_action('widgets_init', create_function('', 'return register_widget("wp_my_plugin");'));



