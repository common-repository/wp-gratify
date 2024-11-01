<?php

/**
  function to create tabs in settings page
  return void
**/
function wp_grv_settings_function()
{
    
    if ( isset( $_GET['sign_status'] ) && isset( $_GET['gmb_id'] ) ) {
        $current_time = date( 'Y-m-d H:i:s' );
        $end_time = strtotime( '+50 minutes', strtotime( $current_time ) );
        $update_time = date( 'Y-m-d H:i:s', $end_time );
        
        if ( $_GET['sign_status'] === '1' ) {
            $gmp_settings_dat = array(
                'gmb_id'             => filter_input( INPUT_GET, 'gmb_id' ),
                'gmb_status'         => filter_input( INPUT_GET, 'sign_status' ),
                'token_time'         => $current_time,
                'token_refresh_time' => $update_time,
            );
        } else {
            $gmp_settings_dat = array(
                'gmb_id'             => filter_input( INPUT_GET, 'gmb_id' ),
                'gmb_status'         => '0',
                'token_time'         => 'null',
                'token_refresh_time' => 'null',
            );
            /* reset current gmb location */
            $gmb_location_settings_dat = array(
                'gmb_location'           => 'null',
                'gmb_location_name'      => 'null',
                'gmb_selected_locations' => 'null',
            );
            update_option( 'wp_grv_gmb_location_settings', $gmb_location_settings_dat );
        }
        
        update_option( 'gmb_settings', $gmp_settings_dat );
    }
    
    $gmb_fetch_sett = get_option( 'gmb_settings' );
    $refresh_time = $gmb_fetch_sett['token_refresh_time'];
    $current_time = date( 'Y-m-d H:i:s' );
    $gmb_enable_flag = 'false';
    // for location path
    $gmb_location_fetch_settings = get_option( 'wp_grv_gmb_location_settings' );
    $wp_grv_gmb_location_path = $gmb_location_fetch_settings['gmb_location'];
    // check gmb enable or not.
    if ( isset( $gmb_fetch_sett['gmb_status'] ) ) {
        if ( $gmb_fetch_sett['gmb_status'] === '1' && $wp_grv_gmb_location_path != 'null' ) {
            $gmb_enable_flag = 'true';
        }
    }
    global  $wpdb ;
    $wp_grv_rtc = filter_input( INPUT_GET, 'rtc' );
    
    if ( isset( $wp_grv_rtc ) ) {
        $check_gmb_value = filter_input( INPUT_GET, 'rtc' );
    } else {
        $check_gmb_value = 'false';
    }
    
    
    if ( $check_gmb_value === 'true' || strtotime( $refresh_time ) > strtotime( $current_time ) || $gmb_enable_flag === 'false' ) {
        ?>
<div id="wp_grv_settings_page_container">
	<!-- div shows loader icon -->
	  <div class="se-pre-con"></div>
	<!-- Ends -->
	<!-- Settings notification bar (admin bar) -->
	<div id="wp_grv_ajax_notification_load" class="wp_grv_header_notification_bar">
		<?php 
        $wp_grv_notification_data = get_option( 'schema_settings' );
        
        if ( strlen( $wp_grv_notification_data['company_name'] ) >= 10 ) {
            $wp_grv_cmp_name = substr( $wp_grv_notification_data['company_name'], 0, 10 ) . '..';
        } else {
            $wp_grv_cmp_name = $wp_grv_notification_data['company_name'];
        }
        
        // taking notification count from comment table
        global  $wpdb ;
        $comment_tbl = $wpdb->prefix . 'comments';
        $wp_grv_notification_count = '0';
        $comment_tbl_data = $wpdb->get_results( "SELECT * FROM {$comment_tbl} WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC", ARRAY_A );
        foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
            $rv_id_fetch = $value_comment_tbl_data['comment_ID'];
            $key = 'comment_extras';
            $comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
            foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
                $wp_grv_notification_flag = $comment_meta_data_fetch_value['review_notification_flag'];
                if ( $wp_grv_notification_flag === '1' ) {
                    $wp_grv_notification_count = $wp_grv_notification_count + 1;
                }
            }
            if ( $wp_grv_notification_flag === '0' ) {
                break;
            }
        }
        /*GMB Login status ends*/
        $schema_fetch_sett = get_option( 'schema_settings' );
        $review_intake_fetch_settings = get_option( 'review_intake_settings' );
        $invitation_fetch_sett = get_option( 'invitation_settings' );
        $social_review_fetch_sett = get_option( 'social_review_setting' );
        $gmb_fetch_sett = get_option( 'gmb_settings' );
        $social_proofing_fetch_sett = get_option( 'social_proofing_settings' );
        ?>
		<a class="wp_grv_bell_hover" style="color: #ffff;" href="<?php 
        echo  admin_url( '/admin.php?page=all_review_menu' ) ;
        ?>"><i class="fa fa-bell"></i></a><span class="wp_grv_notification_count" 
																			<?php 
        if ( $wp_grv_notification_count === '0' ) {
            echo  'style = "display: none"' ;
        }
        ?>
		><?php 
        echo  $wp_grv_notification_count ;
        ?></span>&nbsp;&nbsp;
		<a class="wp_grv_settings_icon_hover" style="color: #ffff;" href="<?php 
        echo  admin_url( '/admin.php?page=settings-menu' ) ;
        ?>"><i class="fa fa-cog" style="margin-left: 15px;"></i></a></span>&nbsp;&nbsp;&nbsp; 
		<a style="text-decoration: none; color: #ffff;" href="<?php 
        echo  admin_url( '/admin.php?page=settings-menu' ) ;
        ?>"><span class="wp_grv_notification_user_hover"><img style="width:25px; position: relative; top: 4px;" src="<?php 
        echo  $wp_grv_notification_data['company_logo'] ;
        ?>" style="width:30px;">&nbsp;&nbsp;<span style="font-size: initial; font-weight: 700;"><?php 
        echo  $wp_grv_cmp_name ;
        ?></span></span></a>
	</div>
	<!-- notification bar ends -->
	<!-- settings menue bar -->
	<div id="tabs" class="wp_grv_menu_settings_tab">
	  <input type="hidden" value="<?php 
        echo  'free' ;
        ?>" id="wp_grv_gratify_version">	
	  <ul>
		<li id="wp_grv_schema_tab" class="wp_grv_tab <?php 
        if ( $schema_fetch_sett == '' ) {
            echo  'wp_grv_tab_first_sub' ;
        }
        ?>"><a class="wp_grv_schema_tab_a" href="#rv_schema_tab" title="Schema settings"><i class="fa fa-building-o"></i> <span>&nbsp;<?php 
        echo  esc_html_e( 'Schema', 'wp-gratify-lang' ) ;
        ?></span></a></li>
		<li id="wp_grv_rv_intake_tab" class="wp_grv_tab <?php 
        if ( $review_intake_fetch_settings == '' ) {
            echo  'wp_grv_tab_first_sub' ;
        }
        ?>"><a class="wp_grv_rv_intake_tab_a" href="#rv_intake_tab" class="wp_grv_rv_intake_tab_a" title="Review intake settings"><i class="fa fa-id-card"></i><span>&nbsp;<?php 
        echo  esc_html_e( 'Review intake', 'wp-gratify-lang' ) ;
        ?></span></a></li>
