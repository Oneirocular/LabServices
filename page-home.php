<?php
/*
Template Name: Home
*/

get_header(); 

/*echo _e( 'home', 'bonestheme' );*/

?>



<!-- Home Slider -->
<div class="row section main-slider background-dark">
	<div class="col-sm-12">
	<?php
    if( get_field('main_slider') )
    {
    	$slides = array();
        while( has_sub_field('main_slider') )
        { 

        	// Prepare variables
        	$slide_image_object = get_sub_field('image');
        	$slide_image = $slide_image_object['sizes']['main-slider'];   
        	$slide_text = get_sub_field('content');
        	$slide_link_object = get_sub_field('link');
        	$slide_link_url = false;

        	if (is_object($slide_link_object)) {
        		$slide_link_url = get_permalink($slide_link_object->ID);
        	}

        	$slide_html = '';
        	if ($slide_text != '') {


	        	// Prepare html
	        	$slide_html .= '<div class="text_frame">';
	        	$slide_html .= $slide_text;
	        	
	        	if ($slide_link_url) {
	        		$slide_html .= '<a href="'.$slide_link_url.'" class="slide_link"></a>';
	        	}	
	        	$slide_html .= '</div>';
        	}
        	$slide_html .= '<img src="'.$slide_image.'"/>';



        	$slides[] = $slide_html;

        		
        

        }

        show_ls_carousel($slides);

    }


    ?>



	</div>
</div>


<!-- Home Columns -->
<div class="row section background-light">

	<!-- Home content fields -->
	<?
	if( get_field('text_blocks') )
	{
		$counter = 0;
		while( has_sub_field('text_blocks') )
		{ 

			$field_label = get_sub_field('label');
			$field_title = get_sub_field('title');
			$field_text = get_sub_field('text');
			$field_button_text = get_sub_field('button');
			$field_button_target = get_sub_field('target');

	 		$pointer_icon = "pointer-products";

	 		if ($counter == 1) {
	 			$pointer_icon = "pointer-services";
	 		}
			// generate the html
			?>

			<div class="text-container-small col-xs-12 col-md-4 clearfix">
				<div class="row">
					<div class="container-icon col-xs-12 col-sm-1 col-md-2">
						<div class="pointer <?php echo $pointer_icon; ?>"></div>
					</div>
					<div class="container-body col-xs-12 col-sm-11 col-md-10">

						<span class="container-category"><h5><? echo $field_label ?></h5></span>
						<h3><? echo $field_title; ?></h3>
						<? echo $field_text; ?>

						<a class="btn btn-arrow btn-sm" href="<?php echo $field_button_target; ?>" role="button"><? echo $field_button_text; ?></a>

					</div>
				</div>
			</div>

			<?
			$counter++;
		}
	}


	

	?>


	<div class=" col-xs-12 col-md-4" >

		<div class="row">
			<div class="col-xs-12 col-md-11  social_feeds" >
					<div class="box clearfix">
						<h5>lab feeds</h5>

						<div id="social_carousel" class="social-feeds-carousel carousel slide" data-ride="social-feeds-carousel">
							<div class="carousel-inner lab-feeds">				
								<?php echo get_labfacts(); ?>
							</div>			
							<ol class="carousel-indicators">		
								<?php echo get_labfacts_indicators(); ?>		
							
							</ol>			
							<a class="left carousel-control" href="#social_carousel" data-slide="prev"><div class="icon_arrow"></div></a>			
							<a class="right carousel-control" href="#social_carousel" data-slide="next"><div class="icon_arrow"></div></a>		
						</div>

					</div>
			</div>
		</div>

	</div>
</div>


			<!-- <div id="content">

				<div id="inner-content" class="wrap clearfix">

						<div id="main" class="eightcol first clearfix" role="main">

							<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

							<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?> role="article" itemscope itemtype="http://schema.org/BlogPosting">

								<header class="article-header">

									<h1 class="page-title"><?php the_title(); ?></h1>
									<p class="byline vcard"><?php
										printf( __( 'Posted <time class="updated" datetime="%1$s" pubdate>%2$s</time> by <span class="author">%3$s</span>.', 'bonestheme' ), get_the_time( 'Y-m-j' ), get_the_time( __( 'F jS, Y', 'bonestheme' ) ), bones_get_the_author_posts_link() );
									?></p>


								</header>

								<section class="entry-content clearfix" itemprop="articleBody">
									<?php the_content(); ?>
								</section>

								<footer class="article-footer">
									<p class="clearfix"><?php the_tags( '<span class="tags">' . __( 'Tags:', 'bonestheme' ) . '</span> ', ', ', '' ); ?></p>

								</footer>

								<?php comments_template(); ?>

							</article>

							<?php endwhile; else : ?>

									<article id="post-not-found" class="hentry clearfix">
											<header class="article-header">
												<h1><?php _e( 'Oops, Post Not Found!', 'bonestheme' ); ?></h1>
										</header>
											<section class="entry-content">
												<p><?php _e( 'Uh Oh. Something is missing. Try double checking things.', 'bonestheme' ); ?></p>
										</section>
										<footer class="article-footer">
												<p><?php _e( 'This is the error message in the page-custom.php template.', 'bonestheme' ); ?></p>
										</footer>
									</article>

							<?php endif; ?>

						</div>

						<?php get_sidebar(); ?>

				</div>

			</div>
 -->
<?php get_footer(); ?>
