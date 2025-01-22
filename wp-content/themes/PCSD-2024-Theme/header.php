<!DOCTYPE html>
<html>

<head>
	<?php $theme_vars = my_theme_variables(); ?>
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=<?php echo $theme_vars['google_tag_manager_id']; ?>"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());

		gtag('config', '<?php echo $theme_vars['google_tag_manager_id']; ?>');
	</script>
	<meta charset="utf-8" />
	<title><?php if (is_home()) { ?>News | <?php } ?><?php if (is_page()) {
															the_title(); ?> | <?php } ?><?php if (is_single()) {
																							the_title(); ?> | <?php } ?><?php bloginfo('name'); ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<!-- Fonts -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:600" rel="stylesheet">
	<!--end Fonts -->
	<meta name="theme-color" content="#ffffff ">
	<?php
	wp_head();
	?>
</head>

<body <?php body_class(); ?>>
	<a class="skip-to-link" href="#trp-floater-ls">Skip to Translation</a>
	<a class="skip-to-link" href="#navbar">Skip to Main Menu</a>
	<a class="skip-to-link" href="#mainContent">Skip to Main Content</a>
	<header id="mainHeader">

		<div class="siteLogo griditem">
			<a href="<?php echo home_url(); ?>">
				<img alt="Provo City School District Home" class="websiteLogo" src="<?php echo $theme_vars['logo']; ?>" />
				<?php echo $theme_vars['full_school_name']; ?>
			</a>
		</div>

		<nav id="navbar">
			<?php wp_nav_menu(array('menu' => 'header-menu')); ?>
		</nav>
		<div class="siteSearch griditem">
			<a href="https://provo.edu/search-results/"><img src="<?php echo get_template_directory_uri(); ?>/assets/icons/search-loupe.svg" alt="link to search page" width="25px"></a>
		</div>

	</header><!-- end mainHeader -->