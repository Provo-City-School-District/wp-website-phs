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


<main id="mainContent" class="homeMainContent">

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
						<li><img src="//globalassets.provo.edu/image/icons/calendar-lt.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
					</ul>
					<h1><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h1>

				</header>

			</article>
			<button class="closeAlert"></button>
		<?php endwhile;
		?>

	</section>
	<div class="notgrid2">
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
			<h2><?php echo $theme_vars['full_school_name']; ?> Announcements</h2>
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
				<div class="slick-wrapper">
					<?php
					$args = array('post_type' => 'announcement', 'posts_per_page' => 5, 'orderby'  => array('date' => 'DESC'));
					// Variable to call WP_Query.
					$the_query = new WP_Query($args);
					if ($the_query->have_posts()) :
						while ($the_query->have_posts()) : $the_query->the_post(); ?>
							<article class="slide" style="background-image: url('<?php the_field('announcement_image'); ?>')">
								<div class="slide-text">
									<h3><?php the_title(); ?></h3>
									<p>
										<?php
										the_field('announcement_text');
										$slideLink = get_field('announcement_link');
										$slideLinkLabel = get_field('announcement_link_label');
										if ($slideLink) { ?>
											<a href="<?php echo $slideLink ?>"><?php echo $slideLinkLabel ?></a>
										<?php }
										?>
									</p>
								</div>
							</article>
					<?php endwhile;
					else :
						echo '<p>No Content Found</p>';
					endif;
					wp_reset_query();
					?>
				</div>
			<?php
			}

			?>
		</section>
		<section>
			<h2><?php echo $theme_vars['full_school_name']; ?> Calendar</h2>
			<?= do_shortcode($theme_vars['front_page_cal']); ?>
			<a class="center" href="<?= $theme_vars['full_calendar_link'] ?>">View Full School Calendar</a>
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
				$the_query = new WP_Query(array('posts_per_page' => 3, 'category_name'  => 'news', 'post_type'  => 'post'));
				if ($the_query->have_posts()) :
					while ($the_query->have_posts()) : $the_query->the_post(); ?>
						<article>
							<a href="<?php the_permalink(); ?>">
								<div class="featured-image">

									<?php
									if (get_field('featured_image', $post_id)) {
									?>
										<img src="<?php echo get_field('featured_image'); ?>" alt="" class="" />
									<?php
									} elseif (has_post_thumbnail()) {
										the_post_thumbnail();
									} else { ?>
										<img src="<?php echo get_stylesheet_directory_uri() . '/assets/img/building-image.jpg'; ?>" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" width="217" height="175">
									<?php } ?>

								</div>
								<h2><?php the_title(); ?></h2>
							</a>
							<div class="articleContent">
								<?php
								echo get_excerpt();
								?>
								<!-- <a href="<?php the_permalink(); ?>">Read More <span class="rightarrow"></span></a> -->
							</div>
							<p class="postDate"><?php echo get_the_date(); ?></p>

						</article>
				<?php endwhile;
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