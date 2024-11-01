jQuery(document).ready(function(){

       /**
		* ajax function for category edit
		* 
		*/
		
jQuery( "body" ).on("click","#wp_grv_rv_cat_edit",function(){
				event.preventDefault();
				var wp_grv_cat_id   	= jQuery( this ).attr( "data_id" ); 
				var ajaxurl            	= wp_grv_ajax_script.wp_grv_ajaxurl;
				var wp_grv_cat_update_data 			= {
							'action'		:'wp_grv_category_update', // function name
							'wp_grv_cat_id'	: wp_grv_cat_id,
				};
				jQuery.post(ajaxurl,wp_grv_cat_update_data,function(response) {
					jQuery( '#wp_grv_add_category_form_block' ).html( response );
					jQuery(window).scrollTop(0);	
				});
		});
       /**
		* ajax function for individual event post deletion 
		* 
		*/
		
jQuery( "body" ).on("click","#wp_grv_rv_event_delete",function(){
				event.preventDefault();
				var wp_grv_gmb_event_delete_confirm = confirm( "Are you sure?" );
				if (wp_grv_gmb_event_delete_confirm === true) {
					  jQuery( '#wp_grv_add_event_list_tbl' ).css( 'opacity', '0.5' );
					  var wp_grv_gmb_event_delete_id   	= jQuery( this ).attr( "data_id" );
					  var wp_grv_gmb_event_location   	= jQuery( this ).attr( "location" );
					  var ajaxurl            			= wp_grv_ajax_script.wp_grv_ajaxurl;
					  var rv_event_delete_data 			= {
							'action':'wp_grv_gmb_event_delete_fun', // function name
							'wp_grv_gmb_event_delete_id' : wp_grv_gmb_event_delete_id,
							'wp_grv_gmb_event_location'	 : wp_grv_gmb_event_location
					};
					jQuery.post(
						ajaxurl,
						rv_event_delete_data,
						function(response) {
							jQuery( '#wp_grv_add_event_list_tbl' ).html( response );
							jQuery( '#wp_grv_add_event_list_tbl' ).css( 'opacity', '1' );
							jQuery( window ).scrollTop( 0 );
							jQuery( '.wp_grv_update_successfull_msg_wp_cat_delete' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp_cat_delete' ).fadeOut( 10000 );
						}
					);
				}
			}
		);
	   /*
		* ajax function for individual new post deletion 
		*
		*/
		
		jQuery( "body" ).on("click","#wp_grv_rv_new_post_delete",function(){
				event.preventDefault();
				var wp_grv_gmb_new_post_delete_confirm = confirm( "Are you sure?" );
				if (wp_grv_gmb_new_post_delete_confirm === true) {
					  jQuery( '#wp_grv_add_new_post_list_tbl' ).css( 'opacity', '0.5' );
					  var wp_grv_gmb_new_post_delete_id   	= jQuery( this ).attr( "data_id" );
					  var wp_grv_gmb_new_post_location   	= jQuery( this ).attr( "location" );
					  var ajaxurl            				= wp_grv_ajax_script.wp_grv_ajaxurl;
					  var rv_new_post_delete_data 			= {
							'action':'wp_grv_gmb_new_post_delete_fun', // function name
							'wp_grv_gmb_new_post_delete_id' : wp_grv_gmb_new_post_delete_id,
							'wp_grv_gmb_new_post_location'  : wp_grv_gmb_new_post_location,
					};
					jQuery.post(
						ajaxurl,
						rv_new_post_delete_data,
						function(response) {
							jQuery( '#wp_grv_add_new_post_list_tbl' ).html( response );
							jQuery( '#wp_grv_add_new_post_list_tbl' ).css( 'opacity', '1' );
							jQuery( window ).scrollTop( 0 );
							jQuery( '.wp_grv_update_successfull_msg_wp_cat_delete' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp_cat_delete' ).fadeOut( 10000 );
						}
					);
				}
			}
		);
	   /*
		* ajax function for individual alert post deletion 
		*
		*/
		
		jQuery( "body" ).on("click","#wp_grv_rv_alert_post_delete",function(){
				event.preventDefault();
				var wp_grv_gmb_alert_post_delete_confirm = confirm( "Are you sure?" );
				if (wp_grv_gmb_alert_post_delete_confirm === true) {
					  jQuery( '#wp_grv_add_alert_post_list_tbl' ).css( 'opacity', '0.5' );
					  var wp_grv_gmb_alert_post_delete_id   = jQuery( this ).attr( "data_id" );
					  var wp_grv_gmb_alert_post_location   	= jQuery( this ).attr( "location" );
					  var ajaxurl            				= wp_grv_ajax_script.wp_grv_ajaxurl;
					  var wp_grv_alert_post_delete_data 			= {
							'action':'wp_grv_gmb_alert_post_delete_fun', // function name
							'wp_grv_gmb_alert_post_delete_id' : wp_grv_gmb_alert_post_delete_id,
							'wp_grv_gmb_alert_post_location'  : wp_grv_gmb_alert_post_location,
					};
					jQuery.post(
						ajaxurl,
						wp_grv_alert_post_delete_data,
						function(response) {
							jQuery( '#wp_grv_add_alert_post_list_tbl' ).html( response );
							jQuery( '#wp_grv_add_alert_post_list_tbl' ).css( 'opacity', '1' );
							jQuery( window ).scrollTop( 0 );
							jQuery( '.wp_grv_update_successfull_msg_wp_cat_delete' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp_cat_delete' ).fadeOut( 10000 );
						}
					);
				}
			}
		);
/**
 * function for button link toggle block in alert post section
 * @author Ekanath
 */
 	jQuery( "#wp_grv_gmb_add_new_post_button_link").hide(); 
 	jQuery('#wp_grv_gmb_add_alert_post_button_list'). change(function(){
 		var wp_grv_gmb_add_alert_post_button_link   = jQuery(this).val();
		if(wp_grv_gmb_add_alert_post_button_link == 'none'){
			jQuery( "#wp_grv_gmb_add_alert_post_button_link").css( "display","none" );
		}else{
			jQuery( "#wp_grv_gmb_add_alert_post_button_link").css( "display","contents" );
		}
 	});	
/**
 * function for button link toggle block in add new post section
 * @author Anusha
 */	
	var wp_grv_gmb_add_new_post_button_link       = jQuery( "#wp_grv_gmb_add_new_post_button_list" ).val();
	jQuery("#wp_grv_gmb_add_new_post_phone_number").hide();
	jQuery( "#wp_grv_gmb_add_new_post_button_link").hide();    
	jQuery( "#wp_grv_gmb_add_new_post_button_list" ).change(function(){
		var wp_grv_gmb_add_new_post_button_link   = jQuery(this).val();
		if(wp_grv_gmb_add_new_post_button_link == 'none'){
			jQuery( "#wp_grv_gmb_add_new_post_button_link").css( "display","none" );
			jQuery( "#wp_grv_gmb_add_new_post_phone_number").css( "display","none" );
		}
         else if(wp_grv_gmb_add_new_post_button_link == 'call'){
			jQuery( "#wp_grv_gmb_add_new_post_phone_number").css( "display","contents" );
			jQuery( "#wp_grv_gmb_add_new_post_button_link").css( "display","none" );
			var fetch_access_token 		= jQuery( '#wp_grv_acess_token_from_admin_phone' ).val();
			var fetch_location_path   	= jQuery( '#wp_grv_location_path_phone' ).val();
			if (fetch_access_token != undefined && fetch_location_path != undefined && location_path != 'null') {
				var auth_code 		= 'Bearer ' + fetch_access_token;
				var url       		= 'https://mybusiness.googleapis.com/v4/' + fetch_location_path;
				var setting_details = {
					"async": true,
					"crossDomain": true,
					"url": url,
					"method": "GET",
					"headers": {
						"Authorization": auth_code
					}
				}
				jQuery.ajax( setting_details ).done(
					function (response) {
							var res 						= response;
							var ajaxurl               		= wp_grv_ajax_script.wp_grv_ajaxurl;
							var wp_grv_gmb_fetch_details 	= {
								'action':'wp_grv_gmb_post_fetch_phone', // function name
								'wp_grv_gmb_phone_number' : res,		
							};
						jQuery.post(ajaxurl,wp_grv_gmb_fetch_details,
												function(response2) {
													console.log(response2);
													jQuery( '#wp_grv_gmb_phone_number' ).val( response2 );
												}
						);
				})
		   }
		}else{
			jQuery( "#wp_grv_gmb_add_new_post_button_link").css( "display","contents" );
			jQuery( "#wp_grv_gmb_add_new_post_phone_number").css( "display","none" );
		}
	});

    /**
     * function for button link toggle block in add new event section
     * @author Anusha
    */
	var wp_grv_gmb_event_more_details = jQuery( "#gmb_event_more_options" ).val();
	var wp_grv_gmb_event_button_link  = jQuery( "#wp_grv_gmb_add_event_button_list" ).val();
		jQuery( "#wp_grv_additional_options_event_toggle_block,#wp_grv_gmb_add_event_button,#wp_grv_gmb_add_event_button_link,#wp_grv_gmb_add_new_event_phone_number" ).hide();
		jQuery( "#gmb_event_more_options" ).click(function(){
	    if(wp_grv_gmb_event_more_details == 'true'){
			jQuery( "#wp_grv_additional_options_event_toggle_block,#wp_grv_gmb_add_event_button").slideToggle( "slow" );
			jQuery( "#wp_grv_gmb_add_event_button_link").css( "display","none" );
			jQuery( "#wp_grv_gmb_add_new_event_phone_number").css( "display","none" );
	}
});
jQuery( "#wp_grv_gmb_add_event_button_list" ).change(function(){
			var wp_grv_gmb_event_button_link       = jQuery(this).val();
			if(wp_grv_gmb_event_button_link == 'none'){
				jQuery( "#wp_grv_gmb_add_event_button_link").css( "display","none" );
				jQuery( "#wp_grv_gmb_add_new_event_phone_number").css( "display","none" );
			}
			else if (wp_grv_gmb_event_button_link == 'call') {
			jQuery( "#wp_grv_gmb_add_new_event_phone_number").css( "display","contents" );
			jQuery( "#wp_grv_gmb_add_event_button_link").css( "display","none" );
			
			var fetch_access_token 		= jQuery( '#wp_grv_acess_token_from_admin_phone' ).val();
			var fetch_location_path   	= jQuery( '#wp_grv_location_path_phone' ).val();
			if (fetch_access_token != undefined && fetch_location_path != undefined && location_path != 'null') {
				var auth_code 		= 'Bearer ' + fetch_access_token;
				var url       		= 'https://mybusiness.googleapis.com/v4/' + fetch_location_path;
				var setting_details = {
					"async": true,
					"crossDomain": true,
					"url": url,
					"method": "GET",
					"headers": {
						"Authorization": auth_code
					}
				}
				jQuery.ajax( setting_details ).done(
					function (response) {
							var event_response 					= response;
							var ajaxurl               			= wp_grv_ajax_script.wp_grv_ajaxurl;
							var wp_grv_gmb_event_fetch_details 	= {
								'action':'wp_grv_gmb_post_fetch_phone', // function name
								'wp_grv_gmb_phone_number' : event_response,
								
				};
						jQuery.post(ajaxurl,wp_grv_gmb_event_fetch_details,
												function(response3) {
													console.log(response3);
													jQuery('#wp_grv_gmb_evnt_phone_number').val(response3);
												}
						);
				})
		   }
		}else{
			jQuery( "#wp_grv_gmb_add_new_event_phone_number").css( "display","none" );
			jQuery( "#wp_grv_gmb_add_event_button_link").css( "display","contents" );
		}
	});
	
   /*
	* ajax function for gmb alert post insertion
	*
	*/
	jQuery( "#wp_grv_alert_post_btn" ).on("click", function(){
				event.preventDefault();
				var wp_grv_gmb_write_post                  	= jQuery( '#wp_grv_gmb_write_alert_post' ).val();
				var wp_grv_gmb_add_alert_post_button_list  	= jQuery( '#wp_grv_gmb_add_alert_post_button_list' ).val();
				var add_alert_post_button_link             	= jQuery('#add_alert_post_button_link').val();
				var wp_grv_select_location_name 			= jQuery( '#wp_grv_gmb_add_alert_post_select_location option:selected' ).text();
				var wp_grv_select_location 					= jQuery( '#wp_grv_gmb_add_alert_post_select_location' ).val();
				/* Validation */
				if (wp_grv_gmb_write_post === '') {
					jQuery( '#wp_grv_gmb_write_alert_post' ).css( 'border', 'solid 1px #f10707' );
					 return false;
				} else {
					jQuery( '#wp_grv_gmb_write_alert_post' ).css( 'border', 'none' );
				}
				if(wp_grv_gmb_add_alert_post_button_list == 'book' || wp_grv_gmb_add_alert_post_button_list == 'order_online' || wp_grv_gmb_add_alert_post_button_list == 'shop' || wp_grv_gmb_add_alert_post_button_list == 'learn_more' || wp_grv_gmb_add_alert_post_button_list == 'sign_up'){
					if( add_alert_post_button_link === '' || add_alert_post_button_link === 'http://'){
						 jQuery( '#add_alert_post_button_link' ).css( 'border', 'solid 1px #f10707' );
						 return false;
						} 
						else {
						 jQuery( '#add_alert_post_button_link' ).css( 'border', 'none' );
						}
				}		
				
				
				var ajaxurl   = wp_grv_ajax_script.wp_grv_ajaxurl;
				jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
				jQuery( '#gmb_add_alert' ).css( 'opacity', '0.3' );
				var gmb_post_data = {
					'action'               			            :'wp_grv_gmb_alert_post_insert_settings', // function name
					'wp_grv_gmb_write_post'                     : wp_grv_gmb_write_post,
					'wp_grv_gmb_add_alert_post_button_list'	    : wp_grv_gmb_add_alert_post_button_list,
					'add_alert_post_button_link'                : add_alert_post_button_link,
					'wp_grv_select_location'					: wp_grv_select_location,
					'wp_grv_select_location_name'				: wp_grv_select_location_name,
				};
				jQuery.post(
					ajaxurl,
					gmb_post_data,
					function(response) {
						console.log(response);
						jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
						jQuery( '#gmb_add_alert' ).css( 'opacity', '1.0' );
						jQuery( window ).scrollTop( 0 );
					    jQuery( '.wp_grv_update_successfull_msg_wp8' ).css( 'display', 'block' );
						jQuery( '.wp_grv_update_successfull_msg_wp8' ).fadeOut( 10000 );
					}
				);
				
	});





   /*
	* ajax function for gmb new post insertion
	*
	*/
	jQuery( "#wp_grv_new_post_btn" ).on("click", function(){
				event.preventDefault();
				var gmb_add_new_post_image_url                             = jQuery( '#gmb_add_new_post_image_url' ).val();
				var wp_grv_gmb_write_post                                  = jQuery( '#wp_grv_gmb_write_post' ).val();
				var wp_grv_gmb_add_new_post_button_list                    = jQuery( '#wp_grv_gmb_add_new_post_button_list' ).val();
				var add_new_post_button_link                               = jQuery('#add_new_post_button_link').val();
				var add_new_post_phone                                     = jQuery('#wp_grv_gmb_phone_number').val();
				var wp_grv_select_location_name 						   = jQuery( '#wp_grv_gmb_add_new_post_select_location option:selected' ).text();
				var wp_grv_select_location 						   		   = jQuery( '#wp_grv_gmb_add_new_post_select_location' ).val();
				/* Validation */
				if (gmb_add_new_post_image_url === '') {
					jQuery( '#gmb_add_new_post_image' ).css( 'border', 'solid 1px #f10707' );
					 return false;
				} else {
					jQuery( '#gmb_add_new_post_image' ).css( 'border', 'none' );
				}
				if (wp_grv_gmb_write_post === '') {
					jQuery( '#wp_grv_gmb_write_post' ).css( 'border', 'solid 1px #f10707' );
					 return false;
				} else {
					jQuery( '#wp_grv_gmb_write_post' ).css( 'border', 'none' );
				}
				if(wp_grv_gmb_add_new_post_button_list == 'book' || wp_grv_gmb_add_new_post_button_list == 'order_online' || wp_grv_gmb_add_new_post_button_list == 'shop' || wp_grv_gmb_add_new_post_button_list == 'learn_more' || wp_grv_gmb_add_new_post_button_list == 'sign_up'){
					if( add_new_post_button_link === '' || add_new_post_button_link === 'http://'){
						 jQuery( '#add_new_post_button_link' ).css( 'border', 'solid 1px #f10707' );
						 return false;
						} 
						else {
						 jQuery( '#add_new_post_button_link' ).css( 'border', 'none' );
						}
				}		/*if(wp_grv_gmb_add_new_post_button_list != 'none'){
						if( add_new_post_button_link === '' || add_new_post_button_link === 'http://'){
						 jQuery( '#add_new_post_button_link' ).css( 'border', 'solid 1px #f10707' );
						 return false;
						} 
						else {
						 jQuery( '#add_new_post_button_link' ).css( 'border', 'none' );
						}
				}*/
				
				if (wp_grv_gmb_add_new === '' || gmb_add_new_post_image_url === '') {
					return false;
				} else {
					var ajaxurl   = wp_grv_ajax_script.wp_grv_ajaxurl;
					jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
					jQuery( '#gmb_add_new' ).css( 'opacity', '0.3' );
					var gmb_post_data = {
						'action'               			            :'wp_grv_gmb_new_post_insert_settings', // function name
						'gmb_add_new_post_image_url'                : gmb_add_new_post_image_url, //values
						'wp_grv_gmb_write_post'                     : wp_grv_gmb_write_post,
						'wp_grv_gmb_add_new_post_button_list'	    : wp_grv_gmb_add_new_post_button_list,
						'add_new_post_button_link'                  : add_new_post_button_link,
						'wp_grv_select_location'					: wp_grv_select_location,
						'wp_grv_select_location_name'				: wp_grv_select_location_name,
					};
					jQuery.post(
						ajaxurl,
						gmb_post_data,
						function(response) {
							console.log(response);
							jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
							jQuery( '#gmb_add_new' ).css( 'opacity', '1.0' );
							jQuery( window ).scrollTop( 0 );
						    jQuery( '.wp_grv_update_successfull_msg_wp8' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp8' ).fadeOut( 10000 );
						}
					);
				}
			}
		);
		/*
		* ajax function for gmb evnt post insertion
		*
		*/
jQuery( "#wp_grv_gmb_event_btn" ).on("click", function(){
				event.preventDefault();
				var gmb_add_event_image_url              = jQuery( '#gmb_add_event_image_url' ).val();
				var wp_grv_event_title                   = jQuery( '#wp_grv_event_title' ).val();
				var gmb_add_time                         = jQuery( '#gmb_add_time').prop('checked');
				var wp_grv_start_date                    = jQuery( '#wp_grv_start_date' ).val();
				var wp_grv_start_time                    = jQuery( '#wp_grv_start_time' ).val();
				var wp_grv_end_date                      = jQuery( '#wp_grv_end_date' ).val();
				var wp_grv_end_time                      = jQuery( '#wp_grv_end_time').val();
				var gmb_event_more_options               = jQuery( '#gmb_event_more_options' ).prop('checked');
				var wp_grv_gmb_event_details             = jQuery( '#wp_grv_gmb_event_details' ).val();
				var wp_grv_gmb_add_event_button_list     = jQuery( '#wp_grv_gmb_add_event_button_list' ).val();
				var add_event_button_link                = jQuery( '#add_event_button_link').val();
				var add_event_phone                      = jQuery( '#wp_grv_gmb_evnt_phone_number' ).val();
				var add_event_select_location_name 		 = jQuery( '#wp_grv_gmb_add_event_post_select_location option:selected' ).text();
				var add_event_select_location 			 = jQuery( '#wp_grv_gmb_add_event_post_select_location' ).val();
				/* Validation*/ 
				if (wp_grv_event_title === '') {
					jQuery( '#wp_grv_event_title' ).css( 'border', 'solid 1px #f10707' );
					return false;
				} else {
					jQuery( '#wp_grv_event_title' ).css( 'border', 'none' );
				}
				if (gmb_add_event_image_url === '') {
					jQuery( '#gmb_add_event_image' ).css( 'border', 'solid 1px #f10707' );
					return false;
				} else {
					jQuery( '#gmb_add_event_image' ).css( 'border', 'none' );
				}
				if (wp_grv_start_date === '') {
					jQuery( '#wp_grv_start_date' ).css( 'border', 'solid 1px #f10707' );
					return false;
				} else {
					jQuery( '#wp_grv_start_date' ).css( 'border', 'none' );
				}
				if(wp_grv_end_date === '') {
					jQuery( '#wp_grv_end_date' ).css( 'border', 'solid 1px #f10707' );
					return false;
				} else {
					jQuery( '#wp_grv_end_date' ).css( 'border', 'none' );
				}
			
               if(gmb_add_time == true){
					var wp_grv_time_pattern= /^((0([1-9])|([1-9])|(1[0-2])):([0-5])(0|5)\s(A|P|a|p)(M|m))+$/;
					if ( ! wp_grv_time_pattern.test( wp_grv_start_time ) || wp_grv_start_time === '') {
						jQuery( '#wp_grv_start_time' ).css( 'border', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_start_time' ).css( 'border', 'none' );
					}
					if ( ! wp_grv_time_pattern.test( wp_grv_end_time ) || wp_grv_start_time === '' ) {
						jQuery( '#wp_grv_end_time' ).css( 'border', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_end_time' ).css( 'border', 'none' );
				}
			}
			if(gmb_event_more_options === true){
				if(wp_grv_gmb_event_details === ''){
						jQuery( '#wp_grv_gmb_event_details' ).css( 'border', 'solid 1px #f10707' );
						return false;
                 } else {
						jQuery( '#wp_grv_gmb_event_details' ).css( 'border', 'none' );
					    }
						if(wp_grv_gmb_add_event_button_list == 'book' || wp_grv_gmb_add_event_button_list == 'order_online' || wp_grv_gmb_add_event_button_list == 'shop' || wp_grv_gmb_add_event_button_list == 'learn_more' || wp_grv_gmb_add_event_button_list == 'sign_up'){
							if( add_event_button_link === '' || add_event_button_link === 'http://'){
								 jQuery( '#add_event_button_link' ).css( 'border', 'solid 1px #f10707' );
								 return false;
							} 
							else {
						 		jQuery( '#add_event_button_link' ).css( 'border', 'none' );
							}
				       }
                       /*if(wp_grv_gmb_add_event_button_list != 'none'){
							if( add_event_button_link === '' || add_event_button_link === 'http://'){
								jQuery( '#add_event_button_link' ).css( 'border', 'solid 1px #f10707' );
								return false;
							} else {
									jQuery( '#add_event_button_link' ).css( 'border', 'none' );
								}
						}*/
				}
				if (wp_grv_event_title === '' || gmb_add_event_image_url === '') {
					return false;
				} else {

					var ajaxurl   = wp_grv_ajax_script.wp_grv_ajaxurl;
					jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
					jQuery( '#gmb_add_event' ).css( 'opacity', '0.3' );
					var gmb_event_data = {
						'action'               			    :'wp_grv_gmb_event_post_settings', // function name
						'gmb_add_event_image_url'           : gmb_add_event_image_url, //values
						'wp_grv_event_title'                : wp_grv_event_title,
						'gmb_add_time'	                    : gmb_add_time,
						'wp_grv_start_date'                 : wp_grv_start_date,
						'wp_grv_start_time'  	            : wp_grv_start_time,
						'wp_grv_end_date'                   : wp_grv_end_date,
						'wp_grv_end_time'                   : wp_grv_end_time,
						'gmb_event_more_options'            : gmb_event_more_options,
						'wp_grv_gmb_event_details'          : wp_grv_gmb_event_details,
						'wp_grv_gmb_add_event_button_list'  : wp_grv_gmb_add_event_button_list,
						'add_event_button_link'             : add_event_button_link,
						'add_event_select_location_name'	: add_event_select_location_name,
						'add_event_select_location'			: add_event_select_location,
					};
					jQuery.post(
						ajaxurl,
						gmb_event_data,
						function(response) {
							console.log(response);
							jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
							jQuery( '#gmb_add_event' ).css( 'opacity', '1.0' );
							jQuery( window ).scrollTop( 0 );
						    jQuery( '.wp_grv_update_successfull_msg_wp8' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp8' ).fadeOut( 10000 );
						}
					);
				}
			}
		);
		
 /**
  * ajax function for gmb business hours
  * @author Ek
  */

jQuery( "body" ).on("click","#wp_grv_gmb_gmb_business_hr_update",function(){
		  var wp_grv_gmb_business_selected_loc 	= jQuery(this).attr('current_loc');
  		  // Hours enable check box values
    	  var wp_grv_gmb_business_check_box_sun = jQuery('#wp_grv_gmb_business_hr_sun').prop('checked');
    	  var wp_grv_gmb_business_check_box_mon = jQuery('#wp_grv_gmb_business_hr_mon').prop('checked');
    	  var wp_grv_gmb_business_check_box_tue = jQuery('#wp_grv_gmb_business_hr_tue').prop('checked');
    	  var wp_grv_gmb_business_check_box_wed = jQuery('#wp_grv_gmb_business_hr_wed').prop('checked');
    	  var wp_grv_gmb_business_check_box_thu = jQuery('#wp_grv_gmb_business_hr_thu').prop('checked');
    	  var wp_grv_gmb_business_check_box_fri = jQuery('#wp_grv_gmb_business_hr_fri').prop('checked');
    	  var wp_grv_gmb_business_check_box_sat = jQuery('#wp_grv_gmb_business_hr_sat').prop('checked');
    	  //open and close timing
    	  //sunday
    	  var wp_grv_gmb_business_open_sun 		= jQuery("#wp_grv_gmb_business_hr_sun_open").val();
    	  var wp_grv_gmb_business_close_sun  	= jQuery("#wp_grv_gmb_business_hr_sun_close").val();
    	  //monday
    	  var wp_grv_gmb_business_open_mon 		= jQuery("#wp_grv_gmb_business_hr_mon_open").val();
    	  var wp_grv_gmb_business_close_mon  	= jQuery("#wp_grv_gmb_business_hr_mon_close").val();
    	  //tuesday
    	  var wp_grv_gmb_business_open_tue 		= jQuery("#wp_grv_gmb_business_hr_tue_open").val();
    	  var wp_grv_gmb_business_close_tue  	= jQuery("#wp_grv_gmb_business_hr_tue_close").val();
    	  //wednesday
    	  var wp_grv_gmb_business_open_wed		= jQuery("#wp_grv_gmb_business_hr_wed_open").val();
    	  var wp_grv_gmb_business_close_wed  	= jQuery("#wp_grv_gmb_business_hr_wed_close").val();
    	  //thursday
    	  var wp_grv_gmb_business_open_thu		= jQuery("#wp_grv_gmb_business_hr_thu_open").val();
    	  var wp_grv_gmb_business_close_thu  	= jQuery("#wp_grv_gmb_business_hr_thu_close").val();
    	  //friday
    	  var wp_grv_gmb_business_open_fri		= jQuery("#wp_grv_gmb_business_hr_fri_open").val();
    	  var wp_grv_gmb_business_close_fri  	= jQuery("#wp_grv_gmb_business_hr_fri_close").val();
    	  //saturday
    	  var wp_grv_gmb_business_open_sat		= jQuery("#wp_grv_gmb_business_hr_sat_open").val();
    	  var wp_grv_gmb_business_close_sat  	= jQuery("#wp_grv_gmb_business_hr_sat_close").val();
    	  // 24hours enable check box values
    	  var wp_grv_gmb_business_24hr_sun 		= jQuery('#wp_grv_gmb_business_24hr_sun').prop('checked');
    	  var wp_grv_gmb_business_24hr_mon 		= jQuery('#wp_grv_gmb_business_24hr_mon').prop('checked');
    	  var wp_grv_gmb_business_24hr_tue 		= jQuery('#wp_grv_gmb_business_24hr_tue').prop('checked');
    	  var wp_grv_gmb_business_24hr_wed 		= jQuery('#wp_grv_gmb_business_24hr_wed').prop('checked');
    	  var wp_grv_gmb_business_24hr_thu 		= jQuery('#wp_grv_gmb_business_24hr_thu').prop('checked');
    	  var wp_grv_gmb_business_24hr_fri 		= jQuery('#wp_grv_gmb_business_24hr_fri').prop('checked');
    	  var wp_grv_gmb_business_24hr_sat 		= jQuery('#wp_grv_gmb_business_24hr_sat').prop('checked');
    	  //validation
    	  if(wp_grv_gmb_business_check_box_sun == false){
    	  	wp_grv_gmb_business_24hr_sun = false;
    	  }
    	  if(wp_grv_gmb_business_check_box_mon == false){
    	  	wp_grv_gmb_business_24hr_mon = false;
    	  }
    	  if(wp_grv_gmb_business_check_box_tue == false){
    	  	wp_grv_gmb_business_24hr_tue = false;
    	  }
    	  if(wp_grv_gmb_business_check_box_wed == false){
    	  	wp_grv_gmb_business_24hr_wed = false;
    	  }
    	  if(wp_grv_gmb_business_check_box_thu == false){
    	  	wp_grv_gmb_business_24hr_thu = false;
    	  }
    	  if(wp_grv_gmb_business_check_box_fri == false){
    	  	wp_grv_gmb_business_24hr_fri = false;
    	  }
    	  if(wp_grv_gmb_business_check_box_sat == false){
    	  	wp_grv_gmb_business_24hr_sat = false;
    	  }
    	  //time validation
    	  var wp_grv_gmb_time_pattern = /^([0-9]|0[0-9]|2[0-9]|1[0-2]):([0-5][0-9])(|[' '])[a,p,A,P][m,M]$/;
    	  //sunday
    	  	if(wp_grv_gmb_business_check_box_sun == true){
    	  		if(wp_grv_gmb_business_24hr_sun == false){
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_open_sun )) {
						jQuery( '#wp_grv_gmb_business_hr_sun_open' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_sun_open' ).css( 'border-bottom', 'none' );
					}
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_close_sun ) || (wp_grv_gmb_business_open_sun == wp_grv_gmb_business_close_sun) ) {
						jQuery( '#wp_grv_gmb_business_hr_sun_close' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_sun_close' ).css( 'border-bottom', 'none' );
					}
				}	
			}else{
				jQuery( '#wp_grv_gmb_business_hr_sun_close' ).css( 'border-bottom', 'none' );
			}	  
		  //monday
		  	if(wp_grv_gmb_business_check_box_mon == true){
    	  		if(wp_grv_gmb_business_24hr_mon == false){
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_open_mon )) {
						jQuery( '#wp_grv_gmb_business_hr_mon_open' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_mon_open' ).css( 'border-bottom', 'none' );
					}
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_close_mon ) || (wp_grv_gmb_business_open_mon == wp_grv_gmb_business_close_mon) ) {
						jQuery( '#wp_grv_gmb_business_hr_mon_close' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_mon_close' ).css( 'border-bottom', 'none' );
					}
				}	
			}else{
				jQuery( '#wp_grv_gmb_business_hr_mon_close' ).css( 'border-bottom', 'none' );
			}	
		  //tuesday
		  	if(wp_grv_gmb_business_check_box_tue == true){
    	  		if(wp_grv_gmb_business_24hr_tue == false){
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_open_tue )) {
						jQuery( '#wp_grv_gmb_business_hr_tue_open' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_tue_open' ).css( 'border-bottom', 'none' );
					}
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_close_tue ) || (wp_grv_gmb_business_open_tue == wp_grv_gmb_business_close_tue) ) {
						jQuery( '#wp_grv_gmb_business_hr_tue_close' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_tue_close' ).css( 'border-bottom', 'none' );
					}
				}	
			}else{
				jQuery( '#wp_grv_gmb_business_hr_tue_close' ).css( 'border-bottom', 'none' );
			}	
		  //wednesday
		  	if(wp_grv_gmb_business_check_box_wed ==true){
    	  		if(wp_grv_gmb_business_24hr_wed == false){
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_open_wed )) {
						jQuery( '#wp_grv_gmb_business_hr_wed_open' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_wed_open' ).css( 'border-bottom', 'none' );
					}
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_close_wed ) || (wp_grv_gmb_business_open_wed == wp_grv_gmb_business_close_wed) ) {
						jQuery( '#wp_grv_gmb_business_hr_wed_close' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_wed_close' ).css( 'border-bottom', 'none' );
					}
				}	
			}else{
				jQuery( '#wp_grv_gmb_business_hr_wed_close' ).css( 'border-bottom', 'none' );
			}	
		  //thursday
			if(wp_grv_gmb_business_check_box_thu == true){
    	  		if(wp_grv_gmb_business_24hr_thu == false){
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_open_thu )) {
						jQuery( '#wp_grv_gmb_business_hr_thu_open' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_thu_open' ).css( 'border-bottom', 'none' );
					}
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_close_thu ) || (wp_grv_gmb_business_open_thu == wp_grv_gmb_business_close_thu) ) {
						jQuery( '#wp_grv_gmb_business_hr_thu_close' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_thu_close' ).css( 'border-bottom', 'none' );
					}
				}	
			}else{
				jQuery( '#wp_grv_gmb_business_hr_thu_close' ).css( 'border-bottom', 'none' );
			}	
		  //friday
		  	if(wp_grv_gmb_business_check_box_fri == true){
    	  		if(wp_grv_gmb_business_24hr_fri == false){
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_open_fri )) {
						jQuery( '#wp_grv_gmb_business_hr_fri_open' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_fri_open' ).css( 'border-bottom', 'none' );
					}
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_close_fri ) || (wp_grv_gmb_business_open_fri == wp_grv_gmb_business_close_fri) ) {
						jQuery( '#wp_grv_gmb_business_hr_fri_close' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_fri_close' ).css( 'border-bottom', 'none' );
					}
				}	
			}else{
				jQuery( '#wp_grv_gmb_business_hr_fri_close' ).css( 'border-bottom', 'none' );
			}	
		  //saturday
		  	if(wp_grv_gmb_business_check_box_sat == true){
    	  		if(wp_grv_gmb_business_24hr_sat == false){
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_open_sat )) {
						jQuery( '#wp_grv_gmb_business_hr_sat_open' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_sat_open' ).css( 'border-bottom', 'none' );
					}
					if ( ! wp_grv_gmb_time_pattern.test( wp_grv_gmb_business_close_sat ) || (wp_grv_gmb_business_open_sat == wp_grv_gmb_business_close_sat) ) {
						jQuery( '#wp_grv_gmb_business_hr_sat_close' ).css( 'border-bottom', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#wp_grv_gmb_business_hr_sat_close' ).css( 'border-bottom', 'none' );
					}
				}	
			}else{
				jQuery( '#wp_grv_gmb_business_hr_sat_close' ).css( 'border-bottom', 'none' );
			}	


    	  jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
		  jQuery( '#rv_gmb_tab' ).css( 'opacity', '0.3' );
          var ajaxurl          					= wp_grv_ajax_script.wp_grv_ajaxurl;
          var wpgrv_gmb_business_hours_data   	= {
            'action'							:'wp_grv_rv_gmb_business_hour_save_fun', //function name
            'wp_grv_gmb_business_check_box_sun' : wp_grv_gmb_business_check_box_sun,
            'wp_grv_gmb_business_check_box_mon' : wp_grv_gmb_business_check_box_mon,
            'wp_grv_gmb_business_check_box_tue' : wp_grv_gmb_business_check_box_tue,
            'wp_grv_gmb_business_check_box_wed' : wp_grv_gmb_business_check_box_wed,
            'wp_grv_gmb_business_check_box_thu' : wp_grv_gmb_business_check_box_thu,
            'wp_grv_gmb_business_check_box_fri' : wp_grv_gmb_business_check_box_fri,
            'wp_grv_gmb_business_check_box_sat' : wp_grv_gmb_business_check_box_sat,
            //open and close timing
            'wp_grv_gmb_business_open_sun' 		: wp_grv_gmb_business_open_sun,
            'wp_grv_gmb_business_close_sun' 	: wp_grv_gmb_business_close_sun,
            'wp_grv_gmb_business_open_mon' 		: wp_grv_gmb_business_open_mon,
            'wp_grv_gmb_business_close_mon' 	: wp_grv_gmb_business_close_mon,
            'wp_grv_gmb_business_open_tue' 		: wp_grv_gmb_business_open_tue,
            'wp_grv_gmb_business_close_tue' 	: wp_grv_gmb_business_close_tue,
            'wp_grv_gmb_business_open_wed' 		: wp_grv_gmb_business_open_wed,
            'wp_grv_gmb_business_close_wed' 	: wp_grv_gmb_business_close_wed,
            'wp_grv_gmb_business_open_thu' 		: wp_grv_gmb_business_open_thu,
            'wp_grv_gmb_business_close_thu' 	: wp_grv_gmb_business_close_thu,
            'wp_grv_gmb_business_open_fri' 		: wp_grv_gmb_business_open_fri,
            'wp_grv_gmb_business_close_fri' 	: wp_grv_gmb_business_close_fri,
            'wp_grv_gmb_business_open_sat' 		: wp_grv_gmb_business_open_sat,
            'wp_grv_gmb_business_close_sat' 	: wp_grv_gmb_business_close_sat,
            // 24hours enable check box values
            'wp_grv_gmb_business_24hr_sun' 		: wp_grv_gmb_business_24hr_sun,
            'wp_grv_gmb_business_24hr_mon' 		: wp_grv_gmb_business_24hr_mon,
            'wp_grv_gmb_business_24hr_tue' 		: wp_grv_gmb_business_24hr_tue,
            'wp_grv_gmb_business_24hr_wed' 		: wp_grv_gmb_business_24hr_wed,
            'wp_grv_gmb_business_24hr_thu' 		: wp_grv_gmb_business_24hr_thu,
            'wp_grv_gmb_business_24hr_fri' 		: wp_grv_gmb_business_24hr_fri,
            'wp_grv_gmb_business_24hr_sat' 		: wp_grv_gmb_business_24hr_sat,
            // selected location
            'wp_grv_gmb_business_selected_loc' 	: wp_grv_gmb_business_selected_loc,
          };
        jQuery.post(ajaxurl, wpgrv_gmb_business_hours_data, function(response) {
        	jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
			jQuery( '#rv_gmb_tab' ).css( 'opacity', '1.0' );
			jQuery( window ).scrollTop( 0 );
			jQuery( '.wp_grv_update_successfull_msg_wp7' ).css( 'display', 'block' );
			jQuery( '.wp_grv_update_successfull_msg_wp7' ).fadeOut( 10000 );
        });
        
  });
  /**
   * ajax function for gmb review replay.
   * @author Ek
   */
  	
	jQuery( "body" ).on("click","#wp_grv_google_review_replay_submit",function(){
	    event.preventDefault(); 
	    var wp_grv_cancel_confirm      = confirm("Are you sure?");
	    if(wp_grv_cancel_confirm === true){
	          var wp_grv_replay_val    = jQuery("#wp_grv_gmb_review_replay").val();
	          var wp_grv_single_rv_id  = jQuery("#wp_grv_single_rv_id").val();
	          jQuery('.wp_grv_goole_review_replay_section').css('opacity', '0.5');
	          var ajaxurl              = wp_grv_ajax_script.wp_grv_ajaxurl;
	          var rv_gmb_replay_data   = {
	            'action':'wp_grv_rv_gmb_replay_fun', //function name
	            'wp_grv_replay_val'    : wp_grv_replay_val,
	            'wp_grv_single_rv_id'  : wp_grv_single_rv_id,
	          };
	        jQuery.post(ajaxurl, rv_gmb_replay_data, function(response) {
	          //jQuery('#wp_grv_invited_users_tbl').html(response);
	          jQuery('.wp_grv_goole_review_replay_section').css('opacity', '1'); 
	          jQuery("#wp_grv_google_review_replay_submit").removeAttr("style");
	          jQuery('#wp_grv_google_review_replay_submit').prop('disabled', true);
	        });
	    }    
	});
   /**
	* ajax function for gmb fetch location selection box click.
	* @author Ek
	*/
		
	jQuery( "body" ).on("change",".wp_grv_location_select",function(){
				var wp_grv_select_location      		= jQuery( this ).val();
				var wp_grv_select_location_name 		= jQuery( this ).children("option:selected").text();
				var wp_grv_gmb_location_confirm = confirm( "Are you sure?" );
				if (wp_grv_gmb_location_confirm === true) {
					var isContains = jQuery('#wp_grv_selected_locations_section label').text().indexOf(wp_grv_select_location_name) > -1;
					if(isContains === false){
						jQuery('<label class="wp_grv_selected_location_box">'+wp_grv_select_location_name+'<span class="wp_grv_selected_location_remove" location="'+wp_grv_select_location+'"><i class="fa fa-times"></i></span></label>').insertAfter('#wp_grv_selected_locations_values');
					}else{
						alert('Location was already added.');
						return false;
					}
					jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
					jQuery( '#rv_gmb_tab' ).css( 'opacity', '0.3' );
					var ajaxurl                     = wp_grv_ajax_script.wp_grv_ajaxurl;
					var wp_grv_select_location_data = {
						'action'						:'wp_grv_select_location_fetch_fun', // function name
						'wp_grv_select_location'        : wp_grv_select_location,
						'wp_grv_select_location_name'   : wp_grv_select_location_name,
					};
					jQuery.post(
						ajaxurl,
						wp_grv_select_location_data,
						function(response) {
							jQuery('.wp_grv_gmb_business_hr_container').remove();
							jQuery(response).insertAfter('#wp_grv_gmb_form_container');
							jQuery( '#wp_grv_loader, .wp_grv_location_select_notice' ).css( 'display', 'none' );
							jQuery( '#rv_gmb_tab' ).css( 'opacity', '1.0' );
							//location.reload();
						}
					);
				} else {
					return false;
				}
			}
		);
		/**
		* ajax function for gmb fetch locations delete box click.
		* @author Ek
		*/
		jQuery( "body" ).on("click","span.wp_grv_selected_location_remove",function(){
			var deleted_location 			= jQuery(this).attr('location');
			jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
			jQuery( '#rv_gmb_tab' ).css( 'opacity', '0.3' );
			jQuery( this ).parent().remove();
			var ajaxurl                     = wp_grv_ajax_script.wp_grv_ajaxurl;
			var wp_grv_select_location_data = {
				'action'			:'wp_grv_select_location_delete_fun', // function name
				'deleted_location'  : deleted_location,
			};
			jQuery.post(
				ajaxurl,
				wp_grv_select_location_data,
				function(response) {
					jQuery('.wp_grv_gmb_business_hr_container').remove();
					jQuery(response).insertAfter('#wp_grv_gmb_form_container');
					jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
					jQuery( '#rv_gmb_tab' ).css( 'opacity', '1.0' );
				}
			);
		});	

	   /**
		* ajax function for gmb fetch location selection.
		* @author Ek
		*/
		var usr_acess_token_location_selection = jQuery( '#wp_grv_acess_token_for_location_selection' ).val();
		if (usr_acess_token_location_selection != undefined) {
						jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
						jQuery( '#rv_gmb_tab' ).css( 'opacity', '0.3' );
						var ajaxurl                     	= wp_grv_ajax_script.wp_grv_ajaxurl;
						var wp_grv_gmb_location_fetch_data 	= {
							'action'			:'wp_grv_gmb_location_fetch', // function name
						};
						jQuery.post(
							ajaxurl,
							wp_grv_gmb_location_fetch_data,
							function(response) {
								jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
								jQuery( '#rv_gmb_tab' ).css( 'opacity', '1.0' );
								jQuery( '#wp_grv_gmb_location_refresh_td' ).html( response );
							}
						);
						/*var auth_code            = 'Bearer ' + usr_acess_token_location_selection;
						var settings = {
							"async": true,
							"crossDomain": true,
							"url": "https://mybusiness.googleapis.com/v4/accounts/",
							"method": "GET",
							"headers": {
								"Authorization": auth_code
							}
						}
						jQuery.ajax( settings ).done(
							function (response) {
								var acc_gen_details = response['accounts']['0']
								var name            = acc_gen_details['name'];
								var url             = 'https://mybusiness.googleapis.com/v4/' + name + '/locations';
								var settings2       = {
									"async": true,
									"crossDomain": true,
									"url": url,
									"method": "GET",
									"headers": {
										"Authorization": auth_code
									}
								}
								jQuery.ajax( settings2 ).done(
									function (response) {
										jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
										jQuery( '#rv_gmb_tab' ).css( 'opacity', '0.3' );
										var ajaxurl                        = wp_grv_ajax_script.wp_grv_ajaxurl;
										var wp_grv_gmb_location_fetch_data = {
											'action':'wp_grv_gmb_location_fetch', // function name
											'wp_grv_gmb_fetch_locations' : response['locations'],
										};
										jQuery.post(
											ajaxurl,
											wp_grv_gmb_location_fetch_data,
											function(response) {
												jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
												jQuery( '#rv_gmb_tab' ).css( 'opacity', '1.0' );
												jQuery( '#wp_grv_gmb_location_refresh_td' ).html( response );
											}
										);
									}
								);
							}
						);*/
		}
   /**
	* ajax function for gmb location selection for business hours.
	* @author Ek
	*/
		
	jQuery( "body" ).on("change","#wpgrv_multiple_location_business_hours",function(){
				var wp_grv_select_location      		= jQuery( this ).val();
				var wp_grv_select_location_name 		= jQuery( '#wpgrv_multiple_location_business_hours option:selected' ).text();
				jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
				jQuery( '#rv_gmb_tab' ).css( 'opacity', '0.3' );
				var ajaxurl                     = wp_grv_ajax_script.wp_grv_ajaxurl;
				var wp_grv_select_location_data = {
					'action'						:'wp_grv_select_location_for_business_hours', // function name
					'wp_grv_select_location'        : wp_grv_select_location,
					'wp_grv_select_location_name'   : wp_grv_select_location_name,
				};
				jQuery.post(
					ajaxurl,
					wp_grv_select_location_data,
					function(response) {
						jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
						jQuery( '#rv_gmb_tab' ).css( 'opacity', '1.0' );
						jQuery('#wp_grv_gmb_gmb_business_hr_update').attr('current_loc',wp_grv_select_location);
						jQuery( '.wp_grv_gmb_business_hr_tbl' ).html( response );
					}
				);
			}
		);
	   /**
		* ajax function for gmb fetch reviews insert to table.
		*
		*/
		var usr_acess_token = jQuery( '#wp_grv_acess_token_from_admin' ).val();
		var location_path   = jQuery( '#wp_grv_location_path' ).val();
		if (usr_acess_token != undefined && location_path != undefined && location_path != 'null') {	
			var auth_code = 'Bearer ' + usr_acess_token;
			var url       = 'https://mybusiness.googleapis.com/v4/' + location_path + '/reviews';
			var settings3 = {
				"async": true,
				"crossDomain": true,
				"url": url,
				"method": "GET",
				"headers": {
					"Authorization": auth_code
				},
				error: function(jqXHR, textStatus, errorThrown) {
                		var ajaxurl               	= wp_grv_ajax_script.wp_grv_ajaxurl;
						var wp_grv_gmb_error_reset 	= {
							'action'	:'wp_grv_gmb_ajax_login_reset_fun', // function name
						};
						jQuery.post(
							ajaxurl,
							wp_grv_gmb_error_reset,
							function(response) {
								location.reload();
							}
						);	
                }//error checking ends.
			}	
			jQuery.ajax( settings3 ).done(
				function (response) {
						
						var wp_grv_num_reviews = Object.keys( response['reviews'] ).length;
						//console.log( response['reviews'] );
						if(response['reviews'] == ''){
							console.log('login error');
						}
						if(response['reviews'] == undefined){
							console.log('login error undefined');
						}
						var ajaxurl               = wp_grv_ajax_script.wp_grv_ajaxurl;
						var wp_grv_gmb_fetch_data = {
							'action':'wp_grv_gmb_fetch_rv_to_db_fun', // function name
							'wp_grv_gmb_fetch_reviews' : response,
							'wp_grv_num_reviews'       : wp_grv_num_reviews,
							'location_path'			   : location_path,
						};
						jQuery.post(
							ajaxurl,
							wp_grv_gmb_fetch_data,
							function(response) {
								if (response == 'false') {
									console.log( 'no review updates' );
								} else {
									jQuery( '#wp_grv_rv_ajax_reload' ).html( response );
									jQuery( '#wp_grv_all_rv_tbl' ).DataTable(
										{
											"pagingType": "full_numbers"
										}
									);
									jQuery( '.rv_select_check_box' ).click(
										function () {
											jQuery( '.rv_all_sel' ).prop( 'checked', this.checked );
										}
									);
								}
							}
						);
				}
			);
		}
		/*
		* ajax function for individual invitation cancel from invitation page
		*
		*/
	
