<?php 

/* Basic file for product single layout. based on the category it loads different template files */
get_header(); 

$product_name = $post->post_title;
$product_body = $post->post_content;
$product_description_title = get_field('description_title');
$product_brand = get_field('product_brand');

$product_categories = wp_get_post_terms($post->ID, 'product_categories', array("fields" => "ids"));


// Check to which category the product belongs and choose the right layout
if (in_array(30, $product_categories)) {
	include(locate_template('template_parts/layout-product-advanced.php'));
} else if (in_array(31, $product_categories)) {
	include(locate_template('template_parts/layout-product-simple.php'));
}

get_footer(); ?>