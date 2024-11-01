jQuery( document ).ready(
	function(){
		jQuery( "body" ).on("click",".wp_grv_sp_close",function(){	
 			jQuery( ".notifyjs-corner" ).css( 'display', 'none' );	
		});
		/*
		*  ajax function to insert review user image from front end
		*
		*/
		jQuery( '#rv_user_image' ). change(
			function(){
				jQuery( ".wp_grv_upload_success_msg" ).css( 'display', 'none' );// hide upload success message
				jQuery( ".wp_grv_loading_bar" ).css( 'display', 'inline-block' );// loading bar enable
				var probn    = new FormData();
				var filedata = jQuery( '#rv_user_image' ); // The <input type="file" /> field
				// Loop through each data and create an array file[] containing our files data.
				jQuery.each(
					jQuery( filedata ),
					function(i, obj) {
						jQuery.each(
							obj.files,
							function(j,file){
								probn.append( 'files[' + j + ']', file );
							}
						)
					}
				);
				// our AJAX identifier
				probn.append( 'action', 'wp_grv_single_review_image_upload_files' );
				var ajax_url = wp_grv_ajax_script.wp_grv_ajaxurl;
				jQuery.ajax(
					{
						type: 'POST',
						url: ajax_url,
						data: probn,
						contentType: false,
						processData: false,
						success: function(response){
							jQuery( ".wp_grv_loading_bar" ).css( 'display', 'none' );// loading bar desable
							jQuery( ".wp_grv_upload_success_msg" ).css( 'display', 'inline-block' );// shows upload success message
							jQuery( '#wp_grv_add_usr_img_url' ).val( response );
						}
					}
				);
			}
		);
		/*
		*  ajax function to insert review from front end
		*
		*/
		jQuery( '#wp_grv_new_rv_add_sub' ). click(
			function(){
				 var wp_grv_add_name        = jQuery( '#rv_add_name' ).val();
				 var wp_grv_add_email       = jQuery( '#rv_add_email' ).val();
				 var wp_grv_add_title       = jQuery( '#rv_add_title' ).val();
				 var wp_grv_add_content     = jQuery( '#rv_add_content' ).val();
				 var wp_grv_add_ref         = jQuery( '#wp_grv_add_ref' ).val();
				 var wp_grv_add_usr_img_url = jQuery( '#wp_grv_add_usr_img_url' ).val();
				 // add duplicate details.
				 var wp_grv_dup_details_check = jQuery( "#wp_grv_add_dup_name_check" ).prop( 'checked' );
				if (wp_grv_dup_details_check == true) {
					  var wp_grv_dup_name   = jQuery( '#wp_grv_dup_name' ).val();
					  var wp_grv_dup_reason = jQuery( '#wp_grv_dup_reason' ).val();
				} else {
					var wp_grv_dup_name   = '';
					var wp_grv_dup_reason = '';
				}
				// add star rating.
				var wp_grv_st5 = jQuery( "#rv_st5" ).prop( "checked" );
				var wp_grv_st4 = jQuery( "#rv_st4" ).prop( "checked" );
				var wp_grv_st3 = jQuery( "#rv_st3" ).prop( "checked" );
				var wp_grv_st2 = jQuery( "#rv_st2" ).prop( "checked" );
				var wp_grv_st1 = jQuery( "#rv_st1" ).prop( "checked" );
				if (wp_grv_st5 === true) {
					var wp_grv_raiting = '5';
				} else if (wp_grv_st4 === true) {
					var wp_grv_raiting = '4';
				} else if (wp_grv_st3 === true) {
					var wp_grv_raiting = '3';
				} else if (wp_grv_st2 === true) {
					var wp_grv_raiting = '2';
				} else if (wp_grv_st1 === true) {
					var wp_grv_raiting = '1';
				} else {
					var wp_grv_raiting = '5';
				}
				// validation
				if (wp_grv_add_name === '') {
					jQuery( '#rv_add_name' ).css( 'border', 'solid 1px #01c3a9' );
					jQuery('html, body').animate({
				        scrollTop: jQuery(".wp_grv_add_new_form_head_text").offset().top
				    }, 1000);
					return false;
				} else {
					jQuery( '#rv_add_name' ).css( 'border', 'none' );
				}
				if (wp_grv_add_email === '') {
					jQuery( '#rv_add_email' ).css( 'border', 'solid 1px #01c3a9' );
					jQuery('html, body').animate({
				        scrollTop: jQuery(".wp_grv_add_new_form_head_text").offset().top
				    }, 1000);
					return false;
				}
				var wp_grv_email_pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if ( ! wp_grv_email_pattern.test( wp_grv_add_email )) {
					jQuery( '#rv_add_email' ).css( 'border', 'solid 1px #01c3a9' );
					jQuery('html, body').animate({
				        scrollTop: jQuery(".wp_grv_add_new_form_head_text").offset().top
				    }, 1000);
					return false;
				} else {
					jQuery( '#rv_add_email' ).css( 'border', 'none' );
					var wp_grv_email_stat = '1'
				}
				if (wp_grv_add_title === '') {
					jQuery( '#rv_add_title' ).css( 'border', 'solid 1px #01c3a9' );
					jQuery('html, body').animate({
				        scrollTop: jQuery(".wp_grv_add_new_form_head_text").offset().top
				    }, 1000);
					return false;
				} else {
					jQuery( '#rv_add_title' ).css( 'border', 'none' );
				}
				if (wp_grv_add_content === '') {
					jQuery( '#rv_add_content' ).css( 'border', 'solid 1px #01c3a9' );
					jQuery('html, body').animate({
				        scrollTop: jQuery(".wp_grv_add_new_form_head_text").offset().top
				    }, 1000);
					return false;
				} else {
					jQuery( '#rv_add_content' ).css( 'border', 'none' );
				}
				if (wp_grv_dup_details_check == true) {
					if (wp_grv_dup_name === '') {
						jQuery( '#wp_grv_dup_name' ).css( 'border', 'solid 1px #01c3a9' );
						jQuery('html, body').animate({
					        scrollTop: jQuery("#rv_add_email").offset().top
					    }, 1000);
						return false;
					} else {
						jQuery( '#wp_grv_dup_name' ).css( 'border', 'none' );
					}
					if (wp_grv_dup_reason === '') {
						jQuery( '#wp_grv_dup_reason' ).css( 'border', 'solid 1px #01c3a9' );
						jQuery('html, body').animate({
					        scrollTop: jQuery("#rv_add_email").offset().top
					    }, 1000);
						return false;
					} else {
						jQuery( '#wp_grv_dup_reason' ).css( 'border', 'none' );
					}
				}
				if ( (wp_grv_add_name != '') && (wp_grv_email_stat === '1') && (wp_grv_add_content != '') && (wp_grv_add_title != '') ) {
					if (wp_grv_dup_details_check == true) {
						if ( (wp_grv_dup_name != '') && (wp_grv_dup_reason != '') ) {
							jQuery( this ).off( 'click' );// button disable
							jQuery( "#fountainTextG" ).css( 'display', 'inline-block' );// loading enable
							var ajaxurl                = wp_grv_ajax_script.wp_grv_ajaxurl;
							var rv_update_details_data = {
								'action'                    : 'wp_grv_single_rv_insert', // function name
								'wp_grv_add_name'           : wp_grv_add_name,
								'wp_grv_add_email'          : wp_grv_add_email,
								'wp_grv_add_title'          : wp_grv_add_title,
								'wp_grv_add_content'        : wp_grv_add_content,
								'wp_grv_raiting'            : wp_grv_raiting,
								'wp_grv_add_ref'            : wp_grv_add_ref,
								'wp_grv_add_usr_img_url'    : wp_grv_add_usr_img_url,
								'wp_grv_dup_details_check'  : wp_grv_dup_details_check,
								'wp_grv_dup_name'           : wp_grv_dup_name,
								'wp_grv_dup_reason'         : wp_grv_dup_reason,
							};
						}
					} else {
						jQuery( this ).off( 'click' );// button disable
						jQuery( "#fountainTextG" ).css( 'display', 'inline-block' );// loading enable
						var ajaxurl                = wp_grv_ajax_script.wp_grv_ajaxurl;
						var rv_update_details_data = {
							'action'                    : 'wp_grv_single_rv_insert', // function name
							'wp_grv_add_name'           : wp_grv_add_name,
							'wp_grv_add_email'          : wp_grv_add_email,
							'wp_grv_add_title'          : wp_grv_add_title,
							'wp_grv_add_content'        : wp_grv_add_content,
							'wp_grv_raiting'            : wp_grv_raiting,
							'wp_grv_add_ref'            : wp_grv_add_ref,
							'wp_grv_add_usr_img_url'    : wp_grv_add_usr_img_url,
							'wp_grv_dup_details_check'  : wp_grv_dup_details_check,
							'wp_grv_dup_name'           : wp_grv_dup_name,
							'wp_grv_dup_reason'         : wp_grv_dup_reason,
						};
					}
					jQuery.post(
						ajaxurl,
						rv_update_details_data,
						function(response) {
							jQuery( "#fountainTextG" ).css( 'display', 'none' );
							jQuery( '#wp_grv_add_new_page' ).css( 'display', 'none' );
							jQuery( '#wp_grv_add_new_page_social_review' ).css( 'display', 'block' );
							var wp_grv_get_json_data              = jQuery.parseJSON( response );
							var wp_grv_google_check               = wp_grv_get_json_data.wp_grv_google_check;
							var wp_grv_fb_check                   = wp_grv_get_json_data.wp_grv_fb_check;
							var wp_grv_twitter_check              = wp_grv_get_json_data.wp_grv_twitter_check;
							var wp_grv_custom_check               = wp_grv_get_json_data.wp_grv_custom_check;
							var wp_grv_google_logo                = wp_grv_get_json_data.wp_grv_google_logo;
							var wp_grv_google_link                = wp_grv_get_json_data.wp_grv_google_link;
							var wp_grv_fb_logo                    = wp_grv_get_json_data.wp_grv_fb_logo;
							var wp_grv_fb_link                    = wp_grv_get_json_data.wp_grv_fb_link;
							var wp_grv_twitter_logo               = wp_grv_get_json_data.wp_grv_twitter_logo;
							var wp_grv_twitter_link               = wp_grv_get_json_data.wp_grv_twitter_link;
							var wp_grv_custom_title               = wp_grv_get_json_data.wp_grv_custom_title;
							var wp_grv_custom_logo                = wp_grv_get_json_data.wp_grv_custom_logo;
							var wp_grv_custom_link                = wp_grv_get_json_data.wp_grv_custom_link;
							var wp_grv_custom_title2              = wp_grv_get_json_data.wp_grv_custom_title2;
							var wp_grv_custom_logo2               = wp_grv_get_json_data.wp_grv_custom_logo2;
							var wp_grv_custom_link2               = wp_grv_get_json_data.wp_grv_custom_link2;
							var wp_grv_custom_title3              = wp_grv_get_json_data.wp_grv_custom_title3;
							var wp_grv_custom_logo3               = wp_grv_get_json_data.wp_grv_custom_logo3;
							var wp_grv_custom_link3               = wp_grv_get_json_data.wp_grv_custom_link3;
							var wp_grv_enable_rating              = wp_grv_get_json_data.wp_grv_enable_rating;
							var wp_grv_auto_post_check            = wp_grv_get_json_data.wp_grv_auto_post_check;
							var wp_grv_thank_you_msg_social_media = wp_grv_get_json_data.wp_grv_thank_you_msg_social_media;
							var wp_grv_thank_you_msg              = wp_grv_get_json_data.wp_grv_thank_you_msg;
							var wp_grv_default_user_img           = wp_grv_get_json_data.wp_grv_default_user_img;
							if ((wp_grv_enable_rating === 'all') && ((wp_grv_raiting === '1') || (wp_grv_raiting === '2') || (wp_grv_raiting === '3') || (wp_grv_raiting === '4') || (wp_grv_raiting === '5'))) {
								jQuery( '#wp_grv_thk_you_msg_social_media_front' ).css( 'display', 'block' );
								if ( (wp_grv_google_check === 'true') && (wp_grv_google_link != '') ) {
									jQuery( '#wp_grv_google_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_fb_check === 'true') && (wp_grv_fb_link != '') ) {
									jQuery( '#wp_grv_fb_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_twitter_check === 'true') && (wp_grv_twitter_link != '') ) {
									jQuery( '#wp_grv_twitter_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title != '') && (wp_grv_custom_link != '') ) {
									jQuery( '#wp_grv_custom_button1' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title2 != '') && (wp_grv_custom_link2 != '') ) {
									jQuery( '#wp_grv_custom_button2' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title3 != '') && (wp_grv_custom_link3 != '') ) {
									jQuery( '#wp_grv_custom_button3' ).css( 'display', 'block' );
								}
							} else if ((wp_grv_enable_rating === 'below3') && ((wp_grv_raiting === '1') || (wp_grv_raiting === '2'))) {
								jQuery( '#wp_grv_thk_you_msg_social_media_front' ).css( 'display', 'block' );
								if ( (wp_grv_google_check === 'true') && (wp_grv_google_link != '') ) {
									jQuery( '#wp_grv_google_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_fb_check === 'true') && (wp_grv_fb_link != '') ) {
									jQuery( '#wp_grv_fb_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_twitter_check === 'true') && (wp_grv_twitter_link != '') ) {
									jQuery( '#wp_grv_twitter_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title != '') && (wp_grv_custom_link != '') ) {
									jQuery( '#wp_grv_custom_button1' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title2 != '') && (wp_grv_custom_link2 != '') ) {
									jQuery( '#wp_grv_custom_button2' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title3 != '') && (wp_grv_custom_link3 != '') ) {
									jQuery( '#wp_grv_custom_button3' ).css( 'display', 'block' );
								}
							} else if ((wp_grv_enable_rating === '3andabove') && ((wp_grv_raiting === '3') || (wp_grv_raiting === '4') || (wp_grv_raiting === '5'))) {
								  jQuery( '#wp_grv_thk_you_msg_social_media_front' ).css( 'display', 'block' );
								if ( (wp_grv_google_check === 'true') && (wp_grv_google_link != '') ) {
									jQuery( '#wp_grv_google_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_fb_check === 'true') && (wp_grv_fb_link != '') ) {
									jQuery( '#wp_grv_fb_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_twitter_check === 'true') && (wp_grv_twitter_link != '') ) {
									jQuery( '#wp_grv_twitter_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title != '') && (wp_grv_custom_link != '') ) {
									jQuery( '#wp_grv_custom_button1' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title2 != '') && (wp_grv_custom_link2 != '') ) {
									jQuery( '#wp_grv_custom_button2' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title3 != '') && (wp_grv_custom_link3 != '') ) {
									jQuery( '#wp_grv_custom_button3' ).css( 'display', 'block' );
								}
							} else if ((wp_grv_enable_rating === '4to5') && ((wp_grv_raiting === '4') || (wp_grv_raiting === '5'))) {
								 jQuery( '#wp_grv_thk_you_msg_social_media_front' ).css( 'display', 'block' );
								if ( (wp_grv_google_check === 'true') && (wp_grv_google_link != '') ) {
									  jQuery( '#wp_grv_google_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_fb_check === 'true') && (wp_grv_fb_link != '') ) {
									jQuery( '#wp_grv_fb_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_twitter_check === 'true') && (wp_grv_twitter_link != '') ) {
									jQuery( '#wp_grv_twitter_button' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title != '') && (wp_grv_custom_link != '') ) {
									jQuery( '#wp_grv_custom_button1' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title2 != '') && (wp_grv_custom_link2 != '') ) {
									jQuery( '#wp_grv_custom_button2' ).css( 'display', 'block' );
								}
								if ( (wp_grv_custom_check === 'true') && (wp_grv_custom_title3 != '') && (wp_grv_custom_link3 != '') ) {
									jQuery( '#wp_grv_custom_button3' ).css( 'display', 'block' );
								}
							} else {
								jQuery( '#wp_grv_thk_you_msg_front' ).css( 'display', 'block' );
								jQuery( '.wp_grv_social_meadia_link_block' ).css( 'display', 'none' );
								// counting
								jQuery( '#wp_grv_default_count' ).css( 'display', 'block' );
								var wp_grv_timeleft      = 5;
								var wp_grv_downloadTimer = setInterval(
									function(){
										wp_grv_timeleft--;
										if (wp_grv_timeleft >= 0) {
											  jQuery( '#wp_grv_countdowntimer' ).text( wp_grv_timeleft );
										}
										if (wp_grv_timeleft <= -1) {
											  clearInterval( wp_grv_downloadTimer );
											  var url         = jQuery( '#wp_grv_url_hidden' ).val();
											  window.location = url;
										}
									},
									1000
								);
							}
						}
					);
				} else {
					// alert( 'Please fill all fields' );
				}
			}
		);
		// for social media buttons
		jQuery( '#wp_grv_google_button' ). click(
			function(){
				var url = jQuery( '#wp_grv_google_link_hidden' ).val();
				window.open( url, '_blank' );
			}
		);
		jQuery( '#wp_grv_fb_button' ). click(
			function(){
				var url = jQuery( '#wp_grv_fb_link_hidden' ).val();
				window.open( url, '_blank' );
			}
		);
		jQuery( '#wp_grv_twitter_button' ). click(
			function(){
				var url = jQuery( '#wp_grv_twitter_link_hidden' ).val();
				window.open( url, '_blank' );
			}
		);
		jQuery( '#wp_grv_custom_button1' ). click(
			function(){
				var url = jQuery( '#wp_grv_custom_link_hidden' ).val();
				window.open( url, '_blank' );
			}
		);
		jQuery( '#wp_grv_custom_button2' ). click(
			function(){
				var url = jQuery( '#wp_grv_custom_link2_hidden' ).val();
				window.open( url, '_blank' );
			}
		);
		jQuery( '#wp_grv_custom_button3' ). click(
			function(){
				var url = jQuery( '#wp_grv_custom_link3_hidden' ).val();
				window.open( url, '_blank' );
			}
		);
	}
);
