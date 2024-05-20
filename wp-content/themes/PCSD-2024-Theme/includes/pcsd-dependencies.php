<?php
	defined( 'ABSPATH' ) or die( 'No script kiddies please!' );


/*==========================================================================================
Custom Excerpt
============================================================================================*/
function get_excerpt(){
	$excerpt = get_the_content();
	$excerpt = preg_replace(" ([.*?])",'',$excerpt);
	$excerpt = strip_shortcodes($excerpt);
	$excerpt = strip_tags($excerpt);
	$excerpt = substr($excerpt, 0, 100);
	$excerpt = substr($excerpt, 0, strripos($excerpt, " "));
	$excerpt = trim(preg_replace( '/\s+/', ' ', $excerpt));
	$excerpt = '<p>'.$excerpt.'...'.'</p>';

	return $excerpt;
}
/*==========================================================================================
add readmore to default excerpt
============================================================================================*/
function wpdocs_excerpt_more( $more ) {
    return ' <a href="'.get_the_permalink().'" rel="nofollow">Read More...</a>';
}
add_filter( 'excerpt_more', 'wpdocs_excerpt_more' );

/*==========================================================================================
Get SVG
============================================================================================*/

function get_svg($name) {
    return file_get_contents(get_template_directory() . "/assets/icons/$name.svg");
}
