<?php

// Get the contact page_id, the contact page contains al fields for address etc.
$contact_page_id = get_option('lab_services_contact_page');


// Load the values
$company_name = get_field('company_name',$contact_page_id);
$email_address = get_field('email_address',$contact_page_id);
$telephone_number = get_field('telephone_number',$contact_page_id);
$fax_number = get_field('fax_number',$contact_page_id);

// Contact post
$postal_address = get_field('postal_address',$contact_page_id);
$postal_zipcode = get_field('postal_zipcode',$contact_page_id);
$postal_city = get_field('postal_city',$contact_page_id);
$postal_country = get_field('postal_country',$contact_page_id);

// Contact visitor
$visitors_address = get_field('visitors_address',$contact_page_id);
$visitors_zipcode = get_field('visitors_zipcode',$contact_page_id);
$visitors_city = get_field('visitors_city',$contact_page_id);
$visitors_country = get_field('visitors_country',$contact_page_id);

// Social media
$facebook_user = get_field('social_facebook_user',$contact_page_id);
$twitter_user = get_field('social_twitter_user',$contact_page_id);

?>
	<div class="row section footer">
		<div class="col-sm-12 ">
			<div class="row">
				<div class="col-xs-12 visible-xs">
					<div class="contact_general contact_block footer-logo-container">
						<div class="pointer pointer-labservices"></div>
					</div>
				</div>
				<div class="col-sm-4  col-md-3">
					<ul class="contact_general contact_block">
						<?php

						if ($company_name) { echo get_contact_row($company_name, false, true); };
						if ($email_address) { echo get_contact_row($email_address, 'mailto:'.$email_address); };
						if ($telephone_number) { echo get_contact_row($telephone_number); };
						if ($fax_number) { echo get_contact_row($fax_number); };

						?>
					</ul>
				</div>
				<div class="col-sm-4 col-md-2">
					<ul class="contact_general contact_block">
						<?php

						echo get_contact_row(__( 'Postal address', 'bonestheme' ), false, true);
						if ($postal_address) { echo get_contact_row($postal_address); };
						if ($postal_zipcode) { echo get_contact_row($postal_zipcode." ".$postal_city); };
						if ($postal_country) { echo get_contact_row($postal_country); };

						?>
					</ul>
				</div>
				<div class="col-sm-4 col-md-3 ">
					<ul class="contact_general contact_block">
						<?php

						echo get_contact_row(__( 'Visitors address', 'bonestheme' ), false, true);
						if ($visitors_address) { echo get_contact_row($visitors_address); };
						if ($visitors_zipcode) { echo get_contact_row($visitors_zipcode." ".$visitors_city); };
						if ($visitors_country) { echo get_contact_row($visitors_country); };

						?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-xs-3 social_channels_container">
					<ul class="social_channels">
						<li><a href="https://www.facebook.com/<?php echo $facebook_user; ?>" target="_BLANK"><div class="icon facebook"></div></a></li>
						<li><a href="https://twitter.com/<?php echo $twitter_user; ?>" target="_BLANK"><div class="icon twitter"></div></a></li>


					</ul>
				</div>
			</div>

		</div>
	</div>



</div>

</div>

<?php wp_footer(); ?>

</body>

</html>
