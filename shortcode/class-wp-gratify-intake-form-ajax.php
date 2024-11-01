<?php
/*
* ajax function for single review front end user image upload
*
*/ 
class Wp_Gratify_Intake_Form_Ajax
{
	public static function wp_grv_single_review_image_upload_files() {
				$valid_formats = array("jpg", "png", "gif", "bmp", "jpeg"); // Supported file types
				$max_file_size = 1024 * 500; // in kb
				$max_image_upload = 10; // Define how many images can be uploaded to the current post
				$wp_upload_dir = wp_upload_dir();
				$path = $wp_upload_dir['path'] . '/';
				$count = 0;
				$prfilebann = get_posts( array(
				'post_type'         => 'attachment',
				'posts_per_page'    => -1,
				'post_parent'       => 0,
				'exclude'           => get_post_thumbnail_id() // Exclude post thumbnail to the attachment count
				) );

				// Image upload handler
				if( $_SERVER['REQUEST_METHOD'] == "POST" ){
				foreach ( $_FILES['files']['name'] as $f => $name ) {
					$extension = pathinfo( $name, PATHINFO_EXTENSION );
					// Generate a randon code for each file name
					$new_filename = substr(md5(uniqid(mt_rand(), true)) , 0, 8)  . '.' . $extension;
					
					if ( $_FILES['files']['error'][$f] == 4 ) {
						continue; 
					}
					
					if ( $_FILES['files']['error'][$f] == 0 ) {
						// Check if image size is larger than the allowed file size
						if ( $_FILES['files']['size'][$f] > $max_file_size ) {
							//$upload_message[] = "$name is too large!.";
							continue;
							
								// Check if the file being uploaded is in the allowed file types
						} elseif( ! in_array( strtolower( $extension ), $valid_formats ) ){
							//$upload_message[] = "$name is not a valid format";
							continue; 
							
						} else{ 
							// If no errors, upload the file...
							if( move_uploaded_file( $_FILES["files"]["tmp_name"][$f], $path.$new_filename ) ) {
								
								$count++; 

								$filename = $path.$new_filename;
								$filetype = wp_check_filetype( basename( $filename ), null );
								$wp_upload_dir = wp_upload_dir();
								$attachment = array(
									'guid'           => $wp_upload_dir['url'] . '/' . basename( $filename ), 
									'post_mime_type' => $filetype['type'],
									'post_title'     => preg_replace( '/\.[^.]+$/', '', basename( $filename ) ),
									'post_content'   => '',
									'post_status'    => 'inherit'
								);
								// Insert attachment to the database
								$attach_id = wp_insert_attachment( $attachment, $filename );

								require_once( ABSPATH . 'wp-admin/includes/image.php' );
									
								// Generate meta data
								$attach_data = wp_generate_attachment_metadata( $attach_id, $filename ); 
								wp_update_attachment_metadata( $attach_id, $attach_data );
									$attach_url = wp_get_attachment_url( $attach_id ); 
							}
						}
					}
				}
				echo $attach_url;
				}
				
				exit();
		}
	/*
	* ajax function for single review front end 
	*
	*/ 
		public static function wp_grv_single_rv_insert(){
			$social_review_fetch_sett 						= get_option('social_review_setting');
			$review_intake_fetch_settings 					= get_option('review_intake_settings');
			$wp_grv_Obj->wp_grv_google_check     			= $social_review_fetch_sett['google_check'];
			$wp_grv_Obj->wp_grv_fb_check         			= $social_review_fetch_sett['fb_check'];
			$wp_grv_Obj->wp_grv_twitter_check    			= $social_review_fetch_sett['twitter_check'];
			$wp_grv_Obj->wp_grv_custom_check  	 			= $social_review_fetch_sett['custom_check'];
			$wp_grv_Obj->wp_grv_google_logo      			= $social_review_fetch_sett['google_logo'];
			$wp_grv_Obj->wp_grv_google_link      			= $social_review_fetch_sett['google_link'];
			$wp_grv_Obj->wp_grv_fb_logo          			= $social_review_fetch_sett['fb_logo'];
			$wp_grv_Obj->wp_grv_fb_link          			= $social_review_fetch_sett['fb_link'];
			$wp_grv_Obj->wp_grv_twitter_logo     			= $social_review_fetch_sett['twitter_logo'];
			$wp_grv_Obj->wp_grv_twitter_link     			= $social_review_fetch_sett['twitter_link'];
			$wp_grv_Obj->wp_grv_custom_title     			= $social_review_fetch_sett['custom_title'];
			$wp_grv_Obj->wp_grv_custom_logo      			= $social_review_fetch_sett['custom_logo'];
			$wp_grv_Obj->wp_grv_custom_link      			= $social_review_fetch_sett['custom_link'];
			$wp_grv_Obj->wp_grv_custom_title2    			= $social_review_fetch_sett['custom_title2'];
			$wp_grv_Obj->wp_grv_custom_logo2     			= $social_review_fetch_sett['custom_logo2'];
			$wp_grv_Obj->wp_grv_custom_link2     			= $social_review_fetch_sett['custom_link2'];
			$wp_grv_Obj->wp_grv_custom_title3    			= $social_review_fetch_sett['custom_title3'];
			$wp_grv_Obj->wp_grv_custom_logo3     			= $social_review_fetch_sett['custom_logo3'];
			$wp_grv_Obj->wp_grv_custom_link3    		 	= $social_review_fetch_sett['custom_link3'];
			$wp_grv_Obj->wp_grv_enable_rating    			= $review_intake_fetch_settings['display_with_rating'];
			$wp_grv_Obj->wp_grv_auto_post_check 			= $review_intake_fetch_settings['auto_post'];
			$wp_grv_Obj->wp_grv_thank_you_msg_social_media  = $review_intake_fetch_settings['thank_you_msg_social_media'];
			$wp_grv_Obj->wp_grv_thank_you_msg    			= $review_intake_fetch_settings['thank_you_msg'];
			$wp_grv_Obj->wp_grv_default_user_img     		= $review_intake_fetch_settings['user_image'];
	 		$wp_grv_get_json_data 							= json_encode($wp_grv_Obj);
 			$wp_grv_default_user_img_check     				= $review_intake_fetch_settings['user_image'];
	 		$wp_grv_enable_rating    							= $review_intake_fetch_settings['display_with_rating'];
	 		$wp_grv_auto_post_check 							= $review_intake_fetch_settings['auto_post'];
	 		//fetching review details via ajax.
		 	$add_rv_name      								= filter_input(INPUT_POST,'wp_grv_add_name');
			$add_rv_email     								= filter_input(INPUT_POST,'wp_grv_add_email');
			$add_rv_title     								= filter_input(INPUT_POST,'wp_grv_add_title');
			$add_rv_content   								= filter_input(INPUT_POST,'wp_grv_add_content');
			$add_rv_rating    								= filter_input(INPUT_POST,'wp_grv_raiting');
			$wp_grv_dup_details_check    					= filter_input(INPUT_POST,'wp_grv_dup_details_check');
			$wp_grv_dup_name    							= filter_input(INPUT_POST,'wp_grv_dup_name');
			$wp_grv_dup_reason    							= filter_input(INPUT_POST,'wp_grv_dup_reason');
			if($add_rv_title === ''){
				$add_rv_title 		= substr( $add_rv_content, 0, 20);
			}
		//checking user image 
		if(filter_input(INPUT_POST,'wp_grv_add_usr_img_url') != ''){
			$add_usr_img_url    = filter_input(INPUT_POST,'wp_grv_add_usr_img_url');
		}	
		else{
			$add_usr_img_url    = $wp_grv_default_user_img_check;
		}
		if(filter_input(INPUT_POST,'wp_grv_add_ref') != ''){
			$add_refer_code	  = trim(filter_input(INPUT_POST,'wp_grv_add_ref'));
			//$new_code  = trim($add_refer_code);
			$wp_grv_rv_done_via = 'invitation';
			// Update invite table status
			global $wpdb;
		 	$invite_tbl_name = $wpdb->prefix . 'wp_grv_review_invitation_tbl';
		    $wpdb->update( $invite_tbl_name, array(
			'status' => 'Review done',
			'rating' => $add_rv_rating,
			'view_link' => admin_url('/admin.php?page=add-new-menu&edit_id='.$comment_id ),
			),
			array('invite_code' => $add_refer_code),
			array('%s','%s'),
			array('%s')
			);
		}
		else{
			$add_refer_code	  = 'no_reference';
			$wp_grv_rv_done_via = 'frontend';
			}
			$dt               = new DateTime();
			$add_rv_date	  = $dt->format('Y-m-d H:i:s');
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
		$rv_type	      = "wp_grv_review";
		$comment_table_data = array(
			'comment_author'       => $add_rv_name,
			'comment_author_email' => $add_rv_email,
			'comment_content'      => $add_rv_content,
			'comment_date'		   => $add_rv_date,
			'comment_approved'	   => $add_approve_stat,
			'comment_type'		   => $rv_type,
			'comment_agent'		   => $add_refer_code
			);
		$id = wp_insert_comment($comment_table_data);
		$comment_id = $id;
		$wp_grv_add_ref  =   filter_input(INPUT_POST,'wp_grv_add_ref');
		if(isset($wp_grv_add_ref)){
			// Update invite table status
			global $wpdb;
		 	$invite_tbl_name = $wpdb->prefix . 'wp_grv_review_invitation_tbl';
		    $wpdb->update( $invite_tbl_name, array(
			'view_link' => admin_url('/admin.php?page=add-new-menu&edit_id='.$comment_id ),
			),
			array('invite_code' => $add_refer_code),
			array('%s'),
			array('%s')
			);
		}
		$comment_meta_table_data  = array(
			'review_title'        				=> $add_rv_title,
			'review_user_image'   				=> $add_usr_img_url,
			'review_done_on'     	 			=> "not_set",
			'review_done_via'     				=> $wp_grv_rv_done_via,
			'review_add_category' 				=> "General Category",
			'review_rating'       				=> $add_rv_rating,
			'review_read_flag'         			=> "0",
			'review_notification_flag' 			=> "1",
			'review_duplicate_details_check'	=> $wp_grv_dup_details_check,
			'review_duplicate_name' 			=> $wp_grv_dup_name,
			'review_duplicate_reason' 			=> $wp_grv_dup_reason
		);
	    update_comment_meta( $comment_id, "comment_extras", $comment_meta_table_data );
	    echo $wp_grv_get_json_data;
	  exit();
	 	}
		public static function wp_grv_intake_form_init(){
			add_action( 'wp_ajax_wp_grv_single_review_image_upload_files', __CLASS__.'::wp_grv_single_review_image_upload_files' );
	        add_action( 'wp_ajax_nopriv_wp_grv_single_review_image_upload_files', __CLASS__.'::wp_grv_single_review_image_upload_files' );
	 		add_action( 'wp_ajax_wp_grv_single_rv_insert', __CLASS__.'::wp_grv_single_rv_insert' );
	 		add_action( 'wp_ajax_nopriv_wp_grv_single_rv_insert' ,__CLASS__.'::wp_grv_single_rv_insert' );
		}
}
Wp_Gratify_Intake_Form_Ajax::wp_grv_intake_form_init();