<?php 
        ?>
		<li id="wp_grv_social_review_tab" class="wp_grv_tab <?php 
        if ( $social_review_fetch_sett == '' ) {
            echo  'wp_grv_tab_first_sub' ;
        }
        ?>"><a class="wp_grv_social_review_tab_a" href="#rv_social_review_tab" class="wp_grv_social_review_tab_a" title="Social Review settings"><i class="fa fa-share-square-o"></i><span>&nbsp;<?php 
        echo  esc_html_e( 'Social Review', 'wp-gratify-lang' ) ;
        ?></span></a></li>
		<li id="wp_grv_social_proofing_tab" class="wp_grv_tab <?php 
        if ( $social_proofing_fetch_sett == '' ) {
            echo  'wp_grv_tab_first_sub' ;
        }
        ?>"><a class="wp_grv_social_proofing_tab_a" href="#rv_social_proofing_tab" title="Social Proofing settings"><i class="fa fa-id-card-o"></i><span>&nbsp;<?php 
        echo  esc_html_e( 'Social Proofing', 'wp-gratify-lang' ) ;
        ?></span></a></li>
		<?php 
        ?>
	  </ul> 
	  <!--
		div for loading
	   --> 
	  <div class="wp_grv_loader" id="wp_grv_loader" style="display: none;"></div>
	  <!-- end loading -->
	  <div id="rv_schema_tab"> 
	  <!-- revew schema comany details form -->
	 <?php 
        $schema_fetch_sett = get_option( 'schema_settings' );
        ?>
		
		   <h2 class="wp_grv_cmp_details_txt wp_grv_head_txt">&nbsp;&nbsp;&nbsp;&nbsp;<?php 
        echo  esc_html_e( 'Company  Details', 'wp-gratify-lang' ) ;
        ?></h2>
		<br><br>
		   <form>
		  <table id="wp_grv_cmp_form_block">
			<tr>
                  <th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Organization Schema Enable:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><label class="wp_grv_orgn_schema"><input type="checkbox" name="organization_schema_enable" id="wp_grv_organization_schema_enable" value="true" <?php 
        if ( $schema_fetch_sett['organization_schema_enable'] === "true" ) {
            echo  'checked' ;
        }
        ?>/><span class="grv_rv_orgn_schema_slider grv_rv_orgn_schema_round"></span></label></td>
            </tr>	
			<tr>
				   <th><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Company Name:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="text" class="wp_grv_field" name="cmp_name" id="rv_cmp_name" maxlength="100" value="<?php 
        echo  $schema_fetch_sett['company_name'] ;
        ?>" autocomplete="off" required/></td>
			</tr> 
			<br/>
			<tr> 
				   <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Company Logo:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="hidden" value="<?php 
        echo  $schema_fetch_sett['company_logo'] ;
        ?>" name="cmp_logo_url" id="rv_cmp_logo_url"><input id="rv_cmp_logo" type="text" placeholder="Company logo ( 270 X 270 )" class="wp_grv_field" name="cmp_logo" disabled value="<?php 
        echo  $schema_fetch_sett['company_logo'] ;
        ?>" />&nbsp;&nbsp;<button class="wp_grv_btn" id="rv_upload_logo_button" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" title="Reset" id="cmp_logo_reset_btn"><i class="fa fa-history"></i></button><div><img id="rv_cmp_logo_shows" src="<?php 
        echo  $schema_fetch_sett['company_logo'] ;
        ?>" style="width:70px; margin-top: 4px; 
																				   <?php 
        if ( $schema_fetch_sett['company_logo'] === '' ) {
            echo  'display: none;' ;
        }
        ?>
					" ></td>
			</tr>
			<tr>  
				   <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Company Email: ', 'wp-gratify-lang' ) ;
        ?></label></th><td><br/><input type="text" class="wp_grv_field" maxlength="100" name="cmp_email" id="rv_cmp_email" value="<?php 
        echo  $schema_fetch_sett['company_email'] ;
        ?>" autocomplete="off" title="Please enter valid email address" type="email" TextMode="Email" validate="required:true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$"/><br/>
			</tr>
			<tr>  
				   <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Address Line 1: ', 'wp-gratify-lang' ) ;
        ?></label></th><td><br/><input type="text" class="wp_grv_field" name="cmp_adr_1" maxlength="250" id="rv_cmp_adr_1" value="<?php 
        echo  $schema_fetch_sett['company_add_l1'] ;
        ?>" autocomplete="off" required/></td>
			</tr>
			<tr>  
				   <th><br/><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Address Line 2:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="text" class="wp_grv_field" name="cmp_adr_2" id="rv_cmp_adr_2" maxlength="250" value="<?php 
        echo  $schema_fetch_sett['company_add_l2'] ;
        ?>" autocomplete="off"/></td>
			</tr>
			<tr>  
				   <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'City:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="text" class="wp_grv_field" name="cmp_city" id="rv_cmp_city" maxlength="100" value="<?php 
        echo  $schema_fetch_sett['company_city'] ;
        ?>" autocomplete="off" required/></td>
			</tr>
			<tr>  
				   <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'State:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="text" class="wp_grv_field" name="cmp_state" id="rv_cmp_state" maxlength="100" value="<?php 
        echo  $schema_fetch_sett['company_state'] ;
        ?>" autocomplete="off" required/></td>
			</tr>
			<tr>  
				   <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Country:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="text" class="wp_grv_field" name="cmp_country" id="rv_cmp_country" maxlength="100" value="<?php 
        echo  $schema_fetch_sett['company_country'] ;
        ?>" autocomplete="off" required/></td>
			</tr>
			<tr>  
				   <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Zip Code:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="text" class="wp_grv_field" name="cmp_zip_code" id="rv_cmp_zip_code" maxlength="50" value="<?php 
        echo  $schema_fetch_sett['company_zip_code'] ;
        ?>" autocomplete="off" required/></td>
			</tr>
			<tr>  
				   <td colspan="2"><button name="rv_cmp_details_sub" class="wp_grv_btn_sub" id="rv_cmp_details_sub"><i class="fa fa-floppy-o"></i>&nbsp; <?php 
        
        if ( $schema_fetch_sett != '' ) {
            echo  esc_html_e( 'Save Changes', 'wp-gratify-lang' ) ;
        } else {
            echo  esc_html_e( 'Save And Next', 'wp-gratify-lang' ) ;
        }
        
        ?></button>
				   </td>
			</tr>
		  </table>    
		   </form><!-- schema form ends -->
	  </div><!--rv_schema_tab div ends.-->
	  <!-- revew intake settings -->
	  <div id="rv_intake_tab">
	<?php 
        $review_intake_fetch_settings = get_option( 'review_intake_settings' );
        ?>
	 
		<h2 class="wp_grv_rv_intake_txt wp_grv_head_txt">&nbsp;&nbsp;&nbsp;&nbsp;<?php 
        echo  esc_html_e( 'Review Intake Settings', 'wp-gratify-lang' ) ;
        ?></h2>
		<br><br>
		  <form>
		  <table id="wp_grv_rv_intake_form_block">
			<tr>
					<th><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Front end Review Display:', 'wp-gratify-lang' ) ;
        ?></label></th>
					<td><div class="wp_grv_tooltip"><select id="rv_disp_with_rating" class="wp_grv_select_field" name="disp_with_rating">
					 <option value="4to5"><?php 
        echo  esc_html_e( '4 to 5 Star Rated Review', 'wp-gratify-lang' ) ;
        ?></option>	
					 <option value="3andabove" 
					 <?php 
        if ( $review_intake_fetch_settings['display_with_rating'] === '3andabove' ) {
            echo  'selected' ;
        }
        ?>
						><?php 
        echo  esc_html_e( '3 Star And Above', 'wp-gratify-lang' ) ;
        ?></option>
					 <option value="below3" 
					 <?php 
        if ( $review_intake_fetch_settings['display_with_rating'] === 'below3' ) {
            echo  'selected' ;
        }
        ?>
						><?php 
        echo  esc_html_e( 'Rate Below 3 Star', 'wp-gratify-lang' ) ;
        ?> </option>
					 <option value="all" 
					 <?php 
        if ( $review_intake_fetch_settings['display_with_rating'] === 'all' ) {
            echo  'selected' ;
        }
        ?>
						><?php 
        echo  esc_html_e( 'Rate All Star', 'wp-gratify-lang' ) ;
        ?> </option>
				</select><span class="wp_grv_tooltip_text"><?php 
        echo  esc_html_e( 'To display review on frontend based on star rating.', 'wp-gratify-lang' ) ;
        ?></span></div></td>
			</tr>
			<tr>
				  <th><br/><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Auto Post:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><div class="wp_grv_tooltip"><label class="wp_grv_switch_intake_settings"><input type="checkbox" name="auto_post" id="rv_auto_post" value="true" 
																  <?php 
        if ( $review_intake_fetch_settings['auto_post'] === 'true' ) {
            echo  'checked' ;
        }
        ?>
					 /><span class="grv_rv_intake_slider grv_rv_intake_round"></span></label><span class="wp_grv_tooltip_text"><?php 
        echo  esc_html_e( 'Automatically approve reviews based on star rating you prefered.', 'wp-gratify-lang' ) ;
        ?></span></div></td>
			</tr>
			<tr>      
				  <th><label class="wp_grv_label wp_grv_required"><br/><br/><span style="float: left;"><?php 
        echo  esc_html_e( 'Thank You message', 'wp-gratify-lang' ) ;
        ?> </span><br/> <?php 
        echo  esc_html_e( 'content with social Media:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><div class="wp_grv_tooltip"><br/><textarea class="wp_grv_field" id="rv_thk_msg_social_media" maxlength="250" rows="4" cols="50" name="thank_you_msg_social_media">
<?php 
        
        if ( $review_intake_fetch_settings['thank_you_msg_social_media'] != '' ) {
            echo  esc_html_e( $review_intake_fetch_settings['thank_you_msg_social_media'], 'wp-gratify-lang' ) ;
        } else {
            echo  esc_html_e( 'Thank You For Your Review. You can also review on', 'wp-gratify-lang' ) ;
        }
        
        ?>
					</textarea><span class="wp_grv_tooltip_text"><?php 
        echo  esc_html_e( 'Thank you message with social media links based on above star rating.', 'wp-gratify-lang' ) ;
        ?></span></div></td>
			</tr>
			<tr>      
				  <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Thank You message content:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><div class="wp_grv_tooltip"><br/><textarea class="wp_grv_field" id="rv_thk_msg" maxlength="250" rows="4" cols="50" name="thank_you_msg"><?php 
        
        if ( $review_intake_fetch_settings['thank_you_msg'] != '' ) {
            echo  esc_html_e( $review_intake_fetch_settings['thank_you_msg'], 'wp-gratify-lang' ) ;
        } else {
            echo  esc_html_e( 'Thank You For Your Review', 'wp-gratify-lang' ) ;
        }
        
        ?></textarea><span class="wp_grv_tooltip_text"><?php 
        echo  esc_html_e( 'Display thank you message if star rating is below your preference.', 'wp-gratify-lang' ) ;
        ?></span></div></td>
			</tr>
			<tr>      
				  <th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Default User Image:', 'wp-gratify-lang' ) ;
        ?></label></th><td><br/><input type="hidden" value="<?php 
        echo  $review_intake_fetch_settings['user_image'] ;
        ?>" id="rv_usr_img_url" name="usr_img_url" /><input id="rv_usr_img" type="text" class="wp_grv_field" disabled name="user_image" value="<?php 
        echo  $review_intake_fetch_settings['user_image'] ;
        ?>" /> <button id="rv_upload_usr_img_button" class="wp_grv_btn" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;<button id="usr_img_reset_btn" class="wp_grv_btn" title="Reset"><i class="fa fa-history"></i></button><img id="rv_intake_logo_shows" src="<?php 
        echo  $review_intake_fetch_settings['user_image'] ;
        ?>" style="width:70px; margin-top: 4px; 
				<?php 
        
        if ( $review_intake_fetch_settings['user_image'] === '' ) {
            echo  'display: none;' ;
        } else {
            echo  'display: block;' ;
        }
        
        ?>
					" ></td>
			</tr>
			<tr>      
				  <th><br/><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Review Archieve Page:', 'wp-gratify-lang' ) ;
        ?></label></th>
				  <td><br/><div class="wp_grv_tooltip">
				  <?php 
        $wp_grv_page_id = 0;
        global  $wpdb ;
        $wp_grv_review_archive_page_id_result = $wpdb->get_row( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = 'review-archive'", 'ARRAY_A' );
        foreach ( $wp_grv_review_archive_page_id_result as $wp_grv_review_archive_page_id ) {
            
            if ( $review_intake_fetch_settings['archieve_page_id'] == '' ) {
                $wp_grv_page_id = $wp_grv_review_archive_page_id;
            } else {
                $wp_grv_page_id = $review_intake_fetch_settings['archieve_page_id'];
            }
            
            $args = array(
                'depth'                 => 0,
                'child_of'              => 0,
                'selected'              => $wp_grv_page_id,
                'echo'                  => 1,
                'name'                  => 'page_id',
                'id'                    => 'rv_archieve_pg_sel',
                'class'                 => 'wp_grv_select_field',
                'show_option_none'      => null,
                'show_option_no_change' => null,
                'option_none_value'     => null,
            );
            $page_list = wp_dropdown_pages( $args );
        }
        ?>
				  <span class="wp_grv_tooltip_text"><?php 
        echo  esc_html_e( 'Select page for archive. Default page is Review Archive', 'wp-gratify-lang' ) ;
        ?></span></div></td>
			</tr>
			<tr>      
				  <th><br/><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Review Intake Form Page:', 'wp-gratify-lang' ) ;
        ?></label></th>
				  <td><br/><div class="wp_grv_tooltip">
				  <?php 
        $wp_grv_page_id_rv_intake = 0;
        global  $wpdb ;
        $wp_grv_review_intake_page_id_result = $wpdb->get_row( "SELECT ID FROM {$wpdb->prefix}posts WHERE post_name = 'review-intake'", 'ARRAY_A' );
        foreach ( $wp_grv_review_intake_page_id_result as $wp_grv_review_intake_page_id ) {
            
            if ( $review_intake_fetch_settings['review_intake_page_id'] == '' ) {
                $wp_grv_page_id_rv_intake = $wp_grv_review_intake_page_id;
            } else {
                $wp_grv_page_id_rv_intake = $review_intake_fetch_settings['review_intake_page_id'];
            }
            
            $args_intake = array(
                'depth'                 => 0,
                'child_of'              => 0,
                'selected'              => $wp_grv_page_id_rv_intake,
                'echo'                  => 1,
                'name'                  => 'page_id',
                'id'                    => 'wp_grv_intake_pg_sel',
                'class'                 => 'wp_grv_select_field',
                'show_option_none'      => null,
                'show_option_no_change' => null,
                'option_none_value'     => null,
            );
            $page_list_intake = wp_dropdown_pages( $args_intake );
        }
        ?>
				  <span class="wp_grv_tooltip_text"><?php 
        echo  esc_html_e( 'Select page for frontend review intake form. Default page is Review Intake', 'wp-gratify-lang' ) ;
        ?></span></div></td>
			</tr>
			<tr>  
					 <td colspan="2"><br/><br/><button name="save_changes_review_intake" class="wp_grv_btn_sub" id="rv_review_intake_details_sub"><i class="fa fa-floppy-o"></i>&nbsp; <?php 
        
        if ( $review_intake_fetch_settings != '' ) {
            echo  esc_html_e( 'Save Changes', 'wp-gratify-lang' ) ;
        } else {
            echo  esc_html_e( 'Save And Next', 'wp-gratify-lang' ) ;
        }
        
        ?></button></td>
			</tr>
		  </table>    
		  </form>
	  </div><!-- rv_intake_tab div ends -->
	<!-- revew invite settings -->
<?php 
        //lock condition ends
        ?>
	  <!-- social review settings -->
	   <div id="rv_social_review_tab">
	<?php 
        $social_review_fetch_sett = get_option( 'social_review_setting' );
        ?>
			
		<h2 class="wp_grv_social_media_txt wp_grv_head_txt">&nbsp;&nbsp;&nbsp;&nbsp;<?php 
        echo  esc_html_e( 'Social Media Review Settings', 'wp-gratify-lang' ) ;
        ?></h2>
		<br/><br/>
		   <form>
	   <!-- social media enable block -->

		<div id="wp_grv_social_media_form_block">
		  <!-- check box block content -->
		  <div class="wp_grv_social_media_check_box_text">
			<label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Enable Social Media Review:', 'wp-gratify-lang' ) ;
        ?> </label>
		  </div>
		  <div class="wp_grv_social_media_check_box_set_1">
			<!-- google check box -->
			<div class="wp_grv_social_media_google_block">
			  <label><?php 
        echo  esc_html_e( ' Google ', 'wp-gratify-lang' ) ;
        ?></label><label class="wp_grv_switch_social_media_settings"><input type="checkbox" name="google_check" id="rw_google" value="true" 
								<?php 
        if ( $social_review_fetch_sett['google_check'] === 'true' ) {
            echo  'checked' ;
        }
        ?>
				 /><span class="grv_rv_social_media_slider grv_rv_social_media_round"></span></label>
			</div>
			<!-- fb check box -->
			<div class="wp_grv_social_media_fb_block">
			  <label><?php 
        echo  esc_html_e( ' Facebook ', 'wp-gratify-lang' ) ;
        ?></label><label class="wp_grv_switch_social_media_settings"><input type="checkbox" name="fb_check" id="rw_fb" value="true" 
								<?php 
        if ( $social_review_fetch_sett['fb_check'] === 'true' ) {
            echo  'checked' ;
        }
        ?>
				 /><span class="grv_rv_social_media_slider grv_rv_social_media_round"></span></label>
			</div>
		  </div> 
		  <div class="wp_grv_social_media_check_box_set_2"> 
			<!-- yelp check box -->
			<div class="wp_grv_social_media_yelp_block">
			  <label><?php 
        echo  esc_html_e( ' Yelp ', 'wp-gratify-lang' ) ;
        ?></label><label class="wp_grv_switch_social_media_settings"><input type="checkbox" name="twitter_check" id="rw_twitter" value="true" 
								<?php 
        if ( $social_review_fetch_sett['twitter_check'] === 'true' ) {
            echo  'checked' ;
        }
        ?>
				 /><span class="grv_rv_social_media_slider grv_rv_social_media_round"></span></label>
			</div>
			<!-- custom check box -->
			<div class="wp_grv_social_media_custom_block">
			  <label><?php 
        echo  esc_html_e( ' Custom (Max 3) ', 'wp-gratify-lang' ) ;
        ?></label><label class="wp_grv_switch_social_media_settings"><input type="checkbox" name="custom_check" id="rw_custom" value="true" 
								<?php 
        if ( $social_review_fetch_sett['custom_check'] === 'true' ) {
            echo  'checked' ;
        }
        ?>
				 /><span class="grv_rv_social_media_slider grv_rv_social_media_round"></span></label>
			</div>
		  </div>
		</div>

		<!-- social media enable block ends -->
		  <table id="rw_google_form" 
		  <?php 
        
        if ( $social_review_fetch_sett['google_check'] === 'true' ) {
            echo  'style="display:inline-table;"' ;
        } else {
            echo  'style="display:none;"' ;
        }
        
        ?>
			 > 		
			<tr> 			
				  <td colspan="2"><h2><?php 
        echo  esc_html_e( 'Google', 'wp-gratify-lang' ) ;
        ?></h2></td>
			</tr>
			<tr>      
						 <th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Logo:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="hidden" name="google_logo_url" value="<?php 
        echo  $social_review_fetch_sett['google_logo'] ;
        ?>" id="rv_google_logo_url"><input id="rv_google_logo" placeholder="<?php 
        echo  esc_html_e( 'Default Image (300 X 150)', 'wp-gratify-lang' ) ;
        ?>" type="text" class="wp_grv_field" disabled name="google_logo" value="<?php 
        echo  $social_review_fetch_sett['google_logo'] ;
        ?>" />&nbsp;<button class="wp_grv_btn" id="rv_upload_google_logo_button" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" id="google_reset_btn" title="Reset"><i class="fa fa-history"></i></button><img id="rv_google_logo_shows" src="
																	<?php 
        
        if ( $social_review_fetch_sett['google_logo'] != '' ) {
            echo  $social_review_fetch_sett['google_logo'] ;
        } else {
            echo  plugin_dir_url( __FILE__ ) . '../shortcode/wp-gratify-icon/wp-grv-google-plus-default-icon.jpg' ;
        }
        
        ?>
							" style="width:70px; margin-top: 4px; display: block;" ></td>
			</tr>
			<tr>      
						 <th><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Link:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="text" class="wp_grv_field" name="google_link" id="rv_google_link" value="<?php 
        echo  $social_review_fetch_sett['google_link'] ;
        ?>" /></td>
			</tr> 
		  </table>
		  <table id="rw_fb_form" 
		  <?php 
        
        if ( $social_review_fetch_sett['fb_check'] === 'true' ) {
            echo  'style="display:inline-table;"' ;
        } else {
            echo  'style="display:none;"' ;
        }
        
        ?>
			 >	
				 <tr><td colspan="2"><h2><?php 
        echo  esc_html_e( 'Facebook', 'wp-gratify-lang' ) ;
        ?></h2></td></tr>
				 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Logo:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="hidden" name="fb_logo_url"  value="<?php 
        echo  $social_review_fetch_sett['fb_logo'] ;
        ?>" id="rv_fb_logo_url"><input id="rv_fb_logo" placeholder="<?php 
        echo  esc_html_e( 'Default Image (300 X 150)', 'wp-gratify-lang' ) ;
        ?>" type="text" class="wp_grv_field" disabled name="fb_logo" value="<?php 
        echo  $social_review_fetch_sett['fb_logo'] ;
        ?>" />&nbsp;<button class="wp_grv_btn" id="rv_upload_fb_logo_button" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" id="fb_reset_btn" title="Reset"><i class="fa fa-history"></i></button><img id="rv_fb_logo_shows" src="
																<?php 
        
        if ( $social_review_fetch_sett['fb_logo'] != '' ) {
            echo  $social_review_fetch_sett['fb_logo'] ;
        } else {
            echo  plugin_dir_url( __FILE__ ) . '../shortcode/wp-gratify-icon/wp-grv-fb-default-icon.jpg' ;
        }
        
        ?>
					" style="width:70px; margin-top: 4px; display: block;" ></td></tr>
				 <tr><th><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Link:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="text" class="wp_grv_field" name="fb_link" id="rv_fb_link" value="<?php 
        echo  $social_review_fetch_sett['fb_link'] ;
        ?>" /></td></tr>
		  </table>
		  <table id="rw_twitter_form" 
		  <?php 
        
        if ( $social_review_fetch_sett['twitter_check'] === 'true' ) {
            echo  'style="display:inline-table;"' ;
        } else {
            echo  'style="display:none;"' ;
        }
        
        ?>
			>
						 <tr><td colspan="2"><h2><?php 
        echo  esc_html_e( 'Yelp', 'wp-gratify-lang' ) ;
        ?></h2></td></tr>
						 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Logo:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="hidden" name="twitter_logo_url" value="<?php 
        echo  $social_review_fetch_sett['twitter_logo'] ;
        ?>" id="rv_twitter_logo_url"><input id="rv_twitter_logo" placeholder="<?php 
        echo  esc_html_e( 'Default Image (300 X 150)', 'wp-gratify-lang' ) ;
        ?>" type="text" class="wp_grv_field" disabled name="twitter_logo" value="<?php 
        echo  $social_review_fetch_sett['twitter_logo'] ;
        ?>" />&nbsp;<button class="wp_grv_btn" id="rv_upload_twitter_logo_button" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" id="twitter_reset_btn" title="Reset"><i class="fa fa-history"></i></button><img id="rv_twitter_logo_shows" src="
																		<?php 
        
        if ( $social_review_fetch_sett['twitter_logo'] != '' ) {
            echo  $social_review_fetch_sett['twitter_logo'] ;
        } else {
            echo  plugin_dir_url( __FILE__ ) . '../shortcode/wp-gratify-icon/wp-grv-yelp-default-icon.jpg' ;
        }
        
        ?>
							" style="width:70px; margin-top: 4px; display: block;" ></td></tr>
						 <tr><th><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Link:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="text" class="wp_grv_field" name="twitter_link" id="rv_twitter_link" value="<?php 
        echo  $social_review_fetch_sett['twitter_link'] ;
        ?>" /></td></tr>
		  </table>        
		  <table id="rw_custom_form" 
		  <?php 
        
        if ( $social_review_fetch_sett['custom_check'] === 'true' ) {
            echo  'style="display:inline-table;"' ;
        } else {
            echo  'style="display:none;"' ;
        }
        
        ?>
			 >	
						 <tr><td colspan="2"><h2><?php 
        echo  esc_html_e( 'Custom Field 1', 'wp-gratify-lang' ) ;
        ?></h2></td></tr>
						 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Title:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="text" class="wp_grv_field" name="custom_title" id="rv_custom_title" maxlength="100" value="<?php 
        echo  $social_review_fetch_sett['custom_title'] ;
        ?>" /></td></tr>
						 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Logo:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="hidden" name="custom_logo_url" value="<?php 
        echo  $social_review_fetch_sett['custom_logo'] ;
        ?>" id="rv_custom_logo_url"><input id="rv_custom_logo" placeholder="<?php 
        echo  esc_html_e( 'Default Image (300 X 150)', 'wp-gratify-lang' ) ;
        ?>" type="text" class="wp_grv_field" disabled name="custom_logo" value="<?php 
        echo  $social_review_fetch_sett['custom_logo'] ;
        ?>" />&nbsp;<button class="wp_grv_btn" id="rv_upload_custom_logo_button" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" id="custom_logo_reset_btn" title="Reset"><i class="fa fa-history"></i></button><img id="rv_custom_logo_shows" src="
																		<?php 
        
        if ( $social_review_fetch_sett['custom_logo'] != '' ) {
            echo  $social_review_fetch_sett['custom_logo'] ;
        } else {
            echo  plugin_dir_url( __FILE__ ) . '../shortcode/wp-gratify-icon/wp-grv-custom-default-icon.jpg' ;
        }
        
        ?>
							" style="width:70px; margin-top: 4px; margin-bottom: 4px; display: block;" ></td></tr>
						 <tr><th><label class="wp_grv_label wp_grv_required"><?php 
        echo  esc_html_e( 'Link:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><input type="text" class="wp_grv_field" name="custom_link" id="rv_custom_link" value="<?php 
        echo  $social_review_fetch_sett['custom_link'] ;
        ?>" /></td></tr>
						 <tr><td colspan="3"><button name="add_new_custom_field" class="wp_grv_btn" id="rv_add_new_custom_field"><?php 
        echo  esc_html_e( 'Add New', 'wp-gratify-lang' ) ;
        ?>&nbsp;<i class="fa fa-plus-square"></i></button></td></tr>
		  </table>
		  <table id="rw_custom_form2" 
		  <?php 
        
        if ( $social_review_fetch_sett['custom_check'] === 'true' && $social_review_fetch_sett['custom_title2'] != '' ) {
            echo  'style="display:inline-table;"' ;
        } else {
            echo  'style="display:none;"' ;
        }
        
        ?>
			 >        
							 <tr><td colspan="3"><h2><?php 
        echo  esc_html_e( 'Custom Field 2', 'wp-gratify-lang' ) ;
        ?></h2></td><td colspan="2"><button class="removeclass2 wp_grv_btn"><i class="fa fa-times"></i></button></td></tr>
							 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Title:', 'wp-gratify-lang' ) ;
        ?> </label></th><td colspan="2" style="width: 87%;"><input type="text" class="wp_grv_field" name="custom_title2" maxlength="100" id="rv_custom_title2" value="<?php 
        echo  $social_review_fetch_sett['custom_title2'] ;
        ?>" /></td></tr>
							 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Logo:', 'wp-gratify-lang' ) ;
        ?> </label></th><td colspan="2" style="width: 87%;"><input type="hidden" name="custom_logo2_url" value="<?php 
        echo  $social_review_fetch_sett['custom_logo2'] ;
        ?>" id="rv_custom_logo2_url"><input id="rv_custom_logo2" placeholder="<?php 
        echo  esc_html_e( 'Default Image (300 X 150)', 'wp-gratify-lang' ) ;
        ?>" type="text" class="wp_grv_field" disabled name="custom_logo2" value="<?php 
        echo  $social_review_fetch_sett['custom_logo2'] ;
        ?>" />&nbsp;<button class="wp_grv_btn" id="rv_upload_custom_logo_button2" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" id="custom_logo2_reset_btn" title="Reset"><i class="fa fa-history"></i></button><img id="rv_custom_logo2_shows" src="
																			<?php 
        
        if ( $social_review_fetch_sett['custom_logo2'] != '' ) {
            echo  $social_review_fetch_sett['custom_logo2'] ;
        } else {
            echo  plugin_dir_url( __FILE__ ) . '../shortcode/wp-gratify-icon/wp-grv-custom-default-icon.jpg' ;
        }
        
        ?>
								" style="width:70px; margin-top: 4px; margin-bottom: 4px; display: block;" ></td></tr>
							 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Link:', 'wp-gratify-lang' ) ;
        ?> </label></th><td colspan="2" style="width: 87%;"><input type="text" class="wp_grv_field" name="custom_link2" id="rv_custom_link2" value="<?php 
        echo  $social_review_fetch_sett['custom_link2'] ;
        ?>" /></td></tr>
							 <tr><td colspan="3"><button name="add_new_custom_field2" class="wp_grv_btn" id="rv_add_new_custom_field2"><?php 
        echo  esc_html_e( 'Add New', 'wp-gratify-lang' ) ;
        ?>&nbsp;<i class="fa fa-plus-square"></i></button></td></tr>
		  </table>
		  <table id="rw_custom_form3" 
		  <?php 
        
        if ( $social_review_fetch_sett['custom_check'] === 'true' && $social_review_fetch_sett['custom_title3'] != '' ) {
            echo  'style="display:inline-table;"' ;
        } else {
            echo  'style="display:none;"' ;
        }
        
        ?>
			 >
							 <tr><td colspan="3"><h2><?php 
        echo  esc_html_e( 'Custom Field 3', 'wp-gratify-lang' ) ;
        ?></h2></td><td colspan="2"><button class="removeclass3 wp_grv_btn"><i class="fa fa-times"></i></button></td></tr>
							 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Title:', 'wp-gratify-lang' ) ;
        ?> </label></th><td colspan="2" style="width: 87%;"><input type="text" class="wp_grv_field" name="custom_title3" maxlength="100" id="rv_custom_title3" value="<?php 
        echo  $social_review_fetch_sett['custom_title3'] ;
        ?>" /></td></tr>
							 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Logo:', 'wp-gratify-lang' ) ;
        ?> </label></th><td colspan="2"style="width: 87%;" ><input type="hidden"  name="custom_logo3_url" value="<?php 
        echo  $social_review_fetch_sett['custom_logo3'] ;
        ?>" id="rv_custom_logo3_url"><input id="rv_custom_logo3" placeholder="<?php 
        echo  esc_html_e( 'Default Image (300 X 150)', 'wp-gratify-lang' ) ;
        ?>" type="text" class="wp_grv_field" disabled name="custom_logo3" value="<?php 
        echo  $social_review_fetch_sett['custom_logo3'] ;
        ?>" />&nbsp;<button class="wp_grv_btn" id="rv_upload_custom_logo_button3" title="Upload"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" id="custom_logo3_reset_btn" title="Reset"><i class="fa fa-history"></i></button><img id="rv_custom_logo3_shows" src="
																			<?php 
        
        if ( $social_review_fetch_sett['custom_logo3'] != '' ) {
            echo  $social_review_fetch_sett['custom_logo3'] ;
        } else {
            echo  plugin_dir_url( __FILE__ ) . '../shortcode/wp-gratify-icon/wp-grv-custom-default-icon.jpg' ;
        }
        
        ?>
								" style="width:70px; margin-top: 4px; margin-bottom: 4px; display: block;" ></td></tr>
							 <tr><th><label class="wp_grv_label"><?php 
        echo  esc_html_e( 'Link:', 'wp-gratify-lang' ) ;
        ?> </label></th><td colspan="2" style="width: 87%;"><input type="text" class="wp_grv_field" name="custom_link3" id="rv_custom_link3" value="<?php 
        echo  $social_review_fetch_sett['custom_link3'] ;
        ?>" /></td></tr>
		  </table>      
		  <table id="wp_grv_social_media_sub_button_form">   		 
					 <tr><td><button name="save_changes_social_media_review_set" class="wp_grv_btn_sub" id="rv_social_media_sub"><i class="fa fa-floppy-o"></i>&nbsp; <?php 
        
        if ( $social_review_fetch_sett != '' ) {
            echo  esc_html_e( 'Save Changes', 'wp-gratify-lang' ) ;
        } else {
            echo  esc_html_e( 'Save And Next', 'wp-gratify-lang' ) ;
        }
        
        ?></button></td></tr>	
		  </table>      									
		</form>	<!--social form ends -->	    											
	   </div><!-- rv_social_review_tab div ends -->

	   <!-- GMB review settings -->
	 <?php 
        //gmb lock condition ends
        ?>   
	  <!-- review social proofing settings --> 
       <div id="rv_social_proofing_tab">
       <?php 
        $social_proofing_fetch_sett = get_option( 'social_proofing_settings' );
        ?>     	
        <h2 class="wp_grv_social_proofing_txt wp_grv_head_txt">&nbsp;&nbsp;&nbsp;&nbsp;<?php 
        echo  _e( 'Social Proofing Settings', 'wp-gratify-lang' ) ;
        ?></h2>
        <br><br>
       	<form>
          <table id="wp_grv_social_proofing_form_block">
            <tr>
             		<th><label class="wp_grv_label wp_grv_required"><?php 
        echo  _e( 'Rating:', 'wp-gratify-lang' ) ;
        ?></label></th>
                <td><div class="wp_grv_tooltip"><select id="rv_rating_sel" class="wp_grv_select_field" name="social_proofing_rating_sel">
                     <option value="4to5"><?php 
        echo  _e( '4 to 5 Star Rated Review', 'wp-gratify-lang' ) ;
        ?></option>	
                     <option value="3andabove" <?php 
        if ( $social_proofing_fetch_sett['social_proofing_rating'] === "3andabove" ) {
            echo  'selected' ;
        }
        ?>><?php 
        echo  _e( '3 Star And Above', 'wp-gratify-lang' ) ;
        ?></option>
                     <option value="below3" <?php 
        if ( $social_proofing_fetch_sett['social_proofing_rating'] === "below3" ) {
            echo  'selected' ;
        }
        ?>><?php 
        echo  _e( 'Rate Below 3 Star', 'wp-gratify-lang' ) ;
        ?> </option>
                     <option value="all" <?php 
        if ( $social_proofing_fetch_sett['social_proofing_rating'] === "all" ) {
            echo  'selected' ;
        }
        ?>><?php 
        echo  _e( 'All Star Rate', 'wp-gratify-lang' ) ;
        ?> </option>
                  </select><span class="wp_grv_tooltip_text"><?php 
        echo  _e( 'Prefer star rating to display social proofing.', 'wp-gratify-lang' ) ;
        ?></span></td>
            </tr>
            <tr>      
                  <th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Category:', 'wp-gratify-lang' ) ;
        ?></label></th>
                  <td><br/><select id="rv_category_sel" class="wp_grv_select_field" name="social_proofing_category_sel">
                    <option value="all_categories"><?php 
        echo  _e( 'All Categories', 'wp-gratify-lang' ) ;
        ?></option>
                    <?php 
        global  $wpdb ;
        $category_tbl = $wpdb->prefix . 'wp_grv_category_list_tbl';
        $result_category = $wpdb->get_results( "SELECT * FROM {$category_tbl} ", ARRAY_A );
        foreach ( $result_category as $value_category ) {
            $category_name_dat = $value_category['category_name'];
            ?> <option value="<?php 
            echo  $category_name_dat ;
            ?>" <?php 
            if ( $social_proofing_fetch_sett['social_proofing_category'] === $category_name_dat ) {
                echo  "selected" ;
            }
            ?> ><?php 
            echo  _e( $category_name_dat, 'wp-gratify-lang' ) ;
            ?></option>
                    <?php 
        }
        ?>  
                  </select></td>
            </tr>
<tr>
		<th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Font size for name (in px):', 'wp-gratify-lang' ) ;
        ?></label></th>
                <td><br/><input type="number" name="social_proofing_text_size_name" id="wp_grv_social_proofing_text_size_name" class="wp_grv_select_field" placeholder="18px(default)" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_text_size_name'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_text_size_name'] ;
        } else {
            echo  "18" ;
        }
        
        ?>">
</tr>
<tr>
		<th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Font color for name:', 'wp-gratify-lang' ) ;
        ?></label></th>
                <td><br/><input type="color" name="social_proofing_font_color_name" id="wp_grv_social_proofing_font_color_name" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_font_color_name'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_font_color_name'] ;
        } else {
            echo  "#000" ;
        }
        
        ?>">
