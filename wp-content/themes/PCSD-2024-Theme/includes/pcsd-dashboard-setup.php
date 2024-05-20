<?php
defined('ABSPATH') or die('No script kiddies please!');

// Enable Featured Images
add_theme_support('post-thumbnails');

// Add Menu Support
add_theme_support('menus');
// Wordpress Menus Registration
register_nav_menus(
	array(
		'header-menu' => __('Header Menu')

	)
);
/*==========================================================================================
Display Modified Date on Dashboard for Posts
============================================================================================*/
// Register Modified Date Column for both posts & pages
function modified_column_register($columns)
{
	$columns['Modified'] = __('Modified Date', 'show_modified_date_in_admin_lists');
	return $columns;
}
add_filter('manage_posts_columns', 'modified_column_register');
add_filter('manage_pages_columns', 'modified_column_register');

function modified_column_display($column_name, $post_id)
{
	switch ($column_name) {
		case 'Modified':
			global $post;
			echo '<p class="mod-date">';
			echo '<em>' . get_the_modified_date() . ' ' . get_the_modified_time() . '</em><br />';
			echo '<small>' . esc_html__('by ', 'show_modified_date_in_admin_lists') . '<strong>' . get_the_modified_author() . '<strong></small>';
			echo '</p>';
			break; // end all case breaks
	}
}
add_action('manage_posts_custom_column', 'modified_column_display', 10, 2);
add_action('manage_pages_custom_column', 'modified_column_display', 10, 2);

function modified_column_register_sortable($columns)
{
	$columns['Modified'] = 'modified';
	return $columns;
}
add_filter('manage_edit-post_sortable_columns', 'modified_column_register_sortable');
add_filter('manage_edit-page_sortable_columns', 'modified_column_register_sortable');


/*==========================================================================================
Add Length Column to the Wordpress Dashboard
============================================================================================*/

//For Posts

//Add the Length column, next to the Title column:

add_filter('manage_post_posts_columns', function ($columns) {
	$_columns = [];

	foreach ((array) $columns as $key => $label) {
		$_columns[$key] = $label;
		if ('title' === $key)
			$_columns['wpse_post_content_length'] = __('Length');
	}
	return $_columns;
});

//Fill that column with the post content length values:

add_action('manage_post_posts_custom_column', function ($column_name, $post_id) {
	if ($column_name == 'wpse_post_content_length')
		echo mb_strlen(get_post($post_id)->post_content);
}, 10, 2);

//Make our Length column orderable:

add_filter('manage_edit-post_sortable_columns', function ($columns) {
	$columns['wpse_post_content_length'] = 'wpse_post_content_length';
	return $columns;
});
//Finally we implement the ordering through the posts_orderby filter:

add_filter('posts_orderby', function ($orderby, \WP_Query $q) {
	$_orderby = $q->get('orderby');
	$_order   = $q->get('order');

	if (
		is_admin()
		&& $q->is_main_query()
		&& 'wpse_post_content_length' === $_orderby
		&& in_array(strtolower($_order), ['asc', 'desc'])
	) {
		global $wpdb;
		$orderby = " LENGTH( {$wpdb->posts}.post_content ) " . $_order . " ";
	}
	return $orderby;
}, 10, 2);

//For Pages

//Add the Length column, next to the Title column:

add_filter('manage_page_posts_columns', function ($columns) {
	$_columns = [];

	foreach ((array) $columns as $key => $label) {
		$_columns[$key] = $label;
		if ('title' === $key)
			$_columns['wpse_post_content_length'] = __('Length');
	}
	return $_columns;
});

//Fill that column with the post content length values:

add_action('manage_page_posts_custom_column', function ($column_name, $post_id) {
	if ($column_name == 'wpse_post_content_length')
		echo mb_strlen(get_post($post_id)->post_content);
}, 10, 2);

//Make our Length column orderable:

add_filter('manage_edit-page_sortable_columns', function ($columns) {
	$columns['wpse_post_content_length'] = 'wpse_post_content_length';
	return $columns;
});
//Finally we implement the ordering through the posts_orderby filter:

add_filter('posts_orderby', function ($orderby, \WP_Query $q) {
	$_orderby = $q->get('orderby');
	$_order   = $q->get('order');

	if (
		is_admin()
		&& $q->is_main_query()
		&& 'wpse_post_content_length' === $_orderby
		&& in_array(strtolower($_order), ['asc', 'desc'])
	) {
		global $wpdb;
		$orderby = " LENGTH( {$wpdb->posts}.post_content ) " . $_order . " ";
	}
	return $orderby;
}, 10, 2);

