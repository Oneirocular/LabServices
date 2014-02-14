<?php

$company_name = get_field('company_name',1264);
$email_address = get_field('email_address',1264);
$telephone_number = get_field('telephone_number',1264);
$fax_number = get_field('fax_number',1264);


	// Contact post
$postal_address = get_field('postal_address',1264);
$postal_zipcode = get_field('postal_zipcode',1264);
$postal_city = get_field('postal_city',1264);
$postal_country = get_field('postal_country',1264);

	// Contact visitor
$visitors_address = get_field('visitors_address',1264);
$visitors_zipcode = get_field('visitors_zipcode',1264);
$visitors_city = get_field('visitors_city',1264);
$visitors_country = get_field('visitors_country',1264);


?>
	<div class="row section footer">
		<div class="col-sm-12 ">
			<div class="row">
				<div class="col-sm-3 ">
					<ul class="contact_general contact_block">
						<?php

						if ($company_name) { echo get_contact_row($company_name, false, true); };
						if ($email_address) { echo get_contact_row($email_address, 'mailto:'.$email_address); };
						if ($telephone_number) { echo get_contact_row($telephone_number); };
						if ($fax_number) { echo get_contact_row($fax_number); };

						?>
					</ul>
				</div>
				<div class="col-sm-2 ">
					<ul class="contact_general contact_block">
						<?php

						echo get_contact_row("Postal address", false, true);
						if ($postal_address) { echo get_contact_row($postal_address); };
						if ($postal_zipcode) { echo get_contact_row($postal_zipcode." ".$postal_city); };
						if ($postal_country) { echo get_contact_row($postal_country); };

						?>
					</ul>
				</div>
				<div class="col-sm-3 ">
					<ul class="contact_general contact_block">
						<?php

						echo get_contact_row("Visitors address", false, true);
						if ($visitors_address) { echo get_contact_row($visitors_address); };
						if ($visitors_zipcode) { echo get_contact_row($visitors_zipcode." ".$visitors_city); };
						if ($visitors_country) { echo get_contact_row($visitors_country); };

						?>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-3 ">
					<ul class="social_channels">
						<li><a href="https://www.facebook.com/LabServices" target="_BLANK"><div class="icon facebook"></div></a></li>
						<li><a href="https://twitter.com/LabFacts" target="_BLANK"><div class="icon twitter"></div></a></li>


					</ul>
				</div>
			</div>

		</div>
	</div>



</div>



<?php // all js scripts are loaded in library/bones.php ?>
<?php wp_footer(); ?>

</body>

</html>
