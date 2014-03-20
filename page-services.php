<?php
/*
Template Name: Services
*/

// Get the form
$page_form_object = get_field('page_form');
$page_form_id = $page_form_object->id;


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

		$counter = 1;
		while( has_sub_field('text_blocks') )
		{ 

			$field_label = get_sub_field('label');
			$field_title = get_sub_field('title');
			$field_text = get_sub_field('text');
			$field_button_text = get_sub_field('button');
	 		$field_button_target = get_sub_field('target');

			// generate the html
			?>

			<div class="text-container-small col-sm-12 col-md-4 clearfix">
				<div class="row">
				<div class="container-icon col-xs-12 col-sm-1 col-md-2">
					<div class="pointer pointer-services-<?php echo $counter; ?>"></div>
				</div>
				<div class="container-body col-xs-12 col-sm-11 col-md-10">

					<span class="container-category"><h5><? echo $field_label ?></h5></span>
					<h3><? echo $field_title; ?></h3>
					<? echo $field_text; ?>

					<a class="btn btn-arrow btn-sm" href="<?php echo $field_button_target; ?>?subject=information&service_id=<?php echo $counter-1;?>" role="button"><? echo $field_button_text; ?></a>

				</div>
				</div>
			</div>

			<?
			$counter++;
		}
	}
	?>

</div>


<!-- Support form -->
<div class="row section background-light">

	<!-- Contact form -->
	<div class="col-sm-12 col-md-6">
		<h1><?php echo get_field('page_form_title'); ?></h1>
		<p><?php echo get_field('page_form_description'); ?></p>
		<?php gravity_form($page_form_id, false, false); ?>
	</div>

	<div class="col-sm-12 col-md-4 col-md-offset-2" >

				<div class="row">
					<div class="col-sm-12 col-md-11 support col-centered">
						<div class="box">
							<h3><?php echo get_field('notice_title'); ?></h3>
							<p><?php echo get_field('notice_text'); ?></p>
		

							</ul>
						</div>
					</div>
				</div>
	
	</div>

</div>
		
<?php get_footer(); ?>
