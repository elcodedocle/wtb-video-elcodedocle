<?php get_header(); ?>

<div id="content">

<div class="postsbody">
	
	<?php if (have_posts()) : ?>
	<div class="latestpart">
	<?php $post = $posts[0]; // Hack. Set $post so that the_date() works. ?>
 	<?php /* If this is a category archive */ if (is_category()) { ?>
	<h2 class="pagetitle"><?php single_cat_title(); ?> Videos</h2>
	<?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
	<h2 class="pagetitle"><?php single_tag_title(); ?> Videos</h2>
	<?php /* If this is a daily archive */ } elseif (is_day()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('F jS, Y'); ?></h2>
	<?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('F, Y'); ?></h2>
	<?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
	<h2 class="pagetitle">Archive for <?php the_time('Y'); ?></h2>
	<?php /* If this is an author archive */ } elseif (is_author()) { ?>
	<h2 class="pagetitle">Author Archive</h2>
	<?php /* If this is a paged archive */ } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
	<h2 class="pagetitle">Blog Archives</h2>
	<?php } ?>
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