<div class="sidebar_right">
<?
global $options;
foreach ($options as $value) {
    if (get_option( $value['id'],FALSE ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_option( $value['id'] ); }
}
?>
		  <?if ($tg_300250_disable == "false") { ?>
		  <? if ($tg_300_250) { ?>
	<div class="rightad">
          <? echo stripslashes($tg_300_250); ?>
	</div>
          <? } else { ?>
	<div class="rightad">
		<img src="<?php bloginfo('stylesheet_directory'); ?>/images/300250.gif" alt="" />
	</div>
          <? } ?>
		  <? } else { ?>
		  <? } ?>
	
	<ul class="randomvideos">
		<li><h3>RECOMENDADAS</h3>
			<ul>
		<?php $recent = new WP_Query("showposts=6&orderby=rand"); while($recent->have_posts()) : $recent->the_post();?>
			<li><div class="singleright">
				<div class="singlerightimage">
					<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><img src="<?php $values = get_post_custom_values("thumb"); echo $values[0]; ?>" width="136" height="90" alt="<?php the_title_attribute(); ?>" /></a>
				</div>
				<div class="singlerighti">
					<div class="singlerightinfo">
						<a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php $tit = html_entity_decode(the_title('','',FALSE),ENT_COMPAT,'UTF-8'); echo htmlentities(mb_substr($tit, 0, 17, 'UTF-8'),ENT_COMPAT,'UTF-8'); if (strlen($tit) > 17) echo " ..."; ?></a>
					</div>
					<div class="postviews">
						<?php the_time('j \d\e F, Y') ?>  
					</div>
					<div class="postviews">
						<?php if(function_exists('the_views')) { the_views(); } ?>  
					</div>
				</div>
			</div></li>
		<?php endwhile; ?>
			</ul>
		</li>
	</ul>	
	
<?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar() ) : ?>

	<ul class="widget_categories">
		<li><h3>Categories</h3>
			<ul>
				<?php $categories = wp_list_categories('echo=0&title_li=');
$categories = preg_replace('/View all posts filed under /','',$categories);
echo $categories; ?>
			</ul>
		</li>
	</ul>
	
	<ul>
		<li><h3>Latest Comments</h3>
<?php
global $wpdb;
$sql = "SELECT DISTINCT ID, post_title, post_password, comment_ID,
comment_post_ID, comment_author, comment_date_gmt, comment_approved,
comment_type,comment_author_url,
SUBSTRING(comment_content,1,30) AS com_excerpt
FROM $wpdb->comments
LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID =
$wpdb->posts.ID)
WHERE comment_approved = '1' AND comment_type = '' AND
post_password = ''
ORDER BY comment_date_gmt DESC
LIMIT 10";
$comments = $wpdb->get_results($sql);
$output = $pre_HTML;
$output .= "\n<ul>";
foreach ($comments as $comment) {
$output .= "\n<li>".strip_tags($comment->comment_author)
.":" . " <a href=\"" . get_permalink($comment->ID) .
"#comment-" . $comment->comment_ID . "\" title=\"on " .
$comment->post_title . "\">" . strip_tags($comment->com_excerpt)
."</a>...</li>";
}
$output .= "\n</ul>";
$output .= $post_HTML;
echo $output;?>
		</li>
	</ul>
			<?php /* If this is the frontpage */ if ( is_home() || is_page() ) { ?>
	<ul>
		<li><h3>Blogroll</h3>
			<ul>		
				<?php wp_list_bookmarks('title_li=&categorize=0'); ?>
			</ul>
		</li>
	</ul>
	<ul>
		<li><h3>Meta</h3>
				<ul>
					<?php wp_register(); ?>
					<li><?php wp_loginout(); ?></li>
					<li><a href="http://validator.w3.org/check/referer" title="This page validates as XHTML 1.0 Transitional">Valid <abbr title="eXtensible HyperText Markup Language">XHTML</abbr></a></li>
					<li><a href="http://gmpg.org/xfn/"><abbr title="XHTML Friends Network">XFN</abbr></a></li>
					<li><a href="http://wordpress.org/" title="Powered by WordPress, state-of-the-art semantic personal publishing platform.">WordPress</a></li>
					<?php wp_meta(); ?>
			</ul>
		</li>
	</ul>
			<?php } ?>
	
<?php endif; ?>
</div>
