<?php




	/* Get distribution products */
	$ls_distribution_groups = get_field('product_groups', $child_page_object->ID);
	$ls_distribution_products_array = array();

	foreach ($ls_distribution_groups as $distribution_group) {


			$args = array(
				'numberposts' => -1,
				'order' => 'ASC',
				'orderby' => 'menu_order',
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
		

		<ul class="ls-accordeon">

			<?php
				if (!empty($ls_distribution_products)) {

					foreach ($ls_distribution_products_array as $product_group) {

						?>

						<li class="ls-accordeon-row col-xs-12">

							<div class="row ls-accordeon-header">
								<div class="col-xs-12">
									<div class="status-arrow"></div>
									<h4><?php echo $product_group['product_group_label']." (".count($product_group['product_group_products']).")"; ?></h4>
								</div>
							</div>

							<!-- start products -->
							<div class="row ls-accordeon-container">

								<div class="ls-accordeon-container-content col-xs-12">
									<div class="row">

						
								<?

								foreach ($product_group['product_group_products'] as $group_product) {

									echo get_distribute_product_container($group_product);

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
