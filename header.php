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
		<link rel="publisher" href="https://plus.google.com/117177552690463329090" />
		<link rel="apple-touch-icon" href="<?php echo get_template_directory_uri(); ?>/library/images/apple-icon-touch.png">
		<link href="//netdna.bootstrapcdn.com/font-awesome/4.0.3/css/font-awesome.css" rel="stylesheet">
		<link rel="icon" href="<?php echo get_template_directory_uri(); ?>/favicon.png">
		<!--[if IE]>
			<link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/favicon.ico">
		<![endif]-->
		<?php // or, set /favicon.ico for IE10 win ?>
		<meta name="msapplication-TileColor" content="#f01d4f">
		<meta name="msapplication-TileImage" content="<?php echo get_template_directory_uri(); ?>/library/images/win8-tile-icon.png">

		<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>">

		<?php // wordpress head functions ?>
		<?php wp_head(); ?>
		<?php // end of wordpress head ?>

		<?php // drop Google Analytics Here ?>
		<?php // end analytics ?>

	</head>

	<body <?php body_class(); ?>>

		<div id="container">

			<header class="header" id="site-header" role="banner">

			
				<div id="inner-header" class="wrap clearfix">
					<!--<?php // to use a image just replace the bloginfo('name') with your img src and remove the surrounding <p> ?>
					<p id="logo" class="h1"><a href="<?php echo home_url(); ?>" rel="nofollow"><?php bloginfo('name'); ?></a></p>
					
					<?php // if you'd like to use the site description you can un-comment it below ?>
					<?php /* bloginfo('description'); */ ?> -->
				

					<nav id="header-nav" class="clearfix" role="navigation">
						<nav class="left-header-nav">
							<ul class="desktop-nav nav-header clearfix">
							
								<!-- LOGO -->
								<li>
									<a href="<?php echo home_url(); ?>" rel="nofollow">
										<image id="logo" xlink:href="<?php echo get_bloginfo('template_url'); ?>/library/images/lightspeed-logo.svg" src="<?php echo get_bloginfo('template_url'); ?>/library/images/lightspeed-logo.png" />
										<!--<div id="header-logo" class="ls-logo"></div>-->
									</a>
								</li>
								
								<!-- ABOUT -->
								<li>
									<a href="" rel="nofollow">
										<?php qtrans_TextTranslate('About', 'Lightspeedについて'); ?>
									</a>
								</li>
								
								<!-- CATEGORIES -->
								<li>
									<a href="" rel="nofollow">
										<?php qtrans_TextTranslate('Features', 'お薦め記事'); ?>
									</a>
								</li>
								
								<!-- CATEGORIES -->
								<li>
									<a href="" rel="nofollow">
										<?php qtrans_TextTranslate('Topics', 'カテゴリー'); ?>
									</a>
								</li>
							</ul>
							
							<?php //bones_main_nav(); ?>
						</nav>
						
						<nav class="right-header-nav">
							<ul class="nav-header">
								<li id="nav-share">
									<i></i>
								</li>
								<li id="nav-lang">
									<i></i>
								</li>
								<li id="nav-RSS">
									<i></i>
								</li>
								<li class="" id="nav-Search">
									<i></i>
								</li>
							</ul>
						</nav>
					</nav>
				</div>
				
				<div>
				
				</div>
			</header>
