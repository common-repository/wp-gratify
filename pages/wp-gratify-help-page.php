<?php

/*
 * function for help page
 * return void
*/
function wp_grv_help_page_function()
{
    ?>
<!-- div shows loader icon -->
<div class="se-pre-con"></div>
<!-- Ends -->
<div id="rv_help_page">
	 <!-- help page notification bar (admin bar) -->
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
	<!-- Ends notification bar -->
	 <div class="wp_grv_header_width"><h2><b><?php 
    _e( 'Help', 'wp-gratify-lang' );
    ?></b></h2></div>
	 <div class="wp_grv_help_details_full_block">
		 <div class="wp_grv_help_shotcode">
			 <p><?php 
    _e( 'Use this shortcode: ', 'wp-gratify-lang' );
    ?><b>[wp_grv_review_intake_form]</b> <?php 
    _e( 'for Frontend Review Intake Form', 'wp-gratify-lang' );
    ?></p>
		 </div>
		 <div class="wp_grv_help_shotcode">
			 <p><?php 
    _e( 'Use this shortcode: ', 'wp-gratify-lang' );
    ?><b>[ wp_grv_review_card count=" " category=" " orderby=" "]</b> <?php 
    _e( 'for Specific Reviews', 'wp-gratify-lang' );
    ?></p>
			 <a href="https://wpgratify.com/wpgratify-shortcode-doc/" target="_blank"><?php 
    _e( 'More>>', 'wp-gratify-lang' );
    ?></a><br/>
		 </div>
		 <div class="wp_grv_help_shotcode">
			 <p><?php 
    _e( 'Use this shortcode: ', 'wp-gratify-lang' );
    ?><b>[wp_grv_review_card]</b> <?php 
    _e( 'for All Reviews', 'wp-gratify-lang' );
    ?></p>
			 <a href="https://wpgratify.com/wpgratify-shortcode-doc/" target="_blank"><?php 
    _e( 'More>>', 'wp-gratify-lang' );
    ?></a>
		 </div>
		 <div class="wp_grv_help_shotcode">
			 <p><?php 
    _e( 'Use this shortcode: ', 'wp-gratify-lang' );
    ?><b>[wp_grv_single_review_card id=" " schema="true"]</b> <?php 
    _e( 'for displaying single review', 'wp-gratify-lang' );
    ?></p>
			 <a href="https://wpgratify.com/wpgratify-shortcode-doc/" target="_blank"><?php 
    _e( 'More>>', 'wp-gratify-lang' );
    ?></a>
		 </div>
		 <div class="wp_grv_help_shotcode">
			 <p><?php 
    _e( 'Use this shortcode: ', 'wp-gratify-lang' );
    ?><b>[wp_grv_business_hours]</b> <?php 
    _e( 'for displaying live Google My Business hours (WP Gratify Pro)', 'wp-gratify-lang' );
    ?></p>
			 <a href="https://wpgratify.com/wpgratify-shortcode-doc/" target="_blank"><?php 
    _e( 'More>>', 'wp-gratify-lang' );
    ?></a>
		 </div>
		<div class="wp_grv_help_shotcode">
			 <h3><?php 
    _e( 'Documentation ', 'wp-gratify-lang' );
    ?></h3>
			 <a href="https://wpgratify.com/wpgratify-documentation/" target="_blank" style="font-size: 35px;"><i class="fa fa-book"></i></a>
		</div><!-- wp_grv_help_details_full_block div ends -->
</div><!-- help page div ends -->
	<?php 
}