</tr>
<tr>
		<th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Font size for review (in px):', 'wp-gratify-lang' ) ;
        ?></label></th>
                <td><br/><input type="number" name="social_proofing_text_size_contents" id="wp_grv_social_proofing_text_size_contents" class="wp_grv_select_field" placeholder=15px(default) value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_text_size_contents'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_text_size_contents'] ;
        } else {
            echo  "15" ;
        }
        
        ?>">
</tr>
<tr>
		<th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Font color for review:', 'wp-gratify-lang' ) ;
        ?></label></th>
                <td><br/><input type="color" name="social_proofing_font_color_review" id="wp_grv_social_proofing_font_color_review" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_font_color_review'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_font_color_review'] ;
        } else {
            echo  "#000" ;
        }
        
        ?>">
</tr>
 <tr>      
             		<th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Content character limit:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="number" title="character count for review contents" name="social_proofing_character_limit"   id="wp_grv_social_proofing_character_limit" class="wp_grv_select_field" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_character_limit'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_character_limit'] ;
        } else {
            echo  "100" ;
        }
        
        ?>"></td>
            </tr>
<tr>      
             		<th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Image Border radius (in %):', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="number" name="social_proofing_border_radius" min="1" max="100" class="wp_grv_select_field"  id="wp_grv_social_proofing_border_radius" class="wp_grv_select_field" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_img_border_radius'] ) && $social_proofing_fetch_sett['social_proofing_img_border_radius'] != '' ) {
            echo  $social_proofing_fetch_sett['social_proofing_img_border_radius'] ;
        } else {
            echo  "50" ;
        }
        
        ?>"></td>
            </tr>
