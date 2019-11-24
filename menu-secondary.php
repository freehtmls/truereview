<?php
// Check if there's a menu assigned to the 'secondary' location.
if ( ! has_nav_menu( 'secondary' ) ) {
	return;
}
?>

<nav class="secondary-navigation" <?php hybrid_attr( 'menu' ); ?>>

	<?php wp_nav_menu(
		array(
			'theme_location'  => 'secondary',
			'container_class' => 'menu-secondary-container',
			'menu_id'         => 'menu-secondary-items',
			'menu_class'      => 'menu-secondary-items',
			'walker'          => new TrueReview_Custom_Nav_Walker
		)
	); ?>

	<?php
		// Get data set in customizer
		$search = truereview_mod( PREFIX . 'search-header' );
		if ( $search ) :
	?>
		<?php get_search_form(); ?>
	<?php endif; ?>

</nav><!-- .secondary-navigation -->
