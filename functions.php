<?php
/*
Author: Eddie Machado 
URL: htp://themble.com/bones/

This is where you can drop your custom functions or
just edit things like thumbnail sizes, header images,
sidebars, comments, ect.
*/

/************* INCLUDE NEEDED FILES ***************/

/*
1. library/bones.php
	- head cleanup (remove rsd, uri links, junk css, ect)
	- enqueueing scripts & styles
	- theme support functions
	- custom menu output & fallbacks
	- related post function
	- page-navi function
	- removing <p> from around images
	- customizing the post excerpt
	- custom google+ integration
	- adding custom fields to user profiles
*/
require_once( 'library/bones.php' ); // if you remove this, bones will break
/*
2. library/custom-post-type.php
	- an example custom post type
	- example custom taxonomy (like categories)
	- example custom taxonomy (like tags)
*/
//require_once( 'library/custom-post-type.php' ); // you can disable this if you like
/*
3. library/admin.php
	- removing some default WordPress dashboard widgets
	- an example custom dashboard widget
	- adding custom login css
	- changing text in footer of admin
*/
// require_once( 'library/admin.php' ); // this comes turned off by default
/*
4. library/translation/translation.php
	- adding support for other languages
*/
 require_once( 'library/translation/translation.php' ); // this comes turned off by default

/************* THUMBNAIL SIZE OPTIONS *************/

// Thumbnail sizes
add_image_size( 'bones-thumb-600', 600, 150, true );
add_image_size( 'bones-thumb-300', 300, 100, true );



/*
to add more sizes, simply copy a line from above
and change the dimensions & name. As long as you
upload a "featured image" as large as the biggest
set width or height, all the other sizes will be
auto-cropped.

To call a different size, simply change the text
inside the thumbnail function.

For example, to call the 300 x 300 sized image,
we would use the function:
<?php the_post_thumbnail( 'bones-thumb-300' ); ?>
for the 600 x 100 image:
<?php the_post_thumbnail( 'bones-thumb-600' ); ?>

You can change the names and dimensions to whatever
you like. Enjoy!
*/

add_filter( 'image_size_names_choose', 'bones_custom_image_sizes' );

function bones_custom_image_sizes( $sizes ) {
    return array_merge( $sizes, array(

        'bones-thumb-600' => __('600px by 150px'),
        'bones-thumb-300' => __('300px by 100px'),
    ) );
}

/*
The function above adds the ability to use the dropdown menu to select 
the new images sizes you have just created from within the media manager 
when you add media to your content blocks. If you add more image sizes, 
duplicate one of the lines in the array and name it according to your 
new image size.
*/

/************* ACTIVE SIDEBARS ********************/

