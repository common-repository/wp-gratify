/*
 * wp_grv backend general script
 *
*/
jQuery( document ).ready(
	function(){
		/**
		 * Initial plugin install settings next btn
		 */
		jQuery( "body" ).on("click","#wp_grv_schema_next",function(){
			jQuery('#ui-id-2').trigger('click');

		});	
		/*jQuery.getJSON('https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=A576A4966B', function(data) {
			    console.log(data);
			});*

	   /*
		* event table style
		*
		*/
		jQuery( '#wp_grv_add_event_list_tbl' ).DataTable(
			{
			}
		);
	   /*
		* alert table style
		*
		*/
		jQuery( '#wp_grv_add_alert_post_list_tbl' ).DataTable(
			{
			}
		);
	   /*
		* new post table style
		*
		*/
		jQuery( '#wp_grv_add_new_post_list_tbl' ).DataTable(
			{
			}
		);
	/**
	 * function for toggle block in category selection.
	 *
	 */ 	
	jQuery( "body" ).on("click","#wp_grv_schema_enable_cat",function(){
		var wp_grv_schema_enable = jQuery( "#wp_grv_schema_enable_cat" ).prop( "checked" );
	    if(wp_grv_schema_enable == true){
			jQuery( ".wp_grv_schema_category_block" ).fadeIn(1000);
		}else{
			jQuery( ".wp_grv_schema_category_block" ).fadeOut(1000);
		}
	});
	jQuery( "body" ).on("click","#wp_grv_manual_enable",function(){
		var wp_grv_manual_enable = jQuery( "#wp_grv_manual_enable" ).prop( "checked" );
	    if(wp_grv_manual_enable == true){
			jQuery(".wp_grv_schema_field").removeAttr("disabled");
		}else{
			jQuery(".wp_grv_schema_field").attr("disabled",'true');
		}
	});

		/**
		 * function for google my business replay section in review intake form.
		 * @author Ek
		 */ 
		var replay_val = jQuery("#wp_grv_gmb_review_replay").val();
		if(replay_val != ''){ 
		  	jQuery('.wp_grv_goole_review_replay_section').css('display','block');
		}  
		jQuery(".wp_grv_goole_review_replay_icon").click(function(){
		  	jQuery(".wp_grv_goole_review_replay_section").slideToggle("slow");
		});
		jQuery("#wp_grv_gmb_review_replay").keyup(function(){
			 var replay_val = jQuery("#wp_grv_gmb_review_replay").val();
			if(replay_val == ''){
				jQuery('#wp_grv_google_review_replay_submit').prop('disabled', true);
			    jQuery("#wp_grv_google_review_replay_submit").removeAttr("style")
			}
			else{
			    jQuery('#wp_grv_google_review_replay_submit').prop('disabled', false);
			    jQuery('#wp_grv_google_review_replay_submit').css('background-color','#01c3a9'); 
			    jQuery('#wp_grv_google_review_replay_submit').css('color','#ffff'); 
			}
		});
	   /**
		* function for duplicate name in review intake form.
		*
		*/
		jQuery( "#wp_grv_add_dup_name_check" ).click(
			function(){
				jQuery( "#wp_grv_duplicate_data_block" ).slideToggle( "slow" );
			}
		);
		var wp_grv_dup_details_check = jQuery( "#wp_grv_add_dup_name_check" ).prop( 'checked' );
		if (wp_grv_dup_details_check == true) {
			jQuery( '#wp_grv_duplicate_data_block' ).css( 'display','block' );
		}
		jQuery( "#rv_add_sub,#wp_grv_update" ).click(function(){
			var wp_grv_add_dup_name_check  	= jQuery( "#wp_grv_add_dup_name_check" ).prop( "checked" );
			var wp_grv_dup_name   			= jQuery( "#wp_grv_dup_name" ).val();
			var wp_grv_dup_reason   		= jQuery( "#wp_grv_dup_reason" ).val();
			var wp_grv_add_email	   		= jQuery( "#wp_grv_add_email" ).val();
			if(wp_grv_add_email == ''){
				jQuery("#wp_grv_add_email").focus();
				return false;
			}
			if(wp_grv_add_dup_name_check == true){
				if(wp_grv_dup_name == ''){
					jQuery( '#wp_grv_dup_name' ).css( 'border', 'solid 1px #6b2db9' );
					return false;
				}else{
					jQuery( '#wp_grv_dup_name' ).css( 'border', 'none' );
				}
				if(wp_grv_dup_reason == ''){
					jQuery( '#wp_grv_dup_reason' ).css( 'border', 'solid 1px #6b2db9' );
					return false;
				}else{
					jQuery( '#wp_grv_dup_reason' ).css( 'border', 'none' );
				}
			}
		});
		/* function to give preview for social proofing background color */
		jQuery( "#fa-eye" ).click(
			function(){
				jQuery( "#wp_grv_bg_block" ).slideToggle( "slow" );
			}
		);
		jQuery( "#wp_grv_social_proofing_bg_color" ).change(
			function (){
				var wp_grv_bg_color_fetch = jQuery( "#wp_grv_social_proofing_bg_color" ).val();
				jQuery( "#wp_grv_bg_block" ).attr( 'style', 'background-color:' + wp_grv_bg_color_fetch + ' !important' );
				jQuery( "#wp_grv_bg_block" ).show();
			}
		);
		/* function to give preview of social proofing font size */

		jQuery( "#wp_grv_social_proofing_text_size_name" ).on(
			"keydown",
			function() {
				setTimeout(
					function($elem){
						var wp_grv_font_size_name = $elem.val() + 'px';
						jQuery( "#wp_grv_txt_block" ).attr( 'style','font-size:' + wp_grv_font_size_name + ' !important' );
					},
					0,
					jQuery( this )
				);
			}
		);

		jQuery( "#wp_grv_social_proofing_text_size_contents" ).on(
			"keydown",
			function() {
				setTimeout(
					function($elem){
						var wp_grv_font_size_contents = $elem.val() + 'px';
						jQuery( "#wp_grv_review_block" ).attr( 'style','font-size:' + wp_grv_font_size_contents + ' !important' );
					},
					0,
					jQuery( this )
				);
			}
		);
		/* function to give preview of social proofing image border radius */

		jQuery( "#wp_grv_social_proofing_border_radius" ).on(
			"keydown",
			function() {
				setTimeout(
					function($elem){
						var wp_grv_img_border_radius = $elem.val() + '%';
						jQuery( "img#wp_grv_img" ).css( 'border-radius',wp_grv_img_border_radius );
					},
					0,
					jQuery( this )
				);
			}
		);
		/* function to give preview of social proofing image size */

		jQuery( "#wp_grv_social_proofing_image_size" ).on(
			"keydown",
			function() {
				setTimeout(
					function($elem){
						var wp_grv_img_size = $elem.val() + 'px';
						jQuery( "img#wp_grv_img" ).css( 'width',wp_grv_img_size );
						jQuery( "img#wp_grv_img" ).css( 'height',wp_grv_img_size );
					},
					0,
					jQuery( this )
				);
			}
		);
		/* function to give preview of social proofing title disable */
		jQuery( "body" ).on("click","#wp_grv_sp_title_enable",function(){
			var wp_grv_title_disable_check_box = jQuery('#wp_grv_sp_title_enable').prop('checked');
			if(wp_grv_title_disable_check_box == true){
				jQuery( "#wp_grv_txt_block" ).css( 'display','none' );
			}else{
				jQuery( "#wp_grv_txt_block" ).css( 'display','block' );
			}
		});
		/* function to give preview of social proofing font color */
		jQuery( "#wp_grv_social_proofing_font_color_name" ).change(
			function (){
				var wp_grv_font_color_fetch = jQuery( "#wp_grv_social_proofing_font_color_name" ).val();
				jQuery( "#wp_grv_txt_block" ).attr( 'style', 'color:' + wp_grv_font_color_fetch + ' !important' );
				jQuery( "#wp_grv_txt_block" ).show();
			}
		);
		jQuery( "#wp_grv_social_proofing_font_color_review" ).change(
			function (){
				var wp_grv_font_color_review_fetch = jQuery( "#wp_grv_social_proofing_font_color_review" ).val();
				jQuery( "#wp_grv_review_block" ).attr( 'style', 'color:' + wp_grv_font_color_review_fetch + ' !important' );
				jQuery( "#wp_grv_review_block" ).show();
			}
		);
		/*
		* page loader style
		*
		*/
		jQuery( window ).load(
			function() {
				// Animate loader off screen
				jQuery( ".se-pre-con" ).fadeOut( "slow" );;
			}
		);
		/*
		* inviation table style
		*
		*/
		jQuery( '#wp_grv_invited_users_tbl' ).DataTable(
			{
				"order": [[ 0, "desc" ]]
			}
		);
		jQuery( "body" ).on("mouseover",".wp_grv_rv_invtation_tbl_row",function(){
				var wp_grv_stat_check = jQuery( this ).find( '#wp_grv_status_text' ).text(); // taking status
				if ( wp_grv_stat_check === 'waiting' ) {
					jQuery( this ).find( ".wp_grv_rv_invitation_cancel_set" ).css( "visibility", "visible" );
				}
			}
		);
		jQuery( "body" ).on("mouseout",".wp_grv_rv_invtation_tbl_row",function(){
				jQuery( this ).find( ".wp_grv_rv_invitation_cancel_set" ).css( "visibility", "hidden" );
			}
		);
		/*
		* category table style
		*
		*/
		jQuery( '#wp_grv_add_cat_list_tbl' ).DataTable(
			{
			}
		);
		/*
		* all review table style
		*
		*/
		jQuery( "body" ).on("mouseover",".wp_grv_rv_tbl_row",function(){
				jQuery( this ).find( ".wp_grv_rv_edit_delete" ).css( "display", "block" );
			}
		);
		jQuery( "body" ).on("mouseout",".wp_grv_rv_tbl_row",function(){
				jQuery( this ).find( ".wp_grv_rv_edit_delete" ).css( "display", "none" );
			}
		);
		/*
		* table pagenation
		*
		*/
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
		/*
		* function to set star rating
		*
		*/
		jQuery( "#rv_st1" ). click(
			function(){
				jQuery( "#rv_st2" ).prop( 'checked', false );
				jQuery( "#rv_st3" ).prop( 'checked', false );
				jQuery( "#rv_st4" ).prop( 'checked', false );
				jQuery( "#rv_st5" ).prop( 'checked', false );
			}
		);
		jQuery( "#rv_st2" ). click(
			function(){
				jQuery( "#rv_st1" ).prop( 'checked', false );
				jQuery( "#rv_st3" ).prop( 'checked', false );
				jQuery( "#rv_st4" ).prop( 'checked', false );
				jQuery( "#rv_st5" ).prop( 'checked', false );
			}
		);
		jQuery( "#rv_st3" ). click(
			function(){
				jQuery( "#rv_st2" ).prop( 'checked', false );
				jQuery( "#rv_st1" ).prop( 'checked', false );
				jQuery( "#rv_st4" ).prop( 'checked', false );
				jQuery( "#rv_st5" ).prop( 'checked', false );
			}
		);
		jQuery( "#rv_st4" ). click(
			function(){
				jQuery( "#rv_st2" ).prop( 'checked', false );
				jQuery( "#rv_st3" ).prop( 'checked', false );
				jQuery( "#rv_st1" ).prop( 'checked', false );
				jQuery( "#rv_st5" ).prop( 'checked', false );
			}
		);
		jQuery( "#rv_st5" ). click(
			function(){
				jQuery( "#rv_st2" ).prop( 'checked', false );
				jQuery( "#rv_st3" ).prop( 'checked', false );
				jQuery( "#rv_st4" ).prop( 'checked', false );
				jQuery( "#rv_st1" ).prop( 'checked', false );
			}
		);
		/*
		* functions to set visibiliti of custom forms in social review tab
		*
		*/
		jQuery( ".removeclass2" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_custom_title2,#rv_custom_logo2,#rv_custom_link2' ).val( "" );
				jQuery( "#rw_custom_form2" ).css( "display", "none" );
				jQuery( "#rv_add_new_custom_field" ).css( "display", "inline-table" );
			}
		);
		jQuery( ".removeclass3" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_custom_title3,#rv_custom_logo3,#rv_custom_link3' ).val( "" );
				jQuery( "#rw_custom_form3" ).css( "display", "none" );
				jQuery( "#rv_add_new_custom_field2" ).css( "display", "inline-table" );
			}
		);
		jQuery( "#rv_add_new_custom_field" ). click(
			function(){
				event.preventDefault();
				jQuery( "#rw_custom_form2" ).css( "display", "inline-table" );
				jQuery( "#rv_add_new_custom_field" ).css( "display", "none" );
			}
		);
		jQuery( "#rv_add_new_custom_field2" ). click(
			function(){
				event.preventDefault();
				jQuery( "#rw_custom_form3" ).css( "display", "inline-table" );
				jQuery( "#rv_add_new_custom_field2" ).css( "display", "none" );
			}
		);
		/*
		* function use to set google form visibility in social review tab
		*
		*/
		jQuery( "#rw_google" ). click(
			function(){
				if (jQuery( this ). prop( "checked" ) == true) {
					 jQuery( "#rw_google_form" ).css( "display", "inline-table" );
				} else {
					jQuery( "#rw_google_form" ).css( "display", "none" );
					jQuery( '#rv_google_logo,#rv_google_link,#rv_google_logo_url' ).val( "" );
				}
			}
		);

		/*
		* function use to set facebook form visibility in social review tab
		*
		*/
		jQuery( "#rw_fb" ). click(
			function(){
				if (jQuery( this ). prop( "checked" ) == true) {
					 jQuery( 'html, body' ).animate( {scrollTop:jQuery( "#rw_twitter_form" ).height()}, 1500 );
					 jQuery( "#rw_fb_form" ).css( "display", "inline-table" );
				} else {
					jQuery( "#rw_fb_form" ).css( "display", "none" );
					jQuery( '#rv_fb_logo,#rv_fb_link,#rv_fb_logo_url' ).val( "" );
				}
			}
		);
		/*
		* function use to set yelp form visibility in social review tab
		*
		*/
		jQuery( "#rw_twitter" ). click(
			function(){
				if (jQuery( this ). prop( "checked" ) == true) {
					 jQuery( 'html, body' ).animate( {scrollTop:jQuery( "#rw_custom_form" ).height()}, 1500 );
					 jQuery( "#rw_twitter_form" ).css( "display", "inline-table" );
				} else {
					jQuery( "#rw_twitter_form" ).css( "display", "none" );
					jQuery( '#rv_twitter_logo,#rv_twitter_link,#rv_twitter_logo_url' ).val( "" );
				}
			}
		);
		/*
		* function use to set custom form visibility in social review tab
		*
		*/
		jQuery( "#rw_custom" ). click(
			function(){
				if (jQuery( this ). prop( "checked" ) == true) {
					 // jQuery("html, body").animate({ scrollTop: jQuery("#rw_custom_form").scrollTop() }, 1000);
					 jQuery( 'html, body' ).animate( {scrollTop:jQuery( document ).height()}, 1500 );
					 jQuery( "#rw_custom_form" ).css( "display", "inline-table" );
					 jQuery( "#rv_add_new_custom_field" ).css( "display", "inline-table" );
					 jQuery( "#rw_custom_form2" ).css( "display", "none" );
					 jQuery( "#rw_custom_form3" ).css( "display", "none" );
				} else {
					jQuery( "html, body" ).animate( { scrollTop: jQuery( "#rw_custom_form" ).scrollTop() }, 1000 );
					jQuery( "#rw_custom_form" ).css( "display", "none" );
					jQuery( "#rw_custom_form2" ).css( "display", "none" );
					jQuery( "#rw_custom_form3" ).css( "display", "none" );
					jQuery( "#rv_add_new_custom_field" ).css( "display", "none" );
					jQuery( '#rv_custom_title,#rv_custom_logo,#rv_custom_link,#rv_custom_title2,#rv_custom_logo2,#rv_custom_link2,#rv_custom_title3,#rv_custom_logo3,#rv_custom_link3,#rv_custom_logo3_url,#rv_custom_logo2_url,#rv_custom_logo_url' ).val( "" );
				}
			}
		);
		/*
		* function use to reset  for image upload field using reset button
		*
		*/
		// Schema page.
		jQuery( "#rv_upload_logo_button" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_cmp_logo_shows' ).css( 'display', 'block' );
			}
		);
		jQuery( "#cmp_logo_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_cmp_logo_url,#rv_cmp_logo' ).val( "" );
				jQuery( '#rv_cmp_logo_shows' ).removeAttr( 'src' );
				jQuery( '#rv_cmp_logo_shows' ).css( 'display', 'none' );
			}
		);
		// Review intake page.
		jQuery( "#rv_upload_usr_img_button" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_intake_logo_shows' ).css( 'display', 'block' );
			}
		);
		jQuery( "#usr_img_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_usr_img_url,#rv_usr_img' ).val( "" );
				jQuery( '#rv_intake_logo_shows' ).removeAttr( 'src' );
				jQuery( '#rv_intake_logo_shows' ).css( 'display', 'none' );
			}
		);
		// Google in social media review page.
		jQuery( "#google_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_google_logo_url,#rv_google_logo' ).val( "" );
				jQuery( '#rv_google_logo_shows' ).removeAttr( 'src' );
			}
		);
		// Facebook in social media review page.
		jQuery( "#fb_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_fb_logo_url,#rv_fb_logo' ).val( "" );
				jQuery( '#rv_fb_logo_shows' ).removeAttr( 'src' );
			}
		);
		// Twitter in social media review page.
		jQuery( "#twitter_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_twitter_logo_url,#rv_twitter_logo' ).val( "" );
				jQuery( '#rv_twitter_logo_shows' ).removeAttr( 'src' );
			}
		);
		// Custom in social media review page.
		jQuery( "#custom_logo_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_custom_logo_url,#rv_custom_logo' ).val( "" );
				jQuery( '#rv_custom_logo_shows' ).removeAttr( 'src' );
			}
		);
		// Custom2 in social media review page.
		jQuery( "#custom_logo2_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_custom_logo2_url,#rv_custom_logo2' ).val( "" );
				jQuery( '#rv_custom_logo2_shows' ).removeAttr( 'src' );
			}
		);
		// Custom3 in social media review page.
		jQuery( "#custom_logo3_reset_btn" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_custom_logo3_url,#rv_custom_logo3' ).val( "" );
				jQuery( '#rv_custom_logo3_shows' ).removeAttr( 'src' );
			}
		);
		// reset for add new review page upload field.
		jQuery( "#rv_add_upload_usr_img_reset_button" ). click(
			function(){
				event.preventDefault();
				jQuery( '#rv_add_usr_img' ).val( "" );
				jQuery( '#rv_upload_img_show' ).removeAttr( 'src' );
			}
		);
		// dashboard review circle progress bar
		var wp_grv_rate = jQuery( '#wp_grv_rate_value1' ).val();
		jQuery( '#wp_grv_circle1' ).circleProgress(
			{
				value: wp_grv_rate,
				size: 220,
				startAngle:1.5,
				fill: {
					gradient: [ "#57c0eb" , "#57c0eb", "#57c0eb"]
				}
			}
		);
		var wp_grv_rate = jQuery( '#wp_grv_rate_value2' ).val();
		jQuery( '#wp_grv_circle2' ).circleProgress(
			{
				value: wp_grv_rate,
				startAngle:1.5,
				size: 130,
				fill: {
					gradient: ["#3badb7", "#3badb7", "#3badb7"]
				}
			}
		);
		var wp_grv_rate = jQuery( '#wp_grv_rate_value3' ).val();
		jQuery( '#wp_grv_circle3' ).circleProgress(
			{
				value: wp_grv_rate,
				startAngle:1.5,
				size: 130,
				fill: {
					gradient: ["#52e3c2", "#52e3c2", "#52e3c2"]
				}
			}
		);
		var wp_grv_rate = jQuery( '#wp_grv_rate_value4' ).val();
		jQuery( '#wp_grv_circle4' ).circleProgress(
			{
				value: wp_grv_rate,
				startAngle:1.5,
				size: 130,
				fill: {
					gradient: ["#acd403", "#acd403", "#acd403"]
				}
			}
		);
		var wp_grv_rate = jQuery( '#wp_grv_rate_value5' ).val();
		jQuery( '#wp_grv_circle5' ).circleProgress(
			{
				value: wp_grv_rate,
				startAngle:1.5,
				size: 130,
				fill: {
					gradient: ["#c03e3e", "#c03e3e", "#c03e3e"]
				}
			}
		);
	}
);
