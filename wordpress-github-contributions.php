<?php
/*
Plugin Name: Wordpress GitHub Contributions
Plugin URI: http://www.ceilicornelison.com
Description: Adds a visual display of GitHub actions by day
Version: 0.1
Author: Ceili Cornelison
Author URI: http://www.ceilicornelison.com
License: GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: wg-contrib
*/

// Block direct requests
if ( !defined('ABSPATH') )
	die('-1');
	
add_action( 'widgets_init', function(){
     register_widget( 'WordPress_GitHub_Contributions' );
});	

/**
 * Adds WordPress_GitHub_Contributions widget.
 */
class WordPress_GitHub_Contributions extends WP_Widget {

	/**
	 * Register widget with WordPress.
	 */
	function __construct() {
		parent::__construct(
			'WordPress_GitHub_Contributions', // Base ID
			__('WordPress GitHub Contributions', 'wg-contrib'), // Name
			array( 'description' => __( 'Adds a visual display of GitHub actions by day', 'wg-contrib' ), ) // Args
		);
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args     Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance ) {
	
     	echo $args['before_widget'];
		if ( ! empty( $instance['title'] ) ) {
			echo $args['before_title'] . apply_filters( 'widget_title', $instance['title'] ). $args['after_title'];
		}
		echo __( 'Coming Soon...', 'wg-contrib' );
		echo $args['after_widget'];
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
		}
		else {
			$title = __( 'New title', 'wg-contrib' );
		}
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>">
		</p>
		<?php 
	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';

		return $instance;
	}

} // class My_Widget
