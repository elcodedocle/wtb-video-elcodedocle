<?php get_header(); ?>
<?
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'],FALSE ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); }
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
						<object width="442" height="356" type="application/x-shockwave-flash">
						<param name="movie" value="http://www.youtube.com/v/<?php $values = get_post_custom_values("youtubeid"); echo $values[0]; ?>?fs=1&amp;hl=en_US" />
						<param name="allowFullScreen" value="true" />
						<embed src="http://www.youtube.com/v/<?php $values = get_post_custom_values("youtubeid"); echo $values[0]; ?>?fs=1&amp;hl=en_US" type="application/x-shockwave-flash" allowfullscreen="true" width="442" height="356" />
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
							<script>function fbs_click() {u=location.href;t=document.title;window.open('http://www.facebook.com/sharer.php?u='+encodeURIComponent(u)+'&t='+encodeURIComponent(t),'sharer','toolbar=0,status=0,width=626,height=436');return false;}</script><a rel="nofollow" class="sh-face" href="http://www.facebook.com/sharer.php?u=<?php the_permalink(); ?>" onclick="return fbs_click()" target="_blank" title="Compartir en Facebook"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/sfacebook.gif" alt="Compartir en Facebook" /></a>
						</div>
						<div class="singleshare">
							<a rel="nofollow" target="_blank" class="sh-tweet" href="http://twitter.com/home?status=Escuchando%20<?php the_permalink(); ?>" title="Compartir en Twitter"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/stwitter.gif" alt="Compartir en Twitter" /></a>
						</div>
						<div class="singleshare">
							<a rel="nofollow" target="_blank" class="sh-su" href="http://www.stumbleupon.com/submit?url=<?php the_permalink(); ?>&amp;title=<?php urlencode(the_title('','',FALSE)); ?>" title="Compartir en Stumbleupon"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/sstumble.gif" alt="Compartir en Stumbleupon" /></a>
						</div>
						<div class="singleshare" style="margin: 0 auto; text-align: center;">
							<!-- Place this tag where you want the share button to render. -->
							<div class="g-plus" data-action="share" data-annotation="bubble" data-height="24"></div>
						</div>
					</div>
					
					<div class="videoinfo">

						<div class="postviewpart">
						<?php if(function_exists('the_views')) { the_views(); } ?>
						</div>
										
						<p><span style="font-weight:bold;">Categor&iacute;a:</span> <?php the_category(', ') ?></p>
					
						<?php the_tags( '<p><span style="font-weight:bold;">Tags:</span> ', ', ', '</p>'); ?>
						
						<p><span style="font-weight:bold;">Descripci&oacute;n del video:</span></p><?php the_content('Leer m&aacute;s&raquo;'); ?>
					
					</div>
					</div>
					</div>
			<?php endwhile; ?>
		</div>
		<div class="latestvideosb"></div>
	</div>

			<?php comments_template(); ?>
			
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

<?php include (TEMPLATEPATH . '/sidebar_single.php'); ?>

</div>

<?php get_footer(); ?>
