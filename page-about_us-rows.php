

<div class="col-sm-12">

<?php

if( get_field('text_rows', $child_page_object->ID) )
	{

		$j = 0;

		while( has_sub_field('text_rows', $child_page_object->ID) )
		{ 

			$field_label = get_sub_field('label', $child_page_object->ID);
			$field_title = get_sub_field('title', $child_page_object->ID);
			$field_text = get_sub_field('text', $child_page_object->ID);
			$field_image = get_sub_field('image', $child_page_object->ID);

			// generate the html
			// Check if this row needs to be mirrored
			if ($j % 2 == 0) {
				$mirrored = true;
			} else {
				$mirrored = false;
			}
			?>

			<!-- Reference row -->
			<div class="row">
				<div class="col-md-12">
					<span class="category"><h5><? echo $field_label; ?></h5></span>
				</div>

				<?php if ($mirrored) { ?>
				<div class="col-md-6 col-image">
				<?php } else { ?>
				<div class="col-md-6 col-md-push-6 col-image">
				<?php } ?>

					<img style="width:100%" src="<? echo $field_image['sizes']['large']; ?>" />
				</div>

				<?php if ($mirrored) { ?>
				<div class="col-md-6">
				<?php } else { ?>
				<div class="col-md-6 col-md-pull-6">
				<?php } ?>
					<h3><? echo $field_title; ?></h3>
					<? echo $field_text; ?>
				</div>
			</div>


			<?

			$j++;
		}

	}
?>

</div>