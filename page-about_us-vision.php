
<div class="row">
<div class="col-sm-6">
	<span class="category"><h5><? echo $child_page_label; ?></h5></span>
	<? echo $child_page_text; ?>
</div>

<div class="col-sm-6 col-image image-align-right">
<?php

$nr_of_images = count(get_field('side_slider', $child_page_object->ID));
$image_size = "side-image-cropped";

// Check if there is more than one image
if( $nr_of_images > 1 )
{

	echo "<div id=\"myCarousel\" class=\"carousel slide \" data-ride=\"carousel\">";
	echo "	<div class=\"carousel-inner\">";	

	$active = true;
	while( has_sub_field('side_slider', $child_page_object->ID) )
	{ 
		$image_object = get_sub_field('image', $child_page_object->ID);
		$image_url = $image_object['sizes'][$image_size];

		if ($active) {
			echo "		<div class=\"item active\"><img src=\"".$image_object['sizes'][$image_size]."\" ></div>";				
		} else {
			echo "		<div class=\"item\"><img src=\"".$image_object['sizes'][$image_size]."\" ></div>";				
		}

		$active = false;
		
	}

	echo "	</div>";
	echo "</div>";

// Only one image
} else if ( $nr_of_images == 1 ) {
	
	$image_object = get_field('side_slider', $child_page_object->ID);
	echo "<img src=\"".$image_object[0]['image']['sizes'][$image_size]."\" >";

} 
?>
</div>
</div>