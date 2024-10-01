<aside id="rightSidebar" class="rightSidebar">
	<?php
	$theme_vars = my_theme_variables();
	if (is_page('teachers-staff')) {
	?>
		<label for="dsearch" class="hidden" id="directorySearch">Directory Search: </label>
		<input type="text" name="dsearch" class="text-input" aria-labelledby="directorySearch" id="sidebar-filter" value="" placeholder="Search our staff..." />
		<img class="directorySearchIcon" src="//globalassets.provo.edu/image/icons/search-lt.svg" alt="" />
	<?php
	}

	?>
	<h2>Follow Us</h2>
	<ul class="sociallinks">
		<?php
		if (isset($theme_vars['insta_link'])) {
		?>
		<li><a href="<?php echo $theme_vars['insta_link'] ?>"><?php echo get_svg('socialmedia-insta'); ?></a></li>
		<?php
		}
		if (isset($theme_vars['twitter_link'])) {
		?>
			<li><a href="<?php echo $theme_vars['twitter_link'] ?>"><?php echo get_svg('socialmedia-twitter'); ?></a></li>
		<?php
		}
		if (isset($theme_vars['facebook_link'])) {
		?>
		<li><a href="<?php echo $theme_vars['facebook_link'] ?>"><?php echo get_svg('socialmedia-facebook'); ?></a></li>
		<?php
		}
		?>
	</ul>
	<?php
	//load sidebar calendars
	if (isset($theme_vars['top_sidebar_cal'])) {
		echo '<h2>A/B Calendar</h2>';
		echo do_shortcode($theme_vars['top_sidebar_cal']);
	}
	//load sidebar menu if it exists
	if (function_exists('sidebar_menu')) {
		sidebar_menu();
	}
	if (isset($theme_vars['bot_sidebar_cal'])) {
		echo '<section class="impDates">';
		echo '<h2>Important Dates</h2>';
		echo do_shortcode($theme_vars['bot_sidebar_cal']);
		echo '</section>';
	}
	?>

</aside>