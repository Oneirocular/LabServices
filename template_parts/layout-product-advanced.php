<!-- Home Slider -->
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
		<div class="col-sm-6">
					<?php 
					show_if_exists($product_description_title, '<h2>'.$product_description_title.'</h2>');
					show_if_exists($product_body);
					?>
		</div>

		<?php 
		
			// Key features
			if( get_field('product_features') ) {
			?>
			<div class="col-sm-6">
				<div class="row">
					<div class="col-sm-9 product_features col-centered">
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

		<!-- Row -->
		<li class="ls-accordeon-row product-specification closed">

			<div class="row ls-accordeon-header">
				<div class="col-sm-12">
					<div class="status-arrow"></div>
					<h4>Product specification</h4>
				</div>

			</div>

			<div class="row ls-accordeon-container">
				<div class="ls-accordeon-container-content col-sm-12">
					<div class="row">
					




						<div class="table-responsive">
							<table class="table table-hover">
								<tbody>
									<tr>
										<th>Range of Motion </th>
										<td class="description"><p>Z Height: 400 or 750 mm<br/>Extended reach options available<br/>Linear modules: 1.0 m, 1.5 m and 2.0 m versions<br/></p></td>
										<td></td>
									</tr>
									<tr>
										<th>Precision</th>
										<td class="description"><p>± 0.2 mm</p></td>
										<td></td>
									</tr>
									<tr>
										<th>Payload</th>
										<td class="description"><p>0.5 – 1 kg including gripper</p></td>
										<td></td>
									</tr>
									<tr>
										<th>Power</th>
										<td class="description"><p>120/240VAC, 50/60Hz</p></td>
										<td></td>
									</tr>
									<tr>
										<th>Communication</th>
										<td class="description"><p>Ethernet, RS-232, RS-485 and Digital I/O</p></td>
										<td></td>
									</tr>
									<tr>
										<th>Operator Interface</th>
										<td class="description"><p>Web based operator interface supports local or remote control via browser connected to embedded web server</p></td>
										<td></td>
									</tr>
								</tbody>
							</table>
						</div>











					</div>
				</div>
			</div>
		</li>

		<!-- Row -->
		<li class="ls-accordeon-row closed">

			<div class="row ls-accordeon-header">
				<div class="col-sm-12">
					<div class="status-arrow"></div>
					<h4>Related products</h4>
				</div>
			</div>

			<div class="row ls-accordeon-container">
				<div class="ls-accordeon-container-content col-sm-12">
					<div class="row">
						<?php for ($i=0; $i < 5; $i++) { 
						
							?>

									<div class="product-container col-sm-2 col-md-2">

										<div class="product-thumbnail"><img src="http://10.0.1.7/labservices/wp-content/uploads/2014/02/product_400x400-340x340.jpg"></div>
										<div class="inside"><div class="product-title">Tristique Ornare Risus Lorem</div><a class="btn btn-default btn-sm" href="http://10.0.1.7/labservices/eng/product/inceptos-ipsum/" role="button">view product</a></div>

									</div>
							<?
							# code...
						}
						?>
					</div>
				</div>
			</div>
		</li>

	</ul>
			

	</div>
</div>