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




?>

<?php get_header(); ?>



<div class="row section background-dark products">
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

		<div class="row">

			<?php

				foreach ($ls_products as $ls_product) {
				
					$product_title = $ls_product->post_title;
					$product_description_excerpt = wp_trim_words( $ls_product->post_content , $num_words = 5, $more = null ); 
					$product_permalink = get_permalink( $ls_product->ID );	


				?>


			<div class="main-product-frame col-sm-3 col-md-3">
				<div class="main-product-container background-light">

					<div class="product-thumbnail"><img src="http://10.0.1.7/labservices/wp-content/themes/bones-bootstrap-sass/library/images/content/product_400x400.jpg"/></div>
					<div class="inside">
						<div class="product-title"><strong><?php echo $product_title; ?></strong></div>
						<p><?php echo $product_description_excerpt; ?></p>
						<a class="btn btn-arrow btn-sm" href="<?php echo $product_permalink; ?>" role="button">view product</a></div>
					
				</div>
			</div>

			<?php } ?>

		</div>

				<div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
				  <!-- Indicators -->
				  <ol class="carousel-indicators">
				    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
				  </ol>

				  <!-- Wrapper for slides -->
				  <div class="carousel-inner">
				    <div class="item active">
			
				    </div>
				  </div>

				  <!-- Controls -->
	<!-- 			  <a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
				    <span class="glyphicon glyphicon-chevron-left"></span>
				  </a>
				  <a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
				    <span class="glyphicon glyphicon-chevron-right"></span>
				  </a> -->
				</div>

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

		<ul class="product-groups">

			<?php
				if (!empty($ls_distribution_products)) {

					foreach ($ls_distribution_products_array as $product_group) {

						?>

						<li class="product-group">

							<div class="row header">
								<div class="col-sm-12">
									<h4><?php echo $product_group['product_group_label']." (".count($product_group['product_group_products']).")"; ?></h4>
								</div>
							</div>

							<!-- start products -->
							<div class="row products">

								<div class="product-group-container col-sm-12">
									<div class="row">
								<?

								foreach ($product_group['product_group_products'] as $group_products) {
									?>

										<div class="product-container col-sm-2 col-md-2">

										<div class="product-thumbnail"><img src="http://10.0.1.7/labservices/wp-content/themes/bones-bootstrap-sass/library/images/content/product_400x400.jpg"/></div>
										<div class="inside"><div class="product-title">lorem ipsum dolor sit</div><a class="btn btn-default btn-sm" href="#" role="button">view product</a></div>

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
				<div id="search_products" ></div>
			</div>
		</div>

		<div class="row">
			<div class="col-md-12" >

				<div id="search_response"></div>
				<div id="search_results"></div>

			</div>
		</div>

	</div>

</div>



		
<?php get_footer(); ?>
