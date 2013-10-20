<?php get_header(); ?>

<div id="content">

<div class="postsbody">
	
	<?php if (have_posts()) : ?>
	<div class="latestpart">
	<h2 class="pagetitle"><?php the_title(); ?></h2>

		<div class="latestvideos">

			<?php while (have_posts()) : the_post(); ?>	
					<div class="entry">
					<?php the_content('<p class="serif">Leer m&aacute;s &raquo;</p>',FALSE); ?>
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
	<h2 class="pagetitle">No se ha encontrado nada</h2>
	
		<div class="latestvideos">

			<div class="entry">
				<p>Por favor, use el men&uacute; de categor&iacute;as o busque un t&eacute;rmino.</p>
			</div>
			
		</div>
		<div class="latestvideosb"></div>
	</div>
	
	<?php endif; ?>
	
</div>

<?php include (TEMPLATEPATH . '/sidebar_home.php'); ?>

</div>

<?php get_footer(); ?>
