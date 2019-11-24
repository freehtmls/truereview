<?php
/**
 * Classic block.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueReview_Classic_Block extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'truereview_classic_block',
			'description' => esc_html__( 'Display classic style posts list.', 'truereview' )
		);

		// Create the widget.
		parent::__construct(
			'truereview_classic_block',                  // $this->id_base
			esc_html__( 'Classic Block', 'truereview' ), // $this->name
			$widget_options                             // $this->widget_options
		);

		$this->alt_option_name = 'truereview_classic_block';
	}

	/**
	 * Outputs the widget based on the arguments input through the widget controls.
	 *
	 * @since 1.0.0
	 */
	public function widget( $args, $instance ) {
		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		// Set up default value
		$cat = ( ! empty( $instance['cat'] ) ) ? $instance['cat'] : '';
		$num = ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : 5;
		if ( ! $num ) {
			$num = 5;
		}

		// Output the theme's $before_widget wrapper.
		echo $args['before_widget'];

			if ( $cat ) :

				// Pull the selected category.
				$cat_id = intval( $cat );

				// Get the category.
				$category = get_category( $cat_id );

				// Get the category archive link.
				$cat_link = get_category_link( $cat_id );

				// Get the category color
				$color = truereview_get_term_color( $cat_id, true );
				$color = $color ? $color : '#46a546';

				// Posts query arguments.
				$query = array(
					'posts_per_page' => $num,
					'post_type'      => 'post',
					'cat'            => $cat
				);

				// Allow dev to filter the post arguments.
				$query = apply_filters( 'truereview_classic_block_arg', $query );

				// The post query.
				$posts = new WP_Query( $query );

				if ( $posts->have_posts() ) : ?>

					<div class="classic-block">

						<h4 class="section-title" style="border-color: <?php echo sanitize_hex_color( $color ); ?>">
							<span class="cat-name" style="background-color: <?php echo sanitize_hex_color( $color ); ?>"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $category->name ); ?></a></span>
							<span class="see-all"><a href="<?php echo esc_url( $cat_link ); ?>"><?php esc_html_e( 'More &raquo;', 'truereview' ); ?></a></span>
						</h4>

						<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>
							<?php get_template_part( 'partials/content', get_post_format() ); ?>
						<?php endwhile; ?>

					</div>

				<?php endif;

				// Restore original Post Data.
				wp_reset_postdata();

			endif;

		// Close the theme's widget wrapper.
		echo $args['after_widget'];

	}

	/**
	 * Updates the widget control options for the particular instance of the widget.
	 *
	 * @since 1.0.0
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['cat'] = intval( $new_instance['cat'] );
		$instance['number'] = (int) $new_instance['number'];
		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		$cat = isset( $instance['cat'] ) ? intval( $instance['cat'] ) : '';
		$num = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php esc_html_e( 'Choose Category:', 'truereview' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" style="width:100%;">
				<?php $categories = get_terms( 'category' ); ?>
				<?php foreach( $categories as $category ) { ?>
					<option value="<?php echo intval( $category->term_id ); ?>" <?php selected( $cat, intval( $category->term_id ) ); ?>><?php echo esc_html( $category->name ); ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'truereview' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo intval( $num ); ?>" size="3" />
		</p>

	<?php

	}

}
