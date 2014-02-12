<?php 

get_header(); 

$page_title = $post->post_title;
$page_content = $post->post_content;

?>


<div class="row section background-dark">
	<div class="col-sm-12">

	<div class="row">
		<div class="col-sm-6">
	
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
			<h1><?php echo $page_title; ?></h1>
			<p><?php echo $page_content; ?></p>
		</div>

	</div>

	</div>
</div>





<?php get_footer(); ?>