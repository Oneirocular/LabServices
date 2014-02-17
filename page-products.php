<?php
/*
Template Name: Products
*/


	$args = array(
		'numberposts' => -1,
		'order' => 'ASC',
		'post_status' => 'publish',
		'post_parent' => $post->ID
	);

	$child_pages = get_children( $args );


	/* Get Ls products */
	$ls_product_term = get_term_by( 'slug', 'labservices', 'product_categories');

	$args = array(
		'numberposts' => -1,
		'order' => 'ASC',
		'post_status' => 'publish',
		'post_type' => 'ls_products',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_categories', 
				'field' => 'term_id', 
				'terms' => $ls_product_term->term_id
				)
			)

	);

	$ls_products = get_posts( $args );



	$products_array = array();

	foreach ($ls_products as $ls_product) {
	
		$product_title = $ls_product->post_title;
		$product_description_excerpt = wp_trim_words( $ls_product->post_content , $num_words = 5, $more = null ); 
		$product_permalink = get_permalink( $ls_product->ID );	

		$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $ls_product->ID ), 'medium' );

		
		 $html = '	<div class="main-product-container background-light">';
		 $html .= '		<div class="product-thumbnail"><img src="'.$product_image[0].'"/></div>';
		 $html .= '		<div class="inside">';
		 $html .= '			<div class="product-title"><strong>'.$product_title.'</strong></div>';
		 $html .= '			<p>'.$product_description_excerpt.'</p>';
		 $html .= '			<a class="btn btn-arrow btn-sm" href="'.$product_permalink.'" role="button">'.__( 'view product', 'bonestheme' ).'</a>';
		 $html .= '		</div>';
		 $html .= '	</div>';
		



		$products_array[] = $html;

	}


		

			
				

		






?>

<?php get_header(); ?>



<div class="row section main-slider background-dark products">
	<div class="col-sm-12">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="row">
			<div class="col-md-6">
				<?php the_content(); ?>
				
			</div>
		</div>

		<div class="row products">
			<div class="col-md-12">

				<?php  show_ls_product_carousel($products_array); ?>

			</div>
		</div>

		<?php endwhile; endif; ?>

	
	</div>
</div>




<?

$background_types = array("background-dark","background-light");

$i = 1;

// Walk through the child pages
foreach ($child_pages as $child_page_id => $child_page_object) {

	$child_page_label = get_field('page_slug', $child_page_object->ID);
	$child_page_title = $child_page_object->post_title;
	$child_page_text = $child_page_object->post_content;

	// $field_button_text = get_sub_field('button');

	// gets the background_class based on odd/even of the section
	$background_class = $background_types[($i % 2)];

	// generate html
	?>
		<!--  -->
		<a name="<?php echo $child_page_label; ?>"></a>
		<div class="row section <? echo $background_class; ?> ">

			<div class="col-sm-12">

				<div class="row">
					<div class="col-sm-7">
						<h1><? echo $child_page_title; ?></h1>
					</div>
				</div>
				<div class="row">
					<div class="col-sm-6">
						<? echo $child_page_text; ?>
					</div>
				</div>
				<?php
				// Get the right page content
				if ($child_page_label == "distribute") {
					include(locate_template('template_parts/page-products-distribute.php')); // because get_template_part doesn;t send vars
				} else if ($child_page_label == "accessoires") {
					include(locate_template('template_parts/page-products-accessoires.php')); // because get_template_part doesn;t send vars
				} 
				?>

			</div>


		</div>
	<?
	$i++;

}



?>




		
<?php get_footer(); ?>
