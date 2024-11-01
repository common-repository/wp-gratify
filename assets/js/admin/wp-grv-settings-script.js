/*
 * function  to set style for settings page
 * return void
 */
jQuery( document ).ready(
	function(){
		// for gmb business hours
		/*
		 * Function for check open or close
		 *
		 */
		
jQuery( "body" ).on("click",".wp_grv_gmb_business_check_box_status",function(){
			var wp_grv_gmb_business_check_box = jQuery(this).prop('checked');
			var wp_grv_day 					  = jQuery(this).attr("day");
			var wp_grv_gmb_business_24hr_sun  = jQuery('#wp_grv_gmb_business_24hr_'+wp_grv_day).prop('checked');
			if(wp_grv_gmb_business_check_box == true){
				jQuery('.wp_grv_gmb_business_hours_span_'+wp_grv_day).text('Open');
				jQuery('.wp_grv_gmb_business_hr_td_visibility_'+wp_grv_day).css('display','');
				if(wp_grv_gmb_business_24hr_sun == true){
					jQuery('.wp_grv_gmb_business_hr_td_visibility_24hr_'+wp_grv_day).css('display','none');
				}
			}
			else{
				jQuery('.wp_grv_gmb_business_hours_span_'+wp_grv_day).text('Close');
				jQuery('.wp_grv_gmb_business_hr_td_visibility_'+wp_grv_day).css('display','none');
				if(wp_grv_gmb_business_24hr_sun == true){
					jQuery('.wp_grv_gmb_business_hr_td_visibility_24hr_'+wp_grv_day).css('display','none');
				}
			}

		});	
		jQuery( function() {
		    var availableTags = [
		      "1:00 am",
		      "1:30 am",
		      "2:00 am",
		      "2:30 am",
		      "3:00 am",
		      "3:30 am",
		      "4:00 am",
		      "4:30 am",
		      "5:00 am",
		      "5:30 am",
		      "6:00 am",
		      "6:30 am",
		      "7:00 am",
		      "7:30 am",
		      "8:00 am",
		      "8:30 am",
		      "9:00 am",
		      "9:30 am",
		      "10:00 am",
		      "10:30 am",
		      "11:00 am",
		      "11:30 am",
		      "12:00 am",
		      "12:30 am",
		      "1:00 pm",
		      "1:30 pm",
		      "2:00 pm",
		      "2:30 pm",
		      "3:00 pm",
		      "3:30 pm",
		      "4:00 pm",
		      "4:30 pm",
		      "5:00 pm",
		      "5:30 pm",
		      "6:00 pm",
		      "6:30 pm",
		      "7:00 pm",
		      "7:30 pm",
		      "8:00 pm",
		      "8:30 pm",
		      "9:00 pm",
		      "9:30 pm",
		      "10:00 pm",
		      "10:30 pm",
		      "11:00 pm",
		      "11:30 pm",
		      "12:00 pm",
		      "12:30 pm"


		    ];
		    jQuery( ".wp_grv_gmb_business_hr_field" ).autocomplete({
		      source: availableTags
		    });
		});
		/**
		 * Function for check 24hr enable or disable
		 *
		 */
		
jQuery( "body" ).on("click",".wp_grv_gmb_business_check_box_time",function(){
			var wp_grv_gmb_business_24hr_check_box 	= jQuery(this).prop('checked');
			var wp_grv_day 					  		= jQuery(this).attr("day");
			if(wp_grv_gmb_business_24hr_check_box == false){
				jQuery('.wp_grv_gmb_business_hr_td_visibility_24hr_'+wp_grv_day).css('display','');
			}
			else{
				jQuery('.wp_grv_gmb_business_hr_td_visibility_24hr_'+wp_grv_day).css('display','none');
			}	

		});
		// for schema
		jQuery( ".wp_grv_cmp_details_txt" ).insertBefore( ".wp_grv_menu_settings_tab" );// default display heading
		jQuery( '#wp_grv_schema_tab' ).click(
			function () {
				// display headings
				jQuery( ".wp_grv_cmp_details_txt" ).css( "display", "block" );
				jQuery( ".wp_grv_rv_intake_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_invitation_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_media_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_gmb_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_proofing_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_licence_txt" ).css( "display", "none" );
				// ends heading style
				jQuery( "#wp_grv_schema_tab span" ).css( "float", "right" );
				jQuery( "#wp_grv_schema_tab" ).css( "width", "108px" );
				setTimeout(
					function() {
						jQuery( "#wp_grv_schema_tab span" ).css( "display", "block" );
					},
					300
				);
				jQuery( "#wp_grv_rv_intake_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_rv_intake_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_invite_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_invite_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_review_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_review_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_gmb_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_gmb_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_proofing_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_proofing_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_licence_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_licence_tab span" ).css( "display", "none" );
			}
		);
		// for review intake
		jQuery( '#wp_grv_rv_intake_tab' ).click(
			function () {
				// display headings
				jQuery( ".wp_grv_rv_intake_txt" ).insertBefore( ".wp_grv_menu_settings_tab" );
				jQuery( ".wp_grv_rv_intake_txt" ).css( "display", "block" );
				jQuery( ".wp_grv_cmp_details_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_invitation_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_media_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_gmb_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_proofing_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_licence_txt" ).css( "display", "none" );
				// ends heading style
				jQuery( "#wp_grv_rv_intake_tab span" ).css( "float", "right" );
				jQuery( "#wp_grv_rv_intake_tab" ).css( "width", "156px" );
				setTimeout(
					function() {
						jQuery( "#wp_grv_rv_intake_tab span" ).css( "display", "block" );
					},
					300
				);
				jQuery( "#wp_grv_schema_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_schema_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_invite_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_invite_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_review_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_review_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_gmb_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_gmb_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_proofing_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_proofing_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_licence_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_licence_tab span" ).css( "display", "none" );
			}
		);
		// for review invite
		jQuery( '#wp_grv_invite_tab' ).click(
			function () {
				// display headings
				jQuery( ".wp_grv_invitation_txt" ).insertBefore( ".wp_grv_menu_settings_tab" );
				jQuery( ".wp_grv_invitation_txt" ).css( "display", "block" );
				jQuery( ".wp_grv_cmp_details_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_rv_intake_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_media_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_gmb_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_proofing_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_licence_txt" ).css( "display", "none" );
				// ends heading style
				jQuery( "#wp_grv_invite_tab span" ).css( "float", "right" );
				jQuery( "#wp_grv_invite_tab" ).css( "width", "91px" );
				setTimeout(
					function() {
						jQuery( "#wp_grv_invite_tab span" ).css( "display", "block" );
					},
					300
				);
				jQuery( "#wp_grv_schema_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_schema_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_rv_intake_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_rv_intake_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_review_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_review_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_gmb_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_gmb_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_proofing_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_proofing_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_licence_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_licence_tab span" ).css( "display", "none" );
			}
		);
		// for social media review
		jQuery( '#wp_grv_social_review_tab' ).click(
			function () {
				// display headings
				jQuery( ".wp_grv_social_media_txt" ).insertBefore( ".wp_grv_menu_settings_tab" );
				jQuery( ".wp_grv_social_media_txt" ).css( "display", "block" );
				jQuery( ".wp_grv_cmp_details_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_rv_intake_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_invitation_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_gmb_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_proofing_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_licence_txt" ).css( "display", "none" );
				// ends heading style
				jQuery( "#wp_grv_social_review_tab span" ).css( "float", "right" );
				jQuery( "#wp_grv_social_review_tab" ).css( "width", "156px" );
				setTimeout(
					function() {
						jQuery( "#wp_grv_social_review_tab span" ).css( "display", "block" );
					},
					300
				);
				jQuery( "#wp_grv_schema_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_schema_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_rv_intake_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_rv_intake_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_invite_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_invite_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_gmb_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_gmb_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_proofing_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_proofing_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_licence_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_licence_tab span" ).css( "display", "none" );
			}
		);
		// for GMB
		jQuery( '#wp_grv_gmb_tab' ).click(
			function () {
				// display headings
				jQuery( ".wp_grv_gmb_txt" ).insertBefore( ".wp_grv_menu_settings_tab" );
				jQuery( ".wp_grv_gmb_txt" ).css( "display", "block" );
				jQuery( ".wp_grv_cmp_details_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_rv_intake_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_invitation_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_media_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_proofing_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_licence_txt" ).css( "display", "none" );
				// ends heading style
				jQuery( "#wp_grv_gmb_tab span" ).css( "float", "right" );
				jQuery( "#wp_grv_gmb_tab" ).css( "width", "89px" );
				setTimeout(
					function() {
						jQuery( "#wp_grv_gmb_tab span" ).css( "display", "block" );
					},
					300
				);
				jQuery( "#wp_grv_schema_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_schema_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_rv_intake_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_rv_intake_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_invite_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_invite_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_review_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_review_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_proofing_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_proofing_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_licence_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_licence_tab span" ).css( "display", "none" );
			}
		);
		// for social proofing
		jQuery( '#wp_grv_social_proofing_tab' ).click(
			function () {
				// display headings
				jQuery( ".wp_grv_social_proofing_txt" ).insertBefore( ".wp_grv_menu_settings_tab" );
				jQuery( ".wp_grv_social_proofing_txt" ).css( "display", "block" );
				jQuery( ".wp_grv_cmp_details_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_rv_intake_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_invitation_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_media_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_gmb_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_licence_txt" ).css( "display", "none" );
				// ends heading style
				jQuery( "#wp_grv_social_proofing_tab span" ).css( "float", "right" );
				jQuery( "#wp_grv_social_proofing_tab" ).css( "width", "163px" );
				setTimeout(
					function() {
						jQuery( "#wp_grv_social_proofing_tab span" ).css( "display", "block" );
					},
					300
				);
				jQuery( "#wp_grv_schema_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_schema_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_rv_intake_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_rv_intake_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_invite_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_invite_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_review_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_review_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_gmb_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_gmb_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_licence_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_licence_tab span" ).css( "display", "none" );
			}
		);
		// for licence
		jQuery( '#wp_grv_licence_tab' ).click(
			function () {
				// display headings
				jQuery( ".wp_grv_licence_txt" ).insertBefore( ".wp_grv_menu_settings_tab" );
				jQuery( ".wp_grv_licence_txt" ).css( "display", "block" );
				jQuery( ".wp_grv_cmp_details_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_rv_intake_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_invitation_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_media_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_gmb_txt" ).css( "display", "none" );
				jQuery( ".wp_grv_social_proofing_txt" ).css( "display", "none" );
				// ends heading style
				jQuery( "#wp_grv_licence_tab span" ).css( "float", "right" );
				jQuery( "#wp_grv_licence_tab" ).css( "width", "108px" );
				setTimeout(
					function() {
						jQuery( "#wp_grv_licence_tab span" ).css( "display", "block" );
					},
					300
				);
				jQuery( "#wp_grv_schema_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_schema_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_rv_intake_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_rv_intake_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_invite_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_invite_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_review_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_review_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_gmb_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_gmb_tab span" ).css( "display", "none" );

				jQuery( "#wp_grv_social_proofing_tab" ).css( "width", "45px" );
				jQuery( "#wp_grv_social_proofing_tab span" ).css( "display", "none" );
			}
		);
	}
);
