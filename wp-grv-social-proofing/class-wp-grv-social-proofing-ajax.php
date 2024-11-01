<?php
/*
 * function for social proofing ajax function
 * return wp_grv_get_json_data
*/ 
class Wp_Grv_Social_Proofing_Ajax{
	public static function wp_grv_social_proofing_function(){
		$wp_grv_social_proofing_settings 	= get_option('social_proofing_settings');
		global $post;
		    //Taking data from settings.
			$wp_grv_social_proofing_rating     	 		= $wp_grv_social_proofing_settings['social_proofing_rating'];
			$wp_grv_social_proofing_category     		= $wp_grv_social_proofing_settings['social_proofing_category'];
			$wp_grv_social_proofing_character_limit		= $wp_grv_social_proofing_settings['social_proofing_character_limit'];
			//3 and above star rating selection take it as value 3.
			if($wp_grv_social_proofing_rating === '3andabove'){
				$wp_grv_social_proofing_rating = '3';
			}
			//4 and 5 star rating selection take it as value 4.
			if($wp_grv_social_proofing_rating === '4to5'){
				$wp_grv_social_proofing_rating = '4';
			}
					//Fetch reviews from comment table and comment meta table.
	    			global $wpdb;
					$comment_tbl      = $wpdb->prefix . 'comments';
					$comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' AND comment_approved='true' AND comment_content != '' ORDER BY comment_ID DESC",ARRAY_A);
					foreach ($comment_tbl_data as $value_comment_tbl_data){
						$rv_id_fetch 				= $value_comment_tbl_data['comment_ID'];
						$rv_author_fetch 			= $value_comment_tbl_data['comment_author'];
						$rv_date_fetch 				= $value_comment_tbl_data['comment_date'];
						$rv_approved 				= $value_comment_tbl_data['comment_approved'];
						//Review content length checking for social proofing
						//if($wp_grv_social_proofing_character_limit >= 100){
						$rv_full_content = $value_comment_tbl_data['comment_content'];
						if(strlen($value_comment_tbl_data['comment_content']) >=$wp_grv_social_proofing_character_limit){
							$rv_content = substr( $value_comment_tbl_data['comment_content'], 0, $wp_grv_social_proofing_character_limit).'..';
							$content_limit_stat = 'true';
						}
				        else{
				          	$rv_content = $value_comment_tbl_data['comment_content'];
				          	$content_limit_stat = 'false';
				        }
						$key 						= "comment_extras";
						$comment_meta_data_fetch 	= get_comment_meta( $rv_id_fetch, $key );
						foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
							$rv_title 			= $comment_meta_data_fetch_value['review_title'];
							$rv_rating_fetch 	= $comment_meta_data_fetch_value['review_rating'];
							$rv_category_fetch 	= $comment_meta_data_fetch_value['review_add_category'];
							$rv_done_on_fetch 	= $comment_meta_data_fetch_value['review_done_on'];
							$review_user_image 	= $comment_meta_data_fetch_value['review_user_image'];
						}
						//Checking category.
						if(($wp_grv_social_proofing_category === $rv_category_fetch) || ($wp_grv_social_proofing_category === 'all_categories')){
							//Check selected as all star rating.
							if($wp_grv_social_proofing_rating === 'all'){
								$wp_grv_Obj->wp_grv_rv_title[]  			= $rv_title;
								$wp_grv_Obj->wp_grv_rv_usr_img[]  			= $review_user_image;
								$wp_grv_Obj->wp_grv_rv_done_on[]  			= $rv_done_on_fetch;
								$wp_grv_Obj->wp_grv_rv_rating[]  			= $rv_rating_fetch;
								$wp_grv_Obj->wp_grv_rv_date[]  				= $rv_date_fetch;
								$wp_grv_Obj->wp_grv_rv_content[]  			= $rv_content;
								$wp_grv_Obj->wp_grv_content_limit_stat[]  	= $content_limit_stat;
								$wp_grv_Obj->wp_grv_rv_full_content[]  		= $rv_full_content;
							}
							//Check selected as below 3 star rating.
							else if($wp_grv_social_proofing_rating === 'below3'){
								if(($rv_rating_fetch === '2') || ($rv_rating_fetch === '1')){
									$wp_grv_Obj->wp_grv_rv_title[]  			= $rv_title;
									$wp_grv_Obj->wp_grv_rv_usr_img[]  			= $review_user_image;
									$wp_grv_Obj->wp_grv_rv_done_on[]  			= $rv_done_on_fetch;
									$wp_grv_Obj->wp_grv_rv_rating[]  			= $rv_rating_fetch;
									$wp_grv_Obj->wp_grv_rv_date[]  				= $rv_date_fetch;
									$wp_grv_Obj->wp_grv_rv_content[]  			= $rv_content;
									$wp_grv_Obj->wp_grv_content_limit_stat[]  	= $content_limit_stat;
									$wp_grv_Obj->wp_grv_rv_full_content[]  		= $rv_full_content;
								}
							}
							//Check selected as 4 or 3 above star rating.
							else if($wp_grv_social_proofing_rating <= $rv_rating_fetch){
								$wp_grv_Obj->wp_grv_rv_title[]  			= $rv_title;
								$wp_grv_Obj->wp_grv_rv_usr_img[]  			= $review_user_image;
								$wp_grv_Obj->wp_grv_rv_done_on[]  			= $rv_done_on_fetch;
								$wp_grv_Obj->wp_grv_rv_rating[]  			= $rv_rating_fetch;
								$wp_grv_Obj->wp_grv_rv_date[]  				= $rv_date_fetch;
								$wp_grv_Obj->wp_grv_rv_content[]  			= $rv_content;
								$wp_grv_Obj->wp_grv_content_limit_stat[]  	= $content_limit_stat;
								$wp_grv_Obj->wp_grv_rv_full_content[]  		= $rv_full_content;
							}
						}

					}
		$wp_grv_Obj->wp_grv_social_proofing_text_size_name       = $wp_grv_social_proofing_settings['social_proofing_text_size_name'].'px';
        $wp_grv_Obj->wp_grv_social_proofing_text_size_contents   = $wp_grv_social_proofing_settings['social_proofing_text_size_contents'].'px';
		$wp_grv_Obj->wp_grv_social_proofing_bg_color             = $wp_grv_social_proofing_settings['social_proofing_bg_color'];
        $wp_grv_Obj->wp_grv_social_proofing_position_sel         = $wp_grv_social_proofing_settings['social_proofing_position_sel'];
		$wp_grv_Obj->wp_grv_mobile_enable                        = $wp_grv_social_proofing_settings['social_proofing_mobile_enable'];
		$wp_grv_Obj->wp_grv_title_enable                         = $wp_grv_social_proofing_settings['social_proofing_title_enable'];
		$wp_grv_Obj->wp_grv_powered_by_enable                    = $wp_grv_social_proofing_settings['social_proofing_powered_by_enable'];
		$wp_grv_Obj->wp_grv_img_border_radius                    = $wp_grv_social_proofing_settings['social_proofing_img_border_radius'].'%';
		$wp_grv_Obj->wp_grv_img_size                             = $wp_grv_social_proofing_settings['social_proofing_img_size'].'px';
		$wp_grv_Obj->wp_grv_font_color_name                      = $wp_grv_social_proofing_settings['social_proofing_font_color_name'];
		$wp_grv_Obj->wp_grv_font_color_review                    = $wp_grv_social_proofing_settings['social_proofing_font_color_review'];
		$wp_grv_Obj->wp_grv_social_proofing_time_invl            = $wp_grv_social_proofing_settings['social_proofing_time_invl'];
		$wp_grv_Obj->wp_grv_social_proofing_notification_stay    = $wp_grv_social_proofing_settings['social_proofing_notification_stay'];	
		$wp_grv_Obj->wp_grv_social_proofing_page_id              = $id;		
		$wp_grv_get_json_data = json_encode($wp_grv_Obj);
	 	echo($wp_grv_get_json_data);			
        exit();	
	} 
	public static function wp_grv_social_proofing_init(){
		add_action( 'wp_ajax_wp_grv_social_proofing_function', __CLASS__.'::wp_grv_social_proofing_function' );
 		add_action( 'wp_ajax_nopriv_wp_grv_social_proofing_function', __CLASS__.'::wp_grv_social_proofing_function' );
	}
}
Wp_Grv_Social_Proofing_Ajax::wp_grv_social_proofing_init();
