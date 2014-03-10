<?php
/*
Template Name: About Us
*/
?>

<?php get_header(); ?>

<?


	$args = array(
		'numberposts' => -1,
		'order' => 'ASC',
		'post_status' => 'publish',
		'orderby' => 'menu_order',
		'post_parent' => $post->ID
	);

	$child_pages = get_children( $args );

?>


<!-- About us header -->
<div class="row sub-section background-dark">
	<div class="col-sm-12">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

			<div class="row">

				<!-- Page Title -->
				<div class="col-sm-2">
					<h3><?php the_title(); ?></h3>
				</div>

				<?php if (count($child_pages) > 1) { ?>
				<!-- Sub Navigation -->
				<div class="col-sm-10">
					<nav class="sub-navigation" role="navigation">
						<ul id="menu-sub-menu" class="sub-nav clearfix">
							<?php foreach ($child_pages as $child_page_id => $child_page_object) { ?>
								<li class="menu-item"><a href="#<?php echo $child_page_object->post_title; ?>"><?php echo $child_page_object->post_title; ?></a></li>
							<?php } ?>
						</ul>					
					</nav>
				</div>
				<?php } ?>
			</div>

			<!-- Heading Content -->
			<div class="row">
				<div class="col-sm-6">
					<?php the_content(); ?>
				</div>
			</div>


		<?php endwhile; endif; ?>

	</div>


</div>







<!-- <div class="col-sm-12">
		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

	
		<div class="row">
			<div class="col-sm-2">
				<h3><?php the_title(); ?></h3>
			</div>
			<div class="col-sm-10">
				<nav class="sub-navigation" role="navigation">
					<ul id="menu-sub-menu" class="sub-nav clearfix">
						<li id="" class="menu-item"><a href="http://10.0.1.7/labservices/eng/home/">Home</a></li>
						<li id="" class="menu-item"><a href="http://10.0.1.7/labservices/eng/products/">Products</a></li>
						<li id="" class="menu-item"><a href="http://10.0.1.7/labservices/eng/services/">Our services</a></li>
						<li id="" class="menu-item"><a href="http://10.0.1.7/labservices/eng/about-us/">About us</a></li>
						<li id="" class="menu-item"><a href="http://10.0.1.7/labservices/eng/contact/">Contact</a></li>
					</ul>					
				</nav>
				</div> 
			</div>
		</div>
		<div class="row">
			<div class="col-sm-6">
				<?php the_content(); ?>
			</div>
		</div>
	</div>

		<?php endwhile; endif; ?>

</div> -->




<?

$background_types = array("background-dark","background-light");

$i = 0;

// Walk through the child pages
foreach ($child_pages as $child_page_id => $child_page_object) {

	$child_page_label = $child_page_object->post_title;
	$child_page_slug = get_field('page_slug', $child_page_id);
	$child_page_text = $child_page_object->post_content;
	// $field_button_text = get_sub_field('button');

	// gets the background_class based on odd/even of the section
	$background_class = $background_types[($i % 2)];

	// generate html
	?>
		<!--  -->
		<a name="<?php echo $child_page_label; ?>"></a>
		<div class="row section <? echo $background_class; ?>">

			<div class="col-sm-12">
				
					<?php
					// Get the right page content
					if ($child_page_slug == "references") {
						include(locate_template('page-about_us-rows.php')); // because get_template_part doesn;t send vars
					} else if ($child_page_slug == "vision") {
						include(locate_template('page-about_us-vision.php')); // because get_template_part doesn;t send vars
					} else if ($child_page_slug == "team") {
						include(locate_template('page-about_us-team.php')); // because get_template_part doesn;t send vars
					} else if ($child_page_slug == "jobs") {
						include(locate_template('page-about_us-jobs.php')); // because get_template_part doesn;t send vars
					}
					?>

			</div>


		</div>
	<?
	$i++;

}



?>


		
<?php get_footer(); ?>
