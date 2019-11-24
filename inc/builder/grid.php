<?php
/**
 * Grid block.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueReview_Grid_Block extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'truereview_grid_block',
			'description' => esc_html__( 'Display grid style posts list.', 'truereview' )
		);

		// Create the widget.
		parent::__construct(
			'truereview_grid_block',                  // $this->id_base
			esc_html__( 'Grid Block', 'truereview' ), // $this->name
			$widget_options                          // $this->widget_options
		);

		$this->alt_option_name = 'truereview_grid_block';
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
		$num = ( ! empty( $instance['number'] ) ) ? intval( $instance['number'] ) : 2;
		if ( ! $num ) {
			$num = 2;
		}
		$col = ( ! empty( $instance['column'] ) ) ? esc_attr( $instance['column'] ) : 'two-columns';

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
				$query = apply_filters( 'truereview_grid_block_arg', $query );

				// The post query.
				$posts = new WP_Query( $query );

				if ( $posts->have_posts() ) : ?>

					<div class="grid-block <?php echo esc_attr( $col ); ?>">

						<h4 class="section-title" style="border-color: <?php echo sanitize_hex_color( $color ); ?>">
							<span class="cat-name" style="background-color: <?php echo sanitize_hex_color( $color ); ?>"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $category->name ); ?></a></span>
							<span class="see-all"><a href="<?php echo esc_url( $cat_link ); ?>"><?php esc_html_e( 'More &raquo;', 'truereview' ); ?></a></span>
						</h4>

						<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

							<div class="grid-post post-overlay">
								<?php if ( has_post_thumbnail() ) : ?>
									<a class="thumbnail-link" href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail( 'medium', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
										<span class="img-overlay"></span>
									</a>
								<?php endif; ?>
								<div class="grid-post-meta post-overlay-meta">
									<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
									<?php
										// Get the review score
										$type   = get_post_meta( get_the_ID(), 'tj_review_type', true );
										$review = get_post_meta( get_the_ID(), 'tj_review_feature', true );
										$avg = truereview_review_avg( array( 'type' => $type, 'count' => $review, 'progressbar' => true ) );
										if ( $avg ) :
									?>
										<span class="post-review">
											<span class="review-score">
												<span class="bar" style="width: <?php echo intval( $avg ) . '%'; ?>"></span>
											</span>
										</span>
									<?php endif; ?>
									<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
								</div>
							</div>

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
		$instance['column'] = isset( $new_instance['column'] ) ? esc_attr( $new_instance['column'] ) : 'two-columns';
		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		$cat = isset( $instance['cat'] ) ? intval( $instance['cat'] ) : '';
		$num = isset( $instance['number'] ) ? absint( $instance['number'] ) : 2;
		$col = isset( $instance['column'] ) ? esc_attr( $instance['column'] ) : 'two-columns';
	?>

		<p>
			<label for="<?php echo $this->get_field_id( 'cat' ); ?>"><?php esc_html_e( 'Choose Category:', 'truereview' ); ?></label>
			<select class="widefat" id="<?php echo $this->get_field_id( 'cat' ); ?>" name="<?php echo $this->get_field_name( 'cat' ); ?>" style="width:100%;">
				<?php $categories = get_terms( 'category' ); ?>
				<?php foreach( $categories as $category ) { ?>
					<option value="<?php echo absint( $category->term_id ); ?>" <?php selected( $cat, absint( $category->term_id ) ); ?>><?php echo esc_html( $category->name ); ?></option>
				<?php } ?>
			</select>
		</p>

		<p>
			<label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php esc_html_e( 'Number of posts to show:', 'truereview' ); ?></label>
			<input class="tiny-text" id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="number" step="1" min="1" value="<?php echo absint( $num ); ?>" size="3" />
		</p>

		<p>
			<label for=""><?php esc_html_e( 'Columns', 'truereview' ); ?></label>
			<ul>
				<li>
					<input class="radio" type="radio" value="two-columns" <?php checked( $col, 'two-columns' ); ?> id="<?php echo $this->get_field_id( 'column' ); ?>-two" name="<?php echo $this->get_field_name( 'column' ); ?>" />
					<label for="<?php echo $this->get_field_id( 'column' ); ?>-two">
						<?php esc_html_e( 'Two Columns', 'truereview' ); ?>
					</label>
				</li>
				<li>
					<input class="radio" type="radio" value="three-columns" <?php checked( $col, 'three-columns' ); ?> id="<?php echo $this->get_field_id( 'column' ); ?>-three" name="<?php echo $this->get_field_name( 'column' ); ?>" />
					<label for="<?php echo $this->get_field_id( 'column' ); ?>-three">
						<?php esc_html_e( 'Three Columns', 'truereview' ); ?>
					</label>
				</li>
			</ul>
		</p>

	<?php

	}

}
