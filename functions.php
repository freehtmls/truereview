<?php
/**
 * Theme functions file
 *
 * Contains all of the Theme's setup functions, custom functions,
 * custom hooks and Theme settings.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * Define Theme Prefix
 */
define( 'PREFIX', 'truereview-' );

/**
 * Sets the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 * @since  1.0.0
 */
function truereview_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'truereview_content_width', 690 );
}
add_action( 'after_setup_theme', 'truereview_content_width', 0 );

/**
 * Set new content width if user uses 1 column layout.
 */
function truereview_custom_content_width() {
	global $content_width;

	if ( in_array( get_theme_mod( 'theme_layout' ), array( '1c' ) ) ) {
		$content_width = 1050;
	}

	if ( is_page_template( 'page-templates/home.php' ) ) {
		$content_width = 728;
	}
}
add_action( 'template_redirect', 'truereview_custom_content_width' );

if ( ! function_exists( 'truereview_theme_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * @since  1.0.0
 */
function truereview_theme_setup() {

	// Make the theme available for translation.
	load_theme_textdomain( 'truereview', trailingslashit( get_template_directory() ) . 'languages' );

	// Add custom stylesheet file to the TinyMCE visual editor.
	add_editor_style( array( 'assets/css/editor-style.css', truereview_fonts_url() ) );

	// Add RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	// Enable support for Post Thumbnails.
	add_theme_support( 'post-thumbnails' );

	// used for Blog
	set_post_thumbnail_size( 365, 180, true );

	// Declare image sizes.
	add_image_size( 'truereview-masonry', 365, 9999 );
	add_image_size( 'truereview-featured-big', 605, 567, true );
	add_image_size( 'truereview-featured-medium', 525, 289, true );

	// Register custom navigation menu.
	register_nav_menus(
		array(
			'primary'   => esc_html__( 'Primary Location', 'truereview' ),
			'secondary' => esc_html__( 'Secondary Location' , 'truereview' ),
		)
	);

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list', 'search-form', 'comment-form', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See: http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'audio', 'gallery', 'video'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'truereview_custom_background_args', array(
		'default-color' => 'f5f5f5'
	) ) );

	// Enable theme-layouts extensions.
	add_theme_support( 'theme-layouts',
		array(
			'1c'   => esc_html__( '1 Column Wide (Full Width)', 'truereview' ),
			'1c-n' => esc_html__( '1 Column Narrow (Full Width)', 'truereview' ),
			'2c-l' => esc_html__( '2 Columns: Content / Sidebar', 'truereview' ),
			'2c-r' => esc_html__( '2 Columns: Sidebar / Content', 'truereview' )
		),
		array( 'customize' => true, 'default' => '2c-l' )
	);

	// This theme uses its own gallery styles.
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Hide ACF admin menu on production / client.
	if ( $_SERVER['REMOTE_ADDR'] != '192.168.33.1' ){
		add_filter( 'acf/settings/show_admin', '__return_false' );
	}

}
endif; // truereview_theme_setup
add_action( 'after_setup_theme', 'truereview_theme_setup' );

if ( ! function_exists( 'truereview_reset_default_image_sizes' ) ) :
/**
 * Re-set default image sizes
 *
 * @since  1.0.0
 */
function truereview_reset_default_image_sizes() {
	// 'large' size: full width
	update_option( 'large_size_w', 1050 );
	update_option( 'large_size_h', 550 );
	update_option( 'large_crop', 1 );

	// 'medium_large' size: featured
	update_option( 'medium_large_size_w', 768 );

	// 'medium' size: related
	update_option( 'medium_size_w', 365 );
	update_option( 'medium_size_h', 260 );
	update_option( 'medium_crop', 1 );

	// 'thumbnail' size: widgets
	update_option( 'thumbnail_size_w', 100 );
	update_option( 'thumbnail_size_h', 100 );
	update_option( 'thumbnail_crop', 1 );
}
endif;
add_action( 'after_switch_theme', 'truereview_reset_default_image_sizes' );

/**
 * Registers custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_widget
 */
function truereview_widgets_init() {

	// Register ad widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads.php';
	register_widget( 'TrueReview_Ads_Widget' );

	// Register ads 125 widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-ads125.php';
	register_widget( 'TrueReview_Ads125_Widget' );

	// Register Facebook widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-facebook.php';
	register_widget( 'TrueReview_Facebook_Widget' );

	// Register feedburner widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-feedburner.php';
	register_widget( 'TrueReview_Feedburner_Widget' );

	// Register recent posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent.php';
	register_widget( 'TrueReview_Recent_Widget' );

	// Register popular posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-popular.php';
	register_widget( 'TrueReview_Popular_Widget' );

	// Register random posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-random.php';
	register_widget( 'TrueReview_Random_Widget' );

	// Register most views posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-views.php';
	register_widget( 'TrueReview_Views_Widget' );

	// Register twitter widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-twitter.php';
	register_widget( 'TrueReview_Twitter_Widget' );

	// Register video widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-video.php';
	register_widget( 'TrueReview_Video_Widget' );

	// Register recent review posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent-review.php';
	register_widget( 'TrueReview_Recent_Review_Widget' );

	// Register recent coupon posts thumbnail widget.
	require trailingslashit( get_template_directory() ) . 'inc/widgets/widget-recent-coupon.php';
	register_widget( 'TrueReview_Recent_Coupon_Widget' );

}
add_action( 'widgets_init', 'truereview_widgets_init' );

