<?php get_header(); ?>
<?
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<div id="content">

<div class="postsbody">
	
	<?php if (have_posts()) : ?>
	<div class="latestpart">
	<h2 class="pagetitle"><?php the_title(); ?></h2>

		<div class="latestvideos">

			<?php while (have_posts()) : the_post(); ?>	
					<div class="entry">
					
					<div class="videoarea">
					<div class="video">
						<?php if( get_post_meta($post->ID, "youtubeid", true) ): ?>
						<object width="442" height="356">
						<param name="movie" value="http://www.youtube.com/v/<?php $values = get_post_custom_values("youtubeid"); echo $values[0]; ?>?fs=1&amp;hl=en_US"></param>
						<param  name="allowFullScreen" value="true"></param>
						<embed  src="http://www.youtube.com/v/<?php $values = get_post_custom_values("youtubeid"); echo $values[0]; ?>?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowfullscreen="true" width="442" height="356"></embed>
						</object> 
						<?php else: ?>
						<?php $values = get_post_custom_values("sembed"); echo $values[0]; ?>
						<?php endif; ?>
					</div>
					
					<div class="videoright">
					
		<?if ($tg_200200_disable == "false") { ?>
		<? if ($tg_200_200) { ?>
			<div class="singlead">
				<? echo stripslashes($tg_200_200); ?>
			</div>
		<? } else { ?>
			<div class="singlead">
				<img src="<?php bloginfo('stylesheet_directory'); ?>/images/200200.gif" alt="" />
			</div>
		<? } ?>
		<? } else { ?>
		<? } ?>	
						<div class="singleshare">
							<script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><a rel="nofollow" class="sh-face" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" onclick="return fbs_click()" target="_blank" title="Click to share on Facebook"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/sfacebook.gif" alt="" /></a>
						</div>
						<div class="singleshare">
							<a rel="nofollow" target="_blank" class="sh-tweet" href="http://twitter.com/home?status=Currently watching <?php the_permalink(); ?>" title="Click to share on Twitter"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/stwitter.gif" alt="" /></a>
						</div>
						<div class="singleshare">
							<a rel="nofollow" target="_blank" class="sh-su" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&title=<?php the_title(); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/sstumble.gif" alt="" /></a>
						</div>
					</div>
					</div>
					
					<div class="videoinfo">

						<div class="postviewpart">
						<?php if(function_exists('the_views')) { the_views(); } ?>
						</div>
					
						<p><font style="font-weight:bold;">Published:</font> <?php echo time_ago(); ?></p>
					
						<p><font style="font-weight:bold;">Category:</font> <?php the_category(', ') ?></p>
					
						<?php the_tags( '<p><font style="font-weight:bold;">Tags:</font> ', ', ', '</p>'); ?>
						
						<p><font style="font-weight:bold;">Description:</font> <?php the_content(''); ?></p>
					
					</div>
					</div>
			<?php endwhile; ?>
		</div>
		<div class="latestvideosb"></div>
	</div>

			<?php comments_template(); ?>
			
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

<?php include (TEMPLATEPATH . '/sidebar_single.php'); ?>

</div>

<?php get_footer(); ?>