<?php
get_header();
?>
<main id="mainContent" class="sidebar">
	<?php custom_breadcrumbs(); ?>
	<!-- Current Page Content -->
	<section id="currentPage">
		<article class="activePost">
			<?php
			if (have_posts()) :
				while (have_posts()) : the_post(); ?>
					<header class="postmeta">
						<h1><?php the_title(); ?></h1>
						<ul>
							<li id="the_post_date"><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?> /</li>
							<li><img src="//globalassets.provo.edu/image/icons/person-ltblue.svg" alt="" /><?php the_author_posts_link() ?> /</li>
							<li><img src="//globalassets.provo.edu/image/icons/hamburger-ltblue.svg" alt="" /><?php the_category(', ') ?></li>
						</ul>
					</header>
			<?php
					the_content();
				endwhile;
			else :
				echo '<p>No Content Found</p>';
			endif;
			echo do_shortcode('[social_warfare]');
			//social_warfare();
			?>
			<div class="bottom"></div>
			<section class="postList">
				<div class="grid3">
					<?php
					$currentID = get_the_ID();
					wp_reset_query();
					wp_reset_postdata();
					//Removes news category from get_the_category
					$categoryID = get_the_category($post->ID);
					foreach ($categoryID as $category) {
						if ($category->term_id == 192) {
							continue;
						}
						$postcategories = '"' . $category->name . '"' . ',';
					}

					//use $postcategories for category_name if you want to display category related posts only. Use actual category name if you want to only use that category
					$my_query = new WP_Query(array('showposts' => 3, 'post_status' => 'publish', 'category_name'  => 'News', 'post__not_in' => array($currentID)));
					while ($my_query->have_posts()) : $my_query->the_post(); ?>
						<article class="post">
							<div class="featured-image">
								<?php

								if (get_field('featured_image', $post_id)) {
								?>
									<a href="<?php the_permalink(); ?>"><img src="<?php echo get_field('featured_image'); ?>" alt="" class="" /></a>
								<?php
								} elseif (has_post_thumbnail()) {
								?>
									<a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(); ?></a>
								<?php
								}
								?>
							</div>
							<header class="postmeta">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<ul>
									<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
								</ul>
							</header>
							<?php echo get_excerpt(); ?>
						</article>
					<?php endwhile; ?>
				</div>
			</section>
		</article>


	</section>
	<!-- Current Page Content End -->
	<?php get_sidebar('categories'); ?>
</main>
<?php
get_footer();
?>