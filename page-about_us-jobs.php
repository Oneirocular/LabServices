
<?php 

	$args = array(
		'numberposts' => -1,
		'order' => 'ASC',
		'post_status' => 'publish',
		'post_parent' => $child_page_id
	);

	$jobs = get_children( $args );

?>


<div class="col-sm-7 jobs">
			

<?php

	foreach ($jobs as $job_id => $job) {
		
		$job_id = $job->ID;
		$job_title = $job->post_title;
		$job_description =  wp_trim_words( $job->post_content , $num_words = 20, $more = null ); 
		$job_permalink = get_permalink( $job_id );	


	?>
		<div class="row">
			<div class="col-sm-9">
				<h4><?php echo $job_title; ?></h4>
				<?php echo $job_description; ?>
			</div>
			<div class="col-sm-2"><a class="btn btn-arrow btn-sm" href="<?php echo $job_permalink; ?>" role="button">view job</a></div>
		</div>

	<?php
	}


?>
			

</div>