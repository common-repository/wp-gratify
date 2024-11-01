jQuery( document ).ready(
	function(){
		jQuery( "#tabs" ).tabs();
		var mediaUploader_cmp;
		var mediaUploader_intake;
		var mediaUploader_google;
		var mediaUploader_fb;
		var mediaUploader_twitter;
		var mediaUploader_custom;
		var mediaUploader_custom2;
		var mediaUploader_custom3;
		var mediaUploader;
		var mediaUploader_gmb_add_new_post;
        var mediaUploader_gmb_add_new_event;
		
       /*
		* for gmb posts upload new event image function
		*
		*/
		jQuery( '#gmb_upload_add_event_img_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_gmb_add_new_event) {
					mediaUploader_gmb_add_new_event.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_gmb_add_new_event = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_gmb_add_new_event.on(
					'select',
					function() {
						var attachment_cmp = mediaUploader_gmb_add_new_event.state().get( 'selection' ).first().toJSON();
						jQuery( '#gmb_add_event_image' ).val( attachment_cmp.url );
						jQuery( '#gmb_add_event_image_url' ).val( attachment_cmp.url );
						jQuery( '#gmb_add_event_logo_shows' ).attr( 'src', attachment_cmp.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_gmb_add_new_event.open();
			}
		);

       /*
		* for gmb posts upload new post image function
		*
		*/
		jQuery( '#gmb_upload_add_new_post_img_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_gmb_add_new_post) {
					mediaUploader_gmb_add_new_post.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_gmb_add_new_post = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_gmb_add_new_post.on(
					'select',
					function() {
						var attachment_cmp = mediaUploader_gmb_add_new_post.state().get( 'selection' ).first().toJSON();
						jQuery( '#gmb_add_new_post_image' ).val( attachment_cmp.url );
						jQuery( '#gmb_add_new_post_image_url' ).val( attachment_cmp.url );
						jQuery( '#gmb_add_new_post_logo_shows' ).attr( 'src', attachment_cmp.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_gmb_add_new_post.open();
			}
		);

		/*
		* for review company tab upload default user image button fuction
		*
		*/
		jQuery( '#rv_upload_logo_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_cmp) {
					mediaUploader_cmp.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_cmp = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_cmp.on(
					'select',
					function() {
						var attachment_cmp = mediaUploader_cmp.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_cmp_logo' ).val( attachment_cmp.url );
						jQuery( '#rv_cmp_logo_url' ).val( attachment_cmp.url );
						jQuery( '#rv_cmp_logo_shows' ).attr( 'src', attachment_cmp.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_cmp.open();
			}
		);
		/*
		* for review intake tab upload default user image button fuction
		*
		*/
		jQuery( '#rv_upload_usr_img_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_intake) {
					mediaUploader_intake.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_intake = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_intake.on(
					'select',
					function() {
						var attachment_intake = mediaUploader_intake.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_usr_img' ).val( attachment_intake.url );
						jQuery( '#rv_usr_img_url' ).val( attachment_intake.url );
						jQuery( '#rv_intake_logo_shows' ).attr( 'src', attachment_intake.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_intake.open();
			}
		);

		/*
		* for review intake tab upload add user image button fuction
		*
		*/
		jQuery( '#rv_add_upload_usr_img_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader) {
					mediaUploader.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader.on(
					'select',
					function() {
						var attachment = mediaUploader.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_add_usr_img' ).val( attachment.url );
						// jQuery('#rv_usr_img_url').val(attachment.url);
						// jQuery('#rv_upload_img_show').html('<img src="'+attachment.url+'" style="width:70px;  border-radius: 50%;" >');
						jQuery( '#rv_upload_img_show' ).attr( 'src', attachment.url );
					}
				);
				// Open the uploader dialog
				mediaUploader.open();
			}
		);

		/*
		* for social media review tab upload logo of google section fuction
		*
		*/
		jQuery( '#rv_upload_google_logo_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_google) {
					mediaUploader_google.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_google = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_google.on(
					'select',
					function() {
						var attachment_google = mediaUploader_google.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_google_logo' ).val( attachment_google.url );
						jQuery( '#rv_google_logo_url' ).val( attachment_google.url );
						jQuery( '#rv_google_logo_shows' ).attr( 'src', attachment_google.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_google.open();
			}
		);
		/*
		* for social media review tab upload logo of fb section fuction
		*
		*/
		jQuery( '#rv_upload_fb_logo_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_fb) {
					mediaUploader_fb.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_fb = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_fb.on(
					'select',
					function() {
						var attachment_fb = mediaUploader_fb.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_fb_logo' ).val( attachment_fb.url );
						jQuery( '#rv_fb_logo_url' ).val( attachment_fb.url );
						jQuery( '#rv_fb_logo_shows' ).attr( 'src', attachment_fb.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_fb.open();
			}
		);
		/*
		* for social media review tab upload logo of twitter section fuction
		*
		*/
		jQuery( '#rv_upload_twitter_logo_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_twitter) {
					mediaUploader_twitter.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_twitter = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_twitter.on(
					'select',
					function() {
						var attachment_twitter = mediaUploader_twitter.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_twitter_logo' ).val( attachment_twitter.url );
						jQuery( '#rv_twitter_logo_url' ).val( attachment_twitter.url );
						jQuery( '#rv_twitter_logo_shows' ).attr( 'src', attachment_twitter.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_twitter.open();
			}
		);
		/*
		* for social media review tab upload logo of custom section fuction
		*
		*/
		jQuery( '#rv_upload_custom_logo_button' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_custom) {
					mediaUploader_custom.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_custom = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_custom.on(
					'select',
					function() {
						var attachment_custom = mediaUploader_custom.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_custom_logo' ).val( attachment_custom.url );
						jQuery( '#rv_custom_logo_url' ).val( attachment_custom.url );
						jQuery( '#rv_custom_logo_shows' ).attr( 'src', attachment_custom.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_custom.open();
			}
		);

		/*
		* for social media review tab upload logo of custom section 2 fuction
		*
		*/
		jQuery( '#rv_upload_custom_logo_button2' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_custom2) {
					mediaUploader_custom2.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_custom2 = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_custom2.on(
					'select',
					function() {
						var attachment_custom2 = mediaUploader_custom2.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_custom_logo2' ).val( attachment_custom2.url );
						jQuery( '#rv_custom_logo2_url' ).val( attachment_custom2.url );
						jQuery( '#rv_custom_logo2_shows' ).attr( 'src', attachment_custom2.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_custom2.open();
			}
		);

		/*
		* for social media review tab upload logo of custom section 3 fuction
		*
		*/
		jQuery( '#rv_upload_custom_logo_button3' ).click(
			function(e) {
				e.preventDefault();
				// If the uploader object has already been created, reopen the dialog
				if (mediaUploader_custom3) {
					mediaUploader_custom3.open();
					return;
				}
				// Extend the wp.media object
				mediaUploader_custom3 = wp.media.frames.file_frame = wp.media(
					{
						title: 'Choose Image',
						button: {
							text: 'Choose Image'
						},
						multiple: false }
				);

				// When a file is selected, grab the URL and set it as the text field's value
				mediaUploader_custom3.on(
					'select',
					function() {
						var attachment_custom3 = mediaUploader_custom3.state().get( 'selection' ).first().toJSON();
						jQuery( '#rv_custom_logo3' ).val( attachment_custom3.url );
						jQuery( '#rv_custom_logo3_url' ).val( attachment_custom3.url );
						jQuery( '#rv_custom_logo3_shows' ).attr( 'src', attachment_custom3.url );
					}
				);
				// Open the uploader dialog
				mediaUploader_custom3.open();
			}
		);
	}
);
