jQuery( document ).ready(
	function(){
		/**
	    * click function for socialproof readmore button
	    *
	    */
	    jQuery( "body" ).on("click","#wp_grv_notification",function(){
			if(jQuery('.wp_grv_sp_status').val() == 'true'){
				jQuery('.wp_grv_sp_auto_hide_btn_hidd').trigger('notify-hide');
			}
		});
	jQuery( "body" ).on("click",".wp_grv_social_proof_more_btn",function(){
	  		var rv_full_content = jQuery('.wp_grv_notification_content_hidden').text();
	  		jQuery('#wp_grv_notification_content').text(rv_full_content);
			jQuery(".wp_grv_social_proof_more_btn").css( 'display', 'none' );
	  		setTimeout(function(){ jQuery('.wp_grv_sp_status').val('true'); }, 100); 
	  		jQuery(".wp_grv_sp_status").attr("active","true");
	  		var wp_grv_sp_status_click 	= jQuery('.wp_grv_sp_status').attr("click");
	  		wp_grv_sp_status_click 		= ++wp_grv_sp_status_click;
	  		jQuery(".wp_grv_sp_status").attr("click",wp_grv_sp_status_click);
	  
		});
		jQuery( "body" ).on("click",".wp_grv_sp_auto_hide_btn_hidd",function(){
			jQuery(this).trigger('notify-hide');
		});
		jQuery('body').append('<input type="hidden" active="false" click="0" value="false" class="wp_grv_sp_status">');
		/*
		* ajax function for social proofing
		*
		*/
		wp_grv_rv_social_proofing();
		function wp_grv_rv_social_proofing(){
			var ajaxurl  				= wp_grv_social_proofing_ajax_script.wp_grv_social_proofing_ajaxurl;
			var api_data 				= {
				'action':'wp_grv_social_proofing_function', // function name
			};
			jQuery.post(
				ajaxurl,
				api_data,
				function(response) {
					var wp_grv_get_json_data                      = jQuery.parseJSON( response );
					var wp_grv_rv_delay_time                      = wp_grv_get_json_data.wp_grv_social_proofing_time_invl;
					var wp_grv_rv_not_stay                        = wp_grv_get_json_data.wp_grv_social_proofing_notification_stay;
					var wp_grv_social_proofing_bg_color           = wp_grv_get_json_data.wp_grv_social_proofing_bg_color;
					var wp_grv_social_proofing_text_size_name     = wp_grv_get_json_data.wp_grv_social_proofing_text_size_name;
					var wp_grv_social_proofing_text_size_contents = wp_grv_get_json_data.wp_grv_social_proofing_text_size_contents;
					var wp_grv_social_proofing_position_sel       = wp_grv_get_json_data.wp_grv_social_proofing_position_sel;
					var wp_grv_mobile_enable                      = wp_grv_get_json_data.wp_grv_mobile_enable;
					var wp_grv_title_enable                       = wp_grv_get_json_data.wp_grv_title_enable;
					var wp_grv_powered_by_enable                  = wp_grv_get_json_data.wp_grv_powered_by_enable;
					var wp_grv_img_border_radius                  = wp_grv_get_json_data.wp_grv_img_border_radius;
					var wp_grv_img_size                           = wp_grv_get_json_data.wp_grv_img_size;
                    var wp_grv_font_color_name                    = wp_grv_get_json_data.wp_grv_font_color_name;
					var wp_grv_font_color_review                  = wp_grv_get_json_data.wp_grv_font_color_review;
					if(wp_grv_title_enable === 'true'){
						wp_grv_title_enable = 'none';
					}
					else{
						 wp_grv_title_enable = 'block';
						 }
					if(wp_grv_powered_by_enable === 'true'){
						wp_grv_powered_by_enable = 'none';
					}
					else{
						 wp_grv_powered_by_enable = 'block';
						 }
					if (wp_grv_mobile_enable === 'true') {
						var current_screen_width = jQuery( window ).width();
						if (current_screen_width < 640) {
							var flag = '1';
						}
					}
					if (flag != 1) {
						var wp_grv_rv_delay_time_add = (+wp_grv_rv_not_stay) + (+wp_grv_rv_delay_time);
						var wp_grv_rv                = wp_grv_get_json_data.wp_grv_rv_title;
						if ( ! wp_grv_rv) {
							var wp_grv_rv_count = 0;
						} else {
							var wp_grv_rv_count = wp_grv_rv.length;
						}
						var i;
						var wp_grv_rv_title;
						var wp_grv_rv_usr_img;
						var wp_grv_rv_done_on;
						var wp_grv_rv_rating;
						var wp_grv_rv_date;
						var wp_grv_rv_content;
						var wp_grv_content_limit_stat;
						var wp_grv_rv_full_content;
						var wp_grv_sp_logo_color;
						var wp_grv_sp_status_active_delay;
						var wp_grv_social_proofing_fun_repeat_delay = (+wp_grv_rv_delay_time_add) * (+wp_grv_rv_count);
						for (i = 0; i < wp_grv_rv_count; i++) {
							(function (i) {
								setTimeout(
									function () {
										var wp_grv_sp_status_active = jQuery('.wp_grv_sp_status').attr("active");
										var wp_grv_sp_status_click 	= jQuery('.wp_grv_sp_status').attr("click");
										if(wp_grv_sp_status_active == 'true'){
											wp_grv_sp_status_active_delay = 8000 * wp_grv_sp_status_click;
										}else{
											wp_grv_sp_status_active_delay = 0;
										}
										setTimeout(
											function () {
												wp_grv_rv_title   			= wp_grv_get_json_data.wp_grv_rv_title[i];
												wp_grv_rv_usr_img 			= wp_grv_get_json_data.wp_grv_rv_usr_img[i];
												wp_grv_rv_done_on 			= wp_grv_get_json_data.wp_grv_rv_done_on[i];
												wp_grv_rv_rating  			= wp_grv_get_json_data.wp_grv_rv_rating[i];
												wp_grv_rv_date    			= wp_grv_get_json_data.wp_grv_rv_date[i];
												wp_grv_rv_content 			= wp_grv_get_json_data.wp_grv_rv_content[i];
												wp_grv_content_limit_stat 	= wp_grv_get_json_data.wp_grv_content_limit_stat[i];
												wp_grv_rv_full_content 		= wp_grv_get_json_data.wp_grv_rv_full_content[i];
												wp_grv_social_icon 			= '';
												if(wp_grv_rv_done_on == 'google' || wp_grv_rv_done_on == 'GMB'){
													wp_grv_social_icon = 'fa fa-google';
													wp_grv_sp_logo_color = "#ff1c1c";
												}else if(wp_grv_rv_done_on == 'facebook'){
													wp_grv_social_icon = 'fa fa-facebook';
													wp_grv_sp_logo_color = "#3f3396";
												}else if(wp_grv_rv_done_on == 'yelp'){
		                                            wp_grv_social_icon = 'fa fa-yelp';
													wp_grv_sp_logo_color = "#ff1c1c";
												}	
												if (wp_grv_rv_rating == '5') {
													if(wp_grv_content_limit_stat == 'true'){
														jQuery.notify.addStyle(
															'wp_grv_social_proofing1',
															{
																
															html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p class='wp_grv_notification_content_hidden' style='display:none;'>"+wp_grv_rv_full_content+"</p><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a href='#' class='wp_grv_social_proof_more_btn'>More</a><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",

															}
														);
													}
													else{	
														jQuery.notify.addStyle(
															'wp_grv_social_proofing1',
															{
																
															html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",

															}
														);
													}	
													
													jQuery.notify(
														wp_grv_rv_content,
														{
															style: 'wp_grv_social_proofing1',
															autoHide: false,
															elementPosition: wp_grv_social_proofing_position_sel,
															position: wp_grv_social_proofing_position_sel,
															showAnimation: 'slideDown',
															showDuration: 800,
															clickToHide: false,
															hideAnimation: 'slideUp',
															hideDuration: 700,
														}
													);
												}
												if (wp_grv_rv_rating == '4') {
													if(wp_grv_content_limit_stat == 'true'){
														jQuery.notify.addStyle(
															'wp_grv_social_proofing2',
															{

																html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p class='wp_grv_notification_content_hidden' style='display:none;'>"+wp_grv_rv_full_content+"</p><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a href='#' class='wp_grv_social_proof_more_btn'>More</a><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",
															}
														);
													}
													else{	
														jQuery.notify.addStyle(
															'wp_grv_social_proofing2',
															{

																html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",
															}
														);
													}
													jQuery.notify(
														wp_grv_rv_content,
														{
															style: 'wp_grv_social_proofing2',
															autoHide: false,
															elementPosition: wp_grv_social_proofing_position_sel,
															position: wp_grv_social_proofing_position_sel,
															showAnimation: 'slideDown',
															showDuration: 800,
															clickToHide: false,
															hideAnimation: 'slideUp',
															hideDuration: 700,
														}
													);
												}
												if (wp_grv_rv_rating == '3') {
													if(wp_grv_content_limit_stat == 'true'){
														jQuery.notify.addStyle(
															'wp_grv_social_proofing3',
															{

																html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p class='wp_grv_notification_content_hidden' style='display:none;'>"+wp_grv_rv_full_content+"</p><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a href='#' class='wp_grv_social_proof_more_btn'>More</a><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span><span class='fa fa-star'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",

															}
														);
													}
													else{	
														jQuery.notify.addStyle(
															'wp_grv_social_proofing3',
															{

																html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span><span class='fa fa-star'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",

															}
														);
													}
													
													jQuery.notify(
														wp_grv_rv_content,
														{
															style: 'wp_grv_social_proofing3',
															autoHide: false,
															elementPosition: wp_grv_social_proofing_position_sel,
															position: wp_grv_social_proofing_position_sel,
															showAnimation: 'slideDown',
															showDuration: 800,
															clickToHide: false,
															hideAnimation: 'slideUp',
															hideDuration: 700,
														}
													);
												}
												if (wp_grv_rv_rating == '2') {
													if(wp_grv_content_limit_stat == 'true'){
														jQuery.notify.addStyle(
															'wp_grv_social_proofing4',
															{

																html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p class='wp_grv_notification_content_hidden' style='display:none;'>"+wp_grv_rv_full_content+"</p><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a href='#' class='wp_grv_social_proof_more_btn'>More</a><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",

															}
														);
													}
													else{	
														jQuery.notify.addStyle(
															'wp_grv_social_proofing4',
															{

																html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",

															}
														);
													}
													
													jQuery.notify(
														wp_grv_rv_content,
														{
															style: 'wp_grv_social_proofing4',
															autoHide: false,
															elementPosition: wp_grv_social_proofing_position_sel,
															position: wp_grv_social_proofing_position_sel,
															showAnimation: 'slideDown',
															showDuration: 800,
															clickToHide: false,
															hideAnimation: 'slideUp',
															hideDuration: 700,
														}
													);
												}
												if (wp_grv_rv_rating == '1') {
													if(wp_grv_content_limit_stat == 'true'){
														jQuery.notify.addStyle(
															'wp_grv_social_proofing5',
															{

																html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p class='wp_grv_notification_content_hidden' style='display:none;'>"+wp_grv_rv_full_content+"</p><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a href='#' class='wp_grv_social_proof_more_btn'>More</a><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",

															}
														);
													}
													else{	
														jQuery.notify.addStyle(
															'wp_grv_social_proofing5',
															{

																html: "<div id='wp_grv_notification' style = 'background-color:" + wp_grv_social_proofing_bg_color + ";'><div class='wp_grv_notification_usr_img_block'><img id='wp_grv_notification_usr_img' src='" + wp_grv_rv_usr_img + "' style = 'border-radius:" + wp_grv_img_border_radius + ";height:"+wp_grv_img_size+";width:"+wp_grv_img_size+"'></div><div class='wp_grv_social_icon_block'><i style='color: "+wp_grv_sp_logo_color+"' class='"+wp_grv_social_icon+"'></i></div><div class='wp_grv_notification_content_block'><h2 style = 'font-size:" + wp_grv_social_proofing_text_size_name + ";display:"+wp_grv_title_enable+";color:"+wp_grv_font_color_name+"'>" + wp_grv_rv_title + "</h2><p id='wp_grv_notification_content' style = 'font-size:" + wp_grv_social_proofing_text_size_contents + ";color:"+wp_grv_font_color_review+";' data-notify-text/><a class='wp_grv_sp_auto_hide_btn_hidd' style='display:none;' data-notify-text='button'>close</a><div id='rv_star_rating_size'><span class='fa fa-star rv_checked'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span><span class='fa fa-star'></span></div><div class='wp_grv_powered' style = 'display:"+wp_grv_powered_by_enable+";'><p>Powered by WPGratify.com</p></div></div><i class='fa fa-times wp_grv_sp_close'></i></div>",

															}
														);
													}
													
													jQuery.notify(
														wp_grv_rv_content,
														{
															style: 'wp_grv_social_proofing5',
															autoHide: false,
															elementPosition: wp_grv_social_proofing_position_sel,
															position: wp_grv_social_proofing_position_sel,
															showAnimation: 'slideDown',
															showDuration: 800,
															clickToHide: false,
															hideAnimation: 'slideUp',
															hideDuration: 700,
														}
													);
												}
												setTimeout(function(){ 
													var load_more_clk_stat = jQuery('.wp_grv_sp_status').val();
													if(load_more_clk_stat == 'true'){
														setTimeout(function(){ 
															jQuery('.wp_grv_sp_auto_hide_btn_hidd').trigger('click');
															setTimeout(function(){ 
																if(i == (wp_grv_rv_count-1)){
																	jQuery(".wp_grv_sp_status").attr("click","0");
																	wp_grv_rv_social_proofing();
																}
															}, wp_grv_rv_not_stay); 

													}, 8000);
														jQuery('.wp_grv_sp_status').val('false');
													}else{
														jQuery('.wp_grv_sp_auto_hide_btn_hidd').trigger('click');
														setTimeout(function(){ 
															if(i == (wp_grv_rv_count-1)){
																jQuery(".wp_grv_sp_status").attr("click","0");
																wp_grv_rv_social_proofing();
															}
														}, wp_grv_rv_not_stay);
													}	
												}, wp_grv_rv_not_stay);
											}, 
										wp_grv_sp_status_active_delay);//second time out function	
									},
									wp_grv_rv_delay_time_add * i
								);
							})( i );
						}//loop ends
						
					}//mobile disable/enable if condition ends
				}
			);
		}// function ends
	   
	}
);