<tr>      
             		<th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Image Size (in px):', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="number" name="social_proofing_image_size" class="wp_grv_select_field" min="1" max="80" id="wp_grv_social_proofing_image_size" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_img_size'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_img_size'] ;
        } else {
            echo  "40" ;
        }
        
        ?>"></td>
            </tr>
	    <tr>
		<th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Background Color:', 'wp-gratify-lang' ) ;
        ?></label></th>
                <td><br/><input type="color" name="social_proofing_bg_color" id="wp_grv_social_proofing_bg_color" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_bg_color'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_bg_color'] ;
        } else {
            echo  "#ffffff" ;
        }
        
        ?>">&nbsp&nbsp&nbsp<i class="fa fa-eye" id="fa-eye"></i>
<div id="wp_grv_bg_block" style = 'background-color:<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_bg_color'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_bg_color'] ;
        } else {
            echo  "#ffffff" ;
        }
        
        ?>;'>
	<?php 
        $review_intake_fetch_settings = get_option( 'review_intake_settings' );
        ?>

	<div class='wp_grv_img_block'> <img id='wp_grv_img' style="width:<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_img_size'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_img_size'] . 'px' ;
        } else {
            echo  "40px" ;
        }
        
        ?>; height:<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_img_size'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_img_size'] . 'px' ;
        } else {
            echo  "40px" ;
        }
        
        ?>; border-radius:<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_img_border_radius'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_img_border_radius'] . '%' ;
        } else {
            echo  "50%" ;
        }
        
        ?>;" src="<?php 
        echo  $review_intake_fetch_settings['user_image'] ;
        ?>" alt="default-image"></div>
	<div class='wp_grv_notification_block'><h2 id='wp_grv_txt_block' style= 'font-size:<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_text_size_name'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_text_size_name'] . 'px' ;
        } else {
            echo  "18px" ;
        }
        
        ?>;display:<?php 
        
        if ( $social_proofing_fetch_sett['social_proofing_title_enable'] === "true" ) {
            echo  'none' ;
        } else {
            echo  'block' ;
        }
        
        ?>;color:<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_font_color_name'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_font_color_name'] ;
        } else {
            echo  "#000" ;
        }
        
        ?>;display:<?php 
        
        if ( $social_proofing_fetch_sett['social_proofing_title_enable'] === "true" ) {
            echo  'none' ;
        } else {
            echo  'block' ;
        }
        
        ?>;'>Name</h2><p id='wp_grv_notification' data-notify-text/>
	<div class='wp_grv_content_block'><p id='wp_grv_review_block' style= 'font-size:<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_text_size_contents'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_text_size_contents'] . 'px' ;
        } else {
            echo  "15px" ;
        }
        
        ?>;color:<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_font_color_review'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_font_color_review'] ;
        } else {
            echo  "#000" ;
        }
        
        ?>;'>Review Contents...</p><p id='wp_grv_notification'   data-notify-text/>
	<div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span></div></div></div></div></div>
