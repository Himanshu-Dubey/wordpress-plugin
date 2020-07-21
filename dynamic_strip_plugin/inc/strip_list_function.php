<?php
require_once( ABSPATH . 'wp-admin/includes/class-wp-list-table.php' );

class WPListtable extends WP_List_Table{
	//define data set for WP_List_Table=> data
	
	
	//prepare items, trim use basically extratdata ...remove
	public function prepare_items(){

		echo "<h1>All Dynamic Strip List</h1>";
		echo '<a href="'.admin_url( "admin.php?page=dynamic-strips&actions=add-page" ).'" class="page-title-action">Add New</a></br>';
		echo 'Paste this shortcode to show strip in head tag in theme header.php between PHP tags<br> <b style="font-size :15px;">echo do_shortcode("[dynamic-strip]")</b>';
		$orderby = isset($_GET['orderby'])?trim($_GET['orderby']):"";
		$order = isset($_GET['order'])?trim($_GET['order']):"";
		
		//search option.............................
		$Search_term =isset($_POST['s'])?trim($_POST['s']):"";
		
		$datas= $this->wp_list_data($orderby, $order, $Search_term);
		
//..................................pagination.........................................		
		$per_page=3;
		$current_page= $this->get_pagenum();
		$total_items= count($datas);
		$args=$this->set_pagination_args(array(
			"total_items"=> $total_items,
			"per_page" => $per_page
		));
		$this->items= array_slice($datas, (($current_page-1)*$per_page), $per_page);
		$columns = $this->get_columns();
		$this->_column_headers = array($columns);
	}
	//...........................data fatch from datbase..............
	public function wp_list_data($orderby='', $order='', $Search_term=''){
		global $wpdb;
		$db_table_name = $wpdb->prefix . 'dynamic_strip';
		//.......This query is for search purpose.....................
		if(!empty($Search_term)){
			$all_post= $wpdb->get_results(
				"SELECT * from $db_table_name WHERE strip_name LIKE '%$Search_term%'"
			);
			
		} 
		else{
		$all_post= $wpdb->get_results(
				"SELECT * from  $db_table_name  ORDER BY id DESC"
			);
			}
	//print_r($all_post);
		$posts_array= array();
			if(count($all_post)>0){
				foreach($all_post as $index=> $post){
					$posts_array[]= array(
							"id" => $post->id,
							"strip_name"=> $post->strip_name,
							"strip_visiblity"=> $post->strip_visiblity,
							"created_date"=> $post->created_date,
							"updated_date"=> $post->updated_date
					);
				}
			}
		//print_r($all_post);die;
		return $posts_array;
	}
	// get coloum
	public function get_columns() {
		$columns= array(
							"strip_name"=> "Name",
							"strip_visiblity"=> "Visiblity",							
							"created_date"=> "Created Date",
							"updated_date"=> "Updated Date"
		);
		return $columns;
	}
	// coloum default
	public function column_default($item, $column_name){
		switch($column_name){
			case 'strip_name';
			case 'strip_visiblity';
			case 'created_date';
			case 'updated_date';
			return $item[$column_name];
			default:
			return "No Value";
		}
	}
	//////.......View......................
	public function column_strip_name($strip_name){

		
		$actions = array (
				"Edit"=> "<a href='?page=".$_GET['page']."&actions=edit-page&strip_id=".$strip_name['id']."'>Edit</a>"
						);
		return sprintf('%1$s,%2$s',$strip_name["strip_name"],$this->row_actions($actions));
	}
}

	//................Show the data.......................
	function wp_showdata_list_table(){
		$wp_table=new WPListtable();
		$wp_table->prepare_items();
		//search box here...........................
		echo "<form method='post' name='frm_search_post' action='".$_SERVER['PHP_SELF']."?page='>";
		$wp_table->search_box("Search", "search_post_id");
		echo "</form>";
		$wp_table->display();
	}
		wp_showdata_list_table();
		




