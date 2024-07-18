<aside id="rightSidebar" class="rightSidebar">
	<?php
	// gather child theme variables
	$theme_vars = my_theme_variables();
	?>
	<h2>Follow Us</h2>
	<ul class="sociallinks">
	<li><a href="<?php echo $theme_vars['insta_link'] ?>"><?php echo get_svg('socialmedia-insta'); ?></a></li>
				<!-- <li><a href="<?php //echo $theme_vars['twitter_link'] ?>"><?php //echo get_svg('socialmedia-twitter'); ?></a></li> -->
				<li><a href="<?php echo $theme_vars['facebook_link'] ?>"><?php echo get_svg('socialmedia-facebook'); ?></a></li>
	</ul>
	<?php
	//load sidebar calendars
	if (isset($theme_vars['top_sidebar_cal'])) {
		echo '<h2>A/B Calendar</h2>';
		echo do_shortcode($theme_vars['top_sidebar_cal']);
	}
	if (isset($theme_vars['bot_sidebar_cal'])) {
		echo '<section class="impDates">';
		echo '<h2>Important Dates</h2>';
		echo do_shortcode($theme_vars['bot_sidebar_cal']);
		echo '</section>';
	}

	//load sidebar menu if it exists
	if (function_exists('sidebar_menu')) {
		sidebar_menu();
	}
	?>

</aside>