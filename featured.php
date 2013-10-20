<?php
$resim 	= mysql_query("SELECT * FROM ".$table_prefix."postmeta LEFT OUTER JOIN ".$table_prefix."posts ON ".$table_prefix."postmeta.post_id = ".$table_prefix."posts.id Where ".$table_prefix."postmeta.meta_key='featured' ORDER By ".$table_prefix."postmeta.post_id DESC Limit 4");
		for ($j=0; $niphell=mysql_fetch_array($resim); $j++){
		$ust .= '<li class="ui-tabs-nav-item" id="nav-fragment-'.($j+1).'"><a href="#fragment-'.($j+1).'"><img src="'.$niphell[meta_value].'" width="120" height="90" alt="" /></a></li>
			';
		$alt .='<div id="fragment-'.($j+1).'" class="ui-tabs-panel" style="">
'.get_post_meta($niphell[post_id], 'embed', true).'			
	    </div>
			';
		}
echo '<!-- Wordpress Slider Plugin coded by NipHeLL bozlak216@gmail.com -->';		
?>
<div class="feattop"></div>
<div id="feat">
<div id="featured">
		  <ul class="ui-tabs-nav">
	        <?php echo $ust;?> 
			</ul>
			<?php echo $alt;?> 
</div>
</div>
<div class="featbottom"></div>