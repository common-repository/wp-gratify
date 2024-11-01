<?php

/*
 * function for adding new review or update review
 * return void
*/
function wp_grv_add_new_page_function()
{
    $wp_grv_edit_id = filter_input( INPUT_GET, 'edit_id' );
    
    if ( isset( $wp_grv_edit_id ) ) {
        // Checking update button.
        global  $wpdb ;
        $rv_id = filter_input( INPUT_GET, 'edit_id' );
        $comment_tbl = $wpdb->prefix . 'comments';
        $comment_tbl_data = $wpdb->get_results( "SELECT * FROM {$comment_tbl} WHERE comment_ID = {$rv_id} ", ARRAY_A );
        foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
            $rv_author_fetch = $value_comment_tbl_data['comment_author'];
            $rv_author_email = $value_comment_tbl_data['comment_author_email'];
            $rv_content = $value_comment_tbl_data['comment_content'];
            $rv_date_fetch = $value_comment_tbl_data['comment_date'];
            $rv_approved = $value_comment_tbl_data['comment_approved'];
            $key = "comment_extras";
            $comment_meta_data_fetch = get_comment_meta( $rv_id, $key );
            foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
                $rv_title = $comment_meta_data_fetch_value['review_title'];
                $rv_rating_fetch = $comment_meta_data_fetch_value['review_rating'];
                $rv_category_fetch = $comment_meta_data_fetch_value['review_add_category'];
                $rv_done_on_fetch = $comment_meta_data_fetch_value['review_done_on'];
                $rv_done_via_fetch = $comment_meta_data_fetch_value['review_done_via'];
                $rv_user_image_fetch = $comment_meta_data_fetch_value['review_user_image'];
                $rv_duplicate_details_check = $comment_meta_data_fetch_value['review_duplicate_details_check'];
                $rv_duplicate_name = $comment_meta_data_fetch_value['review_duplicate_name'];
                $rv_duplicate_reason = $comment_meta_data_fetch_value['review_duplicate_reason'];
                $rv_gmb_replay = ( isset( $comment_meta_data_fetch_value['review_gmb_replay'] ) ? $comment_meta_data_fetch_value['review_gmb_replay'] : '' );
            }
        }
    }
    
    $wp_grv_add_rv_sub = filter_input( INPUT_POST, 'add_rv_sub' );
    
    if ( isset( $wp_grv_add_rv_sub ) ) {
        // Checking submit button
        $add_rv_name = filter_input( INPUT_POST, 'add_name' );
        $add_rv_email = filter_input( INPUT_POST, 'add_email' );
        $add_rv_content = filter_input( INPUT_POST, 'add_content' );
        $wp_grv_dup_details_check = filter_input( INPUT_POST, 'duplicate_check' );
        
        if ( $wp_grv_dup_details_check === 'true' ) {
            $wp_grv_dup_name = filter_input( INPUT_POST, 'add_dup_name' );
            $wp_grv_dup_reason = filter_input( INPUT_POST, 'add_dup_reason' );
        } else {
            $wp_grv_dup_name = '';
            $wp_grv_dup_reason = '';
            $wp_grv_dup_details_check = 'false';
        }
        
        $wp_grv_st1 = filter_input( INPUT_POST, 'st1' );
        $wp_grv_st2 = filter_input( INPUT_POST, 'st2' );
        $wp_grv_st3 = filter_input( INPUT_POST, 'st3' );
        $wp_grv_st4 = filter_input( INPUT_POST, 'st4' );
        $wp_grv_st5 = filter_input( INPUT_POST, 'st5' );
        $rating_array = array(
            'star1' => ( isset( $wp_grv_st1 ) ? $wp_grv_st1 : '0' ),
            'star2' => ( isset( $wp_grv_st2 ) ? $wp_grv_st2 : '0' ),
            'star3' => ( isset( $wp_grv_st3 ) ? $wp_grv_st3 : '0' ),
            'star4' => ( isset( $wp_grv_st4 ) ? $wp_grv_st4 : '0' ),
            'star5' => ( isset( $wp_grv_st5 ) ? $wp_grv_st5 : '0' ),
        );
        $add_rv_rating = max( $rating_array );
        if ( $add_rv_rating === '0' ) {
            $add_rv_rating = '5';
        }
        $dt = new DateTime();
        $add_rv_date = $dt->format( 'Y-m-d H:i:s' );
        $approval_sel = filter_input( INPUT_POST, 'aproval_sel' );
        $add_approve_stat = ( isset( $approval_sel ) ? $approval_sel : 'disable' );
        $rv_type = "wp_grv_review";
        $comment_table_data = array(
            'comment_author'       => $add_rv_name,
            'comment_author_email' => $add_rv_email,
            'comment_content'      => $add_rv_content,
            'comment_date'         => $add_rv_date,
            'comment_approved'     => $add_approve_stat,
            'comment_type'         => $rv_type,
        );
        $id = wp_insert_comment( $comment_table_data );
        $comment_id = $id;
        //checking upload image exisist or not
        
        if ( filter_input( INPUT_POST, 'add_user_image' ) === "" ) {
            $review_intake_fetch_settings = get_option( 'review_intake_settings' );
            $wp_grv_user_image = $review_intake_fetch_settings['user_image'];
        } else {
            $wp_grv_user_image = filter_input( INPUT_POST, 'add_user_image' );
        }
        
        //check gmb
        
        if ( $_POST['done_on'] == 'GMB' ) {
            $comment_meta_table_data = array(
                'review_title'                   => filter_input( INPUT_POST, 'add_title' ),
                'review_user_image'              => $wp_grv_user_image,
                'review_done_on'                 => filter_input( INPUT_POST, 'done_on' ),
                'review_done_via'                => 'backend',
                'review_add_category'            => filter_input( INPUT_POST, 'add_category' ),
                'review_rating'                  => $add_rv_rating,
                'review_read_flag'               => '1',
                'review_notification_flag'       => '0',
                'review_duplicate_details_check' => $wp_grv_dup_details_check,
                'review_duplicate_name'          => $wp_grv_dup_name,
                'review_duplicate_reason'        => $wp_grv_dup_reason,
                'review_gmb_replay'              => $_POST['gmb_review_replay'],
            );
        } else {
            $comment_meta_table_data = array(
                'review_title'                   => filter_input( INPUT_POST, 'add_title' ),
                'review_user_image'              => $wp_grv_user_image,
                'review_done_on'                 => filter_input( INPUT_POST, 'done_on' ),
                'review_done_via'                => 'backend',
                'review_add_category'            => filter_input( INPUT_POST, 'add_category' ),
                'review_rating'                  => $add_rv_rating,
                'review_read_flag'               => '1',
                'review_notification_flag'       => '0',
                'review_duplicate_details_check' => $wp_grv_dup_details_check,
                'review_duplicate_name'          => $wp_grv_dup_name,
                'review_duplicate_reason'        => $wp_grv_dup_reason,
            );
        }
        
        update_comment_meta( $comment_id, "comment_extras", $comment_meta_table_data );
        $url = admin_url( '/admin.php?page=add-new-menu&edit_id=' . $comment_id );
        echo  $url ;
        wp_safe_redirect( $url );
        exit;
    }
    
    ?>
  <!-- div shows loader icon -->
  <div class="se-pre-con"></div>
  <!-- Ends -->
  <div id="rv_add_new_page_container">
    <!-- Add new review page notification bar (admin bar) -->
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
    $wp_grv_check_count = '0';
    $comment_tbl_data = $wpdb->get_results( "SELECT * FROM {$comment_tbl} WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC", ARRAY_A );
    foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
        $rv_id_fetch = $value_comment_tbl_data['comment_ID'];
        $key = "comment_extras";
        $comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
        foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
            $wp_grv_notification_flag = $comment_meta_data_fetch_value['review_notification_flag'];
            if ( $wp_grv_notification_flag === '1' ) {
                $wp_grv_notification_count = $wp_grv_notification_count + 1;
            }
        }
        if ( $wp_grv_notification_flag === '0' && $wp_grv_check_count >= '5' ) {
            break;
        }
        $wp_grv_check_count = $wp_grv_check_count + 1;
    }
    /*GMB Login status ends*/
    ?>
      
        <a class="wp_grv_bell_hover" style="color: #ffff;" href="<?php 
    echo  admin_url( '/admin.php?page=all_review_menu' ) ;
    ?>"><i class="fa fa-bell"></i></a><span class="wp_grv_notification_count" <?php 
    if ( $wp_grv_notification_count === '0' ) {
        echo  'style = "display: none"' ;
    }
    ?>><?php 
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
    <!-- Ends notification bar -->
    <div class="wp_grv_header_width"><h2><?php 
    _e( 'Add New Review', 'wp-gratify-lang' );
    ?></h2></div>
	<!-- single review schort code section -->
	<?php 
    
    if ( isset( $wp_grv_edit_id ) ) {
        ?>
		<div class="wp_grv_review_shortcode">
			<p>Shortcode: [wp_grv_single_review_card id="<?php 
        echo  $wp_grv_edit_id ;
        ?>" schema="true"]</p>
		</div>
		<?php 
    }
    
    ?>
	<!-- single review schort code section -->
    <input type="button" class="wp_grv_btn" <?php 
    
    if ( isset( $rv_id ) ) {
        echo  'style = "display: block;"' ;
    } else {
        echo  'style = "display: none;"' ;
    }
    
    ?> onclick="window.location.href='<?php 
    echo  admin_url( '/admin.php?page=add-new-menu' ) ;
    ?>'" name="add_new_btn" id="rv_add_new_btn" value="<?php 
    _e( 'Add New', 'wp-gratify-lang' );
    ?>" /><br/>
    <br/>
    <form id="rv_add_new_form" action="" method="POST">
        <label class="wp_grv_add_rv_label wp_grv_required"><?php 
    _e( 'Name :', 'wp-gratify-lang' );
    ?></label>
        <input class="wp_grv_field" type="text" maxlength="100" name="add_name" id="wp_grv_add_name" autocomplete="off" required <?php 
    if ( isset( $rv_id ) ) {
        echo  'value = "' . $rv_author_fetch . '"' ;
    }
    ?> /><br/>
        <label class="wp_grv_add_rv_label wp_grv_required"><?php 
    _e( 'Email :', 'wp-gratify-lang' );
    ?></label>
        <input class="wp_grv_field" name="add_email" maxlength="100" id="wp_grv_add_email" autocomplete="off" title="Please enter valid email address" type="email" TextMode="Email" validate="required:true" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" <?php 
    if ( isset( $rv_id ) ) {
        echo  'value = "' . $rv_author_email . '"' ;
    }
    ?> /><br/>
        <label class="wp_grv_add_rv_label wp_grv_required"><?php 
    _e( 'Title :', 'wp-gratify-lang' );
    ?></label>
        <input class="wp_grv_field" type="text" name="add_title" maxlength="100" id="wp_grv_add_title" autocomplete="off" required <?php 
    if ( isset( $rv_id ) ) {
        echo  'value = "' . $rv_title . '"' ;
    }
    ?> /><br/>
        <label class="wp_grv_add_rv_label wp_grv_required"><?php 
    _e( 'Review Content :', 'wp-gratify-lang' );
    ?></label>
        <textarea class="wp_grv_field" id="wp_grv_add_content" maxlength="2000" rows="5" cols="50" name="add_content" required ><?php 
    if ( isset( $rv_id ) ) {
        echo  $rv_content ;
    }
    ?></textarea><br/>
        <!-- Google my business replay section -->
        <?php 
    if ( isset( $rv_done_on_fetch ) ) {
        
        if ( $rv_done_on_fetch === 'GMB' ) {
            ?>
                  <label class="wp_grv_add_rv_label" style="color: #ffffff00;">.</label>
                  <div class="wp_grv_goole_review_replay_icon">
                    <i class="fa fa-reply"></i><span> <?php 
            _e( 'Reply', 'wp-gratify-lang' );
            ?></span>
                  </div>
                  <div class="wp_grv_goole_review_replay_section" style="<?php 
            if ( $rv_gmb_replay != '' ) {
                echo  'display: block;' ;
            }
            ?>">
                    <label class="wp_grv_add_rv_label" style="color: #ffffff00;">.</label> 
                    <textarea class="wp_grv_field" id="wp_grv_gmb_review_replay" maxlength="500" rows="5" cols="50" name="gmb_review_replay"><?php 
            echo  $rv_gmb_replay ;
            ?></textarea><br/> 
                    <label class="wp_grv_add_rv_label" style="color: #ffffff00;">.</label> 
                    <button name="google_review_replay_submit" disabled id="wp_grv_google_review_replay_submit"><?php 
            _e( 'Submit', 'wp-gratify-lang' );
            ?></button>
                  </div>
          <?php 
        }
    
    }
    ?>      
        <!-- Google my business replay section ends -->
        <!-- add duplicate data block -->
        <div id="wp_grv_duplicate_check_section"><input type="checkbox" value="true" name="duplicate_check" id="wp_grv_add_dup_name_check" <?php 
    if ( isset( $rv_id ) ) {
        if ( $rv_duplicate_details_check == 'true' ) {
            echo  'checked' ;
        }
    }
    ?> ><span> <?php 
    _e( 'Add Duplicate Name', 'wp-gratify-lang' );
    ?> <i title="For duplicate name." class="fa fa-question-circle"></i> </span></div>
        <div id="wp_grv_duplicate_data_block">
          <label class="wp_grv_add_rv_label wp_grv_required"><?php 
    _e( 'Name', 'wp-gratify-lang' );
    ?> </label>
          <input type="text" maxlength="100" name="add_dup_name" class="wp_grv_field" id="wp_grv_dup_name" autocomplete="off" <?php 
    if ( isset( $rv_id ) ) {
        echo  'value = "' . $rv_duplicate_name . '"' ;
    }
    ?> /><br/>
          <label class="wp_grv_add_rv_label wp_grv_required"><?php 
    _e( 'Reason', 'wp-gratify-lang' );
    ?> </label>
          <textarea id="wp_grv_dup_reason" class="wp_grv_field" maxlength="250" rows="5" cols="50" name="add_dup_reason" ><?php 
    if ( isset( $rv_id ) ) {
        echo  $rv_duplicate_reason ;
    }
    ?></textarea><br/>
        </div>  
        <!-- duplicate block ends -->
        <label class="wp_grv_add_rv_label"><?php 
    _e( 'User Image :', 'wp-gratify-lang' );
    ?></label>
        <input id="rv_add_usr_img" class="wp_grv_field" type="text" name="add_user_image" autocomplete="off" <?php 
    if ( isset( $rv_id ) ) {
        echo  'value = "' . $rv_user_image_fetch . '"' ;
    }
    ?> />&nbsp;<button class="wp_grv_btn" id="rv_add_upload_usr_img_button"><i class="fa fa-upload"></i></button>&nbsp;<button class="wp_grv_btn" id="rv_add_upload_usr_img_reset_button"><i class="fa fa-history"></i></button>
        <div id="add_rv_img_upload_div"><img id="rv_upload_img_show" <?php 
    if ( isset( $rv_id ) ) {
        echo  'src="' . $rv_user_image_fetch . '"' ;
    }
    ?> style="width:70px; " ></div>
        <label class="wp_grv_add_rv_label"><?php 
    _e( 'Review Done On :', 'wp-gratify-lang' );
    ?></label>
        <?php 
    
    if ( isset( $rv_done_on_fetch ) ) {
        
        if ( $rv_done_on_fetch == "GMB" ) {
            ?>
          <select class="wp_grv_select_field" id="wp_grv_done_on" name="done_on" disabled="true">
            <option selected  value="GMB"><?php 
            _e( 'GMB', 'wp-gratify-lang' );
            ?></option>
          </select>  
        <?php 
        } else {
            ?>
          <select class="wp_grv_select_field" id="wp_grv_done_on" name="done_on">
              <option <?php 
            if ( isset( $rv_id ) ) {
                if ( $rv_done_on_fetch == 'not_set' ) {
                    echo  'selected' ;
                }
            }
            ?> value="not_set"><?php 
            _e( 'Not Select', 'wp-gratify-lang' );
            ?></option>
              <option <?php 
            if ( isset( $rv_id ) ) {
                if ( $rv_done_on_fetch == 'google' ) {
                    echo  'selected' ;
                }
            }
            ?> value="google"><?php 
            _e( 'Google', 'wp-gratify-lang' );
            ?></option>
              <option <?php 
            if ( isset( $rv_id ) ) {
                if ( $rv_done_on_fetch == 'facebook' ) {
                    echo  'selected' ;
                }
            }
            ?> value="facebook"><?php 
            _e( 'Facebook', 'wp-gratify-lang' );
            ?></option>
              <option <?php 
            if ( isset( $rv_id ) ) {
                if ( $rv_done_on_fetch == 'yelp' ) {
                    echo  'selected' ;
                }
            }
            ?> value="yelp"><?php 
            _e( 'Yelp', 'wp-gratify-lang' );
            ?></option>
          </select><br/>
        <?php 
        }
    
    } else {
        ?>
			<select class="wp_grv_select_field" id="wp_grv_done_on" name="done_on">
				<option value="not_set"><?php 
        _e( 'Not Select', 'wp-gratify-lang' );
        ?></option>
				<option value="google"><?php 
        _e( 'Google', 'wp-gratify-lang' );
        ?></option>
				<option value="facebook"><?php 
        _e( 'Facebook', 'wp-gratify-lang' );
        ?></option>
				<option value="yelp"><?php 
        _e( 'Yelp', 'wp-gratify-lang' );
        ?></option>
			</select><br/><?php 
    }
    
    if ( isset( $rv_id ) ) {
        echo  '<label class="wp_grv_add_rv_label">Review Done via : ' . $rv_done_via_fetch . '</label><br/><br/>' ;
    }
    ?>
        <label class="wp_grv_add_rv_label"><?php 
    _e( 'Review Disable / Enable :', 'wp-gratify-lang' );
    ?></label>
        <label class="wp_grv_add_rv_switch rv_switch_add_new_review"><input type="checkbox" name="aproval_sel" class="rv_approval_sel" value="true" <?php 
    if ( isset( $rv_id ) ) {
        if ( $rv_approved == "true" ) {
            echo  'checked' ;
        }
    }
    ?>  /><span class="wp_grv_add_rv_slider wp_grv_add_rv_round"></span></label><br/><br/>
        <label class="wp_grv_add_rv_label"><?php 
    _e( 'Category :', 'wp-gratify-lang' );
    ?></label>
          <select class="wp_grv_select_field" id="wp_grv_add_category" name="add_category">
              <option value="General Category"><?php 
    _e( 'Select Category', 'wp-gratify-lang' );
    ?></option>
              <?php 
    global  $wpdb ;
    $category_tbl = $wpdb->prefix . 'wp_grv_category_list_tbl';
    $result_category = $wpdb->get_results( "SELECT * FROM {$category_tbl} ", ARRAY_A );
    foreach ( $result_category as $value_category ) {
        $category_name_dat = $value_category['category_name'];
        ?>
              <option <?php 
        if ( isset( $rv_id ) ) {
            if ( $rv_category_fetch === $category_name_dat ) {
                echo  'selected' ;
            }
        }
        ?> value= "<?php 
        echo  _e( $category_name_dat, 'wp-gratify-lang' ) ;
        ?>" > <?php 
        echo  _e( $category_name_dat, 'wp-gratify-lang' ) ;
        ?>
              </option>
                  <?php 
    }
    ?>
          </select><br/>
        <label class="wp_grv_add_rv_label"><?php 
    _e( 'Rating :', 'wp-gratify-lang' );
    ?></label>
        <div class="rv_add_rating_style">
        <input type="checkbox" id="rv_st5" value="5" name="st5" <?php 
    if ( isset( $rv_id ) ) {
        if ( $rv_rating_fetch == '5' ) {
            echo  'checked' ;
        }
    }
    ?> />
        <label for="rv_st5"></label>
        <input type="checkbox" id="rv_st4" value="4" name="st4" <?php 
    if ( isset( $rv_id ) ) {
        if ( $rv_rating_fetch == '4' ) {
            echo  'checked' ;
        }
    }
    ?> />
        <label for="rv_st4"></label>
        <input type="checkbox" id="rv_st3" value="3" name="st3" <?php 
    if ( isset( $rv_id ) ) {
        if ( $rv_rating_fetch == '3' ) {
            echo  'checked' ;
        }
    }
    ?> />
        <label for="rv_st3"></label>
        <input type="checkbox" id="rv_st2" value="2" name="st2" <?php 
    if ( isset( $rv_id ) ) {
        if ( $rv_rating_fetch == '2' ) {
            echo  'checked' ;
        }
    }
    ?> />
        <label for="rv_st2"></label>
        <input type="checkbox" id="rv_st1" value="1" name="st1" <?php 
    if ( isset( $rv_id ) ) {
        if ( $rv_rating_fetch == '1' ) {
            echo  'checked' ;
        }
    }
    ?> />
        <label for="rv_st1"></label>
        </div>
        <br/><br/>
        <input type="hidden" name="rv_id" value="<?php 
    if ( isset( $rv_id ) ) {
        echo  $rv_id ;
    }
    ?>" id="wp_grv_single_rv_id" />
        <button name="update_rv_sub" class="wp_grv_btn_sub" id="wp_grv_update" <?php 
    
    if ( isset( $rv_id ) ) {
        echo  'style = "display: block;"' ;
    } else {
        echo  'style = "display: none;"' ;
    }
    
    ?>><i class="fa fa-floppy-o"></i>&nbsp; <?php 
    _e( 'Save', 'wp-gratify-lang' );
    ?></button>
        <button name="add_rv_sub" class="wp_grv_btn_sub" id="rv_add_sub" <?php 
    if ( isset( $rv_id ) ) {
        echo  'style = "display: none;"' ;
    }
    ?>><i class="fa fa-floppy-o"></i>&nbsp; <?php 
    _e( 'Save', 'wp-gratify-lang' );
    ?></button>
    </form>
  </div>
<?php 
}
