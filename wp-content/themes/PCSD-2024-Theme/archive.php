<?php
get_header();
?>
<main id="mainContent" class="sidebar">
	<?php custom_breadcrumbs(); ?>
	<div id="currentPage">
		<h1>District News: <?php single_cat_title(); ?></h1>
		<div class="postList">
			<div class="grid3">
				<?php
				// Exclude sticky posts from the main query
				$args = array(
					'post__not_in' => get_option('sticky_posts'),
					'paged' => $paged
				);
				$query = new WP_Query($args);

				if ($query->have_posts()) :
					while ($query->have_posts()) : $query->the_post(); ?>
						<article class="post">
							<a href="<?php the_permalink(); ?>">
								<div class="featured-image">
									<?php
									if (get_field('featured_image', $post_id)) {
									?>
										<img src="<?php echo get_field('featured_image'); ?>" alt="" class="decorative image" />
									<?php
									} elseif (has_post_thumbnail()) {
										the_post_thumbnail();
									} else { ?>
										<img src="https://provo.edu/wp-content/uploads/2018/03/provo-school-district-logo.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="Building Image" width="217" height="175">
									<?php } ?>
								</div>
							</a>
							<header class="postmeta">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<ul>
									<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="calendar icon" /><?php the_time(' F jS, Y') ?></li>
								</ul>
							</header>
							<?php
							echo get_excerpt();
							?>
						</article>
					<?php endwhile;
					?>
			</div>
		</div>
		<nav class="archiveNav">
			<?php
					echo paginate_links(array(
						'total' => $query->max_num_pages
					));
			?>
		</nav>
	<?php else :
					echo '<p>No Content Found</p>';
				endif;
	?>
	</div>
	<aside id="rightSidebar" class="rightSidebar">
		<?php default_sidebar(); ?>
	</aside>
</main>
<?php
get_footer();
?>