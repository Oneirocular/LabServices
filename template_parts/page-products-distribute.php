<?php





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



	?>

	
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
										<div class="inside"><div class="product-title"><?php echo $product_title; ?></div><a class="btn btn-arrow btn-sm" href="<?php echo $product_permalink; ?>" role="button"><?php echo __( 'view product', 'bonestheme' ); ?></a></div>

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

