<?php get_header(); ?>
<?php 
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'],FALSE ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); }
}
?>

 <?php if ($tg_socials_disable == "false") { ?>	  
<div id="socialtop"></div>
<div id="social">
		  <?php if ($tg_72890_disable == "false") { ?>
		  <?php if ($tg_728_90) { ?>
	<div class="topad">
          <?php echo stripslashes($tg_728_90); ?>
	</div>
          <?php } else { ?>
	<div class="topad">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/72890.gif" alt="" />	
	</div>
          <?php } ?>
		  <?php } else { ?>
		  <?php } ?>
	<div class="socialbook">
		<ul>
			<li><a href="<?php echo $tg_twitter; ?>" title="Follow Us on Twitter"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/twitter.png" alt="Follow Us on Twitter" /></a></li>
			<li><a href="<?php echo $tg_facebook; ?>" title="Follow Us on Facebook"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/facebook.png" alt="Follow Us on Twitter" /></a></li>
			<li><a href="<?php echo $tg_linkedin; ?>" title="Follow Us on Linkedin"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/linkedin.png" alt="Follow Us on Twitter" /></a></li>
			<li><a href="<?php echo $tg_youtube; ?>" title="Follow Us on Youtube"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/youtube.png" alt="Follow Us on Twitter" /></a></li>
			<li><a href="<?php echo $tg_technorati; ?>" title="Follow Us on Technorati"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/technorati.png" alt="Follow Us on Twitter" /></a></li>
			<li><a href="<?php if ($tg_rssurl) { ?><?php echo $tg_rssurl; ?><?php } else { ?><?php bloginfo('rss2_url'); ?><?php } ?>" title="Follow Us by RSS"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/rss.png" alt="Follow Us on Twitter" /></a></li>
			<li><a href="<?php echo $tg_flickr; ?>" title="Follow Us on Flickr"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/flickr.png" alt="Follow Us on Twitter" /></a></li>
			<li><a href="<?php echo $tg_stumbleupon; ?>" title="Follow Us on Stumbleupon"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/stumbleupon.png" alt="Follow Us on Twitter" /></a></li>
		</ul>
	</div>
</div>
<div id="socialbottom"></div>
<?php } else { ?>
 <?php } ?>
		  
<div id="content">

<div class="postsbody">

<?php include (TEMPLATEPATH . "/featured.php"); ?> 

	<div class="latestpart">
		<h2>Nuevos Videos</h2>
		<div class="latestvideos">
			<?php $recent = new WP_Query("showposts=15&offset=0"); while($recent->have_posts()) : $recent->the_post();?>	
					<div class="latestvideo">
					<div class="latestname">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php $tit = html_entity_decode(the_title('','',FALSE),ENT_COMPAT,'UTF-8'); echo htmlentities(mb_substr($tit, 0, 20, 'UTF-8'),ENT_COMPAT,'UTF-8'); if (strlen($tit) > 20) echo " ..."; ?></a>
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

	<div class="latestpart">
		<h2>Videos Destacados</h2>
		<div class="latestvideos">
			<?php query_posts('v_sortby=views&v_orderby=desc&showposts=15') ?>

			<?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>	
					<div class="latestvideo">
					<div class="latestname">
						<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><?php $tit = html_entity_decode(the_title('','',FALSE),ENT_COMPAT,'UTF-8'); echo htmlentities(mb_substr($tit, 0, 20, 'UTF-8'),ENT_COMPAT,'UTF-8'); if (strlen($tit) > 20) echo " ..."; ?></a>
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
			<?php endwhile; else: ?><?php endif; ?>

			<?php wp_reset_query(); ?>	
		</div>
		<div class="latestvideosb"></div>
	</div>
</div>

<?php include (TEMPLATEPATH . '/sidebar_home.php'); ?>

</div>

<?php get_footer(); ?>
