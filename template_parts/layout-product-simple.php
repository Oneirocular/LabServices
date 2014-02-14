<?

$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );

?>

<!-- Product -->
<div class="row section background-dark">
	<div class="col-sm-12">

		<div class="row">
			<div class="col-sm-12">
					<?php 
					show_if_exists($product_brand, '<h5>'.$product_brand.'</h5>');
					?>
					<h3><?php echo $product_name; ?></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-2">
				<?php

				if (isset($product_image)) {
					echo '<img src="'.$product_image[0].'" style="width:100%;" />';
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
		</div>

	</div>
</div>