<?php
/*
Template Name: Services
*/
?>

<?php get_header(); ?>



<!-- Home Slider -->
<div class="row sub-section background-dark">
	<div class="col-sm-12">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<div class="row">
			<div class="col-sm-6">
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
			</div>
		</div>

		<?php endwhile; endif; ?>

	</div>
</div>

<!-- Services Columns -->
<div class="row section background-dark">

	<!-- Home content fields -->
	<?
	if( get_field('text_blocks') )
	{
		while( has_sub_field('text_blocks') )
		{ 

			$field_label = get_sub_field('label');
			$field_title = get_sub_field('title');
			$field_text = get_sub_field('text');
			$field_button_text = get_sub_field('button');
	 
			// generate the html
			?>

			<div class="text-container-small col-sm-4 col-md-4 clearfix">

				<div class="container-icon">
					<div class="pointer pointer-products"></div>
				</div>
				<div class="container-body">

					<span class="container-category"><h5><? echo $field_label ?></h5></span>
					<h3><? echo $field_title; ?></h3>
					<? echo $field_text; ?>

					<a class="btn btn-arrow btn-sm" href="#" role="button"><? echo $field_button_text; ?></a>

				</div>
			</div>

			<?
		}
	}
	?>

</div>


<!-- Support form -->
<div class="row section background-light">

	<div class="col-sm-6">

	form
	
	</div>

	<div class="col-sm-6">

	call
	
	</div>

</div>
		
<?php get_footer(); ?>
