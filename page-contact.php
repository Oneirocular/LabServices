<?php
/*
Template Name: Contact
*/

get_header(); 


// Get the form
$page_form_object = get_field('page_form');
$page_form_id = $page_form_object->id;




?>



<div class="row sub-section background-dark">
	<div class="col-sm-12">

		<?php if (have_posts()) : while (have_posts()) : the_post(); ?>


		<div class="row">
			<div class="col-sm-6">
				<h3><?php the_title(); ?></h3>
				<?php the_content(); ?>
			</div>
		</div>

		<?php endwhile; endif; ?>

	</div>
</div>

<!-- Contact Columns -->
<div class="row section background-dark">

	<!-- Contact gegevens -->
	<div class="col-sm-6">
		<?php

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

		// Contact general
		$company_name = get_field('company_name');
		$email_address = get_field('email_address');
		$telephone_number = get_field('telephone_number');
		$fax_number = get_field('fax_number');
		$kvk_number = get_field('kvk_number');
		$registered_office = get_field('registered_office');
		$btw_number = get_field('btw_number');

		// Contact post
		$postal_address = get_field('postal_address');
		$postal_zipcode = get_field('postal_zipcode');
		$postal_city = get_field('postal_city');
		$postal_country = get_field('postal_country');

		// Contact visitor
		$visitors_address = get_field('visitors_address');
		$visitors_zipcode = get_field('visitors_zipcode');
		$visitors_city = get_field('visitors_city');
		$visitors_country = get_field('visitors_country');

		?>
		<ul class="contact_general contact_block">
		<?php
		
			if ($company_name) { echo get_contact_row($company_name, false, true); };
			if ($email_address) { echo get_contact_row($email_address, 'mailto:'.$email_address); };
			if ($telephone_number) { echo get_contact_row($telephone_number); };
			if ($fax_number) { echo get_contact_row($fax_number); };

		?>
		</ul>

		<ul class="contact_block">
		<?php

			echo get_contact_row("Postal address", false, true);
			if ($postal_address) { echo get_contact_row($postal_address); };
			if ($postal_zipcode) { echo get_contact_row($postal_zipcode); };
			if ($postal_city) { echo get_contact_row($postal_city); };
			if ($postal_country) { echo get_contact_row($postal_country); };

		?>
		</ul>

		<ul class="contact_block">
		<?php
			
			echo get_contact_row("Visitors address", false, true);
			if ($visitors_address) { echo get_contact_row($visitors_address); };
			if ($visitors_zipcode) { echo get_contact_row($visitors_zipcode); };
			if ($visitors_city) { echo get_contact_row($visitors_city); };
			if ($visitors_country) { echo get_contact_row($visitors_country); };

		?>
		</ul>

		<ul class="contact_block">
		<?php
			
			if ($kvk_number) { echo get_contact_row("KvK. nr. ".$kvk_number); };
			if ($registered_office) { echo get_contact_row("Statuaire zetel: ".$registered_office); };
			if ($btw_number) { echo get_contact_row("BTW nr. ".$btw_number); };

		?>
		</ul>
	</div>

	<!-- Contact form -->
	<div class="col-sm-6">
		<?php gravity_form($page_form_id); ?>
	</div>

</div>


<!-- Map -->
<div class="row section map background-light">

	<div class="col-sm-12">


                <div  id='map-canvas'>
                    
                </div>
 
	
	</div>



</div>
		
<?php get_footer(); ?>