// Sidebars & Widgetizes Areas
function bones_register_sidebars() {
	register_sidebar(array(
		'id' => 'sidebar1',
		'name' => __( 'Sidebar 1', 'bonestheme' ),
		'description' => __( 'The first (primary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	/*
	to add more sidebars or widgetized areas, just copy
	and edit the above sidebar code. In order to call
	your new sidebar just use the following code:

	Just change the name to whatever your new
	sidebar's id is, for example:

	register_sidebar(array(
		'id' => 'sidebar2',
		'name' => __( 'Sidebar 2', 'bonestheme' ),
		'description' => __( 'The second (secondary) sidebar.', 'bonestheme' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="widgettitle">',
		'after_title' => '</h4>',
	));

	To call the sidebar in your template, you can just copy
	the sidebar.php file and rename it to your sidebar's name.
	So using the above example, it would be:
	sidebar-sidebar2.php

	*/
} // don't remove this bracket!

/************* COMMENT LAYOUT *********************/

// Comment Layout
function bones_comments( $comment, $args, $depth ) {
   $GLOBALS['comment'] = $comment; ?>
	<li <?php comment_class(); ?>>
		<article id="comment-<?php comment_ID(); ?>" class="clearfix">
			<header class="comment-author vcard">
				<?php
				/*
					this is the new responsive optimized comment image. It used the new HTML5 data-attribute to display comment gravatars on larger screens only. What this means is that on larger posts, mobile sites don't have a ton of requests for comment images. This makes load time incredibly fast! If you'd like to change it back, just replace it with the regular wordpress gravatar call:
					echo get_avatar($comment,$size='32',$default='<path_to_url>' );
				*/
				?>
				<?php // custom gravatar call ?>
				<?php
					// create variable
					$bgauthemail = get_comment_author_email();
				?>
				<img data-gravatar="http://www.gravatar.com/avatar/<?php echo md5( $bgauthemail ); ?>?s=32" class="load-gravatar avatar avatar-48 photo" height="32" width="32" src="<?php echo get_template_directory_uri(); ?>/library/images/nothing.gif" />
				<?php // end custom gravatar call ?>
				<?php printf(__( '<cite class="fn">%s</cite>', 'bonestheme' ), get_comment_author_link()) ?>
				<time datetime="<?php echo comment_time('Y-m-j'); ?>"><a href="<?php echo htmlspecialchars( get_comment_link( $comment->comment_ID ) ) ?>"><?php comment_time(__( 'F jS, Y', 'bonestheme' )); ?> </a></time>
				<?php edit_comment_link(__( '(Edit)', 'bonestheme' ),'  ','') ?>
			</header>
			<?php if ($comment->comment_approved == '0') : ?>
				<div class="alert alert-info">
					<p><?php _e( 'Your comment is awaiting moderation.', 'bonestheme' ) ?></p>
				</div>
			<?php endif; ?>
			<section class="comment_content clearfix">
				<?php comment_text() ?>
			</section>
			<?php comment_reply_link(array_merge( $args, array('depth' => $depth, 'max_depth' => $args['max_depth']))) ?>
		</article>
	<?php // </li> is added by WordPress automatically ?>
<?php
} // don't remove this bracket!

/************* SEARCH FORM LAYOUT *****************/

// Search Form
function bones_wpsearch($form) {
	$form = '<form role="search" method="get" id="searchform" action="' . home_url( '/' ) . '" >
	<label class="screen-reader-text" for="s">' . __( 'Search for:', 'bonestheme' ) . '</label>
	<input type="text" value="' . get_search_query() . '" name="s" id="s" placeholder="' . esc_attr__( 'Search the Site...', 'bonestheme' ) . '" />
	<input type="submit" id="searchsubmit" value="' . esc_attr__( 'Search' ) .'" />
	</form>';
	return $form;
} // don't remove this bracket!


	function get_contact_row($value, $link = false, $strong = false) {

			if ($strong) {
				$the_value = "<strong>".$value."</strong>";
			} else {
				$the_value = $value;
			}


			if (!$link) {
				return "<li>".$the_value."</li>";
			} else {
				return "<li><a href=".$link.">".$the_value."</a></li>";
			}
		
		}



/* Ls custom gravity forms submit button */
add_filter("gform_submit_button", "form_submit_button", 10, 2);

function form_submit_button($button, $form){
	return '<a class="btn button btn-arrow btn-sm" id="gform_submit_button_'.$form["id"].'" href="#" onclick="document.getElementById(\'gform_'.$form['id'].'\').submit();" role="button">'.$form['button']['text'].'</a>';
}




	add_action( 'wp_ajax_nopriv_get_maps_marker', 'get_maps_marker');
	add_action( 'wp_ajax_get_maps_marker', 		  'get_maps_marker' );
	/*GET markers from all non filled vacatures*/
	function get_maps_marker(){


		$post_id = $_GET['post_id'];

		echo json_encode(get_field('office_location', $post_id));

		exit();

	}



/* VIEWS */

function get_ls_product_container($ls_product) {

	$product_title = $ls_product->post_title;
	$product_description_excerpt = wp_trim_words( $ls_product->post_content , $num_words = 5, $more = null ); 
	$product_permalink = get_permalink( $ls_product->ID );	

	$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $ls_product->ID ), 'product-image-cropped' );



	 $html = '<a href="'.$product_permalink.'">';
	 $html .= '	<div class="main-product-container background-light">';
	 $html .= '		<div class="product-thumbnail"><img src="'.$product_image[0].'"/></div>';
	 $html .= '		<div class="inside">';
	 $html .= '			<div class="product-title"><strong>'.$product_title.'</strong></div>';
	 $html .= '			<p>'.$product_description_excerpt.'</p>';
	 $html .= '			<a class="btn btn-arrow btn-sm" href="'.$product_permalink.'" role="button">'.__( 'view product', 'bonestheme' ).'</a>';
	 $html .= '		</div>';
	 $html .= '	</div>';
	 $html .= '</a>';

	 return $html;
		
}



function get_distribute_product_container($distribute_product) {

	$product_title = $distribute_product->post_title;
	$product_description_excerpt = wp_trim_words( $distribute_product->post_content , $num_words = 5, $more = null ); 
	$product_permalink = get_permalink( $distribute_product->ID );	

	$product_image = wp_get_attachment_image_src( get_post_thumbnail_id( $distribute_product->ID ), 'product-image-cropped' );

	$html = '<a href="'.$product_permalink.'">';
	$html .= '<div class="product-container col-xs-12 col-sm-3 col-lg-2">';
	$html .= '	<div class="row">';
	$html .= '		<div class="col-xs-4 col-sm-12">';
	$html .= '			<div class="thumbnail-container"><div class="product-thumbnail"><img src="'.$product_image[0].'"/></div></div>';
	$html .= '		</div>';
	//$html .= '	<div class="thumbnail-container col-sm-12"><div class="product-thumbnail"><img src="'.$product_image[0].'"/></div></div>';

	//$html .= '	<div class="product-thumbnail"><img src="'.$product_image[0].'"/></div>';
	$html .= '		<div class="col-xs-8 col-sm-12" >';
	$html .= '			<div class="inside "><div class="product-title">'.$product_title.'</div><a class="btn btn-arrow btn-sm" href="'.$product_permalink.'" role="button">'.__( 'view product', 'bonestheme' ).'</a></div>';
	$html .= '		</div>';
	$html .= '	</div>';
	$html .= '</div>';
	$html .= '</a>';

	return $html;		
}


function show_ls_product_carousel($products_array, $nr_of_visible = 4) {

	$counter = 0;
	$last_run = false;
	$slides = array();
	$nr_of_products = count($products_array);

	for ($i=1; $i <= $nr_of_products; $i++) { 

		if ($i == $nr_of_products) {
			$last_run = true;
		}

		$counter++;
		if ($counter == 1) {
			$html = '<div class="row">';
		}

		$html .= '<div class="main-product-frame col-sm-'.(12/$nr_of_visible).' ">';
		$html .= $products_array[$i-1];
		$html .= '</div>';

		if ($counter == $nr_of_visible || $last_run) {
			$html .= '</div>';

			$slides[] = $html;
			$counter = 0;
		}
	}


	echo ls_carousel($slides);


}

function show_ls_carousel($slides) {
	echo ls_carousel($slides);
}

function ls_carousel($slides) {

	$nr_of_slides = count($slides);

	if ($nr_of_slides > 1) {

			$html = '';

		  	$html .= '		<div id="myCarousel" class="carousel slide" data-ride="carousel">';
		  	$html .= '			<div class="carousel-inner">';

		  	foreach ($slides as $slide) {

		  		if (!isset($state)) {
		            $state = "active";
		        } else {
		            $state = '';
		        }

		    	$html .= '				<div class="item '.$state.'">';
		        $html .= '					'.$slide;
		        $html .= '				</div>';
		  	}

		  	$html .= '			</div>';


		  	// Only show indicator when there's more than 1 slide


		  	// Indicator
		    $html .= '			<ol class="carousel-indicators">';

		    for ($i=0; $i < $nr_of_slides; $i++) {
		    	$html .= '				<li data-target="#myCarousel" data-slide-to="'.$i.'"></li>';
		    }

		    $html .= '			</ol>';

		  	// Controls
		  	$html .= '			<a class="left carousel-control" href="#myCarousel" data-slide="prev"><div class="icon_arrow"></div></a>';
		    $html .= '			<a class="right carousel-control" href="#myCarousel" data-slide="next"><div class="icon_arrow"></div></a>';



		  	$html .= '		</div>';
	
	} else {
			$html = $slides[0];
	}

  	return $html;

  

}

// Shows a string when a specific variable is set
function show_if_exists($variable, $value = false) {

	if (!$value) {
		$value = $variable;
	}

	if (isset($variable)) {
		echo $value;
	}
}


add_action( 'admin_menu', 'my_remove_menu_pages' );

function my_remove_menu_pages() {

	remove_menu_page('edit.php');
	remove_menu_page('edit-comments.php');

	if ( current_user_can( 'manage_options' ) ) {
    	/* A user with admin privileges */
	} else {
		/* A user without admin privileges */
		remove_menu_page('tools.php');
     	remove_menu_page('widgets.php');

     	/* Customize themes menu */
     	remove_submenu_page( 'themes.php', 'themes.php' );
     	remove_submenu_page( 'themes.php', 'customize.php' );
     	remove_submenu_page( 'themes.php', 'widgets.php' );
     	remove_submenu_page( 'themes.php', 'themes.php?page=custom-background' );



	}

    // remove_menu_page('link-manager.php');
    // remove_menu_page('tools.php');

}

function edit_editor_capabilities(){
    $role = get_role('editor');


    $role->add_cap('gform_full_access');
    // add $cap capability to this role object
	$role->add_cap( 'edit_theme_options' );
}
add_action('admin_init','edit_editor_capabilities');




// Add custom post types under a page menu thing
add_filter('nav_menu_css_class', 'current_type_nav_class', 10, 2 );
function current_type_nav_class($classes, $item) {

    // # get Query Vars
    $post_type = get_post_type();  

    // # get and parse Title attribute of Menu item
    $xfn = $item->xfn; // menu item Title attribute, as post_type;taxonomy
    $xfn_array = explode(";", $xfn);

    // # add class if needed
    if (in_array($post_type, $xfn_array)) {
    	 array_push($classes, 'current-menu-item');
    }

     return $classes;
}




		// Options page
		add_action('admin_menu', 'ls_register_options_page');
		add_action( 'admin_init', 'ls_register_settings');





	function ls_register_options_page() {
		add_options_page('Lab Services options', 'Lab Services options', 'manage_options', 'ls-options', 'ls_options_page');
	}


	function ls_register_settings() {
		add_option( 'lab_services_product_categorie');
		register_setting( 'ls-options', 'lab_services_product_categorie' ); 

		add_option( 'ls_distribution_product_category');
		register_setting( 'ls-options', 'ls_distribution_product_category' ); 

		add_option( 'lab_services_contact_page');
		register_setting( 'ls-options', 'lab_services_contact_page' ); 

		add_option( 'lab_services_services_page');
		register_setting( 'ls-options', 'lab_services_services_page' ); 
	} 


	function ls_options_page() {
		?>
		<div class="wrap">
			<?php screen_icon(); ?>
			<h2>Lab Services options</h2>
			<form method="post" action="options.php"> 
				<?php settings_fields( 'ls-options' ); ?>
				<!-- <h3>Optional section title</h3> -->
				<p>Here some Lab Services specific options are set.</p>
				<!-- Form tables go here -->
				<table class="form-table">
											<tr valign="top">
						<th scope="row"><label for="lab_services_services_page">Lab Services services page:</label></th>
						<td>
						<?php 
							$args = array(
									'id'=>'lab_services_services_page',
									'name'=>'lab_services_services_page',
									'selected'=>get_option('lab_services_services_page'),
									'show_count'=>1,
									'hierarchical'=>1
								);
								
							wp_dropdown_pages($args); 

						?>
					</td>
					</tr>
						<tr valign="top">
						<th scope="row"><label for="lab_services_contact_page">Lab Services contact page:</label></th>
						<td>
						<?php 
							$args = array(
									'id'=>'lab_services_contact_page',
									'name'=>'lab_services_contact_page',
									'selected'=>get_option('lab_services_contact_page'),
									'show_count'=>1,
									'hierarchical'=>1
								);
								
							wp_dropdown_pages($args); 

						?>
					</td>
					</tr>
					<tr valign="top">
						<th scope="row"><label for="lab_services_product_categorie">Lab Services products category:</label></th>
						<td>
						<?php 
							$args = array(
									'id'=>'lab_services_product_categorie',
									'name'=>'lab_services_product_categorie',
									'selected'=>get_option('lab_services_product_categorie'),
									'show_count'=>1,
									'hierarchical'=>1,
									'taxonomy'=>'product_categories'
								);
								
							wp_dropdown_categories($args); 

						?>
					</td>
					</tr>

					<tr valign="top">
						<th scope="row"><label for="ls_distribution_product_category">Distribution product category:</label></th>
						<td>
						<?php 
							$args = array(
									'id'=>'ls_distribution_product_category',
									'name'=>'ls_distribution_product_category',
									'selected'=>get_option('ls_distribution_product_category'),
									'show_count'=>1,
									'hierarchical'=>1,
									'taxonomy'=>'product_categories'
								);
								
							wp_dropdown_categories($args); 

						?>
					</td>
					</tr>
				</table>
				<?php submit_button(); ?>
			</form>
		</div>
		<?php
	}



	function get_facebook_feed() {
				$ch = curl_init(); //Set curl to return the data instead of printing it to the browser. 
		curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); //Set the URL 
		curl_setopt($ch, CURLOPT_URL, 'http://www.facebook.com/feeds/page.php?id=295948050437680&format=rss20'); //Execute the fetch 
		$feed_string = curl_exec($ch); //Close the connection 
		curl_close($ch);
		$feed = simplexml_load_string($feed_string);

			foreach($feed->xpath('//item') as $item)
				{
					if(empty($item->title) || $item->title == ' ') continue;
					echo '<li><a href="'.(string)$item->link.'" title="'.(string)$item->title.'" target="_blank"><span>'.(string)$item->title.'</span></a><span class="arrow"></span></li>';
				}
	}








	/* Gravity form functions */
	add_filter("gform_validation_message", "gf_validation_message", 10, 2); 
	function gf_validation_message($message, $form){

		$message_title = __("The form could not be sent.", "projectmine");
		$message_body = __("Errors have been highlighted below", "projectmine");


		$html = "<div class=\"validation_error\">";

		$html .= "<strong>".$message_title."</strong>";
		$html .= "<p>".$message_body."</p>";

		$html .= "</div>";

		return $html;

	}

	/* Gravity forms service connection */
	add_filter("gform_field_value_gf_message", "gf_populate_message");
	function gf_populate_message($value){

		// If information is set
		if (isset($_GET['subject'])=="information") {

			/* Get service details */
			$services_page_id = get_option('lab_services_services_page');
			$service_options = get_field('text_blocks', $services_page_id);

			/* Message preset */
			$message = __("Information about", "bonestheme").": (services) ".$service_options[$_GET['service_id']]['label']."\n\n";
			return $message;
			
		}

	}



?>