/**
 * Registers widget areas and custom widgets.
 *
 * @since 1.0.0
 * @link  http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function truereview_sidebars_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Primary Sidebar', 'truereview' ),
			'id'            => 'primary',
			'description'   => esc_html__( 'Main sidebar that appears on the right.', 'truereview' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 1', 'truereview' ),
			'id'            => 'footer-1',
			'description'   => esc_html__( 'Sidebar that appears on the bottom of your site.', 'truereview' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 2', 'truereview' ),
			'id'            => 'footer-2',
			'description'   => esc_html__( 'Sidebar that appears on the bottom of your site.', 'truereview' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer 3', 'truereview' ),
			'id'            => 'footer-3',
			'description'   => esc_html__( 'Sidebar that appears on the bottom of your site.', 'truereview' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		)
	);

}
add_action( 'widgets_init', 'truereview_sidebars_init' );

/**
 * Register Google fonts.
 *
 * @since  1.0.0
 * @return string
 */
function truereview_fonts_url() {

	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'truereview' ) ) {
		$fonts[] = 'Open Sans:400,400italic,700,700italic';
	}

	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Lato, translate this to 'off'. Do not translate into your own language.
	 */
	if ( 'off' !== _x( 'on', 'Lato font: on or off', 'truereview' ) ) {
		$fonts[] = 'Lato:400italic,700,700italic,400';
	}

	/*
	 * Translators: To add an additional character subset specific to your language,
	 * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
	 */
	$subset = _x( 'no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'truereview' );

	if ( 'cyrillic' == $subset ) {
		$subsets .= ',cyrillic,cyrillic-ext';
	} elseif ( 'greek' == $subset ) {
		$subsets .= ',greek,greek-ext';
	} elseif ( 'devanagari' == $subset ) {
		$subsets .= ',devanagari';
	} elseif ( 'vietnamese' == $subset ) {
		$subsets .= ',vietnamese';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '%7C', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), 'https://fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

if ( ! function_exists( 'is_polylang_activated' ) ) :
/**
 * Query Polylang activation
 *
 * @since  1.0.0
 */
function is_polylang_activated() {
	return function_exists( 'pll_the_languages' ) ? true : false;
}
endif;

/**
 * Custom template tags for this theme.
 */
require trailingslashit( get_template_directory() ) . 'inc/template-tags.php';

/**
 * Enqueue scripts and styles.
 */
require trailingslashit( get_template_directory() ) . 'inc/scripts.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require trailingslashit( get_template_directory() ) . 'inc/extras.php';

/**
 * Require and recommended plugins list.
 */
require trailingslashit( get_template_directory() ) . 'inc/plugins.php';

/**
 * Customizer.
 */
require trailingslashit( get_template_directory() ) . 'admin/customizer-library.php';
require trailingslashit( get_template_directory() ) . 'admin/functions.php';

/**
 * Customizer functions.
 */
require trailingslashit( get_template_directory() ) . 'inc/customizer.php';
require trailingslashit( get_template_directory() ) . 'inc/mods.php';

/**
 * Mega menus walker.
 */
require trailingslashit( get_template_directory() ) . 'inc/megamenus/init.php';
require trailingslashit( get_template_directory() ) . 'inc/megamenus/class-primary-nav-walker.php';

/**
 * We use some part of Hybrid Core to extends our themes.
 *
 * @link  http://themehybrid.com/hybrid-core Hybrid Core site.
 */
require trailingslashit( get_template_directory() ) . 'inc/hybrid/attr.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/theme-layouts.php';
require trailingslashit( get_template_directory() ) . 'inc/hybrid/entry-views.php';

/**
 * Load Jetpack compatibility file.
 */
require trailingslashit( get_template_directory() ) . 'inc/jetpack.php';

/**
 * Load Polylang compatibility file.
 */
if ( ( function_exists( 'is_polylang_activated' ) && ( is_polylang_activated() ) ) ) {
	require trailingslashit( get_template_directory() ) . 'inc/polylang.php';
}

/**
 * Custom term meta.
 */
require trailingslashit( get_template_directory() ) . 'inc/meta/category.php';
require trailingslashit( get_template_directory() ) . 'inc/meta/helper.php';
require trailingslashit( get_template_directory() ) . 'inc/meta/sanitization.php';
require trailingslashit( get_template_directory() ) . 'inc/meta/functions.php';

/**
 * Review
 */
require trailingslashit( get_template_directory() ) . 'inc/review.php';

/**
 * Coupon
 */
require trailingslashit( get_template_directory() ) . 'inc/coupon.php';

/**
 * ACF fields.
 */
include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if ( is_plugin_active( 'advanced-custom-fields-pro/acf.php' ) ) {
	require trailingslashit( get_template_directory() ) . 'inc/acf.php';
}

/**
 * Load SiteOrigin page builder compatibility file.
 */
if ( is_plugin_active( 'siteorigin-panels/siteorigin-panels.php' ) ) {
	require trailingslashit( get_template_directory() ) . 'inc/builder.php';
}

/**
 * Demo importer
 */
require trailingslashit( get_template_directory() ) . 'inc/demo/demo-importer.php';
