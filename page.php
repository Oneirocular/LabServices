<?php 

get_header(); 

$page_title = $post->post_title;
$page_content = $post->post_content;


// get the parent
if (isset($post->post_parent)) {
	$parent_post = get_post($post->post_parent);
}

$hide_next_section = false;


?>

<div class="row section background-dark">
	<div class="col-sm-12">

	<div class="row">
		<div class="col-sm-6">
			<?php 

				if ($parent_post->post_content != '') {
					
					show_if_exists($parent_post->post_content, '<h5>'.$parent_post->post_content.'</h5>');
					
				} else {

					echo "<h1>".$page_title."</h1>";
					echo "<p>".$page_content."</p>";

					$hide_next_section = true;
				}

			?>
		</div>

	</div>

	</div>
</div>

<?php
if (!$hide_next_section) {
?>
<!-- Home Columns -->
<div class="row section background-light">
	<div class="col-sm-12">


	<!-- Body -->
	<div class="row">
		<div class="col-sm-6">
			<h1><?php echo $page_title; ?></h1>
			<p><?php echo $page_content; ?></p>
		</div>

	</div>

	</div>
</div>


<?php
}
?>



<?php get_footer(); ?>