<?php
	/**
		* @package Access website
		* @version 5.0
	*/
	/*
		Plugin Name: Access website
		Plugin URI: https://websitepr.eu/
		Description: Save and save all the accesses you need for one or multiple sites and easily manage them, save for each website you have: site, site login, site username, site password, ftp, ftp username, ftp password, C-panel, C-panel username, C-panel password, Hosting url, hosting username, hosting password
		Version: 5.0
		Author URI: https://websitepr.eu/about/
	*/
	
	/*
	add_action('activated_plugin','save_error_all_access');
	
	function save_error_all_access(){
		file_put_contents(ABSPATH. 'wp-content/accesswebsite/error_all_access.html', ob_get_contents());
	}
	*/
	
	
	add_action('admin_menu', 'plugin_admin_all_sites_access');
	
	function plugin_admin_all_sites_access() {
		//http://codex.wordpress.org/Function_Reference/add_menu_page
		add_menu_page( 'All access website', 'All access website', 'manage_options', 'accesswebsite/upload/adminpage.php');
	}
	
	function my_all_sites_accesss($hook) {
		//only for our special plugin admin page
		if( 'accesswebsite/upload/adminpage.php' != $hook )
		return;	
		
		wp_register_style('accesswebsite', plugins_url('accesswebsite/upload/pluginpage.css'));
		wp_enqueue_style('accesswebsite');
		
		wp_enqueue_script('pluginscript', plugins_url('upload/pluginpage.js', __FILE__ ), array('jquery'));
	}
	
	add_action( 'admin_enqueue_scripts', 'my_all_sites_accesss' );
	
	function create_all_sites_accesss_database_table()
	{
		global $table_prefix, $wpdb;
		
		$tblname = 'wp_all_sites_accesss';
		$wp_track_table = $table_prefix . "$tblname ";
		
		#Check to see if the table exists already, if not, then create it
		
		if($wpdb->get_var( "show tables like '$wp_track_table'" ) != $wp_track_table) 
		{
			
			$sql = "CREATE TABLE IF NOT EXISTS `wp_all_sites_accesss` (";
			$sql .= "  `id` int(8) NOT NULL, ";
			$sql .= "  `site` varchar(55) NOT NULL,";
			$sql .= "  `site_login` varchar(55) NOT NULL, "; 
			$sql .= "  `site_user` varchar(55) NOT NULL,";
			$sql .= "  `site_pass` varchar(55) NOT NULL,";
			$sql .= "   `ftp` varchar(55) NOT NULL,";
			$sql .= "  `ftp_user` varchar(55) NOT NULL,"; 
			$sql .= "	`ftp_pass` varchar(55) NOT NULL,";
			$sql .= "	`cpanel` varchar(55) NOT NULL,";
			$sql .= " 	`cpanel_user` varchar(55) NOT NULL,";
			$sql .= "  `cpanel_pass` varchar(55) NOT NULL,"; 
			$sql .= "  `hosting` varchar(55) NOT NULL,";
			$sql .= "  `hosting_user` varchar(55) NOT NULL,";
			$sql .= "   `hosting_pass` varchar(55) NOT NULL,";
			$sql .= " PRIMARY KEY (`id`)"; 
			$sql .= ") ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=36 ;";
			require_once( ABSPATH . '/wp-admin/includes/upgrade.php' );
			dbDelta($sql);
		}
	}
	
register_activation_hook( __FILE__, 'create_all_sites_accesss_database_table' );