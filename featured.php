<?php
$resim  = $wpdb->get_results(
    "
        SELECT * FROM ".$table_prefix."postmeta 
        LEFT OUTER JOIN ".$table_prefix."posts 
        ON ".$table_prefix."postmeta.post_id = ".$table_prefix."posts.id 
        WHERE ".$table_prefix."postmeta.meta_key='featured' 
        ORDER BY ".$table_prefix."postmeta.post_id DESC LIMIT 4
    ", 
    ARRAY_A
);
if (is_array($resim)) for ($j=0; $j<count($resim); $j++){
    $niphell = $resim[$j];
    $ust .= '
        <li class="ui-tabs-nav-item" id="nav-fragment-'.($j+1).'">
            <a href="#fragment-'.($j+1).'">
                <img src="'.$niphell[meta_value].'" width="120" height="90" alt="" />
            </a>
        </li>
    ';
    $alt .='
        <div id="fragment-'.($j+1).'" class="ui-tabs-panel" style="">
            '.get_post_meta($niphell[post_id], 'embed', true).'			
        </div>
    ';
}
echo '<!-- Wordpress Slider Plugin coded by NipHeLL bozlak216@gmail.com, WP 3.9/PHP 5.5.11 compat by elcodedocle gael.abadin at: gmail,com -->';		
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
