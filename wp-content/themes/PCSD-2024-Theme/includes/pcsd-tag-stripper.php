<?php 

class Target_Stripper {
 	function __construct() {
 	    add_action( 'add_meta_boxes' , array( $this, 'show_filtered_content' ) , 1 , 2 );
 		add_filter( 'the_content' , array( $this, 'filter_content' ) );
 	}
     function clean_content( $content ) {
 		// Search $content for target="" and rel="" and remove
 		$patterns = array( '/(<[^>]+) target=".*?"/i' , "/(<[^>]+) target='.*?'/i",'/(<[^>]+) rel=".*?"/i' , "/(<[^>]+) rel='.*?'/i", '/(<[^>]+) href="mailto:.*?"/i', '#<iframe[^>]+>.*?</iframe>#is' );
 		$content = preg_replace( $patterns , '$1' , $content );	
 		return apply_filters( 'target_stripper_strip_rel' , $content );
 	}
 	function filter_content( $content ) {
 	    $content = $this->clean_content( $content );
 	    return $content;
 	}
 	function show_filtered_content( $post_type , $post ) {
 	    $post->post_content = $this->clean_content( $post->post_content );
 	}
 }
 $target_stripper = new Target_Stripper(); 
//strips '<br />', '<br/>', '<BR/>', '<br>', '<br >', '<p>&nbsp;</p>', '<b>', '</b>', '&nbsp;', '<h1></h1>', '<h1> </h1>', '<h2></h2>', '<h2> </h2>', '<h3></h3>', '<h3> </h3>', '<h4></h4>', '<h4> </h4>', '<h5>', '</h5>', '<h6>', '</h6>'
class brake_Stripper {
 	function __construct() {
 	    add_action( 'add_meta_boxes' , array( $this, 'show_filtered_content' ) , 1 , 2 );
 		add_filter( 'the_content' , array( $this, 'filter_content' ) );
 	}
     function clean_content( $content ) {
 		// Search $content for target="" and rel="" and remove
 		$patterns = array('<br />', '<br/>', '<BR/>', '<br>', '<br >', '<p>&nbsp;</p>', '<b>', '</b>', '&nbsp;', '<h1></h1>', '<h1> </h1>', '<h2></h2>', '<h2> </h2>', '<h3></h3>', '<h3> </h3>', '<h4></h4>', '<h4> </h4>', '<h5>', '</h5>', '<h6>', '</h6>', '<a>', '<iframe>', '</iframe>');
 		$content = str_replace($patterns, ' ' , $content );
 		
 		return apply_filters( 'brake_stripper_strip_rel' , $content );
 	}
 	function filter_content( $content ) {
 	    $content = $this->clean_content( $content );
 	    return $content;
 	}
 	function show_filtered_content( $post_type , $post ) {
 	    $post->post_content = $this->clean_content( $post->post_content );
 	}
 }
 $brake_stripper = new brake_Stripper(); 
?>