<?php
// Check if there's a menu assigned to the 'primary' location.
if ( ! has_nav_menu( 'primary' ) ) {
	return;
}
?>

<nav class="main-navigation" <?php hybrid_attr( 'menu' ); ?>>

	<?php wp_nav_menu(
		array(
			'theme_location' => 'primary',
			'container'      => false,
			'menu_id'        => 'menu-primary-items',
			'menu_class'     => 'menu-primary-items',
			'walker'         => new TrueReview_Custom_Nav_Walker
		)
	); ?>

</nav><!-- .main-navigation -->
