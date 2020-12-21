<?php
/*
Sitemap Plugin

Plugin Name:	Sitemap Plugin
Description:	Creates a Sitemap Page for your Wordpress site
Version:		0.5.0
Author:			Dimitris Bakiris
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

include 'php/sitemap-shortcode.php';
include 'php/sitemap-options.php';

add_filter( 'template_include', 'php_include_plugin');
function php_include_plugin($page_template){
	add_shortcode('sitemap', 'wp_sitemap_shortcode'); 
	if ( is_page( 'sitemap' ) ) {
        $page_template = dirname( __FILE__ ) . '/php/communityPostSitemap301120.php';
    }
	return $page_template;
}
?>

