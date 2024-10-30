<?php
/**
 * Plugin Name: HS Brand Logo Slider
 * Plugin URI: http://heliossolutions.in/
 * Description: Hs Brand Slider of your clients
 * Version: 2.1
 * Author: Helios Solutions
 * Author URI: http://heliossolutions.in/
 */
$options = array();

/* Activate  the plugin. */
register_activation_hook(__FILE__, 'hsbrand_plugin_activate');

function hsbrand_plugin_activate() {
    hs_brand_logo_creat_table();
}

/* Delete options on Uninstalling the plugin. */
function hsbrand_uninstall() {
    delete_option( 'hsbrand_settings' );
	hs_brand_logo_drop_table();
}

register_uninstall_hook( __FILE__, 'hsbrand_uninstall' );


function hsbrand_menu() {

    /*
     * 	Use the add_options_page function
     * 	add_options_page( $page_title, $menu_title, $capability, $menu-slug, $function ) 
     *
     */
    add_menu_page(
            'HS Brand Logo Slider', 'HS Brand Logo Slider', 'manage_options', 'hs-brand-logo-slider.php', 'hsbrand_options_page'
    );
	/*add_submenu_page(
            'hs-brand-logo-slider.php', 'HS Brand Logo Slider', 'Add New Logo' , 'manage_options', 'add-new-logo.php', 'hsbrand_options_page'
    );*/
}

add_action('admin_menu', 'hsbrand_menu');

