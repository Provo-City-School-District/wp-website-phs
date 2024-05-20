<?php
get_header();
?>
<main id="mainContent" class="sidebar">
	<?php custom_breadcrumbs(); ?>
	<div id="currentPage">

		<article id="activePost" class="activePost">

			<?php
			do_shortcode('[modified-date]');
			if (have_posts()) :
				while (have_posts()) : the_post(); ?>

					<h1><?php the_title(); ?></h1>
					<?php the_content(); ?>

			<?php endwhile;
			else :
				echo '<p>No Content Found</p>';
			endif;
			?>
			<div class="clear"></div>
		</article>
	</div>
	<?php
	get_sidebar();
	?>
</main>
<?php
get_footer();
?>