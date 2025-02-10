<aside id="rightSidebar" class="rightSidebar">
	<?php
	// $theme_vars = my_theme_variables();
	if (is_page('teachers-staff')) {
	?>
		<label for="dsearch" class="hidden" id="directorySearch">Directory Search: </label>
		<input type="text" name="dsearch" class="text-input" aria-labelledby="directorySearch" id="sidebar-filter" value="" placeholder="Search our staff..." />
		<img class="directorySearchIcon" src="//globalassets.provo.edu/image/icons/search-lt.svg" alt="decorative search icon" />
	<?php
	}
	?>
	<?php
	$sidebar_page_id = get_field('sidebar');
	if ($sidebar_page_id) {
		$sidebar_content = get_post($sidebar_page_id);
		echo apply_filters('the_content', $sidebar_content->post_content);
	} else {
		echo 'sidebar not set';
	}
	?>
</aside>