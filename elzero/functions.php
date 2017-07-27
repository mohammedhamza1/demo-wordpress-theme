<?php
// include bootstrap navwalker
require_once('wp-bootstrap-navwalker.php');
// add post thumbnails
add_theme_support( 'post-thumbnails' );


/*
**  function to add my css style
**  wp_enqueue_style()
**  get_template_directory_uri() 
*/
function demo_add_styles(){
    wp_enqueue_style('bootstrap-css',get_template_directory_uri().'/css/bootstrap.min.css');
    wp_enqueue_style('fontawesome-css',get_template_directory_uri().'/css/font-awesome.min.css');
    wp_enqueue_style('main-css',get_template_directory_uri().'/css/main.css');
}
/*
**  function to add my scripts
**  wp_enqueue_script()
**  get_template_directory_uri() 
*/
function demo_add_scripts(){
    //remove registeraction for old jquery
    wp_deregister_script('jquery');
    //register a new jquery
    wp_register_script('jquery',includes_url('/js/jquery/jquery.js'),array(),false,true);
    //enqueue the new jquery
    wp_enqueue_script('jquery');
    wp_enqueue_script('bootstrap-js',get_template_directory_uri().'/js/bootstrap.min.js',array('jquery'),false,true);
    wp_enqueue_script('main-js',get_template_directory_uri().'/js/main.js',array(),false,true);
    //add [lt IE 9] scripts
    wp_enqueue_script('html5shiv',get_template_directory_uri().'/js/html5shiv.js');
    //add conditional comment
    wp_script_add_data('html5shiv','conditional','lt IE 9');
    wp_enqueue_script('respond',get_template_directory_uri().'/js/respond.min.js');
    wp_script_add_data('respond','conditional','lt IE 9');

}
/*
**  function to register custome menu
**  register_nav_menu() 
**  register_nav_menus(array());
*/
function demo_register_custome_menu(){ 
    register_nav_menus(array( 
        'bootstrap-menu' => 'Navigation Bar',
        'footer-menu' => 'Footer Menue' ));
}
/*
**  function to Add bootstrap menu
**  wp_nav_menu() 
*/
function demo_bootstrap_nav_menu(){
    wp_nav_menu(array(
    'theme_location'     => 'bootstrap-menu',
    'menu_class'         => 'nav navbar-nav navbar-right',
    'container'          => false,
    'walker'             => new WP_Bootstrap_Navwalker()
    ));
}
/*
**  function to custome excerpt length 
*/
function demo_excerpt_enhance($length){
    return 20;
}
/*
**  function to custome excerpt read more 
*/
function demo_excerpt_more($more){
    return ' ...';
}



/*
**  Add actions
**  add action()
**  'wp_enqueue_scripts'
**  'init'
*/
add_action('wp_enqueue_scripts','demo_add_styles');
add_action('wp_enqueue_scripts','demo_add_scripts');
add_action('init','demo_register_custome_menu');
/*
**  Add filters
**  add_filter()
**  'excerpt_length'
**  'excerpt_more'
*/
add_filter('excerpt_length','demo_excerpt_enhance');
add_filter('excerpt_more','demo_excerpt_more');

?>
