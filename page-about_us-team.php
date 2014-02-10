

<div class="col-sm-12">
			<div class="row">

<?php

if( get_field('team_members', $child_page_object->ID) )
	{

		$i = 0;

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
					<img style="width:100%" src="<? echo $member_image['sizes']['large']; ?>" />
					<strong><?php echo $member_name; ?></strong>
					<span><?php echo $member_function; ?></span>

					<div class="member-quote">
						<?php echo $member_quote; ?>
					</div>
				</div>


			<?

			$i++;
		}

	}
?>
			</div>

</div>