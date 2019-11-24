<?php
/**
 * Recent Coupon Posts with Thumbnail widget.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueReview_Recent_Coupon_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-truereview-recent-coupon posts-thumbnail-widget',
			'description' => esc_html__( 'Display recent coupon posts with thumbnails.', 'truereview' )
		);

		// Create the widget.
		parent::__construct(
			'truereview-recent-coupon',                          // $this->id_base
			esc_html__( '&raquo; Recent Coupon', 'truereview' ), // $this->name
			$widget_options                                     // $this->widget_options
		);

		// Flush the transient.
		add_action( 'save_post'   , array( $this, 'flush_widget_transient' ) );
		add_action( 'deleted_post', array( $this, 'flush_widget_transient' ) );
		add_action( 'switch_theme', array( $this, 'flush_widget_transient' ) );

	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	function widget( $args, $instance ) {
		extract( $args );

		// Output the theme's $before_widget wrapper.
		echo $before_widget;

		// If the title not empty, display it.
		if ( $instance['title'] ) {
			echo $before_title . apply_filters( 'widget_title', $instance['title'], $instance, $this->id_base ) . $after_title;
		}

		// Display the recent posts.
		if ( false === ( $recent = get_transient( 'truereview_recent_coupon_widget_' . $this->id ) ) ) {

			// Posts query arguments.
			$args = array(
				'post_type'      => 'post',
				'posts_per_page' => $instance['limit'],
				'orderby'        => 'meta_value_num',
				'meta_key'       => 'tj_coupon_enable',
				'meta_value'     => 1
			);

			// The post query
			$recent = new WP_Query( $args );

			// Store the transient.
			set_transient( 'truereview_recent_coupon_widget_' . $this->id, $recent );

		}

		// Set image size
		$size = 'thumbnail';
		if ( $instance['style'] !== 'default' ) {
			$size = 'post-thumbnail';
		}

		if ( $recent->have_posts() ) {
			echo '<ul class="' . esc_attr( $instance['style'] ) . '-style">';

				while ( $recent->have_posts() ) :
					$recent->the_post();

					echo '<li>';
						if ( has_post_thumbnail() ) :
							echo '<a class="thumbnail-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_post_thumbnail( get_the_ID(), $size, array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ) . '</a>';
						endif;
						echo '<a class="post-title" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_attr( get_the_title() ) . '</a>';
						if ( $instance['show_date'] ) :
							echo '<time class="entry-date" datetime="' . esc_html( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
						endif;
					echo '</li>';

				endwhile;

			echo '</ul>';
		}

		// Reset the query.
		wp_reset_postdata();

		// Close the theme's widget wrapper.
		echo $after_widget;

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $new_instance;
		$instance['title']       = strip_tags( $new_instance['title'] );
		$instance['limit']       = (int) $new_instance['limit'];
		$instance['show_date']   = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['style']       = isset( $new_instance['style'] ) ? esc_attr( $new_instance['style'] ) : 'default';

		// Delete our transient.
		$this->flush_widget_transient();

		return $instance;
	}

	/**
	 * Flush the transient.
	 *
	 * @since  1.0.0
	 */
	function flush_widget_transient() {
		delete_transient( 'truereview_recent_coupon_widget_' . $this->id );
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title'       => esc_html__( 'Recent Coupons', 'truereview' ),
			'limit'       => 5,
			'show_date'   => false,
			'style'       => 'default'
		);

		$instance = wp_parse_args( (array) $instance, $defaults );
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php esc_html_e( 'Title', 'truereview' ); ?>
			</label>
			<input type="text" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'limit' ); ?>">
				<?php esc_html_e( 'Number of posts to show', 'truereview' ); ?>
			</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'limit' ); ?>" name="<?php echo $this->get_field_name( 'limit' ); ?>" type="number" step="1" min="0" value="<?php echo (int)( $instance['limit'] ); ?>" />
		</p>

		<p>
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_date'] ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_date' ); ?>">
				<?php esc_html_e( 'Display post date?', 'truereview' ); ?>
			</label>
		</p>

		<p>
			<label for=""><?php esc_html_e( 'Style type', 'truereview' ); ?></label>
			<ul>
				<li>
					<input class="radio" type="radio" value="default" <?php checked( $instance['style'], 'default' ); ?> id="<?php echo $this->get_field_id( 'style' ); ?>-default" name="<?php echo $this->get_field_name( 'style' ); ?>" />
					<label for="<?php echo $this->get_field_id( 'style' ); ?>-default">
						<?php esc_html_e( 'Default', 'truereview' ); ?>
					</label>
				</li>
				<li>
					<input class="radio" type="radio" value="big-thumbnail" <?php checked( $instance['style'], 'big-thumbnail' ); ?> id="<?php echo $this->get_field_id( 'style' ); ?>-big-thumbnail" name="<?php echo $this->get_field_name( 'style' ); ?>" />
					<label for="<?php echo $this->get_field_id( 'style' ); ?>-big-thumbnail">
						<?php esc_html_e( 'Big Thumbnail', 'truereview' ); ?>
					</label>
				</li>
			</ul>
		</p>

	<?php

	}

}
