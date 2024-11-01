<?php
	/*
	 * fuction to create frontend review intake form
	 * return void
	*/
function wp_grv_intake_function() {
	ob_start();
	/*
	 * Checking invitation link
	 *
	*/
    $wp_grv_ref  =  filter_input(INPUT_GET,'ref');
	if ( isset( $wp_grv_ref ) ) {
		$wp_grv_ref_code = $wp_grv_ref;
		global $wpdb;
		$invitation_tbl    = $wpdb->prefix . 'wp_grv_review_invitation_tbl';
		$result_invitation = $wpdb->get_results( "SELECT * FROM $invitation_tbl ORDER BY invitation_id DESC", ARRAY_A );
		foreach ( $result_invitation as $value_invitation ) {
			$invite_tbl_ref_email_id = $value_invitation['email_id'];
			$invite_tbl_ref_code     = $value_invitation['invite_code'];
			$invite_tbl_rv_done      = $value_invitation['status'];
			if ( ( $wp_grv_ref_code === $invite_tbl_ref_code ) && ( $invite_tbl_rv_done === 'Review done' ) ) {
				$wp_grv_rv_done_stat = 'true';
				?> <h1> Review already done with this link </h1> 
				<?php
				$invalid = '';
				break;
			}
			if ( $wp_grv_ref_code === $invite_tbl_ref_code ) {
				$wp_grv_invalid_code_check = 'true';
				$invalid                   = '';
				break;
			} else {
				$invalid = 'invalid_link';
			}
		}
		if ( $invalid === 'invalid_link' ) {
			?>
		   <h1> Invalid link </h1> 
			<?php
		}
		?>
		<div id="wp_grv_add_new_page" style="
		<?php
		if(isset($wp_grv_rv_done_stat)){
			if ( $wp_grv_rv_done_stat === 'true' ) {
			echo 'display: none;';
			} else {
			echo 'display: block;';}
		}
		?>
		">
		<div style="
		<?php
		if ( ! isset( $wp_grv_invalid_code_check ) ) {
			echo 'display: none;';
		} else {
			echo 'display: block;';}
		?>
		">  
		  <div class="wp_grv_add_new_form_head">
			<div class="wp_grv_add_new_form_head_icon">
			  <i class="fa fa-commenting"></i>
			</div>  
			<div class="wp_grv_add_new_form_head_text">
			  <h2>New Review</h2>
			  <p>Please add your Reviews here</p>
			</div>
		  </div><!-- header div -->
		  <form id="wp_grv_add_new_form" action="" method="POST" enctype="multipart/form-data">
			<div class="wp_grv_add_new_form_content">
			  <label class="wp_grv_required"><?php _e( 'Name', 'wp-gratify-lang' ); ?> </label>
			  <input type="text" maxlength="100" class="wp_grv_field" name="add_name" id="rv_add_name" autocomplete="off" required />
			  <label class="wp_grv_required"><?php _e( 'Email', 'wp-gratify-lang' ); ?></label>
			  <input type="text" maxlength="100" class="wp_grv_field" name="add_email" id="rv_add_email" title="Please enter valid email address" type="email" TextMode="Email" validate="required:true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="<?php echo $invite_tbl_ref_email_id; ?>" autocomplete="off" disabled/>
			  <label class="wp_grv_required"><?php _e( 'Title', 'wp-gratify-lang' ); ?> </label>
			  <input type="text" maxlength="100" class="wp_grv_field" name="add_title" id="rv_add_title" autocomplete="off" />
			  <label class="wp_grv_required"><?php _e( 'Review Content', 'wp-gratify-lang' ); ?> </label>
			  <textarea id="rv_add_content" maxlength="250" rows="5" cols="50" name="add_content" required ></textarea>
			  <label><?php _e( 'User Image', 'wp-gratify-lang' ); ?> </label>
			  <label for="rv_user_image" class="wp_grv_custom-file-upload">
				<i class="fa fa-cloud-upload"></i> Upload your User Image
			  </label>
			  <input id="rv_user_image" type="file" name="user_image" size="25" />
			  <div class="wp_grv_loading_bar" style="display: none;"></div>
			  <div class="wp_grv_upload_success_msg" style="display: none;"><p><?php _e( 'Upload Successfull', 'wp-gratify-lang' ); ?></p></div>
			  <label style="margin: 10px 0px -18px 2px;"><?php _e( 'Rating', 'wp-gratify-lang' ); ?> </label>
			  <div class="rv_add_rating_style">
			  <input type="checkbox" id="rv_st5" value="1" name="st5" />
			  <label for="rv_st5"></label>
			  <input type="checkbox" id="rv_st4" value="2" name="st4" />
			  <label for="rv_st4"></label>
			  <input type="checkbox" id="rv_st3" value="3" name="st3" />
			  <label for="rv_st3"></label>
			  <input type="checkbox" id="rv_st2" value="4" name="st2" />
			  <label for="rv_st2"></label>
			  <input type="checkbox" id="rv_st1" value="5" name="st1" />
			  <label for="rv_st1"></label>
			  </div>
			  <input type="hidden" name="add_ref" id="wp_grv_add_ref" value="
			  <?php
				if ( isset( $wp_grv_ref ) ) {
					echo $wp_grv_ref; }
				?>
				"/>
			  <input type="hidden" name="add_usr_img_url" id="wp_grv_add_usr_img_url" />
			  <input type="button" name="add_rv_sub" id="wp_grv_new_rv_add_sub" value="Submit">
			  <!-- for loading effect -->
			  <div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>
			  <!-- for loading effect ends -->
			</div>  
		  </form>
		</div>
		</div>
		<?php
	} //Reference checking if ends.
	?>
  <div id="wp_grv_add_new_page" style="
	<?php
	if ( isset($wp_grv_ref) ) {
		echo 'display: none;';}
	?>
	"><!-- outer div -->
	<div class="wp_grv_add_new_form_head">
	  <div class="wp_grv_add_new_form_head_icon">
		<i class="fa fa-commenting"></i>
	  </div>  
	  <div class="wp_grv_add_new_form_head_text">
		<h2><?php _e( 'New Review', 'wp-gratify-lang' ); ?></h2>
		<p><?php _e( 'Please add your Reviews here', 'wp-gratify-lang' ); ?></p>
	  </div>
	</div><!-- header div -->
	<form id="wp_grv_add_new_form" action="" method="POST" enctype="multipart/form-data">
	  <div class="wp_grv_add_new_form_content">        
		<label class="wp_grv_required"><?php _e( 'Name', 'wp-gratify-lang' ); ?> </label>
		<input type="text" maxlength="100" name="add_name" class="wp_grv_field" id="rv_add_name" autocomplete="off" required />
		<label class="wp_grv_required"><?php _e( 'Email', 'wp-gratify-lang' ); ?> </label>
		<input type="email" maxlength="100" name="add_email" class="wp_grv_field" id="rv_add_email" autocomplete="off" type="email" TextMode="Email" validate="required:true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" />
		<label class="wp_grv_required"><?php _e( 'Title', 'wp-gratify-lang' ); ?> </label>
		<input type="text" maxlength="100" name="add_title" class="wp_grv_field" id="rv_add_title" autocomplete="off" />
		<label class="wp_grv_required"><?php _e( 'Review Content', 'wp-gratify-lang' ); ?> </label>
		<textarea id="rv_add_content" maxlength="250" rows="5" cols="50" name="add_content" required ></textarea>
		<input type="checkbox" id="wp_grv_add_dup_name_check"><span> <?php _e( 'Add Duplicate Name', 'wp-gratify-lang' ); ?> <i title="For duplicate name." class="fa fa-question-circle"></i> </span>
		<div id="wp_grv_duplicate_data_block">
		  <label class="wp_grv_required"><?php _e( 'Name', 'wp-gratify-lang' ); ?> </label>
		  <input type="text" maxlength="100" name="add_dup_name" class="wp_grv_field" id="wp_grv_dup_name" autocomplete="off" />
		  <label class="wp_grv_required"><?php _e( 'Reason', 'wp-gratify-lang' ); ?> </label>
		  <textarea id="wp_grv_dup_reason" maxlength="250" rows="5" cols="50" name="add_dup_reason" required ></textarea>
		</div>  
		<label><?php _e( 'User Image', 'wp-gratify-lang' ); ?> </label>
		<label for="rv_user_image" class="wp_grv_custom-file-upload">
		  <i class="fa fa-cloud-upload"></i> <?php _e( 'Upload your User Image', 'wp-gratify-lang' ); ?>
		</label>
		<input id="rv_user_image" type="file" name="user_image" size="25" />
		<div class="wp_grv_loading_bar" style="display: none;"></div>
		<div class="wp_grv_upload_success_msg" style="display: none;"><p><?php _e( 'Upload Successfull', 'wp-gratify-lang' ); ?></p></div>
		<label style="margin: 10px 0px -18px 2px;"><?php _e( 'Rating', 'wp-gratify-lang' ); ?> </label>
		<div class="rv_add_rating_style">
		<input type="checkbox" id="rv_st5" value="1" name="st5" />
		<label for="rv_st5"></label>
		<input type="checkbox" id="rv_st4" value="2" name="st4" />
		<label for="rv_st4"></label>
		<input type="checkbox" id="rv_st3" value="3" name="st3" />
		<label for="rv_st3"></label>
		<input type="checkbox" id="rv_st2" value="4" name="st2" />
		<label for="rv_st2"></label>
		<input type="checkbox" id="rv_st1" value="5" name="st1" />
		<label for="rv_st1"></label>
		</div>
		<input type="hidden" name="add_ref" id="wp_grv_add_ref" value="
		<?php
		if ( isset( $wp_grv_ref ) ) {
			echo $wp_grv_ref; }
		?>
		"/>
		<input type="hidden" name="add_usr_img_url" id="wp_grv_add_usr_img_url" />
		<input type="button" name="add_rv_sub" id="wp_grv_new_rv_add_sub" value="Submit">
		<!-- for loading effect -->
		<div id="fountainTextG"><div id="fountainTextG_1" class="fountainTextG">L</div><div id="fountainTextG_2" class="fountainTextG">o</div><div id="fountainTextG_3" class="fountainTextG">a</div><div id="fountainTextG_4" class="fountainTextG">d</div><div id="fountainTextG_5" class="fountainTextG">i</div><div id="fountainTextG_6" class="fountainTextG">n</div><div id="fountainTextG_7" class="fountainTextG">g</div></div>
		<!-- for loading effect ends -->
	  </div>  
	</form>
  </div>
  <div id="wp_grv_add_new_page_social_review" style="display: none;">
	<?php
			$social_review_fetch_data              = get_option( 'social_review_setting' );
				$wp_grv_custom_title               = $social_review_fetch_data['custom_title'];
				$wp_grv_custom_title2              = $social_review_fetch_data['custom_title2'];
				$wp_grv_custom_title3              = $social_review_fetch_data['custom_title3'];
				$wp_grv_google_link_hidden         = $social_review_fetch_data['google_link'];
				$wp_grv_fb_link_hidden             = $social_review_fetch_data['fb_link'];
				$wp_grv_twitter_link_hidden        = $social_review_fetch_data['twitter_link'];
				$wp_grv_custom_link_hidden         = $social_review_fetch_data['custom_link'];
				$wp_grv_custom_link2_hidden        = $social_review_fetch_data['custom_link2'];
				$wp_grv_custom_link3_hidden        = $social_review_fetch_data['custom_link3'];
				$wp_grv_google_logo                = $social_review_fetch_data['google_logo'];
				$wp_grv_fb_logo                    = $social_review_fetch_data['fb_logo'];
				$wp_grv_twitter_logo               = $social_review_fetch_data['twitter_logo'];
				$wp_grv_custom_logo                = $social_review_fetch_data['custom_logo'];
				$wp_grv_custom_logo2               = $social_review_fetch_data['custom_logo2'];
				$wp_grv_custom_logo3               = $social_review_fetch_data['custom_logo3'];
				$google_check                      = $social_review_fetch_data['google_check'];
				$fb_check                          = $social_review_fetch_data['fb_check'];
				$twitter_check                     = $social_review_fetch_data['twitter_check'];
				$custom_check                      = $social_review_fetch_data['custom_check'];
			$review_intake_fetch_settings          = get_option( 'review_intake_settings' );
				$wp_grv_enable_rating              = $review_intake_fetch_settings['display_with_rating'];
				$wp_grv_thank_you_msg_social_media = $review_intake_fetch_settings['thank_you_msg_social_media'];
				$wp_grv_thank_you_msg              = $review_intake_fetch_settings['thank_you_msg'];

			$wp_grv_social_media_link_enable_count = '0';

	if ( ( $google_check === 'true' ) || ( $fb_check === 'true' ) || ( $twitter_check === 'true' ) ) {
		$wp_grv_social_media_link_enable_count = '1';
	}
	if ( ( ( $google_check === 'true' ) && ( $fb_check === 'true' ) ) || ( ( $google_check === 'true' ) && ( $twitter_check === 'true' ) ) || ( ( $fb_check === 'true' ) && ( $twitter_check === 'true' ) ) ) {
		$wp_grv_social_media_link_enable_count = '2';
	}
	if ( ( $google_check === 'true' ) && ( $fb_check === 'true' ) && ( $twitter_check === 'true' ) ) {
		$wp_grv_social_media_link_enable_count = '3';
	}
	?>
	<!-- Thank you message block with links -->
	<div class="wp_grv_thank_you_block">
	  <!-- thank you message -->
	  <div class="wp_grv_msg_block">
		<img src="<?php echo plugin_dir_url(__FILE__). '../shortcode/wp-gratify-icon/wp-grv-smiling-baby-icon.png'; ?>">
		<h1> Thank You <i class="fa fa-exclamation"></i></h1>
		<h3 id="wp_grv_thk_you_msg_front" style="display: none;"><?php echo $wp_grv_thank_you_msg; ?></h3>
		<h3 id="wp_grv_thk_you_msg_social_media_front" style="display: none;"><?php echo $wp_grv_thank_you_msg_social_media; ?></h3>
	  </div><!-- wp_grv_msg_block div ends -->
	  <!-- social media link buttons  -->
	  <div class="wp_grv_social_meadia_link_block" style="
	  <?php
		if ( ( $google_check != 'true' ) && ( $fb_check != 'true' ) && ( $twitter_check != 'true' ) && ( $custom_check != 'true' ) ) {
			echo 'display:none;';}
		?>
		">  
			<?php if ( $wp_grv_google_logo != '' ) { ?>
				<input type="hidden" value="<?php echo $wp_grv_google_link_hidden; ?>" id= "wp_grv_google_link_hidden" >
				<input type="image"  style="display: none; 
				<?php
				if ( ( $wp_grv_social_media_link_enable_count === '1' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 45%; float: inherit; margin: auto;';
				} elseif ( ( $wp_grv_social_media_link_enable_count === '2' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 48.5%;'; }
				?>
				 " title="google" src="<?php echo $wp_grv_google_logo; ?>" id="wp_grv_google_button" class= "wp_grv_social_meadia_btn" />
				<?php
			} else {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_google_link_hidden; ?>" id= "wp_grv_google_link_hidden" >
			  <input type="image" style="display: none; 
				<?php
				if ( ( $wp_grv_social_media_link_enable_count === '1' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 45%; float: inherit; margin: auto;';
				} elseif ( ( $wp_grv_social_media_link_enable_count === '2' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 48.5%;'; }
				?>
				 " title="google" src="<?php echo plugin_dir_url(__FILE__). '../shortcode/wp-gratify-icon/wp-grv-google-plus-default-icon.jpg'; ?>" id="wp_grv_google_button" class= "wp_grv_social_meadia_btn" />
				<?php
			}
			if ( $wp_grv_fb_logo != '' ) {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_fb_link_hidden; ?>" id= "wp_grv_fb_link_hidden" >
			  <input type="image" style="display: none; 
				<?php
				if ( ( $wp_grv_social_media_link_enable_count === '1' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 45%; float: inherit; margin: auto;';
				} elseif ( ( $wp_grv_social_media_link_enable_count === '2' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 48.5%;'; }
				?>
				 " title="facebook" src="<?php echo $wp_grv_fb_logo; ?>" id="wp_grv_fb_button" class= "wp_grv_social_meadia_btn" />
				<?php
			} else {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_fb_link_hidden; ?>" id= "wp_grv_fb_link_hidden" >
			  <input type="image" style="display: none; 
				<?php
				if ( ( $wp_grv_social_media_link_enable_count === '1' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 45%; float: inherit; margin: auto;';
				} elseif ( ( $wp_grv_social_media_link_enable_count === '2' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 48.5%;'; }
				?>
				 " title="facebook" src="<?php echo plugin_dir_url(__FILE__). '../shortcode/wp-gratify-icon/wp-grv-fb-default-icon.jpg'; ?>" id="wp_grv_fb_button" class= "wp_grv_social_meadia_btn" />
				<?php
			}
			if ( $wp_grv_twitter_logo != '' ) {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_twitter_link_hidden; ?>" id= "wp_grv_twitter_link_hidden" >  
			  <input type="image" style="display: none; 
				<?php
				if ( ( $wp_grv_social_media_link_enable_count === '1' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 45%; float: inherit; margin: auto;';
				} elseif ( ( $wp_grv_social_media_link_enable_count === '2' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 48.5%;'; }
				?>
				 " title="Yelp" src="<?php echo $wp_grv_twitter_logo; ?>" id="wp_grv_twitter_button" class= "wp_grv_social_meadia_btn" />
				<?php
			} else {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_twitter_link_hidden; ?>" id= "wp_grv_twitter_link_hidden" >  
			  <input type="image" style="display: none; 
				<?php
				if ( ( $wp_grv_social_media_link_enable_count === '1' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 45%; float: inherit; margin: auto;';
				} elseif ( ( $wp_grv_social_media_link_enable_count === '2' ) && ( $custom_check != 'true' ) ) {
					echo 'width: 48.5%;'; }
				?>
				 " title="Yelp" src="<?php echo plugin_dir_url(__FILE__). '../shortcode/wp-gratify-icon/wp-grv-yelp-default-icon.jpg'; ?>" id="wp_grv_twitter_button" class= "wp_grv_social_meadia_btn" />
				<?php
			}
			if ( $wp_grv_custom_logo != '' ) {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_custom_link_hidden; ?>" id= "wp_grv_custom_link_hidden" >
			  <input type="image" style="display: none;" title="<?php echo $wp_grv_custom_title; ?>" src="<?php echo $wp_grv_custom_logo; ?>" id="wp_grv_custom_button1" class= "wp_grv_social_meadia_btn" />
				<?php
			} else {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_custom_link_hidden; ?>" id= "wp_grv_custom_link_hidden" >  
			  <input type="image" style="display: none;" title="<?php echo $wp_grv_custom_title; ?>" src="<?php echo plugin_dir_url(__FILE__). '../shortcode/wp-gratify-icon/wp-grv-custom-default-icon.jpg'; ?>" id="wp_grv_custom_button1" class= "wp_grv_social_meadia_btn" />
				<?php
			}
			if ( $wp_grv_custom_logo2 != '' ) {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_custom_link2_hidden; ?>" id= "wp_grv_custom_link2_hidden" >  
			  <input type="image" style="display: none;" title="<?php echo $wp_grv_custom_title2; ?>" src="<?php echo $wp_grv_custom_logo2; ?>" id="wp_grv_custom_button2" class= "wp_grv_social_meadia_btn" />
				<?php
			} else {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_custom_link2_hidden; ?>" id= "wp_grv_custom_link2_hidden" class= "wp_grv_social_meadia_btn" >  
			  <input type="image" style="display: none;" title="<?php echo $wp_grv_custom_title2; ?>" src="<?php echo plugin_dir_url(__FILE__). '../shortcode/wp-gratify-icon/wp-grv-custom-default-icon.jpg'; ?>" id="wp_grv_custom_button2" class= "wp_grv_social_meadia_btn" />
				<?php
			}
			if ( $wp_grv_custom_logo3 != '' ) {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_custom_link3_hidden; ?>" id= "wp_grv_custom_link3_hidden" class= "wp_grv_social_meadia_btn">    
			  <input type="image" style="display: none;" title="<?php echo $wp_grv_custom_title3; ?>" src="<?php echo $wp_grv_custom_logo3; ?>" id="wp_grv_custom_button3" class= "wp_grv_social_meadia_btn"/>
				<?php
			} else {
				?>
			  <input type="hidden" value="<?php echo $wp_grv_custom_link3_hidden; ?>" id= "wp_grv_custom_link3_hidden" class= "wp_grv_social_meadia_btn">    
			  <input type="image" style="display: none;" title="<?php echo $wp_grv_custom_title3; ?>" src="<?php echo plugin_dir_url(__FILE__). '../shortcode/wp-gratify-icon/wp-grv-custom-default-icon.jpg'; ?>" id="wp_grv_custom_button3" class= "wp_grv_social_meadia_btn" />
			<?php } ?>
	  </div><!-- wp_grv_social_meadia_link_block div ends --> 
		<div id="wp_grv_default_count" style="display: none;">
		  <h1 id="wp_grv_countdowntimer">5</h1>
		</div>
		<input type="hidden" value="<?php echo get_permalink(); ?>" id= "wp_grv_url_hidden" > 
	
	</div><!-- wp_grv_thank_you_block div ends -->    
  </div>  

	<?php
	$output = ob_get_clean();
	return $output;
}
