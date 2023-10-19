<?php

function montheme_support(){
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('menus');
    register_nav_menu('header', 'En tête du menu');

    add_image_size('card-header', 350, 215, true); //création d'un nouveau format de crop selon les besoins
    //attention les formats ne sont pas rétroactifs utiliser regenerate thumbnails extension (plugin)
}

function montheme_register_assets(){
    wp_register_style('bootstrap','https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css');
    wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js', ['popper', 'jquery'],false, true);
    wp_register_script('popper','https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js', [], false,true);
    //permet de dé-enregistrer le jquery requêter par WordPress core
    wp_deregister_script('jquery');
    //attention toutefois si d'autres plugins entre en conflit avec cette désactivation
    wp_register_script('jquery','https://code.jquery.com/jquery-3.2.1.slim.min.js',[],false,true);
    wp_enqueue_style('bootstrap');
    wp_enqueue_script('bootstrap');

}

function montheme_title_separator(){
    return '|';
}
//fonction de vérification du contenu de $title(array) depuis le hook document_title_parts
/*function montheme_document_title_parts($title){
    var_dump($title);die();
}*/


// filtres de modification du menu pour bootstrap
function montheme_menu_class(array $classes) : array
{
  $classes[] = 'nav-item';
  return $classes;
}

function montheme_menu_link_class(array $attrs) : array
{
    $attrs['class'] = 'nav-link';
    return $attrs;
}

function montheme_pagination(){

}

add_action('after_setup_theme', 'montheme_support');
add_action('wp_enqueue_scripts', 'montheme_register_assets');
add_filter('document_title_separator', 'montheme_title_separator');
// add_filter('document_title_parts', 'montheme_document_title_parts');
// hooks de modification d'apparence du menu
add_filter('nav_menu_css_class', 'montheme_menu_class');
add_filter('nav_menu_link_attributes', 'montheme_menu_link_class');