jQuery( "body" ).on("click","#wp_grv_rv_invitaion_cancel",function(){
				event.preventDefault();
				var wp_grv_cancel_confirm = confirm( "Are you sure?" );
				if (wp_grv_cancel_confirm === true) {
					jQuery( '#wp_grv_invited_users_tbl' ).css( 'opacity', '0.5' );
					var wp_grv_cancel_id          = jQuery( this ).attr( "data_id" );
					var ajaxurl                   = wp_grv_ajax_script.wp_grv_ajaxurl;
					var rv_invitation_cancel_data = {
						'action':'wp_grv_rv_invitation_cancel_fun', // function name
						'wp_grv_cancel_id' : wp_grv_cancel_id,
					};
					jQuery.post(
						ajaxurl,
						rv_invitation_cancel_data,
						function(response) {
							jQuery( '#wp_grv_invited_users_tbl' ).html( response );
							jQuery( '#wp_grv_invited_users_tbl' ).css( 'opacity', '1' );
						}
					);
				}
			}
		);
		/*
		* ajax function for check review read or not
		*
		*/
		
jQuery( "body" ).on("click","#wp_grv_edit_count",function(){
				var wp_grv_read_id   = jQuery( this ).attr( "data_edit_id" );
				var ajaxurl          = wp_grv_ajax_script.wp_grv_ajaxurl;
				var wp_grv_read_data = {
					'action':'wp_grv_review_read_count', // function name
					'wp_grv_read_id' : wp_grv_read_id,
				};
				jQuery.post(
					ajaxurl,
					wp_grv_read_data,
					function(response) {

					}
				);
			}
		);
		/*
		* ajax function for individual category delete from category page
		*
		*/
		
