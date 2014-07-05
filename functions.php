<?php 


	function theme_styles() {
		wp_enqueue_style( 'google-fonts','http://fonts.googleapis.com/css?family=Open+Sans:400,600,700|Oxygen:400,700' );
		wp_enqueue_style( 'font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css' );
		wp_enqueue_style( 'boostrap_css', get_template_directory_uri() . '/css/bootstrap.min.css' );
		wp_enqueue_style( 'blueimp', 'http://blueimp.github.io/Gallery/css/blueimp-gallery.min.css' );
		wp_enqueue_style( 'image-gallery', get_template_directory_uri() . '/css/bootstrap-image-gallery.min.css'); 
		wp_enqueue_style( 'main_css', get_template_directory_uri() . '/style.css' );
		
    }
add_action( 'wp_enqueue_scripts', 'theme_styles' );
	
	function theme_js() {
		
		global $wp_scripts;

		wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js', '', '', false );  
		wp_register_script( 'html5_shiv', 'https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js', '', '', false );  
	
		$wp_scripts->add_data( 'html_shiv', 'conditional', 'lt IE 9' );
		$wp_scripts->add_data( 'respond_js', 'conditional', 'le IE 9' );
		
		
		wp_enqueue_script( 'blue_imp', 'http://blueimp.github.io/Gallery/js/jquery.blueimp-gallery.min.js', '', '', true );
		wp_enqueue_script( 'theme_js', get_template_directory_uri() . '/js/theme.js', array('jquery', 'bootstrap_js'), '', true );
		wp_enqueue_script( 'blue_imp_js', get_template_directory_uri() . '/js/bootstrap-image-gallery.min.js', array('jquery'), '',true);

		wp_enqueue_script( 'bootstrap_js', get_template_directory_uri() . '/js/bootstrap.min.js', array('jquery'), '', true );
		/* the bootstrap min for some reasons conflicts with the wp_bootstrap_navwalker.php */
	
	}	
add_action( 'wp_enqueue_scripts', 'theme_js' );

// add_filter( 'show_admin_bar', '__return_false' ); //to turn off the admin bar


$defaults = array(
	'default-color'          => '',
	'default-image'          => '',
	'wp-head-callback'       => '_custom_background_cb',
	'admin-head-callback'    => '',
	'admin-preview-callback' => ''
);
add_theme_support( 'custom-background', $defaults );

$args = array(
	'flex-width'    => true,
	'width'         => 1900,
	'flex-height'    => true,
	'height'        => 500,
	'default-image' => get_template_directory_uri() . '/images/header.jpg'
);
add_theme_support( 'custom-header', $args );

add_theme_support( 'menus' );
add_theme_support( 'post-thumbnails' );

require_once('wp_bootstrap_navwalker.php');
function register_theme_menus() {
	
	register_nav_menus(
		array(
			'primary' => __( 'Primary Menu', 'dental-affiliate-bootstrap' ),
			'footer_menu' => __( 'Footer Menu', 'dental-affiliate-bootstrap' )
		)
	);
}
add_action( 'init', 'register_theme_menus' );



function create_widget($name, $id, $description) {

	register_sidebar(array(
		'name' => __($name),
		'id' => $id,
		'description' => __( $description ),
		'before_widget' => '<div class="widget">',
		'after_widget' => '</div>',
		'before_title' => '<h3>',
		'after_title' => '</h3>'
	));
}

create_widget( 'Front Page Left', 'front-left', 'Displays on the left of the homepage');
create_widget( 'Front Page Center', 'front-center', 'Displays on the center of the homepage');
create_widget( 'Front Page Right', 'front-right', 'Displays on the right of the homepage');

create_widget( 'Page Sidebar', 'page', 'Displays on the side of pages with a sidebar');
create_widget( 'Blog Sidebar', 'blog', 'Displays on the side of blogs with a sidebar');
create_widget ( '404 Error Page', 'fourohfour', 'Displays on the 404 page');