function hsbrand_options_page() {

    if (!current_user_can('manage_options')) {

        wp_die('You do not have sufficient permissions to access this page.');
    }

    global $options;
	global $wpdb;
    $table_name = $wpdb->prefix . "hs_brand_logo";
	
	
	/*To Save Data*/
	if (isset($_POST['submit_data'])) {
	
		$image_file_path = "../wp-content/uploads/";
		$logourl = esc_html($_POST['logourl']);
		$brandname = esc_html($_POST['brandname']);
		$sortorder = esc_html($_POST['sortorder']);
		
		if ($_FILES["logoupload"]["name"] != "") {

					if (
							($_FILES["logoupload"]["type"] == "image/gif")
							|| ($_FILES["logoupload"]["type"] == "image/jpeg")
							|| ($_FILES["logoupload"]["type"] == "image/jpg")
							|| ($_FILES["logoupload"]["type"] == "image/pjpeg")
							|| ($_FILES["logoupload"]["type"] == "image/png")
							&& ($_FILES["logoupload"]["size"] < 1024 * 1024 * 1)) {
						if ($_FILES["logoupload"]["error"] > 0) {
							$err .= "Return Code: " . $_FILES["logoupload"]["error"]. "<br />";
						} else {
							$image_file_name = time() . '_' . $_FILES["logoupload"]["name"];
							$fstatus = move_uploaded_file($_FILES["logoupload"]["tmp_name"], $image_file_path . $image_file_name);
							if ($fstatus == true) {
								$msg = "File Uploaded Successfully!!!" . "<br />";
							}
						}
					} else {
						$err = "Invalid file type or max file size exceded" . "<br />";
					}
				}
		
		
		$insert =  "INSERT INTO `" . $table_name . "` (`company_name`,`logourl`,`image`,`sortorder`) 
					VALUES	
					('".$brandname."','".$logourl."','".$image_file_name."','".$sortorder."')";
		$insert_result = $wpdb->query($insert);
		if($insert_result == 1){
			error_reporting(0);
			header("Location:admin.php?page=hs-brand-logo-slider.php&add=1");
		}
	}
	// Update Data
	if (isset($_POST['update_data'])) {
	
		$image_file_path = "../wp-content/uploads/";
		$logourl = esc_html($_POST['logourl']);
		$brandname = esc_html($_POST['brandname']);
		$sortorder = esc_html($_POST['sortorder']);
		
		if ($_FILES["logoupload"]["name"] != "") {

					if (
							($_FILES["logoupload"]["type"] == "image/gif")
							|| ($_FILES["logoupload"]["type"] == "image/jpeg")
							|| ($_FILES["logoupload"]["type"] == "image/jpg")
							|| ($_FILES["logoupload"]["type"] == "image/pjpeg")
							|| ($_FILES["logoupload"]["type"] == "image/png")
							&& ($_FILES["logoupload"]["size"] < 1024 * 1024 * 1)) {
						if ($_FILES["logoupload"]["error"] > 0) {
							$err .= "Return Code: " . $_FILES["logoupload"]["error"]. "<br />";
						} else {
							$image_file_name = time() . '_' . $_FILES["logoupload"]["name"];
							$fstatus = move_uploaded_file($_FILES["logoupload"]["tmp_name"], $image_file_path . $image_file_name);
							if ($fstatus == true) {
								$msg = "File Uploaded Successfully!!!" . "<br />";
							}
						}
					} else {
						$err = "Invalid file type or max file size exceded" . "<br />";
					}
				}
		if($_FILES["logoupload"]["name"] != ""){
			$update = "update ".$table_name." SET company_name = '".$brandname."', logourl = '".$logourl."', image = '".$image_file_name."', sortorder = ".$sortorder." WHERE id = ".$_GET['id']." ";
		}
		else
		{
			$update = "update ".$table_name." SET company_name = '".$brandname."', logourl = '".$logourl."', sortorder = ".$sortorder." WHERE id = ".$_GET['id']." ";
		}
		
		$update_result = $wpdb->query($update);
		if($update_result == 1){
			header("Location:admin.php?page=hs-brand-logo-slider.php&edit=1");
		}
	}
	
	/*To Save Settings*/
	if (isset($_POST['save_settings'])) {
		$autoplay = esc_html($_POST['autoplay']);
		$stoponhover = esc_html($_POST['stoponhover']);
		$default_items = esc_html($_POST['default_items']);
		$autoplay_time = esc_html($_POST['autoplay_time']);
		$responsive = esc_html($_POST['responsive']);
		$pagination = esc_html($_POST['pagination']);
		$navigation = esc_html($_POST['navigation']);
		$touchdrag = esc_html($_POST['touchdrag']);
		$mousedrag = esc_html($_POST['mousedrag']);
		$default_items_desktop = esc_html($_POST['default_items_desktop']);
		$default_items_small = esc_html($_POST['default_items_small']);
		$default_items_tablet = esc_html($_POST['default_items_tablet']);
		$default_items_mobile = esc_html($_POST['default_items_mobile']);
		
		$options['hsbrand_autoplay'] = $autoplay;
		$options['stoponhover'] = $stoponhover;
		$options['hsbrand_default_items'] = $default_items;
		$options['autoplay_time'] = $autoplay_time;
		$options['responsive'] = $responsive;
		$options['pagination'] = $pagination;
		$options['navigation'] = $navigation;
		$options['touchdrag'] = $touchdrag;
		$options['mousedrag'] = $mousedrag;
		$options['default_items_desktop'] = $default_items_desktop;
		$options['default_items_small'] = $default_items_small;
		$options['default_items_tablet'] = $default_items_tablet;
		$options['default_items_mobile'] = $default_items_mobile;
		update_option('hsbrand_settings', $options);
	}
	
	/*Get Saved Settings*/
	$options = get_option('hsbrand_settings');
	if ($options != '') {
		 $autoplay_option = $options['hsbrand_autoplay'];
		 $stoponhover_option = $options['stoponhover'];
		 $default_items_option = $options['hsbrand_default_items'];
		 $autoplay_time_option = $options['autoplay_time'];
		 $responsive_option = $options['responsive'];
		 $pagination_option = $options['pagination'];
		 $navigation_option = $options['navigation'];
		 $touchdrag_option = $options['touchdrag'];
		 $mousedrag_option = $options['mousedrag'];
		 $default_items_desktop_option = $options['default_items_desktop'];
		 $default_items_small_option = $options['default_items_small'];
		 $default_items_tablet_option = $options['default_items_tablet'];
		 $default_items_mobile_option = $options['default_items_mobile'];
	}
	
	/*Logo Listing*/
	
	$select = "SELECT * FROM " . $table_name . " ORDER BY ID DESC";
	$select_result = $wpdb->get_results($select);
	//print_r($select_result);
	$upload_dir = wp_upload_dir();
	$image_file_path = $upload_dir['baseurl'];
	
	/*Delete Logo*/
	if (isset($_GET['delete'])) {
		if ($_REQUEST['del_id'] != '') {
			$delete = "DELETE FROM " . $table_name . " WHERE id = " . $_REQUEST['del_id'] . " LIMIT 1";
			$results = $wpdb->query($delete);
			header("Location:admin.php?page=hs-brand-logo-slider.php&del=1");
		}
	}
	
	require( 'inc/hs-brand-option-page.php' );
}

