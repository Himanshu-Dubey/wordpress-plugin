<?php
/*
Plugin Name: Dynamic Strip Plugin
Plugin URI: http://wordpress.org/plugins/hello-dolly/
Description: Show custmize and dynamic notice strip on website Frontend 
Author: Himanshu Dubey
Version: 1.7.2
Author URI: 
*/


function create_strip_table()
{      
  global $wpdb; 
  $db_table_name = $wpdb->prefix . 'dynamic_strip';  // table name
  $charset_collate = $wpdb->get_charset_collate();

   if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
    {

  $sql = "CREATE TABLE $db_table_name (
                id int(11) NOT NULL auto_increment,
                strip_name varchar(100) NOT NULL,
                strip_visiblity BOOLEAN NOT NULL,
                strip_color varchar(20) NOT NULL,
                strip_height varchar(10) NOT NULL,
                button_color varchar(10) NOT NULL,
                button_size varchar(50) NOT NULL,
                button_label varchar(50) NOT NULL,
                button_link varchar(100) NOT NULL,
                message_body varchar(500) NOT NULL,
                message_text_color varchar(20) NOT NULL,
                created_date DATE NOT NULL,
                updated_date TIMESTAMP NOT NULL,
                PRIMARY KEY id (id)
        ) $charset_collate;";

   require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
   dbDelta( $sql );
   add_option( 'test_db_version', $test_db_version );
} 
}
register_activation_hook( __FILE__, 'create_strip_table' );


add_action( 'admin_menu', 'extra_post_info_menu' );  

function extra_post_info_menu(){    

	 $page_title = 'Dynamic Strip';  
	 $menu_title = 'Dynamic Strip';   
	 $capability = 'manage_options';   
	 $menu_slug  = 'dynamic-strips';   
	 $function   = 'opendynamicstrip_list';   
	 $icon_url   = 'dashicons-admin-appearance';   
	 $position   = 60;    


	 add_menu_page( $page_title,$menu_title,$capability,$menu_slug,$function,$icon_url,$position);


}



function prefix_enqueue() 
{       
    // JS
    wp_register_script('prefix_bootstrap', plugin_dir_url(__FILE__) .'assets/js/bootstrap.min.js');
    wp_enqueue_script('prefix_bootstrap');

    // CSS
    wp_register_style('prefix_bootstrap', plugin_dir_url(__FILE__) .'assets/css/bootstrap.min.css');
    wp_register_style('prefix_custom', plugin_dir_url(__FILE__) .'assets/css/custom.css');
    wp_enqueue_style(['prefix_bootstrap','prefix_custom']);
    
}

function opendynamicstrip_list()
	{	
	global $wpdb;
	$actions=isset($_GET['actions'])?trim ($_GET['actions']):"";  
	$strip_id=isset($_GET['strip_id'])? intval($_GET['strip_id']):"";
	if($actions=="add-page"){
		ob_start();
		prefix_enqueue();
		savedata();
		require_once __DIR__ . '/view/add_strip.php';

		$template = ob_get_contents();
		ob_clean();
			echo $template;
	}
	elseif($actions == "edit-page"){
		ob_start();
		prefix_enqueue();
		updatedata($strip_id);
		$data = getData($strip_id);
		require_once __DIR__ . '/view/edit_strip.php';

		$template = ob_get_contents();
		ob_clean();
			echo $template;
	}
	
	else {
	ob_start();
	require_once __DIR__ . '/inc/strip_list_function.php';
	$template = ob_get_contents();
	ob_clean();
	echo $template;
	}
}

function sample_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Done! Strip Created Successfully'); ?></p>
    </div>
    <?php
}



function sample_admin_notice__error() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Error! Please try after some time'); ?></p>
    </div>
    <?php
}


function update_admin_notice__success() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Done! Strip Data Updated Successfully'); ?></p>
    </div>
    <?php
}



function update_admin_notice__error() {
    ?>
    <div class="notice notice-success is-dismissible">
        <p><?php _e( 'Error! Please try after some time'); ?></p>
    </div>
    <?php
}



  

