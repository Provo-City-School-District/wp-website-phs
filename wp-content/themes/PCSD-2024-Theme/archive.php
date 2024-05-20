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
				if (have_posts()) :
					while (have_posts()) : the_post(); ?>
						<article class="post">
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
										<img src="https://provo.edu/wp-content/uploads/2018/03/provo-school-district-logo.jpg" class="attachment-post-thumbnail size-post-thumbnail wp-post-image" alt="" width="217" height="175">
									<?php } ?>
								</div>
							</a>
							<header class="postmeta">
								<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
								<ul>
									<li><img src="//globalassets.provo.edu/image/icons/calendar-ltblue.svg" alt="" /><?php the_time(' F jS, Y') ?></li>
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
			<?php echo paginate_links(); ?>
		</nav>
	<?php else :
					echo '<p>No Content Found</p>';
				endif;
	?>
	</div>
	<?php get_sidebar(); ?>
</main>
<?php
get_footer();
?>