function bootstrap_theme_customizer( $wp_customize ) {
    $wp_customize->add_section( 'themeslug_logo_section' , array(
    'title'       => __( 'Logo', 'themeslug' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header'
) );
    $wp_customize->add_setting( 'themeslug_logo' );

    $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'themeslug_logo', array(
    'label'    => __( 'Logo', 'themeslug' ),
    'section'  => 'themeslug_logo_section',
    'settings' => 'themeslug_logo'
) ) );
}
add_action('customize_register', 'bootstrap_theme_customizer');

/* ----------------------------------------------------------
Declare vars
------------------------------------------------------------- */
$themename = "dental affiliate bootstrap";
$shortname = "shortname";
 
$categories = get_categories('hide_empty=0&orderby=name');
$all_cats = array();
foreach ($categories as $category_item ) {
$all_cats[$category_item->cat_ID] = $category_item->cat_name;
}
array_unshift($all_cats, "Select a category");
 
/*---------------------------------------------------
register settings
----------------------------------------------------*/
function theme_settings_init(){
register_setting( 'theme_settings', 'theme_settings' );
wp_enqueue_style("panel_style", get_template_directory_uri()."/panel.css", false, "1.0", "all");
wp_enqueue_script("panel_script", get_template_directory_uri()."/panel_script.js", false, "1.0");
}
 
/*---------------------------------------------------
add settings page to menu
----------------------------------------------------*/
function add_settings_page() {
add_menu_page( __( 'Your theme name' .' Theme Panel' ), __( 'Theme Settings' .'' ), 'manage_options', 'settings', 'theme_settings_page');
}
 
/*---------------------------------------------------
add actions
----------------------------------------------------*/
add_action( 'admin_init', 'theme_settings_init' );
add_action( 'admin_menu', 'add_settings_page' );
 
/* ---------------------------------------------------------
Declare options
----------------------------------------------------------- */
 
$theme_options = array (
 
array( "name" => $themename." Options",
"type" => "title"),
 
/* ---------------------------------------------------------
General section
----------------------------------------------------------- */
array( "name" => "General",
"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Logo URL",
"desc" => "Enter the link to your logo image",
"id" => $shortname."_logo",
"type" => "text",
"std" => ""),
 
array( "name" => "Custom Favicon",
"desc" => "A favicon is a 16x16 pixel icon that represents your site; paste the URL to a .ico image that you want to use as the image",
"id" => $shortname."_favicon",
"type" => "text",
"std" => get_bloginfo('url') ."/images/favicon.ico"),
 
array( "type" => "close"),
 
/* ---------------------------------------------------------
Home section
----------------------------------------------------------- */
array( "name" => "Homepage",
"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Homepage Featured",
"desc" => "Choose a category from which featured posts are drawn",
"id" => $shortname."_feat_cat",
"type" => "select",
"options" => $all_cats,
"std" => "Select a category"),
 
array( "type" => "close"),
 
/* ---------------------------------------------------------
Footer section
----------------------------------------------------------- */
array( "name" => "Social Media",
"type" => "section"),
array( "type" => "open"),
 
array( "name" => "Facebook",
"desc" => "Put your facebook URL here",
"id" => $shortname."_facebook_url",
"type" => "text",
"std" => ""),

array( "name" => "Twitter",
"desc" => "Put your twitter URL here",
"id" => $shortname."_twitter_url",
"type" => "text",
"std" => ""),

array( "name" => "LinkedIn",
"desc" => "Put your LinkedIn URL here",
"id" => $shortname."_linkedin_url",
"type" => "text",
"std" => ""),

array( "name" => "Google+",
"desc" => "Put your Google+ URL here",
"id" => $shortname."_googleplus_url",
"type" => "text",
"std" => ""),

array( "name" => "Pinterest",
"desc" => "Put your Pinterest URL here",
"id" => $shortname."_pinterest_url",
"type" => "text",
"std" => ""),

array( "name" => "YouTube",
"desc" => "Put your YouTube URL here",
"id" => $shortname."_youtube_url",
"type" => "text",
"std" => ""),

array( "name" => "Phone Number",
"desc" => "Put your phone number here",
"id" => $shortname."_phone_url",
"type" => "text",
"std" => ""),

array( "name" => "E-mail",
"desc" => "Put your E-mail here",
"id" => $shortname."_mailto_url",
"type" => "text",
"std" => ""),

array( "name" => "Google Maps",
"desc" => "Put your Google Maps location here",
"id" => $shortname."_googlemaps_url",
"type" => "text",
"std" => ""),
 
array( "type" => "close")

);
 
