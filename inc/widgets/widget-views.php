<?php
/**
 * Most Views Posts with Thumbnail widget.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueReview_Views_Widget extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'widget-truereview-views posts-thumbnail-widget',
			'description' => esc_html__( 'Display the most views posts with thumbnails.', 'truereview' )
		);

		// Create the widget.
		parent::__construct(
			'truereview-views',                                                // $this->id_base
			esc_html__( '&raquo; Most Views Posts Thumbnails', 'truereview' ), // $this->name
			$widget_options                                                   // $this->widget_options
		);

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

		// Posts query arguments.
		$args = array(
			'post_type'      => 'post',
			'posts_per_page' => $instance['limit'],
			'orderby'        => 'meta_value_num',
			'meta_key'       => 'Views'
		);

		// The post query
		$views = new WP_Query( $args );

		// Set image size
		$size = 'thumbnail';
		if ( $instance['style'] !== 'default' ) {
			$size = 'post-thumbnail';
		}

		if ( $views->have_posts() ) {
			echo '<ul class="' . esc_attr( $instance['style'] ) . '-style">';

				while ( $views->have_posts() ) :
					$views->the_post();

					echo '<li>';
						if ( has_post_thumbnail() ) :
							echo '<a class="thumbnail-link" href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . get_the_post_thumbnail( get_the_ID(), $size, array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ) . '</a>';
						endif;
						echo '<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . esc_attr( get_the_title() ) . '</a>';
						echo '<div class="entry-info">';
							if ( $instance['show_date'] ) :
								echo '<time class="entry-date" datetime="' . esc_html( get_the_date( 'c' ) ) . '">' . esc_html( get_the_date() ) . '</time>';
							endif;
							if ( $instance['show_view'] && function_exists( 'truereview_entry_views_get' ) ) :
								echo '<span class="entry-view">- ' .  truereview_entry_views_get( array( 'after' => esc_html__( ' Views', 'truereview' ) ) ) . '</span>';
							endif;
						echo '</div>';
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
		$instance['title']     = strip_tags( $new_instance['title'] );
		$instance['limit']     = (int) $new_instance['limit'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$instance['show_view'] = isset( $new_instance['show_view'] ) ? (bool) $new_instance['show_view'] : false;
		$instance['style']     = isset( $new_instance['style'] ) ? esc_attr( $new_instance['style'] ) : 'default';

		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	function form( $instance ) {

		// Default value.
		$defaults = array(
			'title'     => esc_html__( 'Most Views Posts', 'truereview' ),
			'limit'     => 5,
			'show_date' => false,
			'show_view' => false,
			'style'     => 'default'
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
			<input class="checkbox" type="checkbox" <?php checked( $instance['show_view'] ); ?> id="<?php echo $this->get_field_id( 'show_view' ); ?>" name="<?php echo $this->get_field_name( 'show_view' ); ?>" />
			<label for="<?php echo $this->get_field_id( 'show_view' ); ?>">
				<?php esc_html_e( 'Display post view?', 'truereview' ); ?>
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