</tr>
 	<tr>
		 <th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Position:', 'wp-gratify-lang' ) ;
        ?></label></th>
		 <td><br/>
			<select id="rv_position_sel" class="wp_grv_select_field" name="social_proofing_position_sel">
                 		<option name="bottom_left" value="bottom left" <?php 
        if ( $social_proofing_fetch_sett['social_proofing_position_sel'] === 'bottom left' ) {
            echo  'selected' ;
        }
        ?> >
					<?php 
        echo  _e( 'Bottom Left', 'wp-gratify-lang' ) ;
        ?>
				</option>
				<option name="bottom right" value="bottom right" <?php 
        if ( $social_proofing_fetch_sett['social_proofing_position_sel'] === 'bottom right' ) {
            echo  'selected' ;
        }
        ?> >
					<?php 
        echo  _e( 'Bottom Right', 'wp-gratify-lang' ) ;
        ?>
				</option>
			</select>
		</td>
	</tr>
<tr>
                  <th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Mobile Disable:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><label class="wp_grv_mobile_settings"><input type="checkbox" name="social_proofing_mobile_enable" id="wp_grv_mobile_enable" value="true" <?php 
        if ( $social_proofing_fetch_sett['social_proofing_mobile_enable'] === "true" ) {
            echo  'checked' ;
        }
        ?> /><span class="grv_rv_mobile_slider grv_rv_mobile_round"></span></label></td>
            </tr>	
