<div class="top-bar">
	<div class="container">

		<div class="top-bar-left">
			<?php
				// Get data set in customizer
				$date = truereview_mod( PREFIX . 'date-header' );
				if ( $date ) :
			?>
				<div class="today"><?php echo apply_filters( 'truereview_today_date', date( 'l, j M Y' ) ); ?></div>
			<?php endif; ?>
			<?php get_template_part( 'menu' ); // Loads the menu.php template. ?>
		</div>

		<?php
			// Get data set in customizer
			$social = truereview_mod( PREFIX . 'social-header' );
			if ( $social ) :
		?>
			<div class="top-bar-right">
				<?php truereview_social_icons(); ?>
			</div>
		<?php endif; ?>

	</div>
</div>
