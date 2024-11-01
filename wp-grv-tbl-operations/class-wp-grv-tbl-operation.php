<?php

class Wp_Grv_Tbl_Operation
{
	/**
	 * function for gmb error login reset
	 * return void
	 * @author Ek
	 */ 
	public static function wp_grv_gmb_ajax_login_reset_fun(){
		/* clear login details */
	  	$gmb_fetch_sett 	= get_option('gmb_settings');
	  	if(isset($gmb_fetch_sett)){
		  	$gmb_id 			= $gmb_fetch_sett['gmb_id'];
		  	$gmp_settings_dat 	= array(
					'gmb_id'             => $gmb_id,
					'gmb_status'         => '0',
					'token_time'         => 'null',
					'token_refresh_time' => 'null',
				);
			$gmb_location_settings_dat = array(
					'gmb_location'      => 'null',
					'gmb_location_name' => 'null',
				);
			update_option( 'wp_grv_gmb_location_settings', $gmb_location_settings_dat );
			update_option( 'gmb_settings', $gmp_settings_dat );
		}
		exit();
	}	
	/**
	 * function for gmb review replay
	 * return void
	 */ 
	public static function wp_grv_rv_gmb_replay_fun(){
	 	$wp_grv_replay_val 		= $_POST['wp_grv_replay_val'];
	 	$wp_grv_single_rv_id	= $_POST['wp_grv_single_rv_id'];
	 	$update_flag = 'false';
	 	global $wpdb;
		$comment_tbl 			= $wpdb->prefix . 'comments';
		$comment_tbl_data 		= $wpdb->get_row( " SELECT * FROM $comment_tbl WHERE comment_type='mid_review' AND comment_ID=$wp_grv_single_rv_id ",ARRAY_A);
			$rv_author_fetch 			= $value_comment_tbl_data['comment_author'];
			$rv_date_fetch 				= $value_comment_tbl_data['comment_date'];
			$rv_approved 				= $value_comment_tbl_data['comment_approved'];
			$key 						= "comment_extras";
			$comment_meta_data_fetch 	= get_comment_meta( $wp_grv_single_rv_id, $key );
			foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
				$rv_title 					= $comment_meta_data_fetch_value['review_title'];
				$rv_user_image 				= $comment_meta_data_fetch_value['review_user_image'];
				$rv_done_on_fetch 			= $comment_meta_data_fetch_value['review_done_on'];
				$rv_location 				= $comment_meta_data_fetch_value['review_location'];
				$rv_location_name 			= $comment_meta_data_fetch_value['review_location_name'];
				$rv_done_via 	 			= $comment_meta_data_fetch_value['review_done_via'];
				$rv_category_fetch 			= $comment_meta_data_fetch_value['review_add_category'];
				$rv_rating_fetch 			= $comment_meta_data_fetch_value['review_rating'];
				$rv_read_flag 	 			= $comment_meta_data_fetch_value['review_read_flag'];
				$rv_notification_flag 		= $comment_meta_data_fetch_value['review_notification_flag'];
				$rv_gmb_id 					= $comment_meta_data_fetch_value['review_gmb_id'];
				$rv_duplicate_details_check = $comment_meta_data_fetch_value['review_duplicate_details_check'];
				$rv_duplicate_name			= $comment_meta_data_fetch_value['review_duplicate_name'];
				$rv_duplicate_reason		= $comment_meta_data_fetch_value['review_duplicate_reason'];
			}
			$comment_meta_table_data = array(
				'review_title'             			=> $rv_title,
				'review_user_image'        			=> $rv_user_image,
				'review_done_on'           			=> $rv_done_on_fetch,
				'review_location'           		=> $rv_location,
				'review_location_name'           	=> $rv_location_name,
				'review_done_via'          			=> $rv_done_via,
				'review_add_category'      			=> $rv_category_fetch,
				'review_rating'            			=> $rv_rating_fetch,
				'review_read_flag'         			=> $rv_read_flag,
		  		'review_notification_flag' 			=> $rv_notification_flag,
		  		'review_gmb_id'        	   			=> $rv_gmb_id,
		  		'review_duplicate_details_check' 	=> $rv_duplicate_details_check,
				'review_duplicate_name'         	=> $rv_duplicate_name,
				'review_duplicate_reason'        	=> $rv_duplicate_reason,
				'review_gmb_replay'        			=> $wp_grv_replay_val
			);
		    update_comment_meta( $wp_grv_single_rv_id, "comment_extras", $comment_meta_table_data );
		    /* gmb review replay send to google */
		    $gmb_fetch_sett = get_option('gmb_settings');
			$gmb_id         = $gmb_fetch_sett['gmb_id'];
			$curl 			= curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: */*",
			    "Accept-Encoding: gzip, deflate",
			    "Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Host: wpgratify.com",
			    "cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$json_acess_token_data = trim($response, '"');

			$gmb_fetch_loc_sett = get_option('wp_grv_gmb_location_settings');
			$gmb_location 	= $gmb_fetch_loc_sett['gmb_location'];
		    $query 			= array('comment' => $wp_grv_replay_val);
		    $request_uri 	= "https://mybusiness.googleapis.com/v4/".$gmb_location."/reviews/".$rv_gmb_id."/reply?access_token=" . $json_acess_token_data;
		    $curinit 		= curl_init($request_uri);
		    curl_setopt($curinit, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($curinit, CURLOPT_CUSTOMREQUEST, 'PUT');
		    curl_setopt($curinit, CURLOPT_POSTFIELDS, json_encode($query));
		    curl_setopt($curinit, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curinit, CURLOPT_HTTPHEADER, array(
		      'Content-Type: application/json',
		      'Content-Length: ' . strlen(json_encode($query)))
		    );
		    $json = curl_exec($curinit);
		    $phpObj = json_decode($json, true);
		    var_dump($phpObj);
	 	exit();
	}
	 /*
	  * function for insert gmb reviews to db 
	  * return void
	 */ 
	public static function wp_grv_gmb_fetch_rv_to_db_fun(){
	 	$wp_grv_gmb_fetch_reviews 		= $_POST['wp_grv_gmb_fetch_reviews'];
	 	$wp_grv_num_reviews 	  		= filter_input(INPUT_POST,'wp_grv_num_reviews');
	 	$location_path 	  				= filter_input(INPUT_POST,'location_path');
	 	$review_intake_fetch_settings 	= get_option('review_intake_settings');
		$wp_grv_default_user_image 		= $review_intake_fetch_settings['user_image'];
		$wp_grv_enable_rating    		= $review_intake_fetch_settings['display_with_rating'];
	 	$wp_grv_auto_post_check 		= $review_intake_fetch_settings['auto_post'];
		$gmb_loc 						= get_option( 'wp_grv_gmb_location_settings' );
		$wp_grv_selected_locations_db   = $gmb_loc['gmb_selected_locations'];//gmb selected locations
		$wp_grv_selected_location_count = count($wp_grv_selected_locations_db);
		/* fetch gmb reviews */
					global $wpdb;
					$comment_tbl 			= $wpdb->prefix . 'comments';
					$comment_tbl_data 		= $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC",ARRAY_A);
					foreach ($comment_tbl_data as $value_comment_tbl_data){
						$rv_id_fetch 				= $value_comment_tbl_data['comment_ID'];
						$rv_author_fetch 			= $value_comment_tbl_data['comment_author'];
						$rv_date_fetch 				= $value_comment_tbl_data['comment_date'];
						$rv_approved 				= $value_comment_tbl_data['comment_approved'];
						$key 						= "comment_extras";
						$comment_meta_data_fetch 	= get_comment_meta( $rv_id_fetch, $key );
						foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
							$rv_title 				= $comment_meta_data_fetch_value['review_title'];
							$rv_rating_fetch 		= $comment_meta_data_fetch_value['review_rating'];
							$rv_category_fetch 		= $comment_meta_data_fetch_value['review_add_category'];
							$rv_done_on_fetch 		= $comment_meta_data_fetch_value['review_done_on'];
							$review_location 		= $comment_meta_data_fetch_value['review_location'];
							$review_location_name 	= $comment_meta_data_fetch_value['review_location_name'];
							$rv_gmb_id 				= $comment_meta_data_fetch_value['review_gmb_id'];
						}
						if($review_location === $location_path){
							break;//last gmb review found then break the for loop.
						}
					}
					for($i=0;$i<$wp_grv_num_reviews;$i++){//for taking count of updated reviews.
						$review_details_update 	= $wp_grv_gmb_fetch_reviews['reviews'][$i];
		 				$review_post_id_update 	= $review_details_update['reviewId'];
		 				if($rv_gmb_id === $review_post_id_update){
		 					break;
		 				}
					}
					if($i != 0){
						$number_of_new_reviews = $i - 1;
						$update_flag = 'true';
					}
					else{
						$number_of_new_reviews = 0;
					}
					for($j=$number_of_new_reviews;$j>=0;$j--){
							//insert gmb reviews
							$review_details 	= $wp_grv_gmb_fetch_reviews['reviews'][$j];
		 					$review_post_id 	= $review_details['reviewId'];
		 					$review_name 		= $review_details['reviewer']['displayName'];
		 					$review_content 	= isset($review_details['comment']) ? $review_details['comment'] : ' ';
		 					$fetch_review_date 	= $review_details['createTime'];
							$fetch_review_date2 = substr($fetch_review_date, 0, strpos($fetch_review_date, "."));
							$review_date_con 	= strtolower(str_replace('T', ' ', substr($fetch_review_date2, 0, 30)));
							$converted_date 	= strtotime($review_date_con);
							$review_date 		= date('Y-m-d H:i:s ',$converted_date); 
		 					$reviewer_img 		= $review_details['reviewer']['profilePhotoUrl'];
		 					$review_replay 		= isset($review_details['reviewReply']['comment'])?$review_details['reviewReply']['comment']:'';
		 					$reviewer_rating 	= $review_details['starRating'];
		 					$review_title 		= substr( $review_content, 0, 20);
		 					if($reviewer_rating === 'FIVE'){
		 						$add_rv_rating	= '5';
		 					}
		 					else if($reviewer_rating === 'FOUR'){
		 						$add_rv_rating	= '4';
		 					}
		 					else if($reviewer_rating === 'THREE'){
		 						$add_rv_rating	= '3';
		 					}
		 					else if($reviewer_rating === 'TWO'){
		 						$add_rv_rating	= '2';
		 					}
		 					else if($reviewer_rating === 'ONE'){
		 						$add_rv_rating	= '1';
		 					}	
		 					else{
		 						$add_rv_rating	= '5';
		 					}
		 					//check approval.
		 					if(($wp_grv_auto_post_check === 'true') && ($wp_grv_enable_rating === 'all') && (($add_rv_rating === '1') || ($add_rv_rating === '2') || ($add_rv_rating === '3') || ($add_rv_rating === '4') || ($add_rv_rating === '5')) ){
								$add_approve_stat = "true";
							}
							else if(($wp_grv_auto_post_check === 'true') && ($wp_grv_enable_rating === 'below3') && (($add_rv_rating === '1') || ($add_rv_rating === '2')) ){
								$add_approve_stat = "true";
							}
							else if(($wp_grv_auto_post_check === 'true') && ($wp_grv_enable_rating === '3andabove') && (($add_rv_rating === '3') || ($add_rv_rating === '4') || ($add_rv_rating === '5')) ){
								$add_approve_stat = "true";
							}
							else if(($wp_grv_auto_post_check === 'true') && ($wp_grv_enable_rating === '4to5') && (($add_rv_rating === '4') || ($add_rv_rating === '5')) ){
								$add_approve_stat = "true";
							}
							else{
								$add_approve_stat = "false";
							}
							$rv_type		    = "wp_grv_review";
							if($rv_gmb_id === $review_post_id){
								break;// if last inserted gmb found terminate process.
							}
							else{
								$comment_table_data = array(
								  	'comment_author'         => $review_name,
							  		'comment_author_email'   => 'null',
							  		'comment_content'        => $review_content,
							  		'comment_date'		     => $review_date,
							  		'comment_approved'	     => $add_approve_stat,
							  		'comment_type'		     => $rv_type
								);
								$id = wp_insert_comment($comment_table_data);
								$comment_id = $id;
								//checking upload image exisist or not
								if($reviewer_img === ""){
								  $wp_grv_user_image = $wp_grv_default_user_image;   
								}
								else{
								  $wp_grv_user_image = $reviewer_img;
								}
								if($location_path != ''){
									$gmb_loc 						= get_option( 'wp_grv_gmb_location_settings' );
								 	$wp_grv_selected_locations_db   = $gmb_loc['gmb_selected_locations'];
								 	foreach ($wp_grv_selected_locations_db as $key => $value) {
								 		if($value == $location_path){
								 			$location_path_name = $key;
								 			break;
								 		}else{
								 			$location_path_name = '';
								 		}
								 	}
								} 	
							$rv_read_flag      = $comment_meta_data_fetch_value['review_read_flag'];
								$comment_meta_table_data = array(
									'review_title'             			=> $review_title,
									'review_user_image'        			=> $wp_grv_user_image,
									'review_done_on'           			=> 'GMB',
									'review_location'           		=> $location_path,
									'review_location_name'           	=> $location_path_name,
									'review_done_via'          			=> 'backend',
									'review_add_category'      			=> 'General Category',
									'review_rating'            			=> $add_rv_rating,
									'review_read_flag'         			=> '0',
							  		'review_notification_flag' 			=> '0',
							  		'review_gmb_id'        	   			=> $review_post_id,
							  		'review_duplicate_details_check' 	=> 'false',
		  							'review_duplicate_name'         	=> '',
		  							'review_duplicate_reason'        	=> '',
		  							'review_gmb_replay'        			=> $review_replay
								);
							    update_comment_meta( $comment_id, "comment_extras", $comment_meta_table_data );
							}  
					}//For loop ends.
		if($wp_grv_selected_location_count>1){			
			$k = 1;
			$gmb_fetch_sett        	= get_option( 'gmb_settings' );
			$gmb_id                	= $gmb_fetch_sett['gmb_id'];
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Content-Type: application/json"
			  ),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			$json_acess_token_data = trim($response, '"');
			foreach ($wp_grv_selected_locations_db as $key => $value) {	
				$curl2 = curl_init();

				curl_setopt_array($curl2, array(
				  CURLOPT_URL => "https://mybusiness.googleapis.com/v4/".$value."/reviews",
				  CURLOPT_RETURNTRANSFER => true,
				  CURLOPT_ENCODING => "",
				  CURLOPT_MAXREDIRS => 10,
				  CURLOPT_TIMEOUT => 0,
				  CURLOPT_FOLLOWLOCATION => true,
				  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
				  CURLOPT_CUSTOMREQUEST => "GET",
				  CURLOPT_HTTPHEADER => array(
				    "Content-Type: application/json",
				    "Authorization: Bearer ".$json_acess_token_data
				  ),
				));
				$response 					= curl_exec($curl2);
				curl_close($curl2);
				$wp_grv_gmb_fetch_reviews 	= json_decode($response,true);
				$wp_grv_num_reviews 		= count($wp_grv_gmb_fetch_reviews['reviews']);
				/* fetch gmb reviews */
						global $wpdb;
						$comment_tbl 			= $wpdb->prefix . 'comments';
						$comment_tbl_data 		= $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC",ARRAY_A);
						foreach ($comment_tbl_data as $value_comment_tbl_data){
							$rv_id_fetch 				= $value_comment_tbl_data['comment_ID'];
							$rv_author_fetch 			= $value_comment_tbl_data['comment_author'];
							$rv_date_fetch 				= $value_comment_tbl_data['comment_date'];
							$rv_approved 				= $value_comment_tbl_data['comment_approved'];
							$key 						= "comment_extras";
							$comment_meta_data_fetch 	= get_comment_meta( $rv_id_fetch, $key );
							foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
								$rv_title 				= $comment_meta_data_fetch_value['review_title'];
								$rv_rating_fetch 		= $comment_meta_data_fetch_value['review_rating'];
								$rv_category_fetch 		= $comment_meta_data_fetch_value['review_add_category'];
								$rv_done_on_fetch 		= $comment_meta_data_fetch_value['review_done_on'];
								$review_location 		= $comment_meta_data_fetch_value['review_location'];
								$review_location_name 	= $comment_meta_data_fetch_value['review_location_name'];
								$rv_gmb_id 				= $comment_meta_data_fetch_value['review_gmb_id'];
							}
							if($review_location === $value){
								break;//last gmb review found then break the for loop.
							}
						}
						for($i=0;$i<$wp_grv_num_reviews;$i++){//for taking count of updated reviews.
							$review_details_update 	= $wp_grv_gmb_fetch_reviews['reviews'][$i];
			 				$review_post_id_update 	= $review_details_update['reviewId'];
			 				if($rv_gmb_id === $review_post_id_update){
			 					break;
			 				}
						}
						if($i != 0){
							$number_of_new_reviews = $i - 1;
							$update_flag = 'true';
						}
						else{
							$number_of_new_reviews = 0;
						}
						for($j=$number_of_new_reviews;$j>=0;$j--){
								//insert gmb reviews
								$review_details 	= $wp_grv_gmb_fetch_reviews['reviews'][$j];
			 					$review_post_id 	= $review_details['reviewId'];
			 					$review_name 		= $review_details['reviewer']['displayName'];
			 					$review_content 	= isset($review_details['comment']) ? $review_details['comment'] : ' ';
			 					$fetch_review_date 	= $review_details['createTime'];
								$fetch_review_date2 = substr($fetch_review_date, 0, strpos($fetch_review_date, "."));
								$review_date_con 	= strtolower(str_replace('T', ' ', substr($fetch_review_date2, 0, 30)));
								$converted_date 	= strtotime($review_date_con);
								$review_date 		= date('Y-m-d H:i:s ',$converted_date); 
			 					$reviewer_img 		= $review_details['reviewer']['profilePhotoUrl'];
			 					$review_replay 		= isset($review_details['reviewReply']['comment'])?$review_details['reviewReply']['comment']:'';
			 					$reviewer_rating 	= $review_details['starRating'];
			 					$review_title 		= substr( $review_content, 0, 20);
			 					if($reviewer_rating === 'FIVE'){
			 						$add_rv_rating	= '5';
			 					}
			 					else if($reviewer_rating === 'FOUR'){
			 						$add_rv_rating	= '4';
			 					}
			 					else if($reviewer_rating === 'THREE'){
			 						$add_rv_rating	= '3';
			 					}
			 					else if($reviewer_rating === 'TWO'){
			 						$add_rv_rating	= '2';
			 					}
			 					else if($reviewer_rating === 'ONE'){
			 						$add_rv_rating	= '1';
			 					}	
			 					else{
			 						$add_rv_rating	= '5';
			 					}
			 					//check approval.
			 					if(($wp_grv_auto_post_check === 'true') && ($wp_grv_enable_rating === 'all') && (($add_rv_rating === '1') || ($add_rv_rating === '2') || ($add_rv_rating === '3') || ($add_rv_rating === '4') || ($add_rv_rating === '5')) ){
									$add_approve_stat = "true";
								}
								else if(($wp_grv_auto_post_check === 'true') && ($wp_grv_enable_rating === 'below3') && (($add_rv_rating === '1') || ($add_rv_rating === '2')) ){
									$add_approve_stat = "true";
								}
								else if(($wp_grv_auto_post_check === 'true') && ($wp_grv_enable_rating === '3andabove') && (($add_rv_rating === '3') || ($add_rv_rating === '4') || ($add_rv_rating === '5')) ){
									$add_approve_stat = "true";
								}
								else if(($wp_grv_auto_post_check === 'true') && ($wp_grv_enable_rating === '4to5') && (($add_rv_rating === '4') || ($add_rv_rating === '5')) ){
									$add_approve_stat = "true";
								}
								else{
									$add_approve_stat = "false";
								}
								$rv_type		    = "wp_grv_review";
								if($rv_gmb_id === $review_post_id){
									break;// if last inserted gmb found terminate process.
								}
								else{
									$comment_table_data = array(
									  	'comment_author'         => $review_name,
								  		'comment_author_email'   => 'null',
								  		'comment_content'        => $review_content,
								  		'comment_date'		     => $review_date,
								  		'comment_approved'	     => $add_approve_stat,
								  		'comment_type'		     => $rv_type
									);
									$id = wp_insert_comment($comment_table_data);
									$comment_id = $id;
									//checking upload image exisist or not
									if($reviewer_img === ""){
									  $wp_grv_user_image = $wp_grv_default_user_image;   
									}
									else{
									  $wp_grv_user_image = $reviewer_img;
									}
									if($value != ''){
										$gmb_loc 						= get_option( 'wp_grv_gmb_location_settings' );
									 	$wp_grv_selected_locations_db   = $gmb_loc['gmb_selected_locations'];
									 	foreach ($wp_grv_selected_locations_db as $key => $value2) {
									 		if($value2 == $value){
									 			$location_path_name = $key;
									 			break;
									 		}else{
									 			$location_path_name = '';
									 		}
									 	}
									}
									$comment_meta_table_data = array(
										'review_title'             			=> $review_title,
										'review_user_image'        			=> $wp_grv_user_image,
										'review_done_on'           			=> 'GMB',
										'review_location'           		=> $value,
										'review_location_name'           	=> $location_path_name,
										'review_done_via'          			=> 'backend',
										'review_add_category'      			=> 'General Category',
										'review_rating'            			=> $add_rv_rating,
										'review_read_flag'         			=> '0',
								  		'review_notification_flag' 			=> '0',
								  		'review_gmb_id'        	   			=> $review_post_id,
								  		'review_duplicate_details_check' 	=> 'false',
			  							'review_duplicate_name'         	=> '',
			  							'review_duplicate_reason'        	=> '',
			  							'review_gmb_replay'        			=> $review_replay
									);
								    update_comment_meta( $comment_id, "comment_extras", $comment_meta_table_data );
								}  
						}//For loop ends.
		 		$k=$k+1;
		 		if($k == $wp_grv_selected_location_count){
					break;
				}
		 	}//number of location for loop
		}//location num greater than 1 if condition ends	


	 	if($update_flag == 'true'){			
			//--------------------- html refresh section --------------------------
			global $wpdb;
			$comment_tbl = $wpdb->prefix . 'comments';
			$all_review_num = $wpdb->get_var( "SELECT COUNT(*) FROM $comment_tbl WHERE comment_type='wp_grv_review'");
			$enable_review_num = $wpdb->get_var( "SELECT COUNT(*) FROM $comment_tbl WHERE comment_type='wp_grv_review' AND comment_approved='true'");				
		?>
			<div id="rv_all_list">
			<form action="" method="POST">
			<input class="wp_grv_btn" type="button" onclick="window.location.href='<?php echo admin_url('/admin.php?page=add-new-menu'); ?>'" name="add_new_btn" id="rv_add_new_btn" value="<?php echo _e( 'Add New', 'wp-gratify-lang' ); ?>" /><br/>
			<h4><b> <?php echo _e( 'All', 'wp-gratify-lang' ); ?> (<?php echo $all_review_num; ?>) | <?php echo _e( 'Published', 'wp-gratify-lang' ); ?> (<span id="wp_grv_rv_enable_count"><?php echo $enable_review_num; ?></span>)</b></h4>
			<select class="wp_grv_rv_bulk_actions wp_grv_select_field" name="bulk_actions">
			<option><?php echo _e( 'Bulk Actions', 'wp-gratify-lang' ); ?></option>	
			<option value="delete"> <?php echo _e( 'Delete', 'wp-gratify-lang' ); ?> </option>
			</select> 
			<input type="button" name="action_submit"  class="wp_grv_btn_sub wp_grv_rv_action_submit" value="<?php echo _e( 'Apply', 'wp-gratify-lang' ); ?>" />
			</form>
			<!--
				div for loading
			--> 
			<div class="wp_grv_loader" style="display: none;"></div>
			<!-- for scrolling icon -->
				<div class="wp_grv_scroll_icon_border">
					<h3>Scroll &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right wp_grv_scroll_arrow_icon"></i></h3>
				</div>
			<!-- scrolling icon div ends -->	
			<div id="rv_schema_tab"> 
				<form>
				<div class="wp_grv_tbl">	
				<table id="wp_grv_all_rv_tbl"> 
					<thead>
						<tr>
								<th><input type="checkbox" value="on"  name="all_sel" class="rv_all_sel rv_select_check_box"></th>
								<th><?php echo _e( 'Title', 'wp-gratify-lang' );    ?></th>
								<th><?php echo _e( 'Author', 'wp-gratify-lang' ); 	?></th>
								<th><?php echo _e( 'Category', 'wp-gratify-lang' ); ?></th>
								<th><?php echo _e( 'Approval', 'wp-gratify-lang' ); ?></th>
								<th><?php echo _e( 'Done On', 'wp-gratify-lang' ); 	?></th>
								<th><?php echo _e( 'Rating', 'wp-gratify-lang' ); 	?></th>
								<th><?php echo _e( 'Date', 'wp-gratify-lang' ); 	?></th>
						</tr>
					</thead>
				<tbody>
					<?php
				global $wpdb;
				$comment_tbl 		= $wpdb->prefix . 'comments';
				$comment_tbl_data 	= $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC",ARRAY_A);
				foreach ($comment_tbl_data as $value_comment_tbl_data){
				$rv_id_fetch 				= $value_comment_tbl_data['comment_ID'];
				$rv_author_fetch 			= $value_comment_tbl_data['comment_author'];
				$rv_date_fetch 				= $value_comment_tbl_data['comment_date'];
				$rv_approved 				= $value_comment_tbl_data['comment_approved'];
				$key 						= "comment_extras";
				$comment_meta_data_fetch 	= get_comment_meta( $rv_id_fetch, $key );
				foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
					$rv_title 			= $comment_meta_data_fetch_value['review_title'];
					$rv_rating_fetch 	= $comment_meta_data_fetch_value['review_rating'];
					$rv_category_fetch 	= $comment_meta_data_fetch_value['review_add_category'];
					$rv_done_on_fetch 	= $comment_meta_data_fetch_value['review_done_on'];
					$rv_location_name 	= $comment_meta_data_fetch_value['review_location_name'];
				}
					?>
					<tr class="wp_grv_rv_tbl_row">		
				        <td><input type="checkbox" name="all_sel" class="rv_all_sel" value="<?php echo $rv_id_fetch; ?>"><br/></td>
					<td class="wp_grv_all_rv_title"><?php echo _e( $rv_title, 'wp-gratify-lang' ); ?><br/>
				<div class="wp_grv_rv_edit_delete">
					<a title="Review Edit" id="wp_grv_edit_count" data_edit_id="<?php echo $rv_id_fetch; ?>"  href="<?php echo admin_url('/admin.php?page=add-new-menu&edit_id='.$rv_id_fetch ); ?>" style="text-decoration: none;" ><i class="fa fa-pencil-square-o"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
					<a title="Review Delete" id="wp_grv_rv_delete" data_id="<?php echo $rv_id_fetch; ?>" href="#" style="text-decoration: none;" ><i class="fa fa-trash-o"></i></a>
				</div><br/>
				</td>
					<td><?php echo $rv_author_fetch; ?><br/></td>
					<td><?php echo $rv_category_fetch; ?><br/></td>
					<td><label class="rv_switch"><input type="checkbox" value="<?php echo $rv_id_fetch; ?>" name="aproval_sel" class="rv_approval_sel" <?php if($rv_approved == 'true'){echo 'checked';} ?>/><span class="rv_slider rv_round"></span></label><br/></td>
					<td><?php echo _e( $rv_done_on_fetch, 'wp-gratify-lang' )._e( ' '.$rv_location_name, 'wp-gratify-lang' ); ?><br/></td>
					<!-- It shows star rating. -->
					<td>
						<div id="rv_star_rating_size">
							<span class="fa fa-star <?php if(($rv_rating_fetch == '1')||($rv_rating_fetch =='2')||($rv_rating_fetch =='3')||($rv_rating_fetch =='4')||($rv_rating_fetch =='5')){ echo 'rv_checked'; } ?>"></span>
							<span class="fa fa-star <?php if(($rv_rating_fetch == '2')||($rv_rating_fetch == '3')||($rv_rating_fetch == '4')||($rv_rating_fetch =='5')){ echo 'rv_checked'; } ?>"></span>
							<span class="fa fa-star <?php if(($rv_rating_fetch == '3')||($rv_rating_fetch == '4')||($rv_rating_fetch =='5')){ echo 'rv_checked'; } ?>"></span>
							<span class="fa fa-star <?php if(($rv_rating_fetch == '4')||($rv_rating_fetch =='5')){ echo 'rv_checked'; } ?>" ></span>
							<span class="fa fa-star <?php if( $rv_rating_fetch == '5'){ echo 'rv_checked'; } ?>" ></span>
						</div><br/>
					</td>
					<td><?php echo _e( $rv_date_fetch, 'wp-gratify-lang' ); ?><br/></td>
				        </tr>
				   <?php
				  }
				  ?>	
					</tbody>
					<tfoot>
				 		<tr>
								<th><input type="checkbox" value="on"  name="all_sel" class="rv_all_sel rv_select_check_box"></th>
								<th><?php echo _e( 'Title', 'wp-gratify-lang' );    ?></th>
								<th><?php echo _e( 'Author', 'wp-gratify-lang' ); 	?></th>
								<th><?php echo _e( 'Category', 'wp-gratify-lang' ); ?></th>
								<th><?php echo _e( 'Approval', 'wp-gratify-lang' ); ?></th>
								<th><?php echo _e( 'Done On', 'wp-gratify-lang' ); 	?></th>
								<th><?php echo _e( 'Rating', 'wp-gratify-lang' ); 	?></th>
								<th><?php echo _e( 'Date', 'wp-gratify-lang' ); 	?></th>
						</tr>
					</tfoot>	
				</table>
				</div><!-- wp_grv_tbl div ends -->
				<div id="wp_grv_bulk_action_block">
					<select class="wp_grv_rv_bulk_actions_footer wp_grv_select_field" name="bulk_actions">
			   		<option><?php echo _e( 'Bulk Actions', 'wp-gratify-lang' ); ?></option>	
			   		<option value="delete"><?php echo _e( 'Delete', 'wp-gratify-lang' ); ?></option>
					</select> 
					<input type="submit" name="action_submit" class="wp_grv_btn_sub wp_grv_rv_action_submit_footer" value="<?php echo _e( 'Apply', 'wp-gratify-lang' ); ?>" />
				</div>
				</form>
				</div>
			<?php
			//---------------------- html refresh section ends ----------------------------------
		}
		else{
			echo 'false';
		}

		exit();			
	 }
	 /*
	  * function for single invitation cancel 
	  * return update table data
	 */ 
	public static function wp_grv_rv_invitation_cancel_fun(){
	 	$wp_grv_cancel_id = filter_input(INPUT_POST,'wp_grv_cancel_id');
	 	global $wpdb;
		$wp_grv_tbl_name = $wpdb->prefix . 'wp_grv_review_invitation_tbl';
		$wpdb->update( $wp_grv_tbl_name, array(
			'status' => 'Canceled',
			),
		array('invitation_id' => $wp_grv_cancel_id),
		array('%s'),
		array('%d')
		);
	?>
				<thead>
					<tr>
			  			<th><?php echo _e( 'Email', 'wp-gratify-lang' );  ?></th>
			  			<th><?php echo _e( 'Status', 'wp-gratify-lang' ); ?></th>
			  			<th><?php echo _e( 'Date', 'wp-gratify-lang' );   ?></th>
			  			<th><?php echo _e( 'Rating', 'wp-gratify-lang' ); ?></th>
			  			<th><?php echo _e( 'View', 'wp-gratify-lang' );   ?></th>
			  		</tr>
		  		</thead>
		  		<tbody>
		<?php
			global $wpdb;
			$invitation_tbl    = $wpdb->prefix . 'wp_grv_review_invitation_tbl';
			$result_invitation = $wpdb->get_results( "SELECT * FROM $invitation_tbl ORDER BY invitation_id DESC",ARRAY_A);
			foreach ($result_invitation as $value_invitation){
				$invite_email_id_dat        = $value_invitation['email_id'];
				$invite_status_dat       	= $value_invitation['status'];
				$invite_rating_dat 			= $value_invitation['rating'];
				$invite_view_link_dat 		= $value_invitation['view_link'];
				$invited_date 				= $value_invitation['invited_date'];
				$invited_code 				= $value_invitation['invite_code'];
				$invitation_id 				= $value_invitation['invitation_id'];
				//getting review id
				$comment_tbl = $wpdb->prefix . 'comments';
				$result_comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl",ARRAY_A);
				foreach ($result_comment_tbl_data as $comment_data){
					if($comment_data['comment_agent'] === $invited_code ){
						$comment_id        = $comment_data['comment_ID'];
						$invite_rating_data 	= get_comment_meta($comment_id, 'comment_extras');
						foreach ($invite_rating_data as $invite_rating) {
						    $wp_grv_rating = $invite_rating['review_rating'];
						}  
					}
				} 
				?><tr class="wp_grv_rv_invtation_tbl_row">
					<td>
						<span class="wp_grv_rv_invitation_cancel_set" style="visibility: hidden; margin-left: 5px;">
				    			<a id="wp_grv_rv_invitaion_cancel" class="wp_grv_rv_invitaion_cancel_effect" title="Cancel Invitation" data_id="<?php echo $invitation_id; ?>" href="#" ><i class="fa fa-times"></i></a>
				    	</span>
				    	<span style="margin-left: 12%;"><?php echo _e( $invite_email_id_dat, 'wp-gratify-lang' ); ?></span>
					</td>
					<td style="text-align: center;"><span id="wp_grv_status_text" <?php if($invite_status_dat === 'waiting'){ echo 'class="wp_grv_status_bar_waiting"'; } else if($invite_status_dat === 'Canceled'){ echo 'class="wp_grv_status_bar_cancel"'; } else{ echo 'class="wp_grv_status_bar_done"'; } ?> ><?php if($invite_status_dat === 'waiting'){ echo _e( $invite_status_dat, 'wp-gratify-lang' ); }  else if($invite_status_dat === 'Canceled'){ echo _e( $invite_status_dat, 'wp-gratify-lang' ); } else{ echo _e( 'Reviewed', 'wp-gratify-lang' ); }  ?></span>
					</td>
					<td style="text-align: center;"><?php echo _e( $invited_date, 'wp-gratify-lang' ); ?>
					</td>
					<td style="text-align: center;"><?php if($invite_rating_dat === 'Not rated'){ echo _e( $invite_rating_dat, 'wp-gratify-lang' ); } else { echo '<span class="wp_grv_invtation_star_rating">'.$wp_grv_rating.'&nbsp;<i class="fa fa-star"></i></span>'; } ?>
					</td>
					<td style="text-align: center;"><?php if($invite_view_link_dat === '#'){ echo '<i title="Not available" class="fa fa-eye-slash wp_grv_not_view_icon"></i>';} else {?><a href="<?php echo $invite_view_link_dat; ?>" title="View review" style="text-decoration: none;" ><i class="fa fa-eye wp_grv_view_icon"></i></a><?php } ?>
					</td>
				</tr><?php
			}
		exit();
	}
	/*
	  * function for read count
	  * return void
	 */ 
	public static function wp_grv_review_read_count(){
		$key 						= "comment_extras";
	 	$wp_grv_read_id 			= filter_input(INPUT_POST,'wp_grv_read_id');
		$comment_meta_data_fetch 	= get_comment_meta( $wp_grv_read_id, $key );
		foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
			$rv_title 					= $comment_meta_data_fetch_value['review_title'];
			$rv_rating_fetch 			= $comment_meta_data_fetch_value['review_rating'];
			$rv_category_fetch 			= $comment_meta_data_fetch_value['review_add_category'];
			$rv_done_on_fetch 			= $comment_meta_data_fetch_value['review_done_on'];
			$rv_user_img 				= $comment_meta_data_fetch_value['review_user_image'];
			$rv_done_via 				= $comment_meta_data_fetch_value['review_done_via'];
			if($rv_done_on_fetch === 'GMB'){
				$rv_gmb_id_fetch 	= $comment_meta_data_fetch_value['review_gmb_id'];
				$rv_location 	 	= $comment_meta_data_fetch_value['review_location'];
				$rv_location_name 	= $comment_meta_data_fetch_value['review_location_name'];
			}
			else{
				$rv_gmb_id_fetch 	= '';
				$rv_location 	 	= '';
				$rv_location_name 	= '';
			}
			$rv_duplicate_details_check = $comment_meta_data_fetch_value['review_duplicate_details_check'];
		  	$rv_duplicate_name          = $comment_meta_data_fetch_value['review_duplicate_name'];
		  	$rv_duplicate_reason        = $comment_meta_data_fetch_value['review_duplicate_reason'];
		  	$rv_gmb_replay_val			= $comment_meta_data_fetch_value['review_gmb_replay'];
		}
		$comment_meta_table_data = array(
				'review_title'         				=> $rv_title,
				'review_user_image'    				=> $rv_user_img,
				'review_done_on'   					=> $rv_done_on_fetch,
				'review_location'					=> $rv_location,
				'review_location_name'				=> $rv_location_name,
				'review_done_via' 					=> $rv_done_via,
				'review_add_category'  				=> $rv_category_fetch,
				'review_rating' 					=> $rv_rating_fetch,
				'review_read_flag' 					=> '1',
				'review_notification_flag' 			=> '0',
				'review_gmb_id'        	   			=> $rv_gmb_id_fetch,
				'review_duplicate_details_check' 	=> $rv_duplicate_details_check,
		  		'review_duplicate_name'          	=> $rv_duplicate_name,
		  		'review_duplicate_reason'        	=> $rv_duplicate_reason,
		  		'review_gmb_replay'        			=> $rv_gmb_replay_val
			);
		    update_comment_meta( $wp_grv_read_id, "comment_extras", $comment_meta_table_data );
	 	echo $wp_grv_read_id;
		exit();
	}

	 /*
	  * function for single category delete 
	  * return update table data
	 */ 
	public static function wp_grv_rv_category_delete_fun(){
	 	$wp_grv_delete_id = filter_input(INPUT_POST,'wp_grv_delete_id');
	 	global $wpdb;
		$wpdb->query(
		    'DELETE  FROM '.$wpdb->prefix.'wp_grv_category_list_tbl WHERE category_id = "'.$wp_grv_delete_id.'"'
		);?>
		<thead>
		<tr>
			<th><?php echo _e( 'Name', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'Description', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'Slug', 'wp-gratify-lang' ); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php
			global $wpdb;
			$category_tbl    = $wpdb->prefix . 'wp_grv_category_list_tbl';
			$result_category = $wpdb->get_results( "SELECT * FROM $category_tbl ",ARRAY_A);
			foreach ($result_category as $value_category){
				$category_id        	  = $value_category['category_id'];
				$category_name_dat        = $value_category['category_name'];
				$category_slug_dat        = $value_category['category_slug'];
				$category_description_dat = $value_category['category_description'];
		?>
		<tr class="wp_grv_rv_cat_tbl_row">
			<td>
				<span class="wp_grv_rv_delete_set"><a id="wp_grv_rv_cat_delete" class="wp_grv_rv_cat_delete_effect" data_id="<?php echo $category_id; ?>" title="Delete Category" href="#" ><i class="fa fa-trash-o"></i></a>
				</span>
				<span style="margin-left: 15%;"><?php echo _e( $category_name_dat, 'wp-gratify-lang' );?></span>
			</td>
			<td style="text-align: center;"><?php echo _e( $category_description_dat, 'wp-gratify-lang' ); ?></td>
			<td style="text-align: center;"><?php echo _e( $category_slug_dat, 'wp-gratify-lang' ); ?></td>
		</tr>
				<?php
			}
		exit();
	} 

	 /*
	  * function for single review update data to database
	  * return void
	 */ 
	public static function wp_grv_single_rv_update(){
	 	$wp_grv_single_rv_id    	= filter_input(INPUT_POST,'wp_grv_single_rv_id');
	 	$wp_grv_add_name        	= filter_input(INPUT_POST,'wp_grv_add_name');
	 	$wp_grv_add_email       	= filter_input(INPUT_POST,'wp_grv_add_email');
	 	$wp_grv_add_title       	= filter_input(INPUT_POST,'wp_grv_add_title');
	 	$wp_grv_add_content     	= filter_input(INPUT_POST,'wp_grv_add_content');
	 	$wp_grv_done_on         	= filter_input(INPUT_POST,'wp_grv_done_on');
	 	$wp_grv_approval_sel    	= filter_input(INPUT_POST,'wp_grv_approval_sel');
	 	$wp_grv_add_category    	= filter_input(INPUT_POST,'wp_grv_add_category');
	 	$wp_grv_raiting         	= filter_input(INPUT_POST,'wp_grv_raiting');
	 	if($wp_grv_done_on === 'GMB'){
	 		$wp_grv_gmb_review_replay	= filter_input(INPUT_POST,'wp_grv_gmb_review_replay');
	 	}
	 	$key 						= "comment_extras";
		$comment_meta_data_fetch 	= get_comment_meta( $wp_grv_single_rv_id, $key );
		foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
			$wp_grv_rv_done_on_fetch 		= $comment_meta_data_fetch_value['review_done_on'];
			if($wp_grv_rv_done_on_fetch === 'GMB'){
				$wp_grv_gmb_id_fetch 	= $comment_meta_data_fetch_value['review_gmb_id'];
				$wp_grv_location 		= $comment_meta_data_fetch_value['review_location'];
				$wp_grv_location_name 	= $comment_meta_data_fetch_value['review_location_name'];
				$wp_grv_done_on 		= 'GMB';
			}
			else{
				$wp_grv_gmb_id_fetch	= 'null';
				$wp_grv_location 		= '';
				$wp_grv_location_name 	= '';
			}	
		}	
	 	// fetch from duplicate fields.
	 	$rv_duplicate_details_check = filter_input(INPUT_POST,'wp_grv_dup_details_check');
	 	if($rv_duplicate_details_check === 'true'){
			$rv_duplicate_name    		= filter_input(INPUT_POST,'wp_grv_dup_name');
			$rv_duplicate_reason    	= filter_input(INPUT_POST,'wp_grv_dup_reason');
		}
		else{
			$rv_duplicate_name    		= '';
			$rv_duplicate_reason    	= '';	
		}
	 	$dt                     	= new DateTime();
		$add_rv_date            	= $dt->format('Y-m-d H:i:s');
		$rv_type                	= "wp_grv_review";
		if(filter_input(INPUT_POST,'wp_grv_add_usr_img') === ""){
		  $review_intake_fetch_settings = get_option('review_intake_settings');
		  $wp_grv_add_usr_img = $review_intake_fetch_settings['user_image'];  
		}
		else{
		  $wp_grv_add_usr_img = filter_input(INPUT_POST,'wp_grv_add_usr_img');
		}
		$commentarr = get_comment($wp_grv_single_rv_id, ARRAY_A);
		                $commentarr['comment_author'] 		= $wp_grv_add_name;
		                $commentarr['comment_author_email'] = $wp_grv_add_email;
		                $commentarr['comment_content'] 		= $wp_grv_add_content;
		                $commentarr['comment_date'] 		= $add_rv_date;
		                $commentarr['comment_approved'] 	= $wp_grv_approval_sel;
		                $commentarr['comment_type'] 		= $rv_type; 
		                wp_update_comment($commentarr);
		if($wp_grv_done_on === 'GMB'){
			$comment_meta_table_data = array(
				'review_title'         				=> $wp_grv_add_title,
				'review_user_image'    				=> $wp_grv_add_usr_img,
				'review_done_on'   	 				=> $wp_grv_done_on,
				'review_location'					=> $wp_grv_location,
				'review_location_name'				=> $wp_grv_location_name,
				'review_done_via' 	 				=> 'backend',
				'review_add_category'  				=> $wp_grv_add_category,
				'review_rating' 		 			=> $wp_grv_raiting,
				'review_read_flag'					=> '1',
				'review_notification_flag' 			=> '0',
				'review_gmb_id'        	   			=> $wp_grv_gmb_id_fetch,
				'review_duplicate_details_check' 	=> $rv_duplicate_details_check,
				'review_duplicate_name'          	=> $rv_duplicate_name,
				'review_duplicate_reason'        	=> $rv_duplicate_reason,
				'review_gmb_replay'        			=> $wp_grv_gmb_review_replay
	    	);
	    }else{            
			$comment_meta_table_data = array(
				'review_title'         				=> $wp_grv_add_title,
				'review_user_image'    				=> $wp_grv_add_usr_img,
				'review_done_on'   	 				=> $wp_grv_done_on,
				'review_location'					=> $wp_grv_location,
				'review_location_name'				=> $wp_grv_location_name,
				'review_done_via' 	 				=> 'backend',
				'review_add_category'  				=> $wp_grv_add_category,
				'review_rating' 		 			=> $wp_grv_raiting,
				'review_read_flag'					=> '1',
				'review_notification_flag' 			=> '0',
				'review_gmb_id'        	   			=> $wp_grv_gmb_id_fetch,
				'review_duplicate_details_check' 	=> $rv_duplicate_details_check,
				'review_duplicate_name'          	=> $rv_duplicate_name,
				'review_duplicate_reason'        	=> $rv_duplicate_reason	
			);
		}	
		update_comment_meta( $wp_grv_single_rv_id, "comment_extras", $comment_meta_table_data );
		echo $rv_duplicate_details_check;
		exit();
	 }

	/*
	  * function for delete single review from all review section
	  * return void
	 */ 
	 public static function wp_grv_rv_delete_fun(){
	 	$wp_grv_delete_id = filter_input(INPUT_POST,'wp_grv_delete_id');
	 	$wp_grv_rv_meta_key = "comment_extras";
		 wp_delete_comment( $wp_grv_delete_id , $force_delete = true );
		 delete_comment_meta( $wp_grv_delete_id, $wp_grv_rv_meta_key ); 
		 $tbl_dat = '';
		 //....................................
		global $wpdb;
		$comment_tbl = $wpdb->prefix . 'comments';
		$all_review_num = $wpdb->get_var( "SELECT COUNT(*) FROM $comment_tbl WHERE comment_type='wp_grv_review'");
		$enable_review_num = $wpdb->get_var( "SELECT COUNT(*) FROM $comment_tbl WHERE comment_type='wp_grv_review' AND comment_approved='true'");				
	?>
		<div id="rv_all_list">
		<form action="" method="POST">
		<input class="wp_grv_btn" type="button" onclick="window.location.href='<?php echo admin_url('/admin.php?page=add-new-menu'); ?>'" name="add_new_btn" id="rv_add_new_btn" value="<?php echo _e( 'Add New', 'wp-gratify-lang' ); ?>" /><br/>
		<h4><b> <?php echo _e( 'All', 'wp-gratify-lang' ); ?> (<?php echo $all_review_num; ?>) | <?php echo _e( 'Published', 'wp-gratify-lang' ); ?> (<span id="wp_grv_rv_enable_count"><?php echo $enable_review_num; ?></span>)</b></h4>
		<select class="wp_grv_rv_bulk_actions wp_grv_select_field" name="bulk_actions">
		<option><?php echo _e( 'Bulk Actions', 'wp-gratify-lang' ); ?></option>	
		<option value="delete"> <?php echo _e( 'Delete', 'wp-gratify-lang' ); ?> </option>
		</select> 
		<input type="button" name="action_submit"  class="wp_grv_btn_sub wp_grv_rv_action_submit" value="<?php echo _e( 'Apply', 'wp-gratify-lang' ); ?>" />
		</form>
		<!--
			div for loading
		--> 
		<div class="wp_grv_loader" style="display: none;"></div>
		<!-- for scrolling icon -->
			<div class="wp_grv_scroll_icon_border">
				<h3>Scroll &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right wp_grv_scroll_arrow_icon"></i></h3>
			</div>
		<!-- scrolling icon div ends -->	
		<div id="rv_schema_tab"> 
			<form>
			<div class="wp_grv_tbl">	
			<table id="wp_grv_all_rv_tbl"> 
				<thead>
					<tr>
							<th><input type="checkbox" value="on"  name="all_sel" class="rv_all_sel rv_select_check_box"></th>
							<th><?php echo _e( 'Title', 'wp-gratify-lang' );    ?></th>
							<th><?php echo _e( 'Author', 'wp-gratify-lang' ); 	?></th>
							<th><?php echo _e( 'Category', 'wp-gratify-lang' ); ?></th>
							<th><?php echo _e( 'Approval', 'wp-gratify-lang' ); ?></th>
							<th><?php echo _e( 'Done On', 'wp-gratify-lang' ); 	?></th>
							<th><?php echo _e( 'Rating', 'wp-gratify-lang' ); 	?></th>
							<th><?php echo _e( 'Date', 'wp-gratify-lang' ); 	?></th>
					</tr>
				</thead>
			<tbody>
			<?php
			global $wpdb;
			$comment_tbl = $wpdb->prefix . 'comments';
			$comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC",ARRAY_A);
			foreach ($comment_tbl_data as $value_comment_tbl_data){
			$rv_id_fetch = $value_comment_tbl_data['comment_ID'];
			$rv_author_fetch = $value_comment_tbl_data['comment_author'];
			$rv_date_fetch = $value_comment_tbl_data['comment_date'];
			$rv_approved = $value_comment_tbl_data['comment_approved'];
			$key = "comment_extras";
			$comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
			foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
				$rv_title = $comment_meta_data_fetch_value['review_title'];
				$rv_rating_fetch = $comment_meta_data_fetch_value['review_rating'];
				$rv_category_fetch = $comment_meta_data_fetch_value['review_add_category'];
				$rv_done_on_fetch = $comment_meta_data_fetch_value['review_done_on'];
			}
				?>
				<tr class="wp_grv_rv_tbl_row">		
			        <td><input type="checkbox" name="all_sel" class="rv_all_sel" value="<?php echo $rv_id_fetch; ?>"><br/></td>
				<td class="wp_grv_all_rv_title"><?php echo _e( $rv_title, 'wp-gratify-lang' ); ?><br/>
			<div class="wp_grv_rv_edit_delete">
				<a title="Review Edit" id="wp_grv_edit_count" data_edit_id="<?php echo $rv_id_fetch; ?>"  href="<?php echo admin_url('/admin.php?page=add-new-menu&edit_id='.$rv_id_fetch ); ?>" style="text-decoration: none;" ><i class="fa fa-pencil-square-o"></i></a> &nbsp;&nbsp;&nbsp;&nbsp;
				<a title="Review Delete" id="wp_grv_rv_delete" data_id="<?php echo $rv_id_fetch; ?>" href="#" style="text-decoration: none;" ><i class="fa fa-trash-o"></i></a>
			</div><br/>
			</td>
				<td><?php echo $rv_author_fetch; ?><br/></td>
				<td><?php echo $rv_category_fetch; ?><br/></td>
				<td><label class="rv_switch"><input type="checkbox" value="<?php echo $rv_id_fetch; ?>" name="aproval_sel" class="rv_approval_sel" <?php if($rv_approved == 'true'){echo 'checked';} ?>/><span class="rv_slider rv_round"></span></label><br/></td>
				<td><?php echo _e( $rv_done_on_fetch, 'wp-gratify-lang' );?><br/></td>
				<!-- It shows star rating. -->
				<td>
					<div id="rv_star_rating_size">
						<span class="fa fa-star <?php if(($rv_rating_fetch == '1')||($rv_rating_fetch =='2')||($rv_rating_fetch =='3')||($rv_rating_fetch =='4')||($rv_rating_fetch =='5')){ echo 'rv_checked'; } ?>"></span>
						<span class="fa fa-star <?php if(($rv_rating_fetch == '2')||($rv_rating_fetch == '3')||($rv_rating_fetch == '4')||($rv_rating_fetch =='5')){ echo 'rv_checked'; } ?>"></span>
						<span class="fa fa-star <?php if(($rv_rating_fetch == '3')||($rv_rating_fetch == '4')||($rv_rating_fetch =='5')){ echo 'rv_checked'; } ?>"></span>
						<span class="fa fa-star <?php if(($rv_rating_fetch == '4')||($rv_rating_fetch =='5')){ echo 'rv_checked'; } ?>" ></span>
						<span class="fa fa-star <?php if( $rv_rating_fetch == '5'){ echo 'rv_checked'; } ?>" ></span>
					</div><br/>
				</td>
				<td><?php echo _e( $rv_date_fetch, 'wp-gratify-lang' ); ?><br/></td>
			        </tr>
			   <?php
			  }
			  ?>	
				</tbody>
				<tfoot>
			 		<tr>
							<th><input type="checkbox" value="on"  name="all_sel" class="rv_all_sel rv_select_check_box"></th>
							<th><?php echo _e( 'Title', 'wp-gratify-lang' );    ?></th>
							<th><?php echo _e( 'Author', 'wp-gratify-lang' ); 	?></th>
							<th><?php echo _e( 'Category', 'wp-gratify-lang' ); ?></th>
							<th><?php echo _e( 'Approval', 'wp-gratify-lang' ); ?></th>
							<th><?php echo _e( 'Done On', 'wp-gratify-lang' ); 	?></th>
							<th><?php echo _e( 'Rating', 'wp-gratify-lang' ); 	?></th>
							<th><?php echo _e( 'Date', 'wp-gratify-lang' ); 	?></th>
					</tr>
				</tfoot>	
			</table>
			</div><!-- wp_grv_tbl div ends -->
			<div id="wp_grv_bulk_action_block">
				<select class="wp_grv_rv_bulk_actions_footer wp_grv_select_field" name="bulk_actions">
		   		<option><?php echo _e( 'Bulk Actions', 'wp-gratify-lang' ); ?></option>	
		   		<option value="delete"><?php echo _e( 'Delete', 'wp-gratify-lang' ); ?></option>
				</select> 
				<input type="submit" name="action_submit" class="wp_grv_btn_sub wp_grv_rv_action_submit_footer" value="<?php echo _e( 'Apply', 'wp-gratify-lang' ); ?>" />
			</div>
			</form>
			</div>
		<?php
		//..............................................
			        	        
		exit();
	 }
	 
	 /*
	  * function for insert review enable value from all review section to database
	  * return enable review count
	 */ 

	 public static function wp_grv_rv_approval_update_insert_settings(){
	 	$wp_grv_approve_id = filter_input(INPUT_POST,'wp_grv_approve_id');
	 	$wp_grv_approve = filter_input(INPUT_POST,'wp_grv_approve');
	 	$commentarr = get_comment($wp_grv_approve_id, ARRAY_A);
		                $commentarr['comment_approved'] = $wp_grv_approve;
		                wp_update_comment($commentarr);
		global $wpdb;
		$comment_tbl = $wpdb->prefix . 'comments';                
		$enable_review_num = $wpdb->get_var( "SELECT COUNT(*) FROM $comment_tbl WHERE comment_type='wp_grv_review' AND comment_approved='true'");
		echo $enable_review_num;               
		exit();
	 }
	 /*
	  * function for category update
	  * return void
	  */ 
	public static function wp_grv_category_update(){
 		$wp_grv_cat_id = filter_input(INPUT_POST,'wp_grv_cat_id');
		global $wpdb;
		$category_tbl    					= $wpdb->prefix . 'wp_grv_category_list_tbl';
		$result_category 					= $wpdb->get_row( "SELECT * FROM $category_tbl WHERE category_id=$wp_grv_cat_id ",ARRAY_A);
		$category_name_dat 					= $result_category['category_name'];
		$category_slug_dat        			= $result_category['category_slug'];
		$category_description_dat 			= $result_category['category_description'];
		$category_schema_enable_dat 		= $result_category['schema_enable'];
		$category_manual_dat 				= $result_category['manual'];
		$category_total_reviews_dat 		= $result_category['total_reviews'];
		$category_overall_rating_dat 		= $result_category['overall_rating'];
		$category_best_review_dat 			= $result_category['best_review'];
		if($category_manual_dat === 'false'){
			$comment_tbl      					= $wpdb->prefix . 'comments';
			$comment_tbl_data 					= $wpdb->get_results( "SELECT comment_ID FROM $comment_tbl WHERE comment_type='wp_grv_review'", ARRAY_A );
			$category_review_count 				= 0;
			$category_review_count_one_star     = 0;
			$best_review_count_one_star         = 0;
			$category_review_count_two_star     = 0;
			$best_review_count_two_star         = 0;
			$category_review_count_three_star   = 0;
			$best_review_count_three_star       = 0;
			$category_review_count_four_star    = 0;
			$best_review_count_four_star        = 0;
			$category_review_count_five_star    = 0;
			$best_review_count_five_star        = 0;
			$best_review_rating					= 0;
			$total_rating_value					= 0;
			foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
				$rv_id_fetch_notfy       = $value_comment_tbl_data['comment_ID'];
				$key                     = 'comment_extras';
				$comment_meta_data_fetch = get_comment_meta( $rv_id_fetch_notfy, $key );
			
				foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
					$rv_category_fetch 			= $comment_meta_data_fetch_value['review_add_category'];
					$rv_rating_fetch 			= $comment_meta_data_fetch_value['review_rating'];
					if($category_name_dat == $rv_category_fetch){
						$category_review_count = $category_review_count+1;
						if($rv_rating_fetch == '5'){
						$category_review_count_five_star 	= $category_review_count_five_star+$rv_rating_fetch;
						$best_review_count_five_star 		= $best_review_count_five_star+1;
						}
						if($rv_rating_fetch == '4'){
						$category_review_count_four_star 	= $category_review_count_four_star+$rv_rating_fetch;
						$best_review_count_four_star 		= $best_review_count_four_star+1;
						}
						if($rv_rating_fetch == '3'){
						$category_review_count_three_star 	= $category_review_count_three_star+$rv_rating_fetch;
						$best_review_count_three_star 		= $best_review_count_three_star+1;
						}
						if($rv_rating_fetch == '2'){
						$category_review_count_two_star 	= $category_review_count_two_star+$rv_rating_fetch;
						$best_review_count_two_star 		= $best_review_count_two_star+1;
						}
						if($rv_rating_fetch == '1'){
						$category_review_count_one_star 	= $category_review_count_one_star+$rv_rating_fetch;
						$best_review_count_one_star 		= $best_review_count_one_star+1;
						}
				     }
			     }
			if($category_review_count != 0){
				$total_rating_value = ($category_review_count_five_star + $category_review_count_four_star + $category_review_count_three_star + 				$category_review_count_two_star + $category_review_count_one_star)/$category_review_count;
			}
			$max_overall_rating = max($best_review_count_five_star,$best_review_count_four_star,$best_review_count_three_star,				$best_review_count_two_star,$best_review_count_one_star);
			if($max_overall_rating != '0'){
				if($max_overall_rating == $best_review_count_five_star)
				$best_review_rating = '5';
				else if($max_overall_rating == $best_review_count_four_star)
				$best_review_rating = '4';
				else if($max_overall_rating == $best_review_count_three_star)
				$best_review_rating = '3';
				else if($max_overall_rating == $best_review_count_two_star)
				$best_review_rating = '2';
				else
				$best_review_rating = '1';
			}
		}//foreach
	}//manual enable condition check.
	else{
			$total_rating_value 	= $category_overall_rating_dat;
			$category_review_count 	= $category_total_reviews_dat;
			$best_review_rating		= $category_best_review_dat;
		}
		?>

		<tr><th><label><?php echo _e( 'Name:', 'wp-gratify-lang' ); ?></label></th>
    	<td><input type="text" name="cat_name" value="<?php echo $category_name_dat; ?>" class="wp_grv_field" id="rv_add_cat_name" autocomplete="off" required /></td></tr>
    	<tr><th><label><?php echo _e( 'Slug:', 'wp-gratify-lang' ); ?></label></th>
    	<td><input type="text" name="cat_slug" value="<?php echo $category_slug_dat; ?>" class="wp_grv_field" id="rv_add_cat_slug" autocomplete="off" /></td></tr>
    	<tr><th><label><?php echo _e( 'Description:', 'wp-gratify-lang' ); ?></label></th>
    	<td><textarea id="rv_add_cat_description" class="wp_grv_field" name="cat_description" rows="4" cols="50"><?php echo $category_description_dat; ?></textarea></td></tr>

		<!-- schema enable block -->	

		<tr id="wp_grv_cat_schema_enable" style="display: table-row;">
              <th><br/><label class="wp_grv_label"><?php echo _e( 'Schema Enable:', 'wp-gratify-lang' ); ?> </label></th><td><br/><label class="wp_grv_cat_main"><input type="checkbox" <?php if($category_schema_enable_dat == 'true'){echo 'checked'; } ?> name="schema_enable" id="wp_grv_schema_enable_cat" value="true" /><span class="grv_rv_slider_cat grv_rv_round_cat"></span></label><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="for enabling schema on current category"><i class="fa fa fa-question-circle questain_mark"></i></a></td>
        </tr>
		<tr id="wp_grv_manual"<?php if($category_schema_enable_dat == 'true'){echo 'style="display:table-row;"'; }else{echo 'style="display:none;"';} ?>class="wp_grv_schema_category_block">
              <th><br/><label class="wp_grv_label"><?php echo _e( 'Manual:', 'wp-gratify-lang' ); ?> </label></th><td><br/><label class="wp_grv_cat_main manual_slider"><input type="checkbox" name="manual_enable" id="wp_grv_manual_enable" value="true" <?php if($category_manual_dat === "true"){ echo 'checked'; } ?>/><span class="grv_rv_slider_cat grv_rv_round_cat"></span></label><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="To manually edit the ratings"><i class="fa fa fa-question-circle questain_mark"></i></a></td>
        </tr>
		<tr id="wp_grv_total_reviews" <?php if($category_schema_enable_dat == 'true'){echo 'style="display:table-row;"'; }else{echo 'style="display:none;"';} ?> class="wp_grv_schema_category_block"><th><label><?php echo _e( 'Total Reviews:', 'wp-gratify-lang' ); ?></label></th>
    	<td><input type="number" min="0" <?php if($category_manual_dat != 'true'){echo 'disabled="true"'; } ?>  name="total_reviews" class="wp_grv_field wp_grv_schema_field review_details" id="rv_total_reviews" autocomplete="off" value="<?php echo $category_review_count; ?>" /><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="To display total number of reviews recieved on current category"><i class="fa fa fa-question-circle questain_mark"></i></a><input type="hidden" name="hidden_tot_reviews" value="<?php echo $category_review_count; ?>"></td>
		</tr>
		<tr id="wp_grv_overall_rating" <?php if($category_schema_enable_dat == 'true'){echo 'style="display:table-row;"'; }else{echo 'style="display:none;"';} ?>class="wp_grv_schema_category_block"><th><label><?php echo _e( 'Overall Rating:', 'wp-gratify-lang' ); ?></label></th>
    	<td><input type="number" min="0" max="5" <?php if($category_manual_dat != 'true'){echo 'disabled="true"'; } ?> name="overall_review" class="wp_grv_field wp_grv_schema_field review_details" id="rv_overall_reviews" autocomplete="off" value="<?php echo round($total_rating_value); ?>" /><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="To display the overall rating recieved"><i class="fa fa fa-question-circle questain_mark"></i></a><input type="hidden" name="hidden_ovrall_reviews" value="<?php echo round($total_rating_value); ?>"></td>
		</tr>
		<tr id="wp_grv_best_review" <?php if($category_schema_enable_dat == 'true'){echo 'style="display:table-row;"'; }else{echo 'style="display:none;"';} ?>class="wp_grv_schema_category_block"><th><label><?php echo _e( 'Best Review:', 'wp-gratify-lang' ); ?></label></th>
    	<td><input type="number" min="0" max="5" <?php if($category_manual_dat != 'true'){echo 'disabled="true"'; } ?> name="best_review" class="wp_grv_field wp_grv_schema_field review_details" id="rv_best_reviews" autocomplete="off" value="<?php echo $best_review_rating; ?>"/><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="To display the most rated value"><i class="fa fa fa-question-circle questain_mark"></i></a><input type="hidden" name="hidden_best_reviews" value="<?php echo $best_review_rating; ?>"></td>
		</tr>
		<!-- schema enable block ends -->
    	<tr><td colspan="2">
    		<input type="hidden" name="wp_grv_update_cat_id_hidden" value="<?php echo $wp_grv_cat_id; ?>">
    		<input type="submit" name="wp_grv_update_cat_sub" class="wp_grv_btn_sub" id="wp_grv_update_cat_sub" value="<?php echo _e( 'Update Category', 'wp-gratify-lang' ); ?>" /></td></tr>
		<?php	
		exit();	
	}

	public static function wp_grv_tbl_operation_init(){
		add_action( 'wp_ajax_wp_grv_gmb_ajax_login_reset_fun', __CLASS__.'::wp_grv_gmb_ajax_login_reset_fun' );
 		add_action( 'wp_ajax_nopriv_wp_grv_gmb_ajax_login_reset_fun', __CLASS__.'::wp_grv_gmb_ajax_login_reset_fun' );
		add_action( 'wp_ajax_wp_grv_rv_gmb_replay_fun', __CLASS__.'::wp_grv_rv_gmb_replay_fun' );
 		add_action( 'wp_ajax_nopriv_wp_grv_rv_gmb_replay_fun', __CLASS__.'::wp_grv_rv_gmb_replay_fun' );
		add_action( 'wp_ajax_wp_grv_gmb_fetch_rv_to_db_fun', __CLASS__.'::wp_grv_gmb_fetch_rv_to_db_fun' );
	 	add_action( 'wp_ajax_nopriv_wp_grv_gmb_fetch_rv_to_db_fun', __CLASS__.'::wp_grv_gmb_fetch_rv_to_db_fun' );
		add_action( 'wp_ajax_wp_grv_rv_invitation_cancel_fun', __CLASS__.'::wp_grv_rv_invitation_cancel_fun' );
	    add_action( 'wp_ajax_nopriv_wp_grv_rv_invitation_cancel_fun', __CLASS__.'::wp_grv_rv_invitation_cancel_fun' ); 
	    add_action( 'wp_ajax_wp_grv_review_read_count', __CLASS__.'::wp_grv_review_read_count' );
	    add_action( 'wp_ajax_nopriv_wp_grv_review_read_count',__CLASS__.'::wp_grv_review_read_count' );
		add_action( 'wp_ajax_wp_grv_rv_category_delete_fun', __CLASS__.'::wp_grv_rv_category_delete_fun' );
	    add_action( 'wp_ajax_nopriv_wp_grv_rv_category_delete_fun',__CLASS__.'::wp_grv_rv_category_delete_fun' );	
 		add_action( 'wp_ajax_wp_grv_single_rv_update', __CLASS__.'::wp_grv_single_rv_update' );
	    add_action( 'wp_ajax_nopriv_wp_grv_single_rv_update',__CLASS__.'::wp_grv_single_rv_update' );
		add_action( 'wp_ajax_wp_grv_rv_delete_fun', __CLASS__.'::wp_grv_rv_delete_fun' );
	    add_action( 'wp_ajax_nopriv_wp_grv_rv_delete_fun',__CLASS__.'::wp_grv_rv_delete_fun' );
		add_action( 'wp_ajax_wp_grv_rv_approval_update_insert_settings', __CLASS__.'::wp_grv_rv_approval_update_insert_settings' );
	 	add_action( 'wp_ajax_nopriv_wp_grv_rv_approval_update_insert_settings',__CLASS__.'::wp_grv_rv_approval_update_insert_settings' );
		add_action( 'wp_ajax_wp_grv_category_update', __CLASS__.'::wp_grv_category_update' );
	 	add_action( 'wp_ajax_nopriv_wp_grv_category_update',__CLASS__.'::wp_grv_category_update' );
		
   }
}
Wp_Grv_Tbl_Operation::wp_grv_tbl_operation_init();		
