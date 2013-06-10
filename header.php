<!doctype html>

<!--[if lt IE 7]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if (IE 7)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9 lt-ie8"><![endif]-->
<!--[if (IE 8)&!(IEMobile)]><html <?php language_attributes(); ?> class="no-js lt-ie9"><![endif]-->
<!--[if gt IE 8]><!--> <html <?php language_attributes(); ?> class="no-js"><!--<![endif]--

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<title><?php
	global $page, $paged;
	wp_title( '&mdash;', true, 'right' );
	bloginfo( 'name' );
	echo '&nbsp;::&nbsp;';
	bloginfo('description');
	?></title>

	<meta name="description" content="">
	<meta name="author" content="">

	<!-- mobile meta (hooray!) -->
	<meta name="HandheldFriendly" content="True">
	<meta name="MobileOptimized" content="320">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>

	<!-- icons & favicons (for more: http://themble.com/support/adding-icons-favicons/) -->
	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/library/images/favicon.ico">

	<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">

	<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

	<!-- wordpress head functions -->
	<?php wp_head(); ?>
	<!-- end of wordpress head -->

	<!-- drop Google Analytics Here -->
	<!-- end analytics -->

</head>

<body <?php body_class(); ?>>

	<div class="header_full full_width">

		<header role="banner" class="wrap">

			<div id="inner-header" class="clearfix">

				<nav class="sixcol first clearfix" role="navigation">
					<?php bones_main_nav(); // Adjust using Menus in Wordpress Admin ?>
				</nav>

				<!-- to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> -->
				<div id="logo" class="h1 fourcol last clearfix"><a class="site-logo" href="<?php echo home_url(); ?>" rel="nofollow"></a></div>

				<!-- if you'd like to use the site description you can un-comment it below -->
				<?php // bloginfo('description'); ?>

			</div> <!-- end #inner-header -->

		</header> <!-- end header -->

	</div>

	<div class="content_full full_width">