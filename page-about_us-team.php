
<div class="row">
	<div class="col-sm-6">
		<span class="category"><h5><? echo $child_page_label; ?></h5></span>
		<? echo $child_page_text; ?>
	</div>
</div>
<div class="row">

<div class="col-sm-12 team-members">
			<div class="row">

<?php

if( get_field('team_members', $child_page_object->ID) )
	{

		$j = 0;

		while( has_sub_field('team_members', $child_page_object->ID) )
		{ 

			$member_name = get_sub_field('name', $child_page_object->ID);
			$member_function = get_sub_field('function', $child_page_object->ID);
			$member_image = get_sub_field('image', $child_page_object->ID);
			$member_quote = get_sub_field('quote', $child_page_object->ID);

			// generate the html
			?>

			<!-- Reference row -->
				<div class="col-md-2">
					<div class="image-container">
						<img src="<? echo $member_image['sizes']['team-image-cropped']; ?>" />
					</div>
					<div class="inside">
						<strong><?php echo $member_name; ?></strong>
						<span><?php echo $member_function; ?></span>
					</div>

					<div class="member-quote">
						<?php echo $member_quote; ?>
					</div>
				</div>


			<?

			$j++;
		}

	}
?>
			</div>

</div>
</div>