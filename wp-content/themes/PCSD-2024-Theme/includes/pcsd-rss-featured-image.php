<?php


//ripped pieces from http://dineshkarki.com.np/featured-image-in-rss-feed when wordfence started marking it as a critical error.

$buildingImage = WP_CONTENT_URL . '/themes/PCSD-2024-Theme/assets/img/building-image.jpg';
function pcsdfeaturedtoRSS($content)
{
    global $post;
    if (get_field('featured_image', $post)) {
?>
        <img src="<?php echo get_field('featured_image'); ?>" />
    <?php
    } elseif (has_post_thumbnail()) {
    ?>
        <img src="<?php echo get_the_post_thumbnail_url(); ?>" />
    <?php
    } elseif (file_exists($_SERVER['DOCUMENT_ROOT'] . $buildingImage)) {
        $buildingImage = get_stylesheet_directory_uri() . '/assets/images/building-image.jpg';
    ?>
        <img src="<?php echo $buildingImage; ?>" />
    <?php
    } else {
    ?>
        <img src="https://provo.edu/wp-content/uploads/2018/03/provo-school-district-logo.jpg" />
<?php
    }
    return $content;
}

add_filter('the_excerpt_rss', 'pcsdfeaturedtoRSS');
add_filter('the_content_feed', 'pcsdfeaturedtoRSS');