/* Load CSS and Javascript for plugin */

function hsbrand_frontend_scripts_and_styles() {
	
	// Load CSS
	wp_enqueue_style('owl-css', plugins_url( 'inc/css/owl.carousel.css', __FILE__ ));
	wp_enqueue_style('owl-theme', plugins_url( 'inc/css/owl.theme.css', __FILE__ ));
    wp_enqueue_style('main-style-brand', plugins_url( 'inc/css/hs-brand.css', __FILE__ ));
	
	// Load JS
	
	wp_enqueue_script('owl.carousel.min', plugins_url('inc/js/owl.carousel.min.js', __FILE__ ), array(), '1', true);
}

add_action('wp_enqueue_scripts', 'hsbrand_frontend_scripts_and_styles');

function hsbrand_backend_scripts_and_styles() {
	wp_enqueue_style('main-style', plugins_url('inc/css/hs-brand.css', __FILE__ ));
}
add_action('admin_head', 'hsbrand_backend_scripts_and_styles');

/*
 * Add [hs-brand] shortcode
 *
 */

function hs_brand_shortcode($atts, $content = null) {

    extract(shortcode_atts(array(
				), $atts));

    ob_start();
	
	global $wpdb;
    $table_name = $wpdb->prefix . "hs_brand_logo";
	$finaldiv = "";
	$selectQuery = 'select * from '.$table_name . ' ORDER BY sortorder ASC';
	$result = $wpdb->get_results($selectQuery);
	
	$upload_dir = wp_upload_dir();
    $image_file_path = $upload_dir['baseurl'];
	$finaldiv =  '<div class="hs-brand-logo-slider-list">';
	foreach($result as $row){
		$image_url = $image_file_path . '/' . $row->image;
		$company_name = $row->company_name;
		$logourl = $row->logourl;
		if(str_replace(' ', '', $logourl) == ''){
			$brandurl = 'javascript:void(0)';
		}else{
			$brandurl = esc_url($logourl);
		}
		$finaldiv .= '<div class="hs-brand-logo-item item"><a href="'.$brandurl.'" target="blank"> <img src="'.$image_url.'" alt="'.$company_name.'" title="'.$company_name.'"></a></div>';
	}
	$finaldiv .= '</div>';
	return $finaldiv;
}
add_shortcode("hs-brand", "hs_brand_shortcode");

/**
 * Enqueue link to add CSS through PHP
 */
function hsbrand_register_style() {
        wp_register_style( 'hscss_style', '/?hscss=1' );
        wp_enqueue_style( 'hscss_style' );
}

add_action( 'wp_enqueue_scripts', 'hsbrand_register_style', 99 );
 
 /* Create Table on plugin activate */

