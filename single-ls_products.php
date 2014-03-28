<?php 

/* Basic file for product single layout. based on the category it loads different template files */
get_header(); 
$product_name = $post->post_title;
$product_body = apply_filters('the_content', $post->post_content);
$product_description_title = get_field('description_title');
$product_brand = get_field('product_brand');

/* Get the categories assigned to the product */
$product_categories = wp_get_post_terms($post->ID, 'product_categories', array("fields" => "ids"));

// Get the system categories
$ls_products_category = get_option('lab_services_product_categorie');
$ls_parts_category = get_option('ls_distribution_product_category');

// Check to which category the product belongs and choose the right layout
if (in_array($ls_products_category, $product_categories)) {
	include(locate_template('template_parts/layout-product-advanced.php'));
} else if (in_array($ls_parts_category, $product_categories)) {
	include(locate_template('template_parts/layout-product-simple.php'));

/* Product is not connected to any of the system categories */
} else {
	?>

	<div class="row section background-dark">
		<div class="col-sm-12">
		<?php 	echo "Product category not found."; ?>
		</div>
	</div>

	<?php
}

get_footer(); ?>