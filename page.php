<?php get_header(); ?>

<div id="content">

<div class="postsbody">
	
	<?php if (have_posts()) : ?>
	<div class="latestpart">
	<h2 class="pagetitle"><?php the_title(); ?></h2>

		<div class="latestvideos">

			<?php while (have_posts()) : the_post(); ?>	
					<div class="entry">
					<?php the_content('<p class="serif">Read the rest of this page &raquo;</p>'); ?>
					<?php wp_link_pages(array('before' => '<p><strong>Pages:</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
					</div>
			<?php endwhile; ?>
		</div>
		<div class="latestvideosb"></div>
	</div>
			<div class="navigation">
				<?php if(function_exists('wp_pagenavi')) { wp_pagenavi('', '', '', '', 3, false);} ?>
			</div>
	<?php else: ?>	
	
	<div class="latestpart">
	<h2 class="pagetitle">Nothing Found</h2>
	
		<div class="latestvideos">

			<div class="entry">
				<p>Please, use the category menu or search a term.</p>
			</div>
			
		</div>
		<div class="latestvideosb"></div>
	</div>
	
	<?php endif; ?>
	
</div>

<?php include (TEMPLATEPATH . '/sidebar_home.php'); ?>

</div>

<?php get_footer(); ?>