/*---------------------------------------------------
Theme Panel Output
----------------------------------------------------*/
function theme_settings_page() {
    global $themename,$theme_options;
    $i=0;
    $message=''; 
    if ( 'save' == $_REQUEST['action'] ) {
      
        foreach ($theme_options as $value) {
            update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }
      
        foreach ($theme_options as $value) {
            if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }
        $message='saved';
    }
    else if( 'reset' == $_REQUEST['action'] ) {
          
        foreach ($theme_options as $value) {
            delete_option( $value['id'] ); }
        $message='reset';        
    }
  
    ?>
    <div class="wrap options_wrap">
        <div id="icon-options-general"></div>
        <h2><?php _e( ' Theme Settings' ) //your admin panel title ?></h2>
        <?php
        if ( $message=='saved' ) echo '<div class="updated settings-error" id="setting-error-settings_updated"> 
        <p>'.$themename.' settings saved.</strong></p></div>';
        if ( $message=='reset' ) echo '<div class="updated settings-error" id="setting-error-settings_updated"> 
        <p>'.$themename.' settings reset.</strong></p></div>';
        ?>
        <ul>
            <li>View Documentation |</li>
            <li>Visit Support |</li>
            <li>Theme version 1.0 </li>
        </ul>
        <div class="content_options">
            <form method="post">
  
            <?php foreach ($theme_options as $value) {
          
                switch ( $value['type'] ) {
              
                    case "open": ?>
                    <?php break;
                  
                    case "close": ?>
                    </div>
                    </div><br />
                    <?php break;
                  
                    case "title": ?>
                    <div class="message">
                        <p>To easily use the <?php echo $themename;?> theme options, you can use the options below.</p>
                    </div>
                    <?php break;
                  
                    case 'text': ?>
                    <div class="option_input option_text">
                    <label for="<?php echo $value['id']; ?>">
                    <?php echo $value['name']; ?></label>
                    <input id="" type="<?php echo $value['type']; ?>" name="<?php echo $value['id']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id'])  ); } else { echo $value['std']; } ?>" />
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case 'textarea': ?>
                    <div class="option_input option_textarea">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <textarea name="<?php echo $value['id']; ?>" rows="" cols=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes(get_settings( $value['id']) ); } else { echo $value['std']; } ?></textarea>
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case 'select': ?>
                    <div class="option_input option_select">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <select name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>">
                    <?php foreach ($value['options'] as $option) { ?>
                            <option <?php if (get_settings( $value['id'] ) == $option) { echo 'selected="selected"'; } ?>><?php echo $option; ?></option>
                    <?php } ?>
                    </select>
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case "checkbox": ?>
                    <div class="option_input option_checkbox">
                    <label for="<?php echo $value['id']; ?>"><?php echo $value['name']; ?></label>
                    <?php if(get_option($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = "";} ?>
                    <input id="<?php echo $value['id']; ?>" type="checkbox" name="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> /> 
                    <small><?php echo $value['desc']; ?></small>
                    <div class="clearfix"></div>
                    </div>
                    <?php break;
                  
                    case "section": 
                    $i++; ?>
                    <div class="input_section">
                    <div class="input_title">
                         
                        <h3><img src="<?php echo get_template_directory_uri();?>/images/options.png" alt="">&nbsp;<?php echo $value['name']; ?></h3>
                        <span class="submit"><input name="save<?php echo $i; ?>" type="submit" class="button-primary" value="Save changes" /></span>
                        <div class="clearfix"></div>
                    </div>
                    <div class="all_options">
                    <?php break;
                     
                }
            }?>
          <input type="hidden" name="action" value="save" />
          </form>
          <form method="post">
              <p class="submit">
              <input name="reset" type="submit" value="Reset" />
              <input type="hidden" name="action" value="reset" />
              </p>
          </form>
        </div>
        <div class="footer-credit">
            <p>This theme was made by <a title="travis thompson" href="http://uptrde.com" target="_blank" >Travis Thompson</a>.</p>
        </div>
    </div>
    <?php
}
 
?>
