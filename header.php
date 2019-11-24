<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php hybrid_attr( 'body' ); ?>>

<div id="page" class="site">

	<?php truereview_top_ads(); ?>

	<div class="wide-container">

		<?php get_template_part( 'top', 'bar' ); // Loads the top-bar.php template. ?>

		<header id="masthead" class="site-header" <?php hybrid_attr( 'header' ); ?>>
			<div class="container">

				<div class="site-branding">
					<?php truereview_site_branding(); ?>
				</div>

				<?php truereview_header_ads(); ?>

				<?php get_template_part( 'menu', 'secondary' ); // Loads the menu-secondary.php template. ?>

				<?php get_template_part( 'partials/breaking', 'news' ); // Loads the partials/breaking-news.php template. ?>

			</div>
		</header><!-- #masthead -->

		<?php truereview_after_menu_ads(); ?>

		<?php get_template_part( 'partials/content', 'featured-home' ); ?>

		<div id="content" class="site-content">
			<div class="container">