function savedata()
{
	
		global $wpdb;
	if(isset($_POST['submit'])) {
		$formArray = array();
		$db_table_name = $wpdb->prefix . 'dynamic_strip';
		$formArray['strip_name'] = $_POST['strip_name'];
		$formArray['strip_visiblity'] = $_POST['strip_visiblity'];
		$formArray['strip_color'] = $_POST['strip_color'];
		$formArray['strip_height'] = $_POST['strip_height'];
		$formArray['button_color'] = $_POST['button_color'];
		$formArray['button_size'] = $_POST['button_size'];
		$formArray['button_label'] = $_POST['button_label'];
		$formArray['button_link'] = $_POST['button_link'];
		$formArray['message_body'] = $_POST['strip_text'];
		$formArray['message_text_color'] = $_POST['strip_text_color'];
		$formArray['created_date'] = date('Y-m-d');


		$query = $wpdb->insert($db_table_name,$formArray,array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'));

		
		if($query)
		{
			
			add_action( 'admin_notices', 'sample_admin_notice__success' );
			
		}
		else
		{
			add_action( 'admin_notices', 'sample_admin_notice__error' );
		}


}

}


function getData($id)
{
	global $wpdb;
	$db_table_name = $wpdb->prefix . 'dynamic_strip';
	$query = $wpdb->get_row("select * from ".$db_table_name." where id=".$id);
	return $query;
}

function updatedata($id)
{
	
		global $wpdb;
	if(isset($_POST['update'])) {
		$formArray = array();
		$db_table_name = $wpdb->prefix . 'dynamic_strip';
		$formArray['strip_name'] = $_POST['strip_name'];
		$formArray['strip_visiblity'] = $_POST['strip_visiblity'];
		$formArray['strip_color'] = $_POST['strip_color'];
		$formArray['strip_height'] = $_POST['strip_height'];
		$formArray['button_color'] = $_POST['button_color'];
		$formArray['button_size'] = $_POST['button_size'];
		$formArray['button_label'] = $_POST['button_label'];
		$formArray['button_link'] = $_POST['button_link'];
		$formArray['message_body'] = $_POST['strip_text'];
		$formArray['message_text_color'] = $_POST['strip_text_color'];
		$formArray['created_date'] = date('Y-m-d');
		 

		$query = $wpdb->update($db_table_name,$formArray,array('id' => $id),array('%s','%s','%s','%s','%s','%s','%s','%s','%s','%s','%s'));

		
		if($query)
		{
			
			add_action( 'admin_notices', 'update_admin_notice__success' );
			
		}
		else
		{
			add_action( 'admin_notices', 'update_admin_notice__error' );
		}


}

}



function showStriptofrontend()
{
	ob_start();
	prefix_enqueue() ; ?>

	<?php 
	global $wpdb;
	$db_table_name = $wpdb->prefix . 'dynamic_strip';
	$query = $wpdb->get_row("select * from ".$db_table_name." order by id desc");
	$strip_style= "style=";
	$button = '';
	if($query->button_link)
	{
		$button = '<a href="'.$query->button_link.'"><button class="'.$query->button_size.'" style="background-color:'.$query->button_color.'!important;">'.$query->button_label.'</button></a>';
	}
	else 
	{
		$button = '<button class="'.$query->button_size.'" style="background-color:'.$query->button_color.'!important;">'.$query->button_label.'</button>';
	}
	if($query->strip_visiblity == 1){
		if($query->strip_height){
			$strip_style .= 'height:'.$query->strip_height.';';	
		}
		if($query->strip_color){
			$strip_style .= 'background-color:'.$query->strip_color.';';	
		}
		if($query->message_text_color){
			$strip_style .= 'color:'.$query->message_text_color.';';	
		}
		
		echo '<div id="tabstrip"'.$strip_style.'>'.$query->message_body.'   '.$button.' <b style="float:right;position: relative;
    top: -30px;
    right: 24px;
    font-size: 20px;"><a href="#" style="color:#fff;" onclick="myFunction();" >X</a></b></div>';
	} 
	
	$output = ob_get_contents();
	ob_end_clean();

	return $output;
}


   add_shortcode('dynamic-strip', 'showStriptofrontend');


?>