<?php
/**
 * Register custom customizer panels, sections and settings.
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

/**
 * We register our custom customizer by using the hook.
 *
 * @since  1.0.0
 */
function truereview_customizer_register() {

	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// ======= Start Customizer Panels/Sections/Settings ======= //

	// General Panels and Sections
	$general_panel = 'general';

	$panels[] = array(
		'id'          => $general_panel,
		'title'       => esc_html__( 'General', 'truereview' ),
		'description' => esc_html__( 'This panel is used for managing general section of your site.', 'truereview' ),
		'priority'    => 10
	);

		// Breaking News
		$section = PREFIX . 'breaking-news-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Breaking News', 'truereview' ),
			'priority'    => 100,
			'panel'       => $general_panel
		);
		$options[PREFIX . 'breaking-news-enable'] = array(
			'id'          => PREFIX . 'breaking-news-enable',
			'label'       => esc_html__( 'Show breaking news', 'truereview' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'breaking-news-tag'] = array(
			'id'          => PREFIX . 'breaking-news-tag',
			'label'       => esc_html__( 'Select a tag', 'truereview' ),
			'section'     => $section,
			'type'        => 'select2',
			'choices'     => truereview_tags_list()
		);
		$options[PREFIX . 'breaking-news-num'] = array(
			'id'          => PREFIX . 'breaking-news-num',
			'label'       => esc_html__( 'Number of posts', 'truereview' ),
			'section'     => $section,
			'type'        => 'number',
			'default'     => 5
		);
		$options[PREFIX . 'breaking-news-orderby'] = array(
			'id'          => PREFIX . 'breaking-news-orderby',
			'label'       => esc_html__( 'Order by', 'truereview' ),
			'section'     => $section,
			'type'        => 'select',
			'default'     => 'date',
			'choices'     => array(
				'date'  => esc_html__( 'Date', 'truereview' ),
				'rand'  => esc_html__( 'Random', 'truereview' )
			)
		);

		// RSS
		$section = PREFIX . 'rss-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'RSS', 'truereview' ),
			'priority'    => 100,
			'panel'       => $general_panel,
			'description' => esc_html__( 'If you fill the custom rss url below, it will replace the default.', 'truereview' ),
		);
		$options[PREFIX . 'custom-rss'] = array(
			'id'           => PREFIX . 'custom-rss',
			'label'        => esc_html__( 'Custom RSS URL (eg. Feedburner)', 'truereview' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);

		// Comment
		$section = PREFIX . 'comment-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Comments', 'truereview' ),
			'priority'    => 110,
			'panel'       => $general_panel,
		);
		$options[PREFIX . 'page-comment'] = array(
			'id'           => PREFIX . 'page-comment',
			'label'        => esc_html__( 'Page Comment', 'truereview' ),
			'section'      => $section,
			'type'         => 'switch',
			'default'      => 1
		);

		// Social header
		$section = PREFIX . 'social-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Social', 'truereview' ),
			'priority'    => 120,
			'panel'       => $general_panel
		);
		$options[PREFIX . 'social-header'] = array(
			'id'           => PREFIX . 'social-header',
			'label'        => esc_html__( 'Header', 'truereview' ),
			'description'  => esc_html__( 'Display social icons in header.', 'truereview' ),
			'section'      => $section,
			'type'         => 'switch',
			'default'      => 1
		);
		$options[PREFIX . 'social-footer'] = array(
			'id'           => PREFIX . 'social-footer',
			'label'        => esc_html__( 'Footer', 'truereview' ),
			'description'  => esc_html__( 'Display social icons in footer.', 'truereview' ),
			'section'      => $section,
			'type'         => 'switch',
			'default'      => 1
		);
		$options[PREFIX . 'twitter'] = array(
			'id'      => PREFIX . 'twitter',
			'label'   => esc_html__( 'Twitter URL', 'truereview' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'facebook'] = array(
			'id'      => PREFIX . 'facebook',
			'label'   => esc_html__( 'Facebook URL', 'truereview' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'gplus'] = array(
			'id'      => PREFIX . 'gplus',
			'label'   => esc_html__( 'Google Plus URL', 'truereview' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'instagram'] = array(
			'id'      => PREFIX . 'instagram',
			'label'   => esc_html__( 'Instagram URL', 'truereview' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'pinterest'] = array(
			'id'      => PREFIX . 'pinterest',
			'label'   => esc_html__( 'Pinterest URL', 'truereview' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'linkedin'] = array(
			'id'      => PREFIX . 'linkedin',
			'label'   => esc_html__( 'LinkedIn URL', 'truereview' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);
		$options[PREFIX . 'rss'] = array(
			'id'      => PREFIX . 'rss',
			'label'   => esc_html__( 'RSS URL', 'truereview' ),
			'section' => $section,
			'type'    => 'url',
			'default' => ''
		);

		// Footer Text
		$section = PREFIX . 'footer-text-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Footer Text', 'truereview' ),
			'priority'    => 120,
			'panel'       => $general_panel,
		);
		$options[PREFIX . 'footer-text'] = array(
			'id'           => PREFIX . 'footer-text',
			'label'        => '',
			'description'  => esc_html__( 'Customize the footer text.', 'truereview' ),
			'section'      => $section,
			'type'         => 'textarea',
			'default'      => '&copy; Copyright ' . date( 'Y' ) . ' <a href="' . esc_url( home_url() ) . '">' . esc_attr( get_bloginfo( 'name' ) ) . '</a> &middot; Designed by <a href="http://www.theme-junkie.com/">Theme Junkie</a>'
		);

	// Header Panels and Sections
	$header_panel = 'header';

	$panels[] = array(
		'id'          => $header_panel,
		'title'       => esc_html__( 'Header', 'truereview' ),
		'description' => esc_html__( 'This panel is used for managing header section of your site.', 'truereview' ),
		'priority'    => 15
	);

		// Logo
		$section = PREFIX . 'logo-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Logo', 'truereview' ),
			'priority'    => 30,
			'panel'       => $header_panel
		);
		$options[PREFIX . 'logo'] = array(
			'id'      => PREFIX . 'logo',
			'label'   => esc_html__( 'Regular Logo', 'truereview' ),
			'section' => $section,
			'type'    => 'media',
			'default' => ''
		);

		// Header Date
		$section = PREFIX . 'date-header-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Date', 'truereview' ),
			'priority'    => 115,
			'panel'       => $header_panel,
		);
		$options[PREFIX . 'date-header'] = array(
			'id'           => PREFIX . 'date-header',
			'label'        => esc_html__( 'Enable date header', 'truereview' ),
			'section'      => $section,
			'type'         => 'switch',
			'default'      => 1
		);

		// Search
		$section = PREFIX . 'search-header-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Search', 'truereview' ),
			'priority'    => 120,
			'panel'       => $header_panel,
		);
		$options[PREFIX . 'search-header'] = array(
			'id'           => PREFIX . 'search-header',
			'label'        => esc_html__( 'Enable search form', 'truereview' ),
			'section'      => $section,
			'type'         => 'switch',
			'default'      => 1
		);

	// Colors Panel and Sections
	$color_panel = 'color';

	$panels[] = array(
		'id'          => $color_panel,
		'title'       => esc_html__( 'Color', 'truereview' ),
		'description' => esc_html__( 'This panel is used for managing colors of your site.', 'truereview' ),
		'priority'    => 20
	);

		// Predefined color
		$section = PREFIX . 'predefined-color-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Predefined Skins', 'truereview' ),
			'priority'    => 5,
			'panel'       => $color_panel
		);
		$options[PREFIX . 'skins'] = array(
			'id'          => PREFIX . 'skins',
			'label'       => esc_html__( 'Skins', 'truereview' ),
			'section'     => $section,
			'type'        => 'radio',
			'default'     => 'default',
			'choices'     => array(
				'default' => esc_html__( 'Default', 'truereview' ),
				'red'     => esc_html__( 'Red', 'truereview' ),
				'blue'    => esc_html__( 'Blue', 'truereview' ),
				'indigo'  => esc_html__( 'Indigo', 'truereview' ),
				'cyan'    => esc_html__( 'Cyan', 'truereview' ),
				'magenta' => esc_html__( 'Magenta', 'truereview' ),
			)
		);

	// Typography Panel and Sections
	$typo_panel = 'typography';

	$panels[] = array(
		'id'          => $typo_panel,
		'title'       => esc_html__( 'Typography', 'truereview' ),
		'description' => esc_html__( 'This panel is used for managing typography of your site.', 'truereview' ),
		'priority'    => 30
	);

		// Global typography
		$section = PREFIX . 'global-typography';
		$font_choices = customizer_library_get_font_choices();

		$sections[] = array(
			'id'       => $section,
			'title'    => esc_html__( 'Global', 'truereview' ),
			'priority' => 5,
			'panel'    => $typo_panel
		);
		$options[PREFIX . 'text-font'] = array(
			'id'          => PREFIX . 'text-font',
			'label'       => esc_html__( 'Text font', 'truereview' ),
			'section'     => $section,
			'type'        => 'select2',
			'choices'     => $font_choices,
			'default'     => 'Open Sans',
		);
		$options[PREFIX . 'heading-font'] = array(
			'id'          => PREFIX . 'heading-font',
			'label'       => esc_html__( 'Heading font', 'truereview' ),
			'section'     => $section,
			'type'        => 'select2',
			'choices'     => $font_choices,
			'default'     => 'Lato',
		);

	// Content Panel and Sections
	$content_panel = 'layouts';

	$panels[] = array(
		'id'          => $content_panel,
		'title'       => esc_html__( 'Layouts', 'truereview' ),
		'description' => esc_html__( 'This panel is used for managing several custom features/layouts of your site.', 'truereview' ),
		'priority'    => 35
	);

		// Container
		$section = PREFIX . 'container-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Container', 'truereview' ),
			'priority'    => 4,
			'panel'       => $content_panel
		);
		$options[PREFIX . 'container-layouts'] = array(
			'id'          => PREFIX . 'container-layouts',
			'label'       => esc_html__( 'Container layouts', 'truereview' ),
			'section'     => $section,
			'type'        => 'radio',
			'default'     => 'fullwidth',
			'choices'     => array(
				'fullwidth' => esc_html__( 'Full Width', 'truereview' ),
				'boxed'     => esc_html__( 'Boxed', 'truereview' ),
				'framed'    => esc_html__( 'Framed', 'truereview' )
			)
		);

		// Featured posts
		$section = PREFIX . 'featured-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Featured Posts', 'truereview' ),
			'priority'    => 5,
			'panel'       => $content_panel
		);
		$options[PREFIX . 'featured-enable'] = array(
			'id'          => PREFIX . 'featured-enable',
			'label'       => esc_html__( 'Show featured posts', 'truereview' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);
		$options[PREFIX . 'featured-tag'] = array(
			'id'          => PREFIX . 'featured-tag',
			'label'       => esc_html__( 'Select a tag', 'truereview' ),
			'description' => esc_html__( 'If you are not selecting any tag, the featured posts will display the most recent posts.', 'truereview' ),
			'section'     => $section,
			'type'        => 'select2',
			'choices'     => truereview_tags_list()
		);
		$options[PREFIX . 'featured-num'] = array(
			'id'          => PREFIX . 'featured-num',
			'label'       => esc_html__( 'Number of posts', 'truereview' ),
			'section'     => $section,
			'type'        => 'text',
			'default'     => 6
		);
		$options[PREFIX . 'featured-orderby'] = array(
			'id'          => PREFIX . 'featured-orderby',
			'label'       => esc_html__( 'Order by', 'truereview' ),
			'section'     => $section,
			'type'        => 'select',
			'default'     => 'date',
			'choices'     => array(
				'date'  => esc_html__( 'Date', 'truereview' ),
				'rand'  => esc_html__( 'Random', 'truereview' )
			)
		);

		// Posts
		$section = PREFIX . 'posts-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Posts', 'truereview' ),
			'description' => esc_html__( 'Posts is a single post page.', 'truereview' ),
			'priority'    => 10,
			'panel'       => $content_panel
		);
		$options[PREFIX . 'related-posts-group'] = array(
			'id'          => PREFIX . 'related-posts-group',
			'label'       => esc_html__( 'Related Posts', 'truereview' ),
			'section'     => $section,
			'type'        => 'group-title'
		);
			$options[PREFIX . 'related-posts'] = array(
				'id'          => PREFIX . 'related-posts',
				'label'       => esc_html__( 'Show related posts', 'truereview' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);
			$options[PREFIX . 'related-posts-img'] = array(
				'id'          => PREFIX . 'related-posts-img',
				'label'       => esc_html__( 'Show related posts thumbnail', 'truereview' ),
				'section'     => $section,
				'type'        => 'switch',
				'default'     => 1
			);

		// Page
		$section = PREFIX . 'page-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Page', 'truereview' ),
			'priority'    => 15,
			'panel'       => $content_panel
		);
		$options[PREFIX . 'page-title'] = array(
			'id'          => PREFIX . 'page-title',
			'label'       => esc_html__( 'Show page title', 'truereview' ),
			'section'     => $section,
			'type'        => 'switch',
			'default'     => 1
		);

	// Advertisement Panel and Sections
	$ads_panel = 'advertisement';

	$panels[] = array(
		'id'       => $ads_panel,
		'title'    => esc_html__( 'Advertisement', 'truereview' ),
		'priority' => 80
	);

		// Top ads
		$section = PREFIX . 'top-ads-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Top', 'truereview' ),
			'priority'    => 5,
			'panel'       => $ads_panel,
		);
		$options[PREFIX . 'top-ads-image'] = array(
			'id'           => PREFIX . 'top-ads-image',
			'label'        => esc_html__( 'Ads Image', 'truereview' ),
			'description'  => esc_html__( 'Upload your ads image then put the url in the setting below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'media',
			'default'      => '',
		);
		$options[PREFIX . 'top-ads-url'] = array(
			'id'           => PREFIX . 'top-ads-url',
			'label'        => esc_html__( 'Ads URL', 'truereview' ),
			'description'  => esc_html__( 'Put the ads url in the box below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);
		$options[PREFIX . 'top-ads-custom'] = array(
			'id'                => PREFIX . 'top-ads-custom',
			'label'             => esc_html__( 'Or', 'truereview' ),
			'description'       => esc_html__( 'Pur you custom ads code (eg. adsense) in the box below.', 'truereview' ),
			'section'           => $section,
			'type'              => 'textarea',
			'sanitize_callback' => 'truereview_textarea_stripslashes',
			'default'           => ''
		);

		// Header ads
		$section = PREFIX . 'header-ads-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Header Right', 'truereview' ),
			'priority'    => 5,
			'panel'       => $ads_panel,
		);
		$options[PREFIX . 'header-ads-image'] = array(
			'id'           => PREFIX . 'header-ads-image',
			'label'        => esc_html__( 'Ads Image', 'truereview' ),
			'description'  => esc_html__( 'Upload your ads image then put the url in the setting below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'media',
			'default'      => '',
		);
		$options[PREFIX . 'header-ads-url'] = array(
			'id'           => PREFIX . 'header-ads-url',
			'label'        => esc_html__( 'Ads URL', 'truereview' ),
			'description'  => esc_html__( 'Put the ads url in the box below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);
		$options[PREFIX . 'header-ads-custom'] = array(
			'id'                => PREFIX . 'header-ads-custom',
			'label'             => esc_html__( 'Or', 'truereview' ),
			'description'       => esc_html__( 'Pur you custom ads code (eg. adsense) in the box below.', 'truereview' ),
			'section'           => $section,
			'type'              => 'textarea',
			'sanitize_callback' => 'truereview_textarea_stripslashes',
			'default'           => ''
		);

		// After menu ads
		$section = PREFIX . 'after-menu-ads-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'After Menu', 'truereview' ),
			'priority'    => 5,
			'panel'       => $ads_panel,
		);
		$options[PREFIX . 'after-menu-ads-image'] = array(
			'id'           => PREFIX . 'after-menu-ads-image',
			'label'        => esc_html__( 'Ads Image', 'truereview' ),
			'description'  => esc_html__( 'Upload your ads image then put the url in the setting below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'media',
			'default'      => '',
		);
		$options[PREFIX . 'after-menu-ads-url'] = array(
			'id'           => PREFIX . 'after-menu-ads-url',
			'label'        => esc_html__( 'Ads URL', 'truereview' ),
			'description'  => esc_html__( 'Put the ads url in the box below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);
		$options[PREFIX . 'after-menu-ads-custom'] = array(
			'id'                => PREFIX . 'after-menu-ads-custom',
			'label'             => esc_html__( 'Or', 'truereview' ),
			'description'       => esc_html__( 'Pur you custom ads code (eg. adsense) in the box below.', 'truereview' ),
			'section'           => $section,
			'type'              => 'textarea',
			'sanitize_callback' => 'truereview_textarea_stripslashes',
			'default'           => ''
		);

		// Single post ads before content
		$section = PREFIX . 'posts-ads-before-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Post before content', 'truereview' ),
			'description' => esc_html__( 'Single post advertisement before content', 'truereview' ),
			'priority'    => 10,
			'panel'       => $ads_panel,
		);
		$options[PREFIX . 'post-ads-image-before'] = array(
			'id'           => PREFIX . 'post-ads-image-before',
			'label'        => esc_html__( 'Ads Image', 'truereview' ),
			'description'  => esc_html__( 'Upload your ads image then put the url in the setting below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'media',
			'default'      => '',
		);
		$options[PREFIX . 'post-ads-url-before'] = array(
			'id'           => PREFIX . 'post-ads-url-before',
			'label'        => esc_html__( 'Ads URL', 'truereview' ),
			'description'  => esc_html__( 'Put the ads url in the box below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);
		$options[PREFIX . 'post-ads-custom-before'] = array(
			'id'                => PREFIX . 'post-ads-custom-before',
			'label'             => esc_html__( 'Or', 'truereview' ),
			'description'       => esc_html__( 'Pur you custom ads code (eg. adsense) in the box below.', 'truereview' ),
			'section'           => $section,
			'type'              => 'textarea',
			'sanitize_callback' => 'truereview_textarea_stripslashes',
			'default'           => ''
		);
		$options[PREFIX . 'post-ads-position-before'] = array(
			'id'           => PREFIX . 'post-ads-position-before',
			'label'        => esc_html__( 'Position', 'truereview' ),
			'section'      => $section,
			'type'         => 'radio',
			'default'      => 'default',
			'choices'      => array(
				'default' => esc_html__( 'Default Block', 'truereview' ),
				'center'  => esc_html__( 'Center Block', 'truereview' ),
				'right'   => esc_html__( 'Right Block', 'truereview' ),
				'f-left'  => esc_html__( 'Float Left', 'truereview' ),
				'f-right' => esc_html__( 'Float Right', 'truereview' ),
			)
		);

		// Single post ads after content
		$section = PREFIX . 'posts-ads-after-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Post after content', 'truereview' ),
			'description' => esc_html__( 'Single post advertisement after content', 'truereview' ),
			'priority'    => 15,
			'panel'       => $ads_panel,
		);
		$options[PREFIX . 'post-ads-image-after'] = array(
			'id'           => PREFIX . 'post-ads-image-after',
			'label'        => esc_html__( 'Ads Image', 'truereview' ),
			'description'  => esc_html__( 'Upload your ads image then put the url in the setting below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'media',
			'default'      => '',
		);
		$options[PREFIX . 'post-ads-url-after'] = array(
			'id'           => PREFIX . 'post-ads-url-after',
			'label'        => esc_html__( 'Ads URL', 'truereview' ),
			'description'  => esc_html__( 'Put the ads url in the box below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);
		$options[PREFIX . 'post-ads-custom-after'] = array(
			'id'                => PREFIX . 'post-ads-custom-after',
			'label'             => esc_html__( 'Or', 'truereview' ),
			'description'       => esc_html__( 'Pur you custom ads code (eg. adsense) in the box below.', 'truereview' ),
			'section'           => $section,
			'type'              => 'textarea',
			'sanitize_callback' => 'truereview_textarea_stripslashes',
			'default'           => ''
		);
		$options[PREFIX . 'post-ads-position-after'] = array(
			'id'           => PREFIX . 'post-ads-position-after',
			'label'        => esc_html__( 'Position', 'truereview' ),
			'section'      => $section,
			'type'         => 'radio',
			'default'      => 'default',
			'choices'      => array(
				'default' => esc_html__( 'Default Block', 'truereview' ),
				'center'  => esc_html__( 'Center Block', 'truereview' ),
				'right'   => esc_html__( 'Right Block', 'truereview' )
			)
		);

		// Single post ads after paragraph
		$section = PREFIX . 'posts-ads-after-paragraph-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Post after paragraph', 'truereview' ),
			'description' => esc_html__( 'Single post advertisement after x paragraph', 'truereview' ),
			'priority'    => 20,
			'panel'       => $ads_panel,
		);
		$options[PREFIX . 'post-ads-image-after-paragraph'] = array(
			'id'           => PREFIX . 'post-ads-image-after-paragraph',
			'label'        => esc_html__( 'Ads Image', 'truereview' ),
			'description'  => esc_html__( 'Upload your ads image then put the url in the setting below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'media',
			'default'      => '',
		);
		$options[PREFIX . 'post-ads-url-after-paragraph'] = array(
			'id'           => PREFIX . 'post-ads-url-after-paragraph',
			'label'        => esc_html__( 'Ads URL', 'truereview' ),
			'description'  => esc_html__( 'Put the ads url in the box below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);
		$options[PREFIX . 'post-ads-custom-after-paragraph'] = array(
			'id'                => PREFIX . 'post-ads-custom-after-paragraph',
			'label'             => esc_html__( 'Or', 'truereview' ),
			'description'       => esc_html__( 'Pur you custom ads code (eg. adsense) in the box below.', 'truereview' ),
			'section'           => $section,
			'type'              => 'textarea',
			'sanitize_callback' => 'truereview_textarea_stripslashes',
			'default'           => ''
		);
		$options[PREFIX . 'post-ads-paragraph-after-paragraph'] = array(
			'id'           => PREFIX . 'post-ads-paragraph-after-paragraph',
			'label'        => esc_html__( 'After Paragraph', 'truereview' ),
			'section'      => $section,
			'type'         => 'radio',
			'default'      => '1',
			'choices'      => array(
				'1' => esc_html__( 'One', 'truereview' ),
				'2' => esc_html__( 'Two', 'truereview' ),
				'3' => esc_html__( 'Three', 'truereview' ),
				'4' => esc_html__( 'Four', 'truereview' ),
				'5' => esc_html__( 'Five', 'truereview' )
			)
		);
		$options[PREFIX . 'post-ads-position-after-paragraph'] = array(
			'id'           => PREFIX . 'post-ads-position-after-paragraph',
			'label'        => esc_html__( 'Position', 'truereview' ),
			'section'      => $section,
			'type'         => 'radio',
			'default'      => 'default',
			'choices'      => array(
				'default' => esc_html__( 'Default Block', 'truereview' ),
				'center'  => esc_html__( 'Center Block', 'truereview' ),
				'right'   => esc_html__( 'Right Block', 'truereview' ),
				'f-left'  => esc_html__( 'Float Left', 'truereview' ),
				'f-right' => esc_html__( 'Float Right', 'truereview' ),
			)
		);

		// Footer ads
		$section = PREFIX . 'footer-ads-section';

		$sections[] = array(
			'id'          => $section,
			'title'       => esc_html__( 'Footer', 'truereview' ),
			'priority'    => 25,
			'panel'       => $ads_panel,
		);
		$options[PREFIX . 'footer-ads-image'] = array(
			'id'           => PREFIX . 'footer-ads-image',
			'label'        => esc_html__( 'Ads Image', 'truereview' ),
			'description'  => esc_html__( 'Upload your ads image then put the url in the setting below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'media',
			'default'      => '',
		);
		$options[PREFIX . 'footer-ads-url'] = array(
			'id'           => PREFIX . 'footer-ads-url',
			'label'        => esc_html__( 'Ads URL', 'truereview' ),
			'description'  => esc_html__( 'Put the ads url in the box below.', 'truereview' ),
			'section'      => $section,
			'type'         => 'url',
			'default'      => ''
		);
		$options[PREFIX . 'footer-ads-custom'] = array(
			'id'                => PREFIX . 'footer-ads-custom',
			'label'             => esc_html__( 'Or', 'truereview' ),
			'description'       => esc_html__( 'Pur you custom ads code (eg. adsense) in the box below.', 'truereview' ),
			'section'           => $section,
			'type'              => 'textarea',
			'sanitize_callback' => 'truereview_textarea_stripslashes',
			'default'           => ''
		);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;

	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

}
add_action( 'init', 'truereview_customizer_register' );
