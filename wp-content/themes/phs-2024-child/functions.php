<?php

function my_theme_variables()
{
    $my_theme_variables = array(
        'logo' => get_stylesheet_directory_uri() . '/assets/img/site-logo.png',
        'full_school_name' => 'Provo High School',
        'short_school_name' => 'Provo High',
        'school_address' => '1199 N. Lakeshore Dr. Provo, Utah 84601 | Phone: 801-373-6550',
        'google_tag_manager_id' => 'G-FTPJPV04N2',
        // 'top_sidebar_cal' => '[calendar id="2064"]',
        // 'bot_sidebar_cal' => '[calendar id="2066"]',
        'front_page_cal' => '[calendar id="2069"]',
        // 'insta_link' => 'https://provohigh.provo.edu/provo-high-social-media/',
        // 'facebook_link' => 'https://provohigh.provo.edu/provo-high-social-media/',
        // 'twitter_link' => 'https://provohigh.provo.edu/provo-high-social-media/',
        'full_calendar_link' => 'https://provohigh.provo.edu/school-calendar/',
        // 'search_icon' => get_template_directory_uri() . '/assets/icons/search-loupe.svg',
        'blogLink' => 'https://provohigh.provo.edu/category/news/',
    );
    return $my_theme_variables;
}
function sidebar_menu()
{
    //TODO: add a wp menu here instead of hardcoding
    echo "<ul>";
    echo "<li><a href='https://provohigh.provo.edu/school-calendar/a-b-calendar-month-view/'>A/B Calendar Month View</a></li>";
    echo "</ul>";
}
function pcsd_child_theme_enqueue_styles()
{
    global $theme_version;
    wp_enqueue_style('variables', get_stylesheet_directory_uri() . '/assets/css/variables.css', '', $theme_version, false);
}
add_action('wp_enqueue_scripts', 'pcsd_child_theme_enqueue_styles', 9999);

function default_sidebar()
{
    // Replace 'sidebar_post_id' with the actual field name or method to get the post ID
    $sidebar_post_id = 3053;

    if ($sidebar_post_id) {
        $sidebar_post = get_post($sidebar_post_id);
        if ($sidebar_post) {
            return apply_filters('the_content', $sidebar_post->post_content);
        }
    }

    return 'default sidebar ID not configured';
}