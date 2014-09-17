<?php

/**
 * The configuration options for the Shoestrap Customizer
 */
function shoestrap_customizer_config() {
 
	$args = array(
 
		// Change the logo image. (URL)
		// If omitted, the default theme info will be displayed.
		// A good size for the logo is 250x50.
		'logo_image'   => get_template_directory_uri() . '/images/theme-logo.png',
 
		// The color of active menu items, help bullets etc.
		'color_active' => '#1abc9c',
 
		// Color used for secondary elements and desable/inactive controls
		'color_light'  => '#8cddcd',
 
		// Color used for button-set controls and other elements
		'color_select' => '#34495e',
 
		// Color used on slider controls and image selects
		'color_accent' => '#FF5740',
 
		// The generic background color.
		// You should choose a dark color here as we're using white for the text color.
		'color_back'   => '#333',
 
		// If Kirki is embedded in your theme, then you can use this line to specify its location.
		// This will be used to properly enqueue the necessary stylesheets and scripts.
		// If you are using kirki as a plugin then please delete this line.
		'url_path'     => get_template_directory_uri() . '/kirki/',
 
		// If you want to take advantage of the backround control's 'output',
		// then you'll have to specify the ID of your stylesheet here.
		// The "ID" of your stylesheet is its "handle" on the wp_enqueue_style() function.
		// http://codex.wordpress.org/Function_Reference/wp_enqueue_style
		'stylesheet_id' => 'shoestrap',
 
	);
 
	return $args;
 
}
add_filter( 'kirki/config', 'shoestrap_customizer_config' );

/**
 * Create the section
 */
function my_custom_section( $wp_customize ) {

	// Create the "My Section" section
	$wp_customize->add_section( 'my_section', array(
		'title'    => __( 'My Section', 'translation_domain' ),
		'priority' => 12
	) );

}
add_action( 'customize_register', 'my_custom_section' );

/**
 * Create the setting
 */
function my_custom_setting( $controls ) {
 
	$controls[] = array(
	'type'         => 'background',
	'setting'      => 'my_setting',
	'label'        => __( 'My Setting', 'textdomain' ),
	'description'  =>   __( 'Background Color', 'textdomain' ),
	'section'      => 'my_section',
	'default'      => array(
		'color'    => '#ffffff',
		'image'    => null,
		'repeat'   => 'repeat',
		'size'     => 'inherit',
		'attach'   => 'inherit',
		'position' => 'left-top',
		'opacity'  => 100,
	),
	'priority' => 3,
	'output' => 'body',
);
 
	return $controls;
}
add_filter( 'kirki/controls', 'my_custom_setting' );