<tr>
                  <th><br/><label class="wp_grv_label"><?php 
        echo  _e( 'Title Disable:', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><label class="wp_grv_title_settings"><input type="checkbox" name="social_proofing_title_enable" id="wp_grv_sp_title_enable" value="true" <?php 
        if ( $social_proofing_fetch_sett['social_proofing_title_enable'] === "true" ) {
            echo  'checked' ;
        }
        ?>/><span class="grv_rv_title_slider grv_rv_title_round"></span></label></td>
            </tr>	


            <tr>      
             		<th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  _e( 'Time delay(in sec):', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="number" name="social_proofing_time_invl" class="wp_grv_select_field" min="3" max="100" id="rv_social_proofing_time_invl" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_time_invl'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_time_invl'] / 1000 ;
        } else {
            echo  "3" ;
        }
        
        ?>" autocomplete="off" required /></td>
            </tr>
 <tr>      
             		<th><br/><label class="wp_grv_label wp_grv_required"><?php 
        echo  _e( 'Time delay for notification stay(in sec):', 'wp-gratify-lang' ) ;
        ?> </label></th><td><br/><input type="number" name="social_proofing_notifcation_stay" class="wp_grv_select_field" min="4" max="100" id="rv_social_proofing_notification_stay" value="<?php 
        
        if ( isset( $social_proofing_fetch_sett['social_proofing_notification_stay'] ) ) {
            echo  $social_proofing_fetch_sett['social_proofing_notification_stay'] / 1000 ;
        } else {
            echo  "4" ;
        }
        
        ?>" autocomplete="off" required /></td>
            </tr>


