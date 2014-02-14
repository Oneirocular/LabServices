<?php
/*
Template Name: Products
*/

	/* Get Ls products */
	$args = array(
		'numberposts' => -1,
		'order' => 'ASC',
		'post_status' => 'publish',
		'post_type' => 'ls_products',
		'tax_query' => array(
			array(
				'taxonomy' => 'product_categories', 
				'field' => 'term_id', 
				'terms' => '30'
				)
			)

	);

	$ls_products = get_posts( $args );




	/* Get distribution products */
	$ls_distribution_groups = get_field('product_groups');
	$ls_distribution_products_array = array();

	foreach ($ls_distribution_groups as $distribution_group) {

			$args = array(
				'numberposts' => -1,
				'order' => 'ASC',
				'post_status' => 'publish',
				'post_type' => 'ls_products',
				'tax_query' => array(
					array(
						'taxonomy' => $distribution_group['product_category']->taxonomy, 
						'field' => 'term_id', 
						'terms' => $distribution_group['product_category']->term_id
						)
					)

			);

			$ls_distribution_products = get_posts($args);

			// Add the products to the array
			if (!empty($ls_products)) {
				$ls_distribution_products_array[] = array(
					"product_group_label" => $distribution_group['product_group_label'],
					"product_group_products" => $ls_distribution_products
				);
			}


	}




	//$ls_distribution_categories = get_categories('child_of=32'); 
	//$ls_distribution_products = array();

	// foreach ($ls_distribution_categories as $categorie) {
	// 	print_r($categorie);
	// 	# code...
	// }

 //  foreach ($categories as $category) {
 //  	$option = '<option value="/category/archives/'.$category->category_nicename.'">';
	// $option .= $category->cat_name;
	// $option .= ' ('.$category->category_count.')';
	// $option .= '</option>';
	// echo $option;
 //  }



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
		 $html .= '			<a class="btn btn-arrow btn-sm" href="'.$product_permalink.'" role="button">view product</a>';
		 $html .= '		</div>';
		 $html .= '	</div>';
		



		$products_array[] = $html;

	}


		

			
				

		






?>

<?php get_header(); ?>



<div class="row section main-slider background-dark products">
	<div class="col-sm-12">

		<div class="row">
			<div class="col-md-6">
				<h3>Lab Services Products</h3>
				<p>PlateButler® Robotic Systems are built with PlateButler® V3 software and allow integration of all kinds of automatable instruments. Whether it concerns integration of previously used devices or a complete new system. Even a combination of both is possible. As the independent system integrator, Lab Services makes sure to develop a custom made 
robotic system</p>
			</div>
		</div>

		<div class="row products">
			<div class="col-md-12">

				<?php  show_ls_product_carousel($products_array); ?>

			</div>
		</div>


	
	</div>
</div>




<!--                -->
<div class="row section background-light products">

	<div class="col-sm-12">

		<div class="row">
			<div class="col-md-6">
				<h1>We’re also supplier of:</h1>
			</div>
		</div>

		<div class="row">
		</div>

		<ul class="ls-accordeon">

			<?php
				if (!empty($ls_distribution_products)) {

					foreach ($ls_distribution_products_array as $product_group) {

						?>

						<li class="ls-accordeon-row">

							<div class="row ls-accordeon-header">
								<div class="col-sm-12">
									<div class="status-arrow"></div>
									<h4><?php echo $product_group['product_group_label']." (".count($product_group['product_group_products']).")"; ?></h4>
								</div>
							</div>

							<!-- start products -->
							<div class="row ls-accordeon-container">

								<div class="ls-accordeon-container-content col-sm-12">
									<div class="row">
								<?

								foreach ($product_group['product_group_products'] as $group_product) {

									
									$product_title = $group_product->post_title;
									$product_description_excerpt = wp_trim_words( $group_product->post_content , $num_words = 5, $more = null ); 
									$product_permalink = get_permalink( $group_product->ID );	

									$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $group_product->ID ), 'medium' );
									?>

										<div class="product-container col-sm-2 col-md-2">

										<div class="product-thumbnail"><img src="<?php echo $product_image[0]; ?>"/></div>
										<div class="inside"><div class="product-title"><?php echo $product_title; ?></div><a class="btn btn-arrow btn-sm" href="<?php echo $product_permalink; ?>" role="button">view product</a></div>

										</div>

									<?
								}

								?>
							</div>
						</div>
							</div>
							<!-- end products -->
						</li>

						<?
					?>

			<? 

		}
		} ?>

		</ul>
		
	</div>

</div>



<div class="row section background-dark">

	<div class="col-sm-12">

		<div class="row">
			<div class="col-md-6">
				<h1>Looking for a specific product?:</h1>
				<p>Labservices can deliver a range of <strong>5.000 products</strong>, use the form below to search for a specific product.</p>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6">
				<input type="text" id="product_search_field" class="form-control" placeholder="i.e. 'banff 430 pressure system'">
			</div>
			<div class="col-md-2">
				<div id="search_products_icon" ></div><div id="icon_loader" ></div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-6" >
				<div id="search_response"></div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12" >
				<div id="search_results"></div>
			</div>
		</div>

	</div>

</div>



		
<?php get_footer(); ?>
