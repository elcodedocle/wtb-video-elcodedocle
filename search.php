<?php get_header(); ?>

<div id="content">

<div class="postsbody">

	
	<?php if (have_posts()) : ?>
	<div class="latestpart">
	<h2 class="pagetitle">Search Results for &#8216;<?php the_search_query(); ?>&#8217;</h2>
	
		<div class="latestvideos">

			<?php while (have_posts()) : the_post(); ?>	
					<div class="latestvideo">
					<div class="latestname">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php $tit = the_title('','',FALSE); echo substr($tit, 0, 20); if (strlen($tit) > 20) echo " ..."; ?></a>
					</div>
					<div class="latestthumb">
						<?php if( get_post_meta($post->ID, "thumb", true) ): ?>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php $values = get_post_custom_values("thumb"); echo $values[0]; ?>" width="120" height="90" alt="<?php the_title(); ?>" /></a>
						<?php else: ?>
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/noimage.gif" width="120" height="90" alt="<?php the_title(); ?>" /></a>
						<?php endif; ?>
					</div>
					<div class="latestinfo">
						<div class="postviews">
							<?php echo time_ago(); ?>  
						</div>
						<div class="postviews">
							<?php if(function_exists('the_views')) { the_views(); } ?>  
						</div>
					</div>
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
	<h2 class="pagetitle">Search Results for &#8216;<?php the_search_query(); ?>&#8217;</h2>
	
		<div class="latestvideos">

			<div class="entry">
				<p>Nothing found. Please, use the category menu or search a term.</p>
			</div>
			
		</div>
		<div class="latestvideosb"></div>
	</div>
	
	<?php endif; ?>
	
</div>

<?php include (TEMPLATEPATH . '/sidebar_home.php'); ?>

</div>

<?php get_footer(); ?>