/*==========================================================================================
removes the welcome panel from the dashboard page since
most users cant do the things it references anyway
============================================================================================*/
function pcsd_auto_hide_welcome()
{
	remove_action('welcome_panel', 'wp_welcome_panel');
	$user_id = get_current_user_id();
	if (1 == get_user_meta($user_id, 'show_welcome_panel', true))
		update_user_meta($user_id, 'show_welcome_panel', 0);
}
add_action('load-index.php', 'pcsd_auto_hide_welcome');

/*==========================================================================================
Remove non needed meta boxes from the dashboard page.
============================================================================================*/
function pcsd_dashboard_setup()
{

	remove_meta_box('dashboard_primary', 'dashboard', 'side'); //Wordpress Blog info
	remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //At a Glance
	remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Quick Draft
	remove_meta_box('tinypng_dashboard_widget', 'dashboard', 'side'); //remove compressions widget
}
add_action('wp_dashboard_setup', 'pcsd_dashboard_setup');

/*==========================================================================================
Dashboard Widgets

Can be used to announce new things to the users of the site once they Log in
============================================================================================*/

function add_custom_dashboard_widgets()
{
	$site = get_bloginfo('name');
	wp_add_dashboard_widget(
		'wpexplorer_dashboard_widget', // Widget slug.
		'Welcome to the ' . $site . ' website', // Title.
		'custom_dashboard_widget_content' // Display function.
	);
}

add_action('wp_dashboard_setup', 'add_custom_dashboard_widgets');

/**
 * Create the function to output the contents of your Dashboard Widget.
 */

function custom_dashboard_widget_content()
{
	// Display whatever it is you want to show.
	$tutorialspage = get_bloginfo('url') . '/wp-admin/admin.php?page=pcsd_tutorial-admin-page.php';
	echo "Check out our new <a href=\"" . $tutorialspage . "\">Tutorials page</a> for helpful hints on how to accomplish your desired task.";
}

/*==========================================================================================
puts a note on each dashboard page to let content managers how to contact us.
============================================================================================*/
function pcsd_change_admin_footer()
{
	echo '<span id="footer-note">For any questions don\'t hesitate to contact the District Web Team Rob Francom(robertf@provo.edu).</span>';
}
add_filter('admin_footer_text', 'pcsd_change_admin_footer');

/*==========================================================================================
Remove Version Number from WP
============================================================================================*/
remove_action('wp_head', 'wp_generator');
function wpt_remove_version()
{
	return '';
}
add_filter('the_generator', 'wpt_remove_version');

function wpbeginner_remove_version()
{
	return '';
}
add_filter('the_generator', 'wpbeginner_remove_version');


/*==========================================================================================
add Tutorials page
============================================================================================*/
add_action('admin_menu', 'pcsd_tut_admin_menu');
function pcsd_tut_admin_menu()
{
	add_menu_page('Tutorials Dashboard', 'Tutorials', 'read', 'pcsd_tutorial-admin-page.php', 'pcsd_tutorial_admin_page', 'https://globalassets.provo.edu/image/icons/pcsd-icon-16x16.png', 4);
}
function pcsd_tutorial_admin_page()
{
	$tuts_page = curl_init();
	// set URL and other appropriate options
	curl_setopt($tuts_page, CURLOPT_URL, 'https://globalassets.provo.edu/globalpages/tutorials-page.php');
	curl_setopt($tuts_page, CURLOPT_HEADER, 0);
	// grab URL and pass it to the browser
	curl_exec($tuts_page);
	// close cURL resource, and free up system resources
	curl_close($tuts_page);
}

/*==========================================================================================
File Upload Tips
============================================================================================*/

//use post-upload-ui hook for after upload box, use pre-upload-ui hook for before upload box
add_action('post-upload-ui', 'pcsd_media_upload_tips');

function pcsd_media_upload_tips()
{
?>
	<h2>Your file will be processed by the server. This may take a few minutes depending on the size of the file.</h2>
<?php
};

/*==========================================================================================
Editor Changes
============================================================================================*/
//turn on paste_as_text by default
function change_paste_as_text($mceInit, $editor_id)
{
	//NB this has no effect on the browser's right-click context menu's paste!
	$mceInit['paste_as_text'] = true;
	return $mceInit;
}
add_filter('tiny_mce_before_init', 'change_paste_as_text', 1, 2);

/*==========================================================================================
removed Wordpress "stuff"
============================================================================================*/
// Remove type from scripts and styles
add_filter('style_loader_tag', 'codeless_remove_type_attr', 10, 2);
add_filter('script_loader_tag', 'codeless_remove_type_attr', 10, 2);
function codeless_remove_type_attr($tag, $handle)
{
	return preg_replace("/type=['\"]text\/(javascript|css)['\"]/", '', $tag);
}


// REMOVE WP EMOJI
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('admin_print_scripts', 'print_emoji_detection_script');
remove_action('admin_print_styles', 'print_emoji_styles');