<?php 
        ?> </tr>		
            <tr>    
             		<td colspan="2"><button name="save_changes_social_proofing" class="wp_grv_btn_sub" id="rv_social_proofing_sub"><i class="fa fa-floppy-o"></i>&nbsp; <?php 
        echo  esc_html_e( 'Save Changes', 'wp-gratify-lang' ) ;
        ?></button></td>
            </tr> 
          </table>     
       	</form><!-- social proofing form ends -->
       </div><!-- rv_social_proofing_tab div ends -->
	</div><!--Tabs div ends.-->
</div><!-- wp_grv_settings_page_container div ends -->
	<?php 
        $gmb_fetch_sett = get_option( 'gmb_settings' );
        $gmb_id = $gmb_fetch_sett['gmb_id'];
        $curl = curl_init();
        curl_setopt_array( $curl, array(
            CURLOPT_URL            => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=" . $gmb_id,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING       => "",
            CURLOPT_MAXREDIRS      => 10,
            CURLOPT_TIMEOUT        => 30,
            CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST  => "GET",
            CURLOPT_HTTPHEADER     => array(
            "Accept: */*",
            "Accept-Encoding: gzip, deflate",
            "Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
            "Cache-Control: no-cache",
            "Connection: keep-alive",
            "Host: wpgratify.com",
            "cache-control: no-cache"
        ),
        ) );
        $response = curl_exec( $curl );
        $err = curl_error( $curl );
        curl_close( $curl );
        $json_acess_token_data = trim( $response, '"' );
        // for location path
        $gmb_location_fetch_settings = get_option( 'wp_grv_gmb_location_settings' );
        $wp_grv_gmb_location_path = $gmb_location_fetch_settings['gmb_location'];
        ?>
				<input type="hidden" name="wp_grv_acess_token_from_admin" id="wp_grv_acess_token_from_admin" value="<?php 
        echo  $json_acess_token_data ;
        ?>">
				<input type="hidden" name="wp_grv_location_path" id="wp_grv_location_path" value="<?php 
        echo  $wp_grv_gmb_location_path ;
        ?>">
				<input type="button" style="display: none;" name="wp_grv_gmb_reviews_insert_btn" id="wp_grv_gmb_reviews_insert_btn"><!-- wp_grv_all_rv_page_container div ends -->		
				<?php 
    } elseif ( $check_gmb_value === 'false' && strtotime( $refresh_time ) < strtotime( $current_time ) ) {
        $gmb_fetch_sett = get_option( 'gmb_settings' );
        $gmb_id = $gmb_fetch_sett['gmb_id'];
        $gmb_status = $gmb_fetch_sett['gmb_status'];
        $endTime = strtotime( '+50 minutes', strtotime( $current_time ) );
        $update_time = date( 'Y-m-d H:i:s', $endTime );
        $gmp_settings_refresh_dat = array(
            'gmb_id'             => $gmb_id,
            'gmb_status'         => $gmb_status,
            'token_time'         => $current_time,
            'token_refresh_time' => $update_time,
        );
        update_option( 'gmb_settings', $gmp_settings_refresh_dat );
        $refresh_redirect_url = admin_url( '/admin.php?page=settings-menu&rtc=true' );
        $refresh_url = 'https://wpgratify.com/gmb-refresh/?auth=' . $gmb_id . '&redirect=' . $refresh_redirect_url;
        wp_redirect( $refresh_url );
        exit;
    }

}
