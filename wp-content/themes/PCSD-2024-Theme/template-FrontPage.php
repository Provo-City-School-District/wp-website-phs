<?php
/*
Template Name: Front Page
*/
get_header();

//fetch all stored variables from the control post
$get_to_know_fields = get_fields();
// gather child theme variables
$theme_vars = my_theme_variables();
?>


<main id="mainContent" class="homeMainContent frontpage">

	<?php
	//query any alerts
	$my_query = new WP_Query(array('showposts' => $posts_to_show, 'category_name'  => 'alert', 'post_status' => 'publish'));
	?>
	<section class="alerts 
		<?php if ($my_query->found_posts <= 0) {
			echo 'hidden';
		} ?>">
		<?php
		while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<article class="post">
				<header class="postmeta">
					<ul>
						<li><img src="//globalassets.provo.edu/image/icons/calendar-lt.svg" alt="calendar icon" /><?php the_time(' F jS, Y') ?></li>
					</ul>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

				</header>

			</article>
			<button class="closeAlert"></button>
		<?php endwhile;
		?>

	</section>
	<div class="address">
		<?php echo $theme_vars['school_address']; ?>
	</div>
	<?php
	wp_reset_query();
	?>

	<h2 class="novisibility"><?php echo $theme_vars['full_school_name']; ?></h2>
	<div class="grid2_3">
		<section id="announcments" <?php if ($get_to_know_fields['video_or_slider'] == 'video') {
										echo 'class="videoslide"';
									} ?>>
			<h1><?php echo $theme_vars['full_school_name']; ?> Announcements</h1>
			<?php

			if ($get_to_know_fields['video_or_slider'] == 'video') {
			?>

				<video id="heroVideo" autoplay loop controls>
					<source src="<?php echo $get_to_know_fields['video_url'] ?>" type="video/mp4">
					Your browser does not support MP4 Format videos or HTML5 Video.
				</video>
			<?php
			} elseif ($get_to_know_fields['video_or_slider'] == 'slider') {
			?>
				<?php
				$args = array(
					'posts_per_page' => 1,
					'post__in'  => get_option('sticky_posts'),
					'ignore_sticky_posts' => 1
				);
				$sticky_query = new WP_Query($args);
				if ($sticky_query->have_posts()) :
					while ($sticky_query->have_posts()) : $sticky_query->the_post();
						$background_image = '';
						$post_id = get_the_ID(); // Define the $post_id variable
						if (get_field('featured_image', $post_id)) {
							$background_image = get_field('featured_image');
						} elseif (has_post_thumbnail()) {
							$background_image = get_the_post_thumbnail_url();
						} else {
							$background_image = get_stylesheet_directory_uri() . '/assets/images/building-image.jpg';
						}
				?>
						<article class="sticky post" style="background-image: url('<?php echo esc_url($background_image); ?>');">


							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						</article>
				<?php endwhile;
					wp_reset_postdata();
				else :
					echo '<p>No sticky posts found</p>';
				endif;
				?>
			<?php
			}

			?>
		</section>
		<section>
			<h2><?php echo $theme_vars['full_school_name']; ?> Calendar</h2>
			<?= do_shortcode($theme_vars['front_page_cal']); ?>
			<a class="center" href="<?= $theme_vars['full_calendar_link'] ?>">View full calendar for more events</a>
		</section>
	</div>
	<div id="belowSlider">
		<section id="stayCurrent" class="grid2 calendar">
			<ul>
				<?php
				if ($theme_vars['insta_link']) {
				?>
					<li><a href="<?php echo $theme_vars['insta_link'] ?>" aria-label="Instagram">
							<?php echo get_svg('socialmedia-insta'); ?>
						</a></li>
				<?php
				}
				if ($theme_vars['facebook_link']) {
				?>
					<li><a href="<?php echo $theme_vars['facebook_link'] ?>" aria-label="Facebook">
							<?php echo get_svg('socialmedia-facebook'); ?>
						</a></li>
				<?php
				}
				if ($theme_vars['twitter_link']) {
				?>
					<li><a href="<?php echo $theme_vars['twitter_link'] ?>" aria-label="Twitter">
							<?php echo get_svg('socialmedia-twitter'); ?>
						</a></li>
				<?php
				}
				?>
			</ul>
			<?php
			if (get_field('hero_link_address') || get_field('hero_link_2_address')) {
			?>
				<ul>
					<?php
					if (get_field('hero_link_label')) {
					?>
						<li class="calendar"><a href="<?php echo get_field('hero_link_address'); ?>"><?php echo get_field('hero_link_label'); ?></a></li>
					<?php
					}
					?>
					<?php
					if (get_field('hero_link_2_label')) {
					?>
						<li class="newsletter"><a href="<?php echo get_field('hero_link_2_address'); ?>"><?php echo get_field('hero_link_2_label'); ?></a></li>
					<?php
					}
					?>
				</ul>
			<?php
			}
			?>
		</section>

		<section class="wpMenu">
			<?php
			wp_reset_query();
			$topMenu = get_field('select_a_menu');
			wp_nav_menu(array('menu' => $topMenu));
			?>
		</section>
		<section id="homeNews">
			<!-- News Home Page Start -->
			<h1><?php echo $theme_vars['short_school_name']; ?> News & Events</h1>
			<p>The latest news from <?php echo $theme_vars['full_school_name']; ?></p>
			<div class="stories">
				<?php
				$sticky_posts = get_option('sticky_posts');
				$sticky_args = array(
					'posts_per_page' => 3,
					'post__in' => $sticky_posts,
					'category_name' => 'news',
					'post_type' => 'post',
					'ignore_sticky_posts' => 1
				);
				$sticky_query = new WP_Query($sticky_args);
				$sticky_count = $sticky_query->post_count;

				$regular_args = array(
					'posts_per_page' => 6 - $sticky_count,
					'category_name' => 'news',
					'post_type' => 'post',
					'post__not_in' => $sticky_posts,
					'ignore_sticky_posts' => 1
				);
				$regular_query = new WP_Query($regular_args);

				$all_posts = array_merge($sticky_query->posts, $regular_query->posts);

				if (!empty($all_posts)) :
					foreach ($all_posts as $post) : setup_postdata($post);
						$background_image = '';
						$post_id = get_the_ID(); // Define the $post_id variable
						if (get_field('featured_image', $post_id)) {
							$background_image = get_field('featured_image');
						} elseif (has_post_thumbnail()) {
							$background_image = get_the_post_thumbnail_url();
						} else {
							$background_image = get_stylesheet_directory_uri() . '/assets/images/building-image.jpg';
						}
				?>
						<article class="post" style="background-image: url('<?php echo esc_url($background_image); ?>');">


							<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>

						</article>
				<?php endforeach;
					wp_reset_postdata();
				else :
					echo '<p>No Content Found</p>';
				endif;
				?>
			</div>
			<p class="moreNews"><a href="<?= $theme_vars['blogLink'] ?>">Read More <?php echo $theme_vars['short_school_name']; ?> News <span class="rightarrow"></span></a></p>
		</section> <!-- News Home Page End -->


		<section id="socialMediaFrontPage">
			<!-- Start Social Media -->
			<h1>Social Media</h1>
			See what's being discussed & shared
			<ul class="sociallinks">
				<li><a href="<?php echo $theme_vars['insta_link'] ?>"><?php echo get_svg('socialmedia-insta'); ?></a></li>
				<!-- <li><a href="<?php //echo $theme_vars['twitter_link'] 
									?>"><?php //echo get_svg('socialmedia-twitter'); 
										?></a></li> -->
				<li><a href="<?php echo $theme_vars['facebook_link'] ?>"><?php echo get_svg('socialmedia-facebook'); ?></a></li>
			</ul>
		</section> <!-- End Social Media -->
	</div><!-- End of post slider content -->
</main><!-- End of #mainContent -->
<?php
get_footer();
?>