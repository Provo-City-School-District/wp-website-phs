<?php
$theme_version = '1.0.7';
/*==========================================================================================
Theme Setup
============================================================================================*/
function pcsd_assets()
{
	global $theme_version;
	//register different script files
	wp_register_script('mainScripts', get_template_directory_uri() . '/assets/js/main_scripts.js', array('jquery'), $theme_version, true);
	wp_register_script('cludoScripts', 'https://customer.cludo.com/scripts/bundles/search-script.min.js', '', '1.0.1', true);
	wp_register_script('linkDetection', get_template_directory_uri() . '/assets/js/linkDetection.js', '', $theme_version, true);
	wp_register_script('404easterEgg', get_template_directory_uri() . '/assets/js/404.js', '', $theme_version, true);
	wp_register_script('formfix', get_template_directory_uri() . '/assets/js/formfix.js', '', $theme_version, true);
	wp_register_script('directorySearch', get_template_directory_uri() . '/assets/js/directorySearch.js', '', $theme_version, true);

	//load CSS files
	wp_enqueue_style('reset', get_template_directory_uri() . '/assets/css/reset.css', '', $theme_version, false);
	wp_enqueue_style('main', get_template_directory_uri() . '/assets/css/main.css', '', $theme_version, false);
	wp_enqueue_style('fonts', get_template_directory_uri() . '/assets/css/font.css', '', $theme_version, false);
	wp_enqueue_style('header', get_template_directory_uri() . '/assets/css/header.css', '', $theme_version, false);
	wp_enqueue_style('breadcrumbs', get_template_directory_uri() . '/assets/css/breadcrumbs.css', '', $theme_version, false);
	wp_enqueue_style('footer', get_template_directory_uri() . '/assets/css/footer.css', '', $theme_version, false);
	wp_enqueue_style('sidebar', get_template_directory_uri() . '/assets/css/sidebar.css', '', $theme_version, false);
	wp_enqueue_style('cludo_css', 'https://customer.cludo.com/css/templates/v2.1/essentials/cludo-search.min.css', '', '2.1', false);
	wp_enqueue_style('linkmarking', get_template_directory_uri() . '/assets/css/linkmarking.css', '', $theme_version, false);
	wp_enqueue_style('printing', get_template_directory_uri() . '/assets/css/print.css', '', $theme_version, false);


	//load js files
	wp_enqueue_script('slickScripts');
	wp_enqueue_script('cludoScripts');
	wp_enqueue_script('linkDetection');
	wp_enqueue_script('mainScripts');

	if (is_front_page()) {
		wp_enqueue_style('front_page', get_template_directory_uri() . '/assets/css/frontpage.css', array(), $theme_version, false);
	}
	if (is_page_template(
		array(
			'template-department_2024_news_links.php',
		)
	)) {
		wp_enqueue_style('department', get_template_directory_uri() . '/assets/css/department-styles.css', '', $theme_version, false);
		wp_enqueue_style('tiles', get_template_directory_uri() . '/assets/css/tiles.css', '', $theme_version, false);
	}

	if (is_404()) {
		wp_enqueue_script('404easterEgg');
	}
	if (is_page('teachers-staff')) {
		wp_enqueue_script('directorySearch');
	}
}
add_action('wp_enqueue_scripts', 'pcsd_assets', 9990);

/*==========================================================================================
Dashboard Setup
============================================================================================*/
include_once(get_template_directory() . '/includes/pcsd-dashboard-setup.php');
include_once(get_template_directory() . '/includes/pcsd-rss-featured-image.php');
include_once(get_template_directory() . '/includes/pcsd-dependencies.php');
include_once(get_template_directory() . '/includes/pcsd-shortcodes.php');
include_once(get_template_directory() . '/includes/pcsd-tag-stripper.php');
include_once(get_template_directory() . '/includes/pcsd-breadcrumbs.php');

/*==========================================================================================
// Favicon
============================================================================================*/
function pcsd_add_favicon()
{ ?>
	<!-- Custom Favicons -->
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/apple-touch-icon.png">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-32x32.png" sizes="32x32">
	<link rel="icon" type="image/png" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/favicon-16x16.png" sizes="16x16">
	<link rel="manifest" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/manifest.json">
	<link rel="mask-icon" href="<?php echo get_template_directory_uri(); ?>/assets/img/favicons/safari-pinned-tab.svg">
<?php }
//add the favicon link to the live site head
add_action('wp_head', 'pcsd_add_favicon');
//add the favicon to the login page
add_action('login_head', 'pcsd_add_favicon');
/*==========================================================================================
// custom Login Page
============================================================================================*/
function my_custom_login()
{
	echo '<link rel="stylesheet" type="text/css" href="' . get_bloginfo('stylesheet_directory') . '/assets/css/custom-login-styles.css" />';
}
add_action('login_head', 'my_custom_login');

function my_login_logo_url()
{
	return get_bloginfo('url');
}
add_filter('login_headerurl', 'my_login_logo_url');

function my_login_logo_url_title()
{
	return 'Provo City School District';
}
add_filter('login_headertitle', 'my_login_logo_url_title');

/*==========================================================================================
block WordPress User Enumeration Scans
============================================================================================*/
if (!is_admin()) {
	// default URL format
	if (preg_match('/author=([0-9]*)/i', $_SERVER['QUERY_STRING'])) die();
	add_filter('redirect_canonical', 'shapeSpace_check_enum', 10, 2);
}
function shapeSpace_check_enum($redirect, $request)
{
	// permalink URL format
	if (preg_match('/\?author=([0-9]*)(\/*)/i', $request)) die();
	else return $redirect;
}

// adds class .active to top menu item if the current active page is the page in the menu 
// so that we can style that differently.
add_filter('nav_menu_css_class', 'special_nav_class', 10, 2);

function special_nav_class($classes, $item)
{
	if (in_array('current-menu-item', $classes)) {
		$classes[] = 'active ';
	}
	return $classes;
}
