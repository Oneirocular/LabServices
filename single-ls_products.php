<?php 

get_header(); 

$product_name = $post->post_title;
$product_body = $post->post_content;

?>

<!-- Home Slider -->
<div class="row section background-dark">
	<div class="col-sm-12">

		<div class="row">
			<div class="col-sm-12">
					<h3><?php echo $product_name; ?></h3>
			</div>
		</div>

		<div class="row">
			<div class="col-sm-12">
				slider
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
				<?php echo $product_body; ?>
		</div>

		<?php 
			

			// Key features

			if( get_field('product_features') ) {
			?>
			<div class="col-sm-6">
				<div class="row aaa">
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
		<li class="ls-accordeon-row">

			<div class="row ls-accordeon-header">
				<div class="col-sm-12">
					<h4>Product specification</h4>
				</div>
			</div>

			<div class="row ls-accordeon-container">
				<div class="ls-accordeon-container-content col-sm-12">
					<div class="row">
						<div class="col-sm-12">sdf</div>
					</div>
				</div>
			</div>
		</li>

		<!-- Row -->
		<li class="ls-accordeon-row">

			<div class="row ls-accordeon-header">
				<div class="col-sm-12">
					<h4>Related products</h4>
				</div>
			</div>

			<div class="row ls-accordeon-container">
				<div class="ls-accordeon-container-content col-sm-12">
					<div class="row">
						<div class="col-sm-12">sdf</div>
					</div>
				</div>
			</div>
		</li>

	</ul>
			




	</div>
</div>





<?php get_footer(); ?>