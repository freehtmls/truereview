<?php
/**
 * ACF fields
 *
 * @package    TrueReview
 * @author     Theme Junkie
 * @copyright  Copyright (c) 2016, Theme Junkie
 * @license    http://www.gnu.org/licenses/gpl-2.0.html
 * @since      1.0.0
 */

if( function_exists('acf_add_local_field_group') ):

acf_add_local_field_group(array (
	'key' => 'group_56ee531daa676',
	'title' => esc_html__( 'Form Shortcode', 'truereview' ),
	'fields' => array (
		array (
			'key' => 'field_56ee532b596e1',
			'label' => esc_html__( 'Form Shortcode', 'truereview' ),
			'name' => 'tj_contact_form_shortcode',
			'type' => 'text',
			'instructions' => esc_html__( 'Add your contact form shortcode here. We recommend you to use Contact Form 7 plugin.', 'truereview' ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '[contact-shortcode]',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-templates/contact.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => esc_html__( 'Contact form shortcode', 'truereview' ),
));

acf_add_local_field_group(array (
	'key' => 'group_56ee50acdf58f',
	'title' => esc_html__( 'Maps', 'truereview' ),
	'fields' => array (
		array (
			'key' => 'field_56ee50b09f21f',
			'label' => esc_html__( 'Maps', 'truereview' ),
			'name' => 'tj_contact_maps',
			'type' => 'google_map',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'center_lat' => '',
			'center_lng' => '',
			'zoom' => '',
			'height' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'page_template',
				'operator' => '==',
				'value' => 'page-templates/contact.php',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => esc_html__( 'Contact maps', 'truereview' ),
));

acf_add_local_field_group(array (
	'key' => 'group_56e96e565331f',
	'title' => esc_html__( 'Review', 'truereview' ),
	'fields' => array (
		array (
			'key' => 'field_56e97f67bb90e',
			'label' => esc_html__( 'Enable Review', 'truereview' ),
			'name' => 'tj_review_enable',
			'type' => 'true_false',
			'instructions' => esc_html__( 'Enable review to this post.', 'truereview' ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => 'Enable',
			'default_value' => 0,
		),
		array (
			'key' => 'field_56ea53168658a',
			'label' => esc_html__( 'Review Heading', 'truereview' ),
			'name' => 'tj_review_heading',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56e97f67bb90e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => esc_html__( 'Review Overview', 'truereview' ),
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56e9835b80ad7',
			'label' => esc_html__( 'Review Type', 'truereview' ),
			'name' => 'tj_review_type',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56e97f67bb90e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'point' => esc_html__( 'Point', 'truereview' ),
				'percentage' => esc_html__( 'Percentage', 'truereview' ),
				'star' => esc_html__( 'Stars', 'truereview' ),
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'point',
			'layout' => 'horizontal',
		),
		array (
			'key' => 'field_56ee4088645fe',
			'label' => esc_html__( 'Review Position', 'truereview' ),
			'name' => 'tj_review_position',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56e97f67bb90e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'top' => esc_html__( 'Top', 'truereview' ),
				'bottom' => esc_html__( 'Bottom', 'truereview' ),
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'bottom',
			'layout' => 'horizontal',
		),
		array (
			'key' => 'field_56e9807a5b21e',
			'label' => esc_html__( 'Feature Name', 'truereview' ),
			'name' => 'tj_review_feature',
			'type' => 'repeater',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56e97f67bb90e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'collapsed' => '',
			'min' => '',
			'max' => '',
			'layout' => 'table',
			'button_label' => esc_html__( 'Add Feature', 'truereview' ),
			'sub_fields' => array (
				array (
					'key' => 'field_56e980b95b21f',
					'label' => esc_html__( 'Name', 'truereview' ),
					'name' => 'name',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => 0,
					'wrapper' => array (
						'width' => 70,
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_56e980c55b220',
					'label' => esc_html__( 'Point (1 - 10)', 'truereview' ),
					'name' => 'point',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_56e9835b80ad7',
								'operator' => '==',
								'value' => 'point',
							),
						),
					),
					'wrapper' => array (
						'width' => 30,
						'class' => '',
						'id' => '',
					),
					'default_value' => '0.0',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_56e9841b74525',
					'label' => esc_html__( 'Percentage (1 - 100)', 'truereview' ),
					'name' => 'percentage',
					'type' => 'number',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_56e9835b80ad7',
								'operator' => '==',
								'value' => 'percentage',
							),
						),
					),
					'wrapper' => array (
						'width' => 30,
						'class' => '',
						'id' => '',
					),
					'default_value' => '',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'min' => 1,
					'max' => 100,
					'step' => 1,
					'readonly' => 0,
					'disabled' => 0,
				),
				array (
					'key' => 'field_56e984b22bfaf',
					'label' => esc_html__( 'Star (1 - 5)', 'truereview' ),
					'name' => 'star',
					'type' => 'text',
					'instructions' => '',
					'required' => 0,
					'conditional_logic' => array (
						array (
							array (
								'field' => 'field_56e9835b80ad7',
								'operator' => '==',
								'value' => 'star',
							),
						),
					),
					'wrapper' => array (
						'width' => 30,
						'class' => '',
						'id' => '',
					),
					'default_value' => '0.0',
					'placeholder' => '',
					'prepend' => '',
					'append' => '',
					'maxlength' => '',
					'readonly' => 0,
					'disabled' => 0,
				),
			),
		),
		array (
			'key' => 'field_56e9812dfbdba',
			'label' => esc_html__( 'Review Description', 'truereview' ),
			'name' => 'tj_review_description',
			'type' => 'textarea',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56e97f67bb90e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'maxlength' => '',
			'rows' => '',
			'new_lines' => 'wpautop',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56e981fd28042',
			'label' => esc_html__( 'Button Text', 'truereview' ),
			'name' => 'tj_review_button_text',
			'type' => 'text',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56e97f67bb90e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56e9821228043',
			'label' => esc_html__( 'Button URL', 'truereview' ),
			'name' => 'tj_review_button_url',
			'type' => 'url',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56e97f67bb90e',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 1,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => esc_html__( 'Post review', 'truereview' ),
));

acf_add_local_field_group(array (
	'key' => 'group_56ef6b4f67141',
	'title' => esc_html__( 'Coupon', 'truereview' ),
	'fields' => array (
		array (
			'key' => 'field_56ef6c5ded1f9',
			'label' => esc_html__( 'Enable Coupon', 'truereview' ),
			'name' => 'tj_coupon_enable',
			'type' => 'true_false',
			'instructions' => esc_html__( 'Enable coupon / deal to this post.', 'truereview' ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'message' => esc_html__( 'Enable', 'truereview' ),
			'default_value' => 0,
		),
		array (
			'key' => 'field_56ef6d0f6d55a',
			'label' => esc_html__( 'Position', 'truereview' ),
			'name' => 'tj_coupon_position',
			'type' => 'radio',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56ef6c5ded1f9',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'choices' => array (
				'top' => esc_html__( 'Top', 'truereview' ),
				'bottom' => esc_html__( 'Bottom', 'truereview' ),
			),
			'other_choice' => 0,
			'save_other_choice' => 0,
			'default_value' => 'bottom',
			'layout' => 'horizontal',
		),
		array (
			'key' => 'field_56ef6bd818e13',
			'label' => esc_html__( 'Coupon Code', 'truereview' ),
			'name' => 'tj_coupon_code',
			'type' => 'text',
			'instructions' => esc_html__( 'Coupon code for this deal.', 'truereview' ),
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56ef6c5ded1f9',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
		array (
			'key' => 'field_56ef6c0918e14',
			'label' => esc_html__( 'Destination URL', 'truereview' ),
			'name' => 'tj_coupon_destination_url',
			'type' => 'text',
			'instructions' => esc_html__( 'This could be your affiliate link.', 'truereview' ),
			'required' => 0,
			'conditional_logic' => array (
				array (
					array (
						'field' => 'field_56ef6c5ded1f9',
						'operator' => '==',
						'value' => '1',
					),
				),
			),
			'wrapper' => array (
				'width' => 50,
				'class' => '',
				'id' => '',
			),
			'default_value' => '',
			'placeholder' => '',
			'prepend' => '',
			'append' => '',
			'maxlength' => '',
			'readonly' => 0,
			'disabled' => 0,
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_type',
				'operator' => '==',
				'value' => 'post',
			),
		),
	),
	'menu_order' => 2,
	'position' => 'normal',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => esc_html__( 'Coupon options', 'truereview' ),
));

acf_add_local_field_group(array (
	'key' => 'group_56f110504e5b1',
	'title' => esc_html__( 'Gallery', 'truereview' ),
	'fields' => array (
		array (
			'key' => 'field_56f1106b8f703',
			'label' => esc_html__( 'Gallery', 'truereview' ),
			'name' => 'tj_format_gallery',
			'type' => 'gallery',
			'instructions' => esc_html__( 'Upload your images here.', 'truereview' ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'min' => '',
			'max' => '',
			'preview_size' => 'medium',
			'library' => 'all',
			'min_width' => '',
			'min_height' => '',
			'min_size' => '',
			'max_width' => '',
			'max_height' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_format',
				'operator' => '==',
				'value' => 'gallery',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => esc_html__( 'Format gallery', 'truereview' ),
));

acf_add_local_field_group(array (
	'key' => 'group_56f2378d2d911',
	'title' => esc_html__( 'Audio', 'truereview' ),
	'fields' => array (
		array (
			'key' => 'field_56f2378d3b982',
			'label' => esc_html__( 'Audio embed', 'truereview' ),
			'name' => 'tj_format_audio_embed',
			'type' => 'oembed',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'width' => '',
			'height' => '',
		),
		array (
			'key' => 'field_56f2378d3bae7',
			'label' => esc_html__( 'Audio upload', 'truereview' ),
			'name' => 'tj_format_audio_upload',
			'type' => 'file',
			'instructions' => esc_html__( 'Upload your audio/music.', 'truereview' ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_format',
				'operator' => '==',
				'value' => 'audio',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => esc_html__( 'Audio format', 'truereview' ),
));

acf_add_local_field_group(array (
	'key' => 'group_56f22fe274850',
	'title' => 'Video',
	'fields' => array (
		array (
			'key' => 'field_56f230858a3da',
			'label' => esc_html__( 'Video embed', 'truereview' ),
			'name' => 'tj_format_video_embed',
			'type' => 'oembed',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'width' => '',
			'height' => '',
		),
		array (
			'key' => 'field_56f230d592375',
			'label' => esc_html__( 'Video upload', 'truereview' ),
			'name' => 'tj_format_video_upload',
			'type' => 'file',
			'instructions' => esc_html__( 'Upload your video.', 'truereview' ),
			'required' => 0,
			'conditional_logic' => 0,
			'wrapper' => array (
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => '',
		),
	),
	'location' => array (
		array (
			array (
				'param' => 'post_format',
				'operator' => '==',
				'value' => 'video',
			),
		),
	),
	'menu_order' => 0,
	'position' => 'acf_after_title',
	'style' => 'default',
	'label_placement' => 'top',
	'instruction_placement' => 'label',
	'hide_on_screen' => '',
	'active' => 1,
	'description' => esc_html__( 'Video format', 'truereview' ),
));

endif;
