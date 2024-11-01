<?php

/*
 * function  schedule event for invitaion
 *
*/
class Wp_Grv_Invitation_Schedule_Event
{
    public static function wp_grv_inv_schedule_event()
    {
        $schema_fetch_sett = get_option( 'schema_settings' );
        $wp_grv_cmp_name = $schema_fetch_sett['company_name'];
        $invitation_fetch_sett = get_option( 'invitation_settings' );
        $wp_grv_invitation_days = $invitation_fetch_sett['invitaion_days'];
        $wp_grv_invitation_repeat = $invitation_fetch_sett['invitation_repeat'];
        $wp_grv_invitation_message = $invitation_fetch_sett['invitaion_email_content'];
        $wp_grv_invitation_link = $invitation_fetch_sett['invitaion_link'];
        $wp_grv_link = filter_var( $wp_grv_invitation_link, FILTER_SANITIZE_URL );
        $wp_grv_invitation_from_email = $invitation_fetch_sett['invitaion_from'];
        $dt = new DateTime();
        $wp_grv_current_date = $dt->format( 'Y-m-d' );
        global  $wpdb ;
        $invitation_tbl = $wpdb->prefix . 'wp_grv_review_invitation_tbl';
        $result_invitation = $wpdb->get_results( "SELECT * FROM {$invitation_tbl}", ARRAY_A );
        foreach ( $result_invitation as $value_invitation ) {
            $re_invited_date = $value_invitation['re_invited_date'];
            $re_inviting_count = $value_invitation['re_inviting_count'];
            $invitation_id = $value_invitation['invitation_id'];
            $wp_grv_invitaion_img_link = plugin_dir_url( __FILE__ ) . '../assets/img/wp_grv_review_email_image.png';
            $wp_grv_unic_code = $value_invitation['invite_code'];
            $wp_grv_invite_email_id = $value_invitation['email_id'];
            $invite_status_dat = $value_invitation['status'];
            
            if ( $wp_grv_current_date === $re_invited_date && $re_inviting_count < $wp_grv_invitation_repeat && $invite_status_dat === 'waiting' ) {
                $wp_grv_invitation_link_with_code = $wp_grv_link . '?ref=' . $wp_grv_unic_code;
                $format_link = '<a style="color:#fff; text-decoration:none;" href="' . $wp_grv_invitation_link_with_code . '" >Add your review</a>';
                $wp_grv_invitation_message_with_link = '<div style="padding: 40px 100px 40px 100px; background-color:#f4f5f7; border-radius:6px;"><img src= "' . $wp_grv_invitaion_img_link . '" style="width:100%;" alt="review_rating"><h2 style="font-weight:700; font-size:32px; text-align:center; color:#5d5858;">We Value Your Feedback</h2><p style="color:#3c3939; font-size:15px; padding-left:30px;">' . $wp_grv_invitation_message . '</p>' . '<center><button class="linkbutn" style="background:linear-gradient(to right, #3a01a8, #6007ad);border-color:#6007ad ;padding: 10px 16px;cursor: pointer;font-size: 15px;border-radius: 12px;">' . $format_link . '</button></center></div>';
                $wp_grv_invitation_from_addr = 'From: ' . $wp_grv_cmp_name . ' <' . $wp_grv_invitation_from_email . '>' . "\r\n";
                $wp_grv_invitation_subject = 'Invitation to Review';
                /*
                 * sending reinviting email
                 *
                 */
                wp_mail(
                    $wp_grv_invite_email_id,
                    $wp_grv_invitation_subject,
                    $wp_grv_invitation_message_with_link,
                    $wp_grv_invitation_from_addr
                );
                $re_inviting_count = $re_inviting_count + 1;
                $wp_grv_invitation_update_repeat_date = date( 'Y-m-d', strtotime( $wp_grv_current_date . ' + ' . $wp_grv_invitation_days . ' days' ) );
                $wpdb->update(
                    $invitation_tbl,
                    array(
                    're_invited_date'   => $wp_grv_invitation_update_repeat_date,
                    're_inviting_count' => $re_inviting_count,
                ),
                    array(
                    'invitation_id' => $invitation_id,
                ),
                    array( '%s', '%d' ),
                    array( '%d' )
                );
            }
        
        }
        $wpdb->update(
            $invitation_tbl,
            array(
            'status'    => 'Review done',
            'rating'    => $add_rv_rating,
            'view_link' => admin_url( '/admin.php?page=add-new-menu&edit_id=' . $comment_id ),
        ),
            array(
            'invite_code' => $add_refer_code,
        ),
            array( '%s', '%s' ),
            array( '%s' )
        );
    }
    
    public static function wp_grv_cvf_mail_content_type()
    {
        return "text/html";
    }
    
    public static function wp_grv_invitation_init()
    {
        //premium condition ends.
    }

}
Wp_Grv_Invitation_Schedule_Event::wp_grv_invitation_init();