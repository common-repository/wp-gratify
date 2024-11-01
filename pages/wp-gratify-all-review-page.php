<?php

function wp_grv_all_review_function()
{
    //wpgrv_premium condition ends.
    
    if ( wp_grv()->is_free_plan() ) {
        global  $wpdb ;
        $comment_tbl = $wpdb->prefix . 'comments';
        $comment_tbl_data = $wpdb->get_results( "SELECT * FROM {$comment_tbl} WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC", ARRAY_A );
        foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
            $rv_id_fetch_notfy = $value_comment_tbl_data['comment_ID'];
            $key = 'comment_extras';
            $comment_meta_data_fetch = get_comment_meta( $rv_id_fetch_notfy, $key );
            foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
                $rv_title_notfy = $comment_meta_data_fetch_value['review_title'];
                $rv_rating_fetch_notfy = $comment_meta_data_fetch_value['review_rating'];
                $rv_category_fetch_notfy = $comment_meta_data_fetch_value['review_add_category'];
                $rv_done_on_fetch_notfy = $comment_meta_data_fetch_value['review_done_on'];
                $rv_location = ( isset( $comment_meta_data_fetch_value['review_location'] ) ? $comment_meta_data_fetch_value['review_location'] : '' );
                $rv_location_name = ( isset( $comment_meta_data_fetch_value['review_location_name'] ) ? $comment_meta_data_fetch_value['review_location_name'] : '' );
                $rv_done_via_fetch_notfy = $comment_meta_data_fetch_value['review_done_via'];
                $rv_user_image_fetch_notfy = $comment_meta_data_fetch_value['review_user_image'];
                $rv_read_flag_notfy = $comment_meta_data_fetch_value['review_read_flag'];
                $wp_grv_notification_flag_notfy = $comment_meta_data_fetch_value['review_notification_flag'];
                $rv_duplicate_details_check = $comment_meta_data_fetch_value['review_duplicate_details_check'];
                $rv_duplicate_name = $comment_meta_data_fetch_value['review_duplicate_name'];
                $rv_duplicate_reason = $comment_meta_data_fetch_value['review_duplicate_reason'];
                if ( $wp_grv_notification_flag_notfy === '0' ) {
                    break;
                }
                $comment_meta_table_data = array(
                    'review_title'                   => $rv_title_notfy,
                    'review_user_image'              => $rv_user_image_fetch_notfy,
                    'review_done_on'                 => $rv_done_on_fetch_notfy,
                    'review_location'                => $rv_location,
                    'review_location_name'           => $rv_location_name,
                    'review_done_via'                => $rv_done_via_fetch_notfy,
                    'review_add_category'            => $rv_category_fetch_notfy,
                    'review_rating'                  => $rv_rating_fetch_notfy,
                    'review_read_flag'               => $rv_read_flag_notfy,
                    'review_notification_flag'       => '0',
                    'review_duplicate_details_check' => $rv_duplicate_details_check,
                    'review_duplicate_name'          => $rv_duplicate_name,
                    'review_duplicate_reason'        => $rv_duplicate_reason,
                );
                update_comment_meta( $rv_id_fetch_notfy, 'comment_extras', $comment_meta_table_data );
            }
        }
    }
    
    //wpgrv free version condition ends.
}

//end all_review_function()