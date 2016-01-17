<?php 
function theme_resources() {
    wp_enqueue_style('style', get_stylesheet_uri());
    
    wp_register_script( 'vendor', get_stylesheet_directory_uri() . '/js/vendor.min.js' );
    wp_enqueue_script('main', get_template_directory_uri() . '/js/main.min.js', ['vendor'], '1.2', true);
}
add_action('wp_enqueue_scripts', 'theme_resources');



//Custom excerpt length
function custom_excerpt_length() {
    return 25;
}
add_filter('excerpt_length', 'custom_excerpt_length');


//theme setup
function theme_setup() {
    
    //Let WordPress manage the document title.
	add_theme_support( 'title-tag' );
    
    //Register menus Location
    register_nav_menus([
        'nav' => __('Menu Navbar'), 
        'sitemap' => __('Sitemap Menu')
    ]);
    
    //Add feature image support
    add_theme_support('post-thumbnail');
        
    //Add image cropping/resizing
    add_image_size('small-thumbnail', 180, 120, true);  //('name of the argument passed in the get_the_thumbnail', width, height, background-size: cover -> true 
    add_image_size('banner-image', 920, 220, ['left', 'top']);  //background-position
    
    //Add post format support
    add_theme_support('post-formats', ['image', 'video']);
}
add_action('after_setup_theme', 'theme_setup');


//Add widget locations
function myWidgetLocations() {
    register_sidebar([
        'name' => 'Footer 4',
        'id' => 'footer4',
        'before_widget' => '<div class="footer4-widget">', //in default it outputs each widget in this area in a <li>, you can change that here
        'after_widget' => '</div>'
        'before_title' => '<h3>', //the same shit for the widget title
        'after_title' => '</h3>'
    ]);
}
add_action('widgets_inits', 'myWidgetLocations');


?>