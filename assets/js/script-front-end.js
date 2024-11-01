jQuery( document ).ready(
	function(){
		/*
		* function for duplicate name in review intake form.
		*
		*/
		jQuery( "#wp_grv_add_dup_name_check" ).click(
			function(){
				jQuery( "#wp_grv_duplicate_data_block" ).slideToggle( "slow" );
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
	}
);