function hs_brand_logo_creat_table() {
    global $wpdb;
    $table_name = $wpdb->prefix . "hs_brand_logo";
    if ($wpdb->get_var("show tables like '$table_name'") != $table_name) {

    $create_table = "CREATE TABLE " . $table_name . " (
	`id` BIGINT(20) NOT NULL AUTO_INCREMENT, 
	`company_name` VARCHAR(255) NULL,
	`logourl` VARCHAR(255) NULL, 
	`image` VARCHAR(255) NULL, 
	`sortorder` INT NOT NULL DEFAULT '0',
    PRIMARY KEY (`id`)) ENGINE = InnoDB;";
    }
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($create_table);
}

/* DROP table on plugin deactivate */

function hs_brand_logo_drop_table() {
    global $table_prefix, $table_suffix, $wpdb;
    $table_name = $wpdb->prefix . "hs_brand_logo";
    $wpdb->query("DROP TABLE {$table_name}");
}

// Add settings link on plugin page
function hs_brand_plugin_settings_link($links) { 
  $settings_link = '<a href="admin.php?page=hs-brand-logo-slider.php">Settings</a>'; 
  array_unshift($links, $settings_link); 
  return $links; 
}
$plugin = plugin_basename(__FILE__); 
add_filter("plugin_action_links_$plugin", 'hs_brand_plugin_settings_link' );
?>
<?php
function hsbrand_setting_function() {
$options = get_option('hsbrand_settings');
	if ($options != '') {
		 $autoplay_option = $options['hsbrand_autoplay'];
		 $stoponhover_option = $options['stoponhover'];
		 $default_items_option = $options['hsbrand_default_items'];
		 $autoplay_time_option2 = $options['autoplay_time'];
		 $responsive_option = $options['responsive'];
		 $pagination_option = $options['pagination'];
		 $navigation_option = $options['navigation'];
		 $touchdrag_option = $options['touchdrag'];
		 $mousedrag_option = $options['mousedrag'];
		 $default_items_desktop_option = $options['default_items_desktop'];
		 $default_items_small_option = $options['default_items_small'];
		 $default_items_tablet_option = $options['default_items_tablet'];
		 $default_items_mobile_option = $options['default_items_mobile'];
	}
?>
<script>
jQuery(document).ready(function() {
    jQuery(".hs-brand-logo-slider-list").owlCarousel({
     <?php if($autoplay_option == 'yes' ) {
			if($options['autoplay_time'] == ''){
	 ?>
		autoPlay: 3000, //Set AutoPlay to 3 seconds
	<?php 
		}else{
		?>
		autoPlay: <?php echo $autoplay_time_option2; ?>, //Set AutoPlay to 3 seconds
	<?php 
		}
	} ?>
		items : <?php if(trim($default_items_option) == '') {echo "3";} else {echo $default_items_option;} ?>,
		itemsDesktop : [1199,<?php if(trim($default_items_desktop_option) == '') {echo "3";} else {echo $default_items_desktop_option;} ?>],
		itemsDesktopSmall : [980,<?php if(trim($default_items_small_option) == '') {echo "3";} else {echo $default_items_small_option;} ?>],
		itemsTablet 	: [768,<?php if(trim($default_items_tablet_option) == '') {echo "3";} else {echo $default_items_tablet_option;} ?>],
		itemsMobile 	: [480,<?php if(trim($default_items_mobile_option) == '') {echo "2";} else {echo $default_items_mobile_option;} ?>],
		pagination : <?php if(trim($pagination_option) == '') {echo "false";} else {echo "true";} ?>,
		stopOnHover : <?php if(trim($stoponhover_option) == '') {echo "false";} else {echo "true";} ?>,
		responsive : <?php if(trim($responsive_option) == '') {echo "false";} else {echo "true";} ?>,
		navigation : <?php if(trim($navigation_option) == '') {echo "false";} else {echo "true";} ?>,
		mouseDrag : <?php if(trim($mousedrag_option) == '') {echo "true";} else {echo "false";} ?>,
		touchDrag : <?php if(trim($touchdrag_option) == '') {echo "true";} else {echo "false";} ?>,
		itemsScaleUp : true
    });
});
</script>
<?php }
add_action('wp_footer', 'hsbrand_setting_function');
?>