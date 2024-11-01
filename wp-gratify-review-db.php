<?php
/*
 * review  DB
 * function to create table for this plugin activate
 * return void
*/
function wp_grv_create_plugin_database_table() {
	global $wpdb;
	$wp_grv_review_main_tbl_nm = $wpdb->prefix . 'wp_grv_review_main_tbl';// Table name.
	$charset_collate        = $wpdb->get_charset_collate();
	// Creating category listing tbl.
	$wp_grv_category_list_tbl_nm = $wpdb->prefix . 'wp_grv_category_list_tbl';// Table name.
	if ( $wpdb->get_var( "SHOW TABLES LIKE '$wp_grv_category_list_tbl_nm'" ) != $wp_grv_category_list_tbl_nm ) { // Checking category table exsist or not.
		$wp_grv_category_list_tbl = "CREATE TABLE IF NOT EXISTS $wp_grv_category_list_tbl_nm (
			category_id bigint(20) unsigned NOT NULL auto_increment,
			category_name varchar(50),
			category_slug varchar(50),
			category_description longtext, 
			schema_enable varchar(30),
			manual varchar(30),
			total_reviews varchar(30),
			overall_rating varchar(30),
			best_review varchar(30),                               
			PRIMARY KEY  (category_id) 
		) $charset_collate;";
		require_once ABSPATH . 'wp-admin/includes/upgrade.php';
		dbDelta( $wp_grv_category_list_tbl );
		$category_name        = 'General Category';
		$category_slug        = 'general-category';
		$category_description = 'default category';
		$wpdb->insert(
			$wp_grv_category_list_tbl_nm,
			array(
				'category_name'        => $category_name,
				'category_slug'        => $category_slug,
				'category_description' => $category_description,
				'schema_enable'        => 'null',
				'manual'               => 'null',
				'total_reviews'        => 'null',
				'overall_rating'       => 'null',
				'best_review'          => 'null',
			),
			array( '%s', '%s', '%s','%s', '%s', '%s','%s', '%s' )
		);
	}
	// Creating review invitation tbl.
	$wp_grv_review_invitation_tbl_nm = $wpdb->prefix . 'wp_grv_review_invitation_tbl';// Table name.
	$wp_grv_review_invitation_tbl    = "CREATE TABLE IF NOT EXISTS $wp_grv_review_invitation_tbl_nm (
		invitation_id bigint(20) unsigned NOT NULL auto_increment,
		email_id varchar(50),
	    status varchar(50),
	    rating varchar(50),
	    view_link varchar(100),
	    invited_date date,
	    re_invited_date date,
	    re_inviting_count bigint(20),
	    invite_code varchar(100),                               
		PRIMARY KEY  (invitation_id) 
	) $charset_collate;";
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $wp_grv_review_invitation_tbl );
	/* creating gmb_posts table */
	$wp_grv_gmb_posts = $wpdb->prefix . 'wp_grv_gmb_posts_tbl';// Table name.
	$wp_grv_gmb_posts_tbl    = "CREATE TABLE IF NOT EXISTS $wp_grv_gmb_posts(
		post_id bigint(20) unsigned NOT NULL auto_increment,
		post_type varchar(20),
	    data longtext,                          
		PRIMARY KEY  (post_id) 
	) $charset_collate;";
	require_once ABSPATH . 'wp-admin/includes/upgrade.php';
	dbDelta( $wp_grv_gmb_posts_tbl );

	// add_option( 'jal_db_version', $jal_db_version );
}//end wp_grv_create_plugin_database_table()
