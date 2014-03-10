<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"><![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]-->

	<head>
		<meta charset="utf-8">

		<?php // Google Chrome Frame for IE ?>
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
		<title><?php wp_title(''); ?></title>

		<?php // mobile meta (hooray!) ?>
		<meta name="HandheldFriendly" content="True">
		<meta name="MobileOptimized" content="320">
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

		<?php // icons & favicons (for more: http://www.jonathantneal.com/blog/understand-the-favicon/) ?>

		<!-- Basic favicons -->
		<link rel="shortcut icon" sizes="16x16 32x32 48x48 64x64" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon.ico?v2">
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon.ico?v2">
		<!--[if IE]><link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon.ico?v2"><![endif]-->
		<!-- For Opera Speed Dial -->
		<link rel="icon" type="image/png" sizes="195x195" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-195.png?v2?v2">
		<!-- For iPad with high-resolution Retina Display running iOS ≥ 7 -->
		<link rel="apple-touch-icon" sizes="152x152" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-152.png?v2?v2">
		<!-- For iPad with high-resolution Retina Display running iOS ≤ 6 -->
		<link rel="apple-touch-icon" sizes="144x144" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-144.png?v2?v2">
		<!-- For iPhone with high-resolution Retina Display running iOS ≥ 7 -->
		<link rel="apple-touch-icon" sizes="120x120" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-120.png?v2?v2">
		<!-- For iPhone with high-resolution Retina Display running iOS ≤ 6 -->
		<link rel="apple-touch-icon" sizes="114x114" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-114.png?v2?v2">
		<!-- For Google TV devices -->
		<link rel="icon" type="image/png" sizes="96x96" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-96.png?v2?v2">
		<!-- For iPad Mini -->
		<link rel="apple-touch-icon" sizes="76x76" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-76.png?v2">
		<!-- For first- and second-generation iPad -->
		<link rel="apple-touch-icon" sizes="72x72" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-72.png?v2">
		<!-- For non-Retina iPhone, iPod Touch and Android 2.1+ devices -->
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/favicon/favicon-57.png?v2">
		<!-- Windows 8 Tiles -->
		<meta name="msapplication-TileColor" content="#FFFFFF">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/favicon//favicon-144.png?v2">



		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">


		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>


		<div class="container">
			<header class="row header section">
					<div class="col-sm-4 ">
					<a href="<?php echo get_site_url(); ?>"><img class="logo" src="<?php echo get_template_directory_uri(); ?>/library/images/labservices_logo.svg" data-svg-fallback="<?php echo get_template_directory_uri(); ?>/library/images/labservices_logo.png"/></a>
					</div>
					<div class="col-sm-8">
						<div class="row">
							<div class="col-sm-11">
							<nav class="navigation" role="navigation">
								<?php bones_main_nav(); ?>
								

								

								<!-- <div class="language">eng</div> -->
							</nav>
							</div>
							<div class="col-sm-1">
								<?php if (function_exists('ms_ml_language_switch')) { ms_ml_language_switch(); } ?>
							</div>
						</div>
					</div>
			</header>




