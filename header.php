<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo( 'html_type' ); ?>; charset=<?php bloginfo( 'charset' ); ?>" />
<meta name="description" content="<?php bloginfo( 'description' ); ?>" />
<title><?php bloginfo( 'name' ); wp_title( ' | ', true ); ?></title>
<link rel="stylesheet" href="<?php bloginfo( 'stylesheet_url' ); ?>" />
<link rel="alternate" type="application/rss+xml" title="<?php bloginfo( 'name' ); ?> Feed" href="<?php bloginfo( 'rss2_url' ); ?>" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<div id="page" class="group aligncenter">
	<div id="head" class="group">
		<div class="name"><a href="<?php echo get_option( 'home' ); ?>/" title="Return Home"><?php bloginfo( 'name' ); ?></a></div>
		<div class="description"><?php bloginfo( 'description' ); ?></div>
		<ul class="navi">
			<li><a href="<?php bloginfo( 'home' ); ?>" title="Home">Home</a></li>
			<?php wp_list_pages( 'title_li=&link_before=<span>&link_after=</span>' ); ?>
			<li><a href="<?php bloginfo( 'rss2_url' ); ?>" title="Subscribe">Subscribe</a></li>
		</ul>
	</div>
	<div id="body" class="group">