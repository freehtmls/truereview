<?php
/**
 * Modern vertical block.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */
class TrueReview_Modern_Vertical_Block extends WP_Widget {

	/**
	 * Sets up the widgets.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		// Set up the widget options.
		$widget_options = array(
			'classname'   => 'truereview_modern_vertical_block',
			'description' => esc_html__( 'Display modern vertical style posts list.', 'truereview' )
		);

		// Create the widget.
		parent::__construct(
			'truereview_modern_vertical_block',                  // $this->id_base
			esc_html__( 'Modern Vertical Block', 'truereview' ), // $this->name
			$widget_options                                     // $this->widget_options
		);

		$this->alt_option_name = 'truereview_modern_vertical_block';
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
					'posts_per_page' => 4,
					'post_type'      => 'post',
					'cat'            => $cat
				);

				// Allow dev to filter the post arguments.
				$query = apply_filters( 'truereview_modern_vertical_block_arg', $query );

				// The post query.
				$posts = new WP_Query( $query );

				if ( $posts->have_posts() ) : ?>

					<div class="modern-block modern-vertical-block">

						<h4 class="section-title" style="border-color: <?php echo sanitize_hex_color( $color ); ?>">
							<span class="cat-name" style="background-color: <?php echo sanitize_hex_color( $color ); ?>"><a href="<?php echo esc_url( $cat_link ); ?>"><?php echo esc_html( $category->name ); ?></a></span>
							<span class="see-all"><a href="<?php echo esc_url( $cat_link ); ?>"><?php esc_html_e( 'More &raquo;', 'truereview' ); ?></a></span>
						</h4>

						<?php while ( $posts->have_posts() ) : $posts->the_post(); ?>

							<?php if ( 0 === $posts->current_post ) : ?>
								<div class="top-post">
									<?php if ( has_post_thumbnail() ) : ?>
										<a class="thumbnail-link" href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'large', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
										</a>
									<?php endif; ?>
									<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
									<div class="entry-meta">
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
										<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
										<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
											<span class="entry-comment"><?php comments_popup_link( esc_html__( '0 Comment', 'truereview' ), esc_html__( '1 Comment', 'truereview' ), esc_html__( '% Comments', 'truereview' ) ); ?></span>
										<?php endif; ?>
									</div>

									<div class="entry-summary" <?php hybrid_attr( 'entry-summary' ); ?>>
										<?php the_excerpt(); ?>
									</div>
								</div>
							<?php else : ?>

								<?php if ( 1 === $posts->current_post ) :?>
									<div class="bottom-post">
								<?php endif; ?>

									<div class="small-post">
										<?php if ( has_post_thumbnail() ) : ?>
											<a class="thumbnail-link" href="<?php the_permalink(); ?>">
												<?php the_post_thumbnail( 'thumbnail', array( 'class' => 'entry-thumbnail', 'alt' => esc_attr( get_the_title() ) ) ); ?>
											</a>
										<?php endif; ?>
										<?php the_title( sprintf( '<h2 class="entry-title" ' . hybrid_get_attr( 'entry-title' ) . '><a href="%s" rel="bookmark" itemprop="url">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										<div class="entry-meta">
											<time class="entry-date published" datetime="<?php echo esc_attr( get_the_date( 'c' ) ); ?>" <?php hybrid_attr( 'entry-published' ); ?>><?php echo esc_html( get_the_date() ); ?></time>
											<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
												<span class="entry-comment"><?php comments_popup_link( esc_html__( '0 Comment', 'truereview' ), esc_html__( '1 Comment', 'truereview' ), esc_html__( '% Comments', 'truereview' ) ); ?></span>
											<?php endif; ?>
										</div>
									</div>

								<?php if ( $posts->post_count === $posts->current_post + 1 ) : ?>
									</div>
								<?php endif; ?>

							<?php endif; ?>

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
		$instance['cat'] = absint( $new_instance['cat'] );
		return $instance;
	}

	/**
	 * Displays the widget control options in the Widgets admin screen.
	 *
	 * @since 1.0.0
	 */
	public function form( $instance ) {
		$cat = isset( $instance['cat'] ) ? intval( $instance['cat'] ) : '';
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

	<?php

	}

}
