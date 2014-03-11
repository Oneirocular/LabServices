<!-- Slider -->
<div class="row section main-slider background-dark">
	<div class="col-sm-12">

		<div class="row">
			<div class="col-sm-12">
				<h3><?php echo $product_name; ?></h3>
			</div>
		</div>

		<div class="row main-slider">
			<div class="col-sm-12">
				<?php
				if( get_field('main_slider') )
				{
					$slides = array();
					while( has_sub_field('main_slider') )
					{ 

						$slide_image_object = get_sub_field('image');
						$slide_image = $slide_image_object['sizes']['main-slider'];
						$slides[] = '<img src="'.$slide_image.'"/>';

					}
					show_ls_carousel($slides);
				}

				?>
			</div>
		</div>

	</div>
</div>


<!-- Home Columns -->
<div class="row section background-light">
	<div class="col-sm-12">


		<!-- Body -->
		<div class="row">
			<div class="col-xs-12 col-md-6 ">
				<?php 
				show_if_exists($product_description_title, '<h2>'.$product_description_title.'</h2>');
				show_if_exists($product_body);
				?>
			</div>

			<?php 
			
			// Key features
			if( get_field('product_features') ) {
				?>
				<div class="col-xs-12 col-md-6">
					<div class="row">
						<div class="col-xs-12 col-md-9 product_features col-centered">
							<div class="box">
								<h3>Key features</h3>
								<ul class="">

									<?php

									while( has_sub_field('product_features') )
									{ 

										$feature = get_sub_field('feature');
										?>
										<li><?php echo $feature; ?></li>
										<?php

									}

									?>

								</ul>
							</div>
						</div>
					</div>
				</div>

				<?

			}

			?>

		</div>


		<!-- Accordeon -->


		<ul class="ls-accordeon">

			<?php if (get_field('product_specifications')) { ?>

			<!-- Row -->
			<li class="ls-accordeon-row product-specification closed">

				<div class="row ls-accordeon-header">
					<div class="col-xs-12">
						<div class="status-arrow"></div>
						<h4><?php _e("Product specification","bonestheme"); ?></h4>
					</div>

				</div>

				<div class="row ls-accordeon-container">
					<div class="ls-accordeon-container-content col-xs-12">
						<div class="row">
							
							<div class="table-responsive">
								<table class="table table-hover">
									<tbody>
										<?php 
										while( has_sub_field('product_specifications') )
										{
											$spec_label = get_sub_field('label');
											$spec_text = get_sub_field('text');

											?>
											<tr>
												<th><?php echo $spec_label; ?></th>
												<td class="description"><p><?php echo $spec_text; ?></p></td>
												<td></td>
											</tr>
											
											<?php
										}


										?>

									</tbody>
								</table>
							</div>


						</div>
					</div>
				</div>
			</li>

			<?php }


			if (get_field('related_products')) {

			 ?>

			<!-- Row -->
			<li class="ls-accordeon-row closed">

				<div class="row ls-accordeon-header">
					<div class="col-xs-12">
						<div class="status-arrow"></div>
						<h4>Related products</h4>
					</div>
				</div>

				<div class="row ls-accordeon-container">
					<div class="ls-accordeon-container-content col-xs-12">
						<div class="row">

							<?php

							while( has_sub_field('related_products') )
								{ 
									$product = get_sub_field('product');
									echo get_distribute_product_container($product);
								}

							?>

						</div>
					</div>
				</div>
			</li>

			<?php
			}
			?>	
		</ul>
		

	</div>
</div>