jQuery( "body" ).on("click","#wp_grv_rv_cat_delete",function(){
				event.preventDefault();
				var wp_grv_delete_confirm = confirm( "Are you sure?" );
				if (wp_grv_delete_confirm === true) {
					  jQuery( '#wp_grv_add_cat_list_tbl' ).css( 'opacity', '0.5' );
					  var wp_grv_delete_id   = jQuery( this ).attr( "data_id" );
					  var ajaxurl            = wp_grv_ajax_script.wp_grv_ajaxurl;
					  var rv_cat_delete_data = {
							'action':'wp_grv_rv_category_delete_fun', // function name
							'wp_grv_delete_id' : wp_grv_delete_id,
					};
					jQuery.post(
						ajaxurl,
						rv_cat_delete_data,
						function(response) {
							jQuery( '#wp_grv_add_cat_list_tbl' ).html( response );
							jQuery( '#wp_grv_add_cat_list_tbl' ).css( 'opacity', '1' );
							jQuery( window ).scrollTop( 0 );
							jQuery( '.wp_grv_update_successfull_msg_wp_cat_delete' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp_cat_delete' ).fadeOut( 10000 );
						}
					);
				}
			}
		);

		/*
		* ajax function for update single review
		*
		*/
		jQuery( "#wp_grv_update" ).click(
			function(){
				var wp_grv_single_rv_id = jQuery( '#wp_grv_single_rv_id' ).val();
				var wp_grv_add_name     = jQuery( '#wp_grv_add_name' ).val();
				var wp_grv_add_email    = jQuery( "#wp_grv_add_email" ).val();
				var wp_grv_add_title    = jQuery( '#wp_grv_add_title' ).val();
				var wp_grv_add_content  = jQuery( '#wp_grv_add_content' ).val();
				var wp_grv_add_usr_img  = jQuery( '#rv_add_usr_img' ).val();
				var wp_grv_done_on      = jQuery( '#wp_grv_done_on' ).val();
				var wp_grv_approval_sel = jQuery( ".rv_approval_sel" ).prop( "checked" );
				var wp_grv_add_category = jQuery( "#wp_grv_add_category" ).val();
				// duplicate block data.
				var wp_grv_dup_details_check = jQuery( "#wp_grv_add_dup_name_check" ).prop( 'checked' );
				if (wp_grv_dup_details_check == true) {
					var wp_grv_dup_name   = jQuery( '#wp_grv_dup_name' ).val();
					var wp_grv_dup_reason = jQuery( '#wp_grv_dup_reason' ).val();
				} else {
					var wp_grv_dup_name   = '';
					var wp_grv_dup_reason = '';
				}
				//gmb review replay
      			var wp_grv_gmb_review_replay = jQuery("#wp_grv_gmb_review_replay").val();
				// for star rating.
				var wp_grv_st5 = jQuery( "#rv_st5" ).prop( "checked" );
				var wp_grv_st4 = jQuery( "#rv_st4" ).prop( "checked" );
				var wp_grv_st3 = jQuery( "#rv_st3" ).prop( "checked" );
				var wp_grv_st2 = jQuery( "#rv_st2" ).prop( "checked" );
				var wp_grv_st1 = jQuery( "#rv_st1" ).prop( "checked" );
				if (wp_grv_st5 === true) {
					var wp_grv_raiting = jQuery( '#rv_st5' ).val();
				} else if (wp_grv_st4 === true) {
					var wp_grv_raiting = jQuery( '#rv_st4' ).val();
				} else if (wp_grv_st3 === true) {
					var wp_grv_raiting = jQuery( '#rv_st3' ).val();
				} else if (wp_grv_st2 === true) {
					var wp_grv_raiting = jQuery( '#rv_st2' ).val();
				} else if (wp_grv_st1 === true) {
					var wp_grv_raiting = jQuery( '#rv_st1' ).val();
				} else {
					var wp_grv_raiting = 'not_rated';
				}
				var ajaxurl                = wp_grv_ajax_script.wp_grv_ajaxurl;
				var rv_update_details_data = {
					'action'                    : 'wp_grv_single_rv_update', // function name
					'wp_grv_single_rv_id'       : wp_grv_single_rv_id,
					'wp_grv_add_name'           : wp_grv_add_name,
					'wp_grv_add_email'          : wp_grv_add_email,
					'wp_grv_add_title'          : wp_grv_add_title,
					'wp_grv_add_content'        : wp_grv_add_content,
					'wp_grv_add_usr_img'        : wp_grv_add_usr_img,
					'wp_grv_done_on'            : wp_grv_done_on,
					'wp_grv_approval_sel'       : wp_grv_approval_sel,
					'wp_grv_add_category'       : wp_grv_add_category,
					'wp_grv_raiting'            : wp_grv_raiting,
					'wp_grv_dup_details_check'  : wp_grv_dup_details_check,
					'wp_grv_dup_name'           : wp_grv_dup_name,
					'wp_grv_dup_reason'         : wp_grv_dup_reason,
					'wp_grv_gmb_review_replay'  : wp_grv_gmb_review_replay,
				};
				jQuery.post(
					ajaxurl,
					rv_update_details_data,
					function(response) {
						if (wp_grv_dup_details_check == true) {
							jQuery( '#wp_grv_duplicate_data_block' ).css( 'display','block' );
						}
						jQuery( '.wp_grv_update_successfull_msg_wp_add_rv_update' ).css( 'display', 'block' );
						jQuery( '.wp_grv_update_successfull_msg_wp_add_rv_update' ).fadeOut( 10000 );
						jQuery( window ).scrollTop( 0 );
					}
				);
			}
		);

		/*
		* ajax function for bulk action in all review section
		*
		*/
		
jQuery( "body" ).on("click",".wp_grv_rv_action_submit",function(){
				var wp_grv_rv_bulk_action = jQuery( '.wp_grv_rv_bulk_actions' ).val();
				if ( wp_grv_rv_bulk_action === 'delete') {
					var wp_grv_delete_confirm = confirm( "Are you sure?" );
					if (wp_grv_delete_confirm === true) {
						// jQuery('.wp_grv_loader').css('display', 'block');
						jQuery( '.rv_all_sel' ).each(
							function() {
								var wp_grv_rv_sel     = jQuery( this ).prop( "checked" );
								var wp_grv_rv_sel_val = jQuery( this ).val();
								// alert(wp_grv_rv_sel);
								if ( wp_grv_rv_sel === true && wp_grv_rv_sel_val != 'on' ) { // checkbox condition checking.on value is default value of all checking check box.
									jQuery( '.wp_grv_delete_loader_icon' ).css( 'display', 'block' );// loader icon visible
									var ajaxurl        = wp_grv_ajax_script.wp_grv_ajaxurl;
									var rv_delete_data = {
										'action':'wp_grv_rv_delete_fun', // function name
										'wp_grv_delete_id' : wp_grv_rv_sel_val,
									};
									jQuery.post(
										ajaxurl,
										rv_delete_data,
										function(response) {
											// jQuery('.wp_grv_loader').css('display', 'none');
											jQuery( '.wp_grv_delete_loader_icon' ).css( 'display', 'none' );// loader icon hide.
											jQuery( '.wp_grv_delete_loader_success' ).css( 'display', 'block' );// success icon visible.
											setTimeout( function() { jQuery( '.wp_grv_delete_loader_success' ).css( 'display', 'none' ); }, 1000 );// loader icon hide.
											jQuery( '#wp_grv_rv_ajax_reload' ).html( response );
											jQuery( '#wp_grv_all_rv_tbl' ).DataTable(
												{
													"pagingType": "full_numbers"
												}
											);
											jQuery( '.rv_select_check_box' ).click(
												function () {
													jQuery( '.rv_all_sel' ).prop( 'checked', this.checked );
												}
											);
										}
									);
								}
							}
						);
					}//wp_grv_delete_confirm if ends.
				} else {
					alert( 'Please select Bulk action.' );
				}
			}
		);
		// footer bulk action.
		
jQuery( "body" ).on("click",".wp_grv_rv_action_submit_footer",function(){
				var wp_grv_rv_bulk_action = jQuery( '.wp_grv_rv_bulk_actions_footer' ).val();
				if ( wp_grv_rv_bulk_action === 'delete') {
					var wp_grv_delete_confirm = confirm( "Are you sure?" );
					if (wp_grv_delete_confirm === true) {
						// jQuery('.wp_grv_loader').css('display', 'block');
						jQuery( '.rv_all_sel' ).each(
							function() {
								var wp_grv_rv_sel     = jQuery( this ).prop( "checked" );
								var wp_grv_rv_sel_val = jQuery( this ).val();
								// alert(wp_grv_rv_sel);
								if ( wp_grv_rv_sel === true && wp_grv_rv_sel_val != 'on' ) { // checkbox condition checking.on value is default value of all checking check box.
									jQuery( '.wp_grv_delete_loader_icon' ).css( 'display', 'block' );// loader icon visible
									var ajaxurl        = wp_grv_ajax_script.wp_grv_ajaxurl;
									var rv_delete_data = {
										'action':'wp_grv_rv_delete_fun', // function name
										'wp_grv_delete_id' : wp_grv_rv_sel_val,
									};
									jQuery.post(
										ajaxurl,
										rv_delete_data,
										function(response) {
											// jQuery('.wp_grv_loader').css('display', 'none');
											jQuery( '.wp_grv_delete_loader_icon' ).css( 'display', 'none' );// loader icon hide.
											jQuery( '.wp_grv_delete_loader_success' ).css( 'display', 'block' );// success icon visible.
											setTimeout( function() { jQuery( '.wp_grv_delete_loader_success' ).css( 'display', 'none' ); }, 1000 );// loader icon hide.
											jQuery( '#wp_grv_rv_ajax_reload' ).html( response );
											jQuery( '#wp_grv_all_rv_tbl' ).DataTable(
												{
													"pagingType": "full_numbers"
												}
											);
											jQuery( '.rv_select_check_box' ).click(
												function () {
													jQuery( '.rv_all_sel' ).prop( 'checked', this.checked );
												}
											);
										}
									);
								}
							}
						);
					}// wp_grv_delete_confirm if ends.
				} else {
					alert( 'Please select Bulk action.' );
				}
			}
		);
		/*
		* ajax function for individual review delete in all review section
		*
		*/
	
jQuery( "body" ).on("click","#wp_grv_rv_delete",function(){
				event.preventDefault();
				var wp_grv_delete_confirm = confirm( "Are you sure?" );
				if (wp_grv_delete_confirm === true) {
					  jQuery( '.wp_grv_delete_loader_icon' ).css( 'display', 'block' );// loader icon visible
					  var wp_grv_delete_id = jQuery( this ).attr( "data_id" );
					  var ajaxurl          = wp_grv_ajax_script.wp_grv_ajaxurl;
					var rv_delete_data     = {
						'action':'wp_grv_rv_delete_fun', // function name
						'wp_grv_delete_id' : wp_grv_delete_id,
					};
					jQuery.post(
						ajaxurl,
						rv_delete_data,
						function(response) {
							jQuery( '.wp_grv_delete_loader_icon' ).css( 'display', 'none' );// loader icon hide.
							jQuery( '.wp_grv_delete_loader_success' ).css( 'display', 'block' );// success icon visible.
							setTimeout( function() { jQuery( '.wp_grv_delete_loader_success' ).css( 'display', 'none' ); }, 1000 );// loader icon hide.
							jQuery( '#wp_grv_rv_ajax_reload' ).html( response );
							jQuery( '#wp_grv_all_rv_tbl' ).DataTable(
								{
									"pagingType": "full_numbers"
								}
							);
						}
					);
				}
			}
		);
		/*
		* ajax function for review enable in all review section
		*
		*/
		
jQuery( "body" ).on("click",".rv_approval_sel",function(){
				var wp_grv_approve_id = jQuery( this ).val();
				var wp_grv_approve    = jQuery( this ).prop( "checked" );
				var ajaxurl           = wp_grv_ajax_script.wp_grv_ajaxurl;
				var rv_approval_data  = {
					'action':'wp_grv_rv_approval_update_insert_settings', // function name
					'wp_grv_approve_id' : wp_grv_approve_id,
					'wp_grv_approve'    : wp_grv_approve,
				};
				jQuery.post(
					ajaxurl,
					rv_approval_data,
					function(response) {
						jQuery( '#wp_grv_rv_enable_count' ).text( response );
					}
				);
			}
		);

		/*
		* ajax function for api insertion
		*
		*/
		jQuery( "#rv_api_sub" ).click(
			function(){
				event.preventDefault();
				var wp_grv_api = jQuery( '#rv_api_key' ).val();
				jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
				jQuery( '#rv_licence_tab' ).css( 'opacity', '0.3' );
				var ajaxurl  = wp_grv_ajax_script.wp_grv_ajaxurl;
				var api_data = {
					'action':'wp_grv_api_insert_settings', // function name
					'wp_grv_api' : wp_grv_api,
				};
				jQuery.post(
					ajaxurl,
					api_data,
					function(response) {
						jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
						jQuery( '#rv_licence_tab' ).css( 'opacity', '1.0' );
						jQuery( window ).scrollTop( 0 );
						jQuery( '.wp_grv_update_successfull_msg_wp7' ).css( 'display', 'block' );
						jQuery( '.wp_grv_update_successfull_msg_wp7' ).fadeOut( 10000 );
					}
				);
			}
		);
		/*
		* ajax function for social_proofing insertion
		*
		*/
		jQuery( "#rv_social_proofing_sub" ).click(
			function(){
				event.preventDefault();
				var wp_grv_sc_pr_rating                       = jQuery( '#rv_rating_sel' ).val();
				var wp_grv_sc_pr_cat                          = jQuery( '#rv_category_sel' ).val();
				var wp_grv_sc_pr_tm_invl_sec                  = jQuery( '#rv_social_proofing_time_invl' ).val();
				var wp_grv_sc_pr_tm_invl                      = wp_grv_sc_pr_tm_invl_sec * 1000;
				var wp_grv_sc_pr_not_stay_sec                  = jQuery( '#rv_social_proofing_notification_stay' ).val();
				var wp_grv_sc_pr_not_stay                      = wp_grv_sc_pr_not_stay_sec * 1000;
				var wp_grv_social_proofing_bg_color           = jQuery( '#wp_grv_social_proofing_bg_color' ).val();
				var wp_grv_social_proofing_text_size_name     = jQuery( '#wp_grv_social_proofing_text_size_name' ).val();
				var wp_grv_social_proofing_text_size_contents = jQuery( '#wp_grv_social_proofing_text_size_contents' ).val();
				var wp_grv_social_proofing_position_sel       = jQuery( '#rv_position_sel' ).val();
				var wp_grv_mobile_enable                      = jQuery( "#wp_grv_mobile_enable" ).prop( "checked" );
				var wp_grv_sp_title_enable                    = jQuery( "#wp_grv_sp_title_enable" ).prop( "checked" );
				var wp_grv_sp_powered_by_enable               = jQuery( "#wp_grv_sp_powered_by_enable" ).prop( "checked" );
				var wp_grv_sp_character_limit                 = jQuery( '#wp_grv_social_proofing_character_limit' ).val();
				var wp_grv_sp_img_border_radius               = jQuery( '#wp_grv_social_proofing_border_radius' ).val();
				var wp_grv_sp_img_size                        = jQuery( '#wp_grv_social_proofing_image_size' ).val();
				var wp_grv_sp_font_color_name                 = jQuery( '#wp_grv_social_proofing_font_color_name' ).val();
				var wp_grv_sp_font_color_review               = jQuery( '#wp_grv_social_proofing_font_color_review' ).val();
				/* Validation */
				if (wp_grv_sc_pr_rating === '') {
					jQuery( '#rv_rating_sel' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_rating_sel' ).css( 'border', 'none' );
				}
				if (wp_grv_sc_pr_cat === '') {
					jQuery( '#rv_category_sel' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_category_sel' ).css( 'border', 'none' );
				}
				if (wp_grv_sc_pr_tm_invl === '') {
					jQuery( '#rv_social_proofing_time_invl' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_social_proofing_time_invl' ).css( 'border', 'none' );
				}
				if (wp_grv_sc_pr_rating === '' || wp_grv_sc_pr_cat === '' || wp_grv_sc_pr_tm_invl === '') {
					return false;
				} else {
					jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
					jQuery( '#rv_social_proofing_tab' ).css( 'opacity', '0.3' );
					var ajaxurl   = wp_grv_ajax_script.wp_grv_ajaxurl;
					var sc_p_data = {
						'action'               			    :'wp_grv_social_proofing_insert_settings', // function name
						'wp_grv_sc_pr_rating'                       : wp_grv_sc_pr_rating, //values
						'wp_grv_sc_pr_cat'                          : wp_grv_sc_pr_cat,
						'wp_grv_sc_pr_tm_invl'                      : wp_grv_sc_pr_tm_invl,
						'wp_grv_sc_pr_not_stay'                     : wp_grv_sc_pr_not_stay,
						'wp_grv_social_proofing_bg_color'  	        : wp_grv_social_proofing_bg_color,
						'wp_grv_social_proofing_text_size_name'     : wp_grv_social_proofing_text_size_name,
						'wp_grv_social_proofing_text_size_contents' : wp_grv_social_proofing_text_size_contents,
						'wp_grv_social_proofing_position_sel'       : wp_grv_social_proofing_position_sel,
						'wp_grv_mobile_enable'                      : wp_grv_mobile_enable,
					    'wp_grv_sp_title_enable'                    : wp_grv_sp_title_enable,
						'wp_grv_sp_powered_by_enable'               : wp_grv_sp_powered_by_enable,
                        'wp_grv_sp_character_limit'                 : wp_grv_sp_character_limit,
						'wp_grv_sp_img_border_radius'               : wp_grv_sp_img_border_radius,
						'wp_grv_sp_img_size'                        : wp_grv_sp_img_size,
						'wp_grv_sp_font_color_name'                 : wp_grv_sp_font_color_name,
						'wp_grv_sp_font_color_review'               : wp_grv_sp_font_color_review
					};
					jQuery.post(
						ajaxurl,
						sc_p_data,
						function(response) {
							jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
							jQuery( '#rv_social_proofing_tab' ).css( 'opacity', '1.0' );
							jQuery( window ).scrollTop( 0 );
							jQuery( '.wp_grv_update_successfull_msg_wp6' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp6' ).fadeOut( 10000 );
							jQuery( '.wp_grv_tab_first_sub .wp_grv_gmb_tab_a').trigger('click');
						}
					);
				}//else ends.
			}
		);
		/*
		* ajax function for gmp insertion
		*
		*/
		jQuery( "#rv_gmb_sub" ).click(
			function(){
				event.preventDefault();
				var wp_grv_gmp_key       = jQuery( '#rv_gmb_key' ).val();
				var wp_grv_gmp_id        = jQuery( '#rv_gmp_id' ).val();
				var wp_grv_gmp_time_invl = jQuery( '#rv_time_invl' ).val();
				jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
				jQuery( '#rv_gmb_tab' ).css( 'opacity', '0.3' );
				var ajaxurl  = wp_grv_ajax_script.wp_grv_ajaxurl;
				var gmp_data = {
					'action'         : 'wp_grv_gmp_insert_settings', // function name
					'wp_grv_gmp_key' : wp_grv_gmp_key,
					'wp_grv_gmp_id'  : wp_grv_gmp_id,
					'wp_grv_gmp_time_invl'     : wp_grv_gmp_time_invl,
				};
				jQuery.post(
					ajaxurl,
					gmp_data,
					function(response) {
						jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
						jQuery( '#rv_gmb_tab' ).css( 'opacity', '1.0' );
						window.location.href = response;// redirect for gmb login.
					}
				);
			}
		);
		// reconnect function
		jQuery( "#wp_grv_gmb_reconnect" ).click(
			function(){
				event.preventDefault();
				var wp_grv_gmp_key       = jQuery( '#rv_gmb_key' ).val();
				var wp_grv_gmp_id        = jQuery( '#rv_gmp_id' ).val();
				var wp_grv_gmp_time_invl = jQuery( '#rv_time_invl' ).val();
				jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
				jQuery( '#rv_gmb_tab' ).css( 'opacity', '0.3' );
				var ajaxurl  = wp_grv_ajax_script.wp_grv_ajaxurl;
				var gmp_data = {
					'action'         : 'wp_grv_gmp_reconnect_fun', // function name
					'wp_grv_gmp_key' : wp_grv_gmp_key,
					'wp_grv_gmp_id'  : wp_grv_gmp_id,
					'wp_grv_gmp_time_invl'     : wp_grv_gmp_time_invl,
				};
				jQuery.post(
					ajaxurl,
					gmp_data,
					function(response) {
						jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
						jQuery( '#rv_gmb_tab' ).css( 'opacity', '1.0' );
						window.location.href = response;// redirect for reconnect gmb login.
					}
				);
			}
		);

		/*
		* ajax function for invite settings insertion
		*
		*/
		jQuery( "#rv_invitation_sub" ).click(
			function(){
				event.preventDefault();
				var wp_grv_invite_from          = jQuery( '#rv_invite_from' ).val();
				var wp_grv_invite_days          = jQuery( '#rv_invite_days' ).val();
				var wp_grv_invite_email_content = jQuery( '#rv_invite_email_content' ).val();
				var wp_grv_invite_link          = jQuery( '#rv_invite_link' ).val();
				var wp_grv_invitation_repeat    = jQuery( '#rv_invitation_repeat' ).val();
				/* Validation */
				var wp_grv_email_pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if ( ! wp_grv_email_pattern.test( wp_grv_invite_from )) {
					jQuery( '#rv_invite_from' ).css( 'border', 'solid 1px #f10707' );
					var wp_grv_invt_email_stat = '0';
				} else {
					jQuery( '#rv_invite_from' ).css( 'border', 'none' );
				}
				if (wp_grv_invite_days === '' || wp_grv_invite_days <= 0) {
					jQuery( '#rv_invite_days' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_invite_days' ).css( 'border', 'none' );
				}
				if (wp_grv_invite_email_content === '') {
					jQuery( '#rv_invite_email_content' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_invite_email_content' ).css( 'border', 'none' );
				}
				if (wp_grv_invite_link === '') {
					jQuery( '#rv_invite_link' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_invite_link' ).css( 'border', 'none' );
				}
				if (wp_grv_invitation_repeat === '' || wp_grv_invitation_repeat <= 0) {
					jQuery( '#rv_invitation_repeat' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_invitation_repeat' ).css( 'border', 'none' );
				}
				if (wp_grv_invite_from === '' || wp_grv_invite_days === '' || wp_grv_invite_email_content === '' || wp_grv_invite_link === '' || wp_grv_invitation_repeat === '' || wp_grv_invitation_repeat <= 0 || wp_grv_invite_days <= 0 || wp_grv_invt_email_stat === '0') {
					return false;
				} else {
					jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
					jQuery( '#rv_invite_tab' ).css( 'opacity', '0.3' );
					var ajaxurl     = wp_grv_ajax_script.wp_grv_ajaxurl;
					var invite_data = {
						'action'                      : 'wp_grv_invite_insert_settings', // function name
						'wp_grv_invite_from'          : wp_grv_invite_from,
						'wp_grv_invite_days'          : wp_grv_invite_days,
						'wp_grv_invite_email_content' : wp_grv_invite_email_content,
						'wp_grv_invite_link'          : wp_grv_invite_link,
						'wp_grv_invitation_repeat'    : wp_grv_invitation_repeat,
					};
					jQuery.post(
						ajaxurl,
						invite_data,
						function(response) {
							jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
							jQuery( '#rv_invite_tab' ).css( 'opacity', '1.0' );
							jQuery( window ).scrollTop( 0 );
							jQuery( '.wp_grv_update_successfull_msg_wp3' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp3' ).fadeOut( 10000 );
							jQuery( '.wp_grv_tab_first_pro_sub .wp_grv_social_review_tab_a').trigger('click');
						}
					);
				}//else ends.
			}
		);

		/*
		* ajax function for review intake settings insertion
		*
		*/
		jQuery( "#rv_review_intake_details_sub" ).click(
			function(){
				event.preventDefault();
				var wp_grv_disp_with_rating     = jQuery( '#rv_disp_with_rating' ).val();
				var wp_grv_auto_post            = jQuery( "#rv_auto_post" ).prop( "checked" );
				var wp_grv_thk_msg_social_media = jQuery( '#rv_thk_msg_social_media' ).val();
				var wp_grv_thk_msg              = jQuery( '#rv_thk_msg' ).val();
				var wp_grv_usr_img_url          = jQuery( '#rv_usr_img_url' ).val();
				var wp_grv_archieve_pg_sel      = jQuery( '#rv_archieve_pg_sel' ).val();
				var wp_grv_intake_pg_sel        = jQuery( '#wp_grv_intake_pg_sel' ).val();
				/* Validation */
				if (wp_grv_disp_with_rating === '') {
					jQuery( '#rv_disp_with_rating' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_disp_with_rating' ).css( 'border', 'none' );
				}
				if (wp_grv_thk_msg_social_media === '') {
					jQuery( '#rv_thk_msg_social_media' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_thk_msg_social_media' ).css( 'border', 'none' );
				}
				if (wp_grv_thk_msg === '') {
					jQuery( '#rv_thk_msg' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_thk_msg' ).css( 'border', 'none' );
				}
				if (wp_grv_usr_img_url === '') {
					jQuery( '#rv_usr_img' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_usr_img' ).css( 'border', 'none' );
				}
				if (wp_grv_disp_with_rating === '' || wp_grv_thk_msg_social_media === '' || wp_grv_thk_msg === '' || wp_grv_usr_img_url === '') {
					return false;
				} else {
					jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
					jQuery( '#rv_intake_tab' ).css( 'opacity', '0.3' );
					var ajaxurl        = wp_grv_ajax_script.wp_grv_ajaxurl;
					var rv_intake_data = {
						'action'                      : 'wp_grv_rv_intake_insert_settings', // function name
						'wp_grv_disp_with_rating'     : wp_grv_disp_with_rating,
						'wp_grv_auto_post'            : wp_grv_auto_post,
						'wp_grv_thk_msg_social_media' : wp_grv_thk_msg_social_media,
						'wp_grv_thk_msg'              : wp_grv_thk_msg,
						'wp_grv_usr_img_url'          : wp_grv_usr_img_url,
						'wp_grv_archieve_pg_sel'      : wp_grv_archieve_pg_sel,
						'wp_grv_intake_pg_sel'        : wp_grv_intake_pg_sel,
					};
					jQuery.post(
						ajaxurl,
						rv_intake_data,
						function(response) {
							jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
							jQuery( '#rv_intake_tab' ).css( 'opacity', '1.0' );
							jQuery( window ).scrollTop( 0 );
							jQuery( '.wp_grv_update_successfull_msg_wp2' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp2' ).fadeOut( 10000 );
							var version = jQuery('#wp_grv_gratify_version').val();
							if(version == 'pro'){
								jQuery('.wp_grv_tab_first_sub .wp_grv_invite_tab_a').trigger('click');
							}else{
								jQuery('.wp_grv_tab_first_sub .wp_grv_social_review_tab_a').trigger('click');
							}	
						}
					);
				}// else ends.
			}
		);

		/*
		* ajax function for company details (schema) settings insertion
		*
		*/
		jQuery( "#rv_cmp_details_sub" ).click(
			function(){
				event.preventDefault();
				var wp_grv_organization_schema_enable   = jQuery( '#wp_grv_organization_schema_enable' ).prop( "checked" );
				var wp_grv_cmp_name       				= jQuery( '#rv_cmp_name' ).val();
				var wp_grv_cmp_logo_url    				= jQuery( "#rv_cmp_logo_url" ).val();
				var wp_grv_cmp_email       				= jQuery( '#rv_cmp_email' ).val();
				var wp_grv_cmp_adr_1       				= jQuery( '#rv_cmp_adr_1' ).val();
				var wp_grv_cmp_adr_2      	 			= jQuery( '#rv_cmp_adr_2' ).val();
				var wp_grv_cmp_city        				= jQuery( '#rv_cmp_city' ).val();
				var wp_grv_cmp_state       				= jQuery( '#rv_cmp_state' ).val();
				var wp_grv_cmp_country     				= jQuery( "#rv_cmp_country" ).val();
				var wp_grv_rv_cmp_zip_code 				= jQuery( '#rv_cmp_zip_code' ).val();
				/* validation */
				if (wp_grv_cmp_name === '') {
					jQuery( '#rv_cmp_name' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_cmp_name' ).css( 'border', 'none' );
				}
				if (wp_grv_cmp_logo_url === '') {
					jQuery( '#rv_cmp_logo' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_cmp_logo' ).css( 'border', 'none' );
				}
				var wp_grv_email_pattern = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
				if ( ! wp_grv_email_pattern.test( wp_grv_cmp_email )) {
					jQuery( '#rv_cmp_email' ).css( 'border', 'solid 1px #f10707' );
					var wp_grv_cmp_email_stat = '0';
				} else {
					jQuery( '#rv_cmp_email' ).css( 'border', 'none' );
				}
				if (wp_grv_cmp_adr_1 === '') {
					jQuery( '#rv_cmp_adr_1' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_cmp_adr_1' ).css( 'border', 'none' );
				}
				if (wp_grv_cmp_city === '') {
					jQuery( '#rv_cmp_city' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_cmp_city' ).css( 'border', 'none' );
				}
				if (wp_grv_cmp_state === '') {
					jQuery( '#rv_cmp_state' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_cmp_state' ).css( 'border', 'none' );
				}
				if (wp_grv_cmp_country === '') {
					jQuery( '#rv_cmp_country' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_cmp_country' ).css( 'border', 'none' );
				}
				if (wp_grv_rv_cmp_zip_code === '') {
					jQuery( '#rv_cmp_zip_code' ).css( 'border', 'solid 1px #f10707' );
				} else {
					jQuery( '#rv_cmp_zip_code' ).css( 'border', 'none' );
				}
				if (wp_grv_cmp_name === '' || wp_grv_cmp_logo_url === '' || wp_grv_cmp_email === '' || wp_grv_cmp_adr_1 === '' || wp_grv_cmp_city === '' || wp_grv_cmp_state === '' || wp_grv_cmp_country === '' || wp_grv_rv_cmp_zip_code === '' || wp_grv_cmp_email_stat === '0' ) {
					return false;
				} else {
					jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
					jQuery( '#rv_schema_tab' ).css( 'opacity', '0.3' );
					var ajaxurl          = wp_grv_ajax_script.wp_grv_ajaxurl;
					var cmp_details_data = {
						'action'                 			: 'wp_grv_cmp_details_insert_settings', // function name
                        'wp_grv_organization_schema_enable' : wp_grv_organization_schema_enable,
						'wp_grv_cmp_name'        			: wp_grv_cmp_name,
						'wp_grv_cmp_logo_url'    			: wp_grv_cmp_logo_url,
						'wp_grv_cmp_email'       			: wp_grv_cmp_email,
						'wp_grv_cmp_adr_1'       			: wp_grv_cmp_adr_1,
						'wp_grv_cmp_adr_2'       			: wp_grv_cmp_adr_2,
						'wp_grv_cmp_city'        			: wp_grv_cmp_city,
						'wp_grv_cmp_state'       			: wp_grv_cmp_state,
						'wp_grv_cmp_country'     			: wp_grv_cmp_country,
						'wp_grv_rv_cmp_zip_code' 			: wp_grv_rv_cmp_zip_code,
					};
					jQuery.post(
						ajaxurl,
						cmp_details_data,
						function(response) {
							jQuery( '#wp_grv_ajax_notification_load' ).html( response );
							jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
							jQuery( '#rv_schema_tab' ).css( 'opacity', '1.0' );
							jQuery( window ).scrollTop( 0 );
							jQuery( '.wp_grv_update_successfull_msg_wp' ).css( 'display', 'block' );
							jQuery( '.wp_grv_update_successfull_msg_wp' ).fadeOut( 10000 );
							jQuery( '.wp_grv_tab_first_sub .wp_grv_rv_intake_tab_a').trigger('click');
							jQuery( '.wp_grv_tab_first_pro_sub .wp_grv_rv_intake_tab_a').trigger('click');
						}
					);
				} //else ends.
			}
		);

		/*
		* ajax function for social review settings insertion
		*
		*/
		jQuery( "#rv_social_media_sub" ).click(
			function(){
				event.preventDefault();
				var wp_grv_google_check     = jQuery( "#rw_google" ).prop( "checked" );
				var wp_grv_fb_check         = jQuery( "#rw_fb" ).prop( "checked" );
				var wp_grv_twitter_check    = jQuery( "#rw_twitter" ).prop( "checked" );
				var wp_grv_custom_check     = jQuery( "#rw_custom" ).prop( "checked" );
				var wp_grv_google_logo_url  = jQuery( '#rv_google_logo_url' ).val();
				var wp_grv_google_link      = jQuery( '#rv_google_link' ).val();
				var wp_grv_fb_logo_url      = jQuery( '#rv_fb_logo_url' ).val();
				var wp_grv_fb_link          = jQuery( "#rv_fb_link" ).val();
				var wp_grv_twitter_logo_url = jQuery( '#rv_twitter_logo_url' ).val();
				var wp_grv_twitter_link     = jQuery( '#rv_twitter_link' ).val();
				var wp_grv_custom_title     = jQuery( "#rv_custom_title" ).val();
				var wp_grv_custom_logo_url  = jQuery( '#rv_custom_logo_url' ).val();
				var wp_grv_custom_link      = jQuery( '#rv_custom_link' ).val();
				var wp_grv_custom_title2    = jQuery( '#rv_custom_title2' ).val();
				var wp_grv_custom_logo2_url = jQuery( '#rv_custom_logo2_url' ).val();
				var wp_grv_custom_link2     = jQuery( '#rv_custom_link2' ).val();
				var wp_grv_custom_title3    = jQuery( "#rv_custom_title3" ).val();
				var wp_grv_custom_logo3_url = jQuery( '#rv_custom_logo3_url' ).val();
				var wp_grv_custom_link3     = jQuery( '#rv_custom_link3' ).val();
				// validation for google
				if (wp_grv_google_check == true) {
					if (wp_grv_google_link === '' || wp_grv_google_link === 'http://') {
						jQuery( '#rv_google_link' ).css( 'border', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#rv_google_link' ).css( 'border', 'none' );
					}
				}
				// validation for fb
				if (wp_grv_fb_check == true) {
					if (wp_grv_fb_link === '' || wp_grv_fb_link === 'http://') {
						jQuery( '#rv_fb_link' ).css( 'border', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#rv_fb_link' ).css( 'border', 'none' );
					}
				}
				// validation for yelp
				if (wp_grv_twitter_check == true) {
					if (wp_grv_twitter_link === '' || wp_grv_twitter_link === 'http://') {
						jQuery( '#rv_twitter_link' ).css( 'border', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#rv_twitter_link' ).css( 'border', 'none' );
					}
				}
				// validation for custom
				if (wp_grv_custom_check == true) {
					if (wp_grv_custom_link === '' || wp_grv_custom_link === 'http://') {
						jQuery( '#rv_custom_link' ).css( 'border', 'solid 1px #f10707' );
						return false;
					} else {
						jQuery( '#rv_custom_link' ).css( 'border', 'none' );
					}
				} //wp_grv_custom_check if ends.

				jQuery( '#wp_grv_loader' ).css( 'display', 'block' );
				jQuery( '#rv_social_review_tab' ).css( 'opacity', '0.3' );
				var ajaxurl                    = wp_grv_ajax_script.wp_grv_ajaxurl;
				var social_review_details_data = {
					'action'                  : 'wp_grv_social_review_insert_settings', // function name
					'wp_grv_google_check'     : wp_grv_google_check,
					'wp_grv_fb_check'         : wp_grv_fb_check,
					'wp_grv_twitter_check'    : wp_grv_twitter_check,
					'wp_grv_custom_check'     : wp_grv_custom_check,
					'wp_grv_google_logo_url'  : wp_grv_google_logo_url,
					'wp_grv_google_link'      : wp_grv_google_link,
					'wp_grv_fb_logo_url'      : wp_grv_fb_logo_url,
					'wp_grv_fb_link'          : wp_grv_fb_link,
					'wp_grv_twitter_logo_url' : wp_grv_twitter_logo_url,
					'wp_grv_twitter_link'     : wp_grv_twitter_link,
					'wp_grv_custom_title'     : wp_grv_custom_title,
					'wp_grv_custom_logo_url'  : wp_grv_custom_logo_url,
					'wp_grv_custom_link'      : wp_grv_custom_link,
					'wp_grv_custom_title2'    : wp_grv_custom_title2,
					'wp_grv_custom_logo2_url' : wp_grv_custom_logo2_url,
					'wp_grv_custom_link2'     : wp_grv_custom_link2,
					'wp_grv_custom_title3'    : wp_grv_custom_title3,
					'wp_grv_custom_logo3_url' : wp_grv_custom_logo3_url,
					'wp_grv_custom_link3' 	  : wp_grv_custom_link3,
				};
				jQuery.post(
					ajaxurl,
					social_review_details_data,
					function(response) {
						jQuery( '#wp_grv_loader' ).css( 'display', 'none' );
						jQuery( '#rv_social_review_tab' ).css( 'opacity', '1.0' );
						jQuery( window ).scrollTop( 0 );
						jQuery( '.wp_grv_update_successfull_msg_wp4' ).css( 'display', 'block' );
						jQuery( '.wp_grv_update_successfull_msg_wp4' ).fadeOut( 10000 );
						jQuery( '.wp_grv_tab_first_sub .wp_grv_social_proofing_tab_a').trigger('click');
					}
				);
			}
		);
	}
);
