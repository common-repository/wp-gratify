<?php
/*
  * function for insert gmb location data to database
  * return void
 */ 
class Wp_Grv_Settings_Tbl_Operation
{
	/**
	 * Function for gmb business hours saving
	 * @author Ek
	 */ 
	public static function wp_grv_rv_gmb_business_hour_save_fun(){ 
		// Hours enable check box values
		$wp_grv_gmb_business_check_box_sun      = $_POST['wp_grv_gmb_business_check_box_sun'];
		$wp_grv_gmb_business_check_box_mon      = $_POST['wp_grv_gmb_business_check_box_mon'];
		$wp_grv_gmb_business_check_box_tue      = $_POST['wp_grv_gmb_business_check_box_tue'];
		$wp_grv_gmb_business_check_box_wed      = $_POST['wp_grv_gmb_business_check_box_wed'];
		$wp_grv_gmb_business_check_box_thu      = $_POST['wp_grv_gmb_business_check_box_thu'];
		$wp_grv_gmb_business_check_box_fri      = $_POST['wp_grv_gmb_business_check_box_fri'];
		$wp_grv_gmb_business_check_box_sat    	= $_POST['wp_grv_gmb_business_check_box_sat'];
		//open and close timing
		$wp_grv_gmb_business_open_sun       	= $_POST['wp_grv_gmb_business_open_sun'];
		$wp_grv_gmb_business_close_sun       	= $_POST['wp_grv_gmb_business_close_sun'];
		$wp_grv_gmb_business_open_mon       	= $_POST['wp_grv_gmb_business_open_mon'];
		$wp_grv_gmb_business_close_mon       	= $_POST['wp_grv_gmb_business_close_mon'];
		$wp_grv_gmb_business_open_tue       	= $_POST['wp_grv_gmb_business_open_tue'];
		$wp_grv_gmb_business_close_tue       	= $_POST['wp_grv_gmb_business_close_tue'];
		$wp_grv_gmb_business_open_wed       	= $_POST['wp_grv_gmb_business_open_wed'];
		$wp_grv_gmb_business_close_wed       	= $_POST['wp_grv_gmb_business_close_wed'];
		$wp_grv_gmb_business_open_thu 	     	= $_POST['wp_grv_gmb_business_open_thu'];
		$wp_grv_gmb_business_close_thu       	= $_POST['wp_grv_gmb_business_close_thu'];
		$wp_grv_gmb_business_open_fri       	= $_POST['wp_grv_gmb_business_open_fri'];
		$wp_grv_gmb_business_close_fri       	= $_POST['wp_grv_gmb_business_close_fri'];
		$wp_grv_gmb_business_open_sat       	= $_POST['wp_grv_gmb_business_open_sat'];
		$wp_grv_gmb_business_close_sat       	= $_POST['wp_grv_gmb_business_close_sat'];
		// 24hours enable check box values
		$wp_grv_gmb_business_24hr_sun      		= $_POST['wp_grv_gmb_business_24hr_sun'];
		$wp_grv_gmb_business_24hr_mon      		= $_POST['wp_grv_gmb_business_24hr_mon'];
		$wp_grv_gmb_business_24hr_tue      		= $_POST['wp_grv_gmb_business_24hr_tue'];
		$wp_grv_gmb_business_24hr_wed      		= $_POST['wp_grv_gmb_business_24hr_wed'];
		$wp_grv_gmb_business_24hr_thu      		= $_POST['wp_grv_gmb_business_24hr_thu'];
		$wp_grv_gmb_business_24hr_fri      		= $_POST['wp_grv_gmb_business_24hr_fri'];
		$wp_grv_gmb_business_24hr_sat      		= $_POST['wp_grv_gmb_business_24hr_sat'];
		$wp_grv_business_hours_data = array(
				// Hours enable check box values
		        "enable_sunday_check"  			=> $wp_grv_gmb_business_check_box_sun,
		        "enable_monday_check"  			=> $wp_grv_gmb_business_check_box_mon,
		        "enable_tuesday_check"  		=> $wp_grv_gmb_business_check_box_tue,
		        "enable_wednesday_check"  		=> $wp_grv_gmb_business_check_box_wed,
		        "enable_thursday_check"  		=> $wp_grv_gmb_business_check_box_thu,
		        "enable_friday_check"  			=> $wp_grv_gmb_business_check_box_fri,
		        "enable_saturday_check"  		=> $wp_grv_gmb_business_check_box_sat,
		        //open and close time
		        "sunday_open"  					=> $wp_grv_gmb_business_open_sun,
				"sunday_close"  				=> $wp_grv_gmb_business_close_sun,
				"monday_open"  					=> $wp_grv_gmb_business_open_mon,
				"monday_close"  				=> $wp_grv_gmb_business_close_mon,
				"tuesday_open"  				=> $wp_grv_gmb_business_open_tue,
				"tuesday_close"  				=> $wp_grv_gmb_business_close_tue,
				"wednesday_open"  				=> $wp_grv_gmb_business_open_wed,
				"wednesday_close"  				=> $wp_grv_gmb_business_close_wed,
				"thursday_open"  				=> $wp_grv_gmb_business_open_thu,
				"thursday_close"  				=> $wp_grv_gmb_business_close_thu,
				"friday_open"  					=> $wp_grv_gmb_business_open_fri,
				"friday_close"  				=> $wp_grv_gmb_business_close_fri,
				"saturday_open"  				=> $wp_grv_gmb_business_open_sat,
				"saturday_close"  				=> $wp_grv_gmb_business_close_sat,
				// 24hours enable check box values
				"enable_sunday_check_24hr"  	=> $wp_grv_gmb_business_24hr_sun,
		        "enable_monday_check_24hr"  	=> $wp_grv_gmb_business_24hr_mon,
		        "enable_tuesday_check_24hr"  	=> $wp_grv_gmb_business_24hr_tue,
		        "enable_wednesday_check_24hr"  	=> $wp_grv_gmb_business_24hr_wed,
		        "enable_thursday_check_24hr"  	=> $wp_grv_gmb_business_24hr_thu,
		        "enable_friday_check_24hr"  	=> $wp_grv_gmb_business_24hr_fri,
		        "enable_saturday_check_24hr"  	=> $wp_grv_gmb_business_24hr_sat,
		    );
		update_option('wp_grv_business_hours_data',$wp_grv_business_hours_data);
		/**
		 * Business hours GMB connection
		 * @author Ek
		 */
			$gmb_fetch_sett 	= get_option( 'gmb_settings' );
			$gmb_fetch_loc_sett = get_option( 'wp_grv_gmb_location_settings' );
		// acess acesstoken throung rest api
			$gmb_id                = $gmb_fetch_sett['gmb_id'];
			$gmb_location          = $_POST['wp_grv_gmb_business_selected_loc'];
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: */*",
			    "Accept-Encoding: gzip, deflate",
			    "Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Host: wpgratify.com",
			    "cache-control: no-cache"
			  ),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$access_token = trim($response, '"');
			//24hrs time convertion for GMB
			$wp_grv_gmb_business_open_sun 	= strtotime($wp_grv_gmb_business_open_sun);
			$wp_grv_gmb_business_open_sun 	= date('H:i', $wp_grv_gmb_business_open_sun);
			$wp_grv_gmb_business_close_sun 	= strtotime($wp_grv_gmb_business_close_sun);
			$wp_grv_gmb_business_close_sun 	= date('H:i', $wp_grv_gmb_business_close_sun);

			$wp_grv_gmb_business_open_mon 	= strtotime($wp_grv_gmb_business_open_mon);
			$wp_grv_gmb_business_open_mon 	= date('H:i', $wp_grv_gmb_business_open_mon);
			$wp_grv_gmb_business_close_mon 	= strtotime($wp_grv_gmb_business_close_mon);
			$wp_grv_gmb_business_close_mon 	= date('H:i', $wp_grv_gmb_business_close_mon);

			$wp_grv_gmb_business_open_tue 	= strtotime($wp_grv_gmb_business_open_tue);
			$wp_grv_gmb_business_open_tue 	= date('H:i', $wp_grv_gmb_business_open_tue);
			$wp_grv_gmb_business_close_tue 	= strtotime($wp_grv_gmb_business_close_tue);
			$wp_grv_gmb_business_close_tue 	= date('H:i', $wp_grv_gmb_business_close_tue);

			$wp_grv_gmb_business_open_wed 	= strtotime($wp_grv_gmb_business_open_wed);
			$wp_grv_gmb_business_open_wed 	= date('H:i', $wp_grv_gmb_business_open_wed);
			$wp_grv_gmb_business_close_wed 	= strtotime($wp_grv_gmb_business_close_wed);
			$wp_grv_gmb_business_close_wed 	= date('H:i', $wp_grv_gmb_business_close_wed);

			$wp_grv_gmb_business_open_thu 	= strtotime($wp_grv_gmb_business_open_thu);
			$wp_grv_gmb_business_open_thu 	= date('H:i', $wp_grv_gmb_business_open_thu);
			$wp_grv_gmb_business_close_thu 	= strtotime($wp_grv_gmb_business_close_thu);
			$wp_grv_gmb_business_close_thu 	= date('H:i', $wp_grv_gmb_business_close_thu);

			$wp_grv_gmb_business_open_fri 	= strtotime($wp_grv_gmb_business_open_fri);
			$wp_grv_gmb_business_open_fri 	= date('H:i', $wp_grv_gmb_business_open_fri);
			$wp_grv_gmb_business_close_fri 	= strtotime($wp_grv_gmb_business_close_fri);
			$wp_grv_gmb_business_close_fri 	= date('H:i', $wp_grv_gmb_business_close_fri);

			$wp_grv_gmb_business_open_sat 	= strtotime($wp_grv_gmb_business_open_sat);
			$wp_grv_gmb_business_open_sat 	= date('H:i', $wp_grv_gmb_business_open_sat);
			$wp_grv_gmb_business_close_sat 	= strtotime($wp_grv_gmb_business_close_sat);
			$wp_grv_gmb_business_close_sat 	= date('H:i', $wp_grv_gmb_business_close_sat);
			//SUNDAY
			if(($wp_grv_gmb_business_check_box_sun == 'true')&&($wp_grv_gmb_business_24hr_sun == 'true')){
		    	$periods[] = array('openDay' => 'SUNDAY','closeDay' => 'SUNDAY','openTime' => '00:00','closeTime' => '24:00');
		    }else if($wp_grv_gmb_business_check_box_sun == 'true'){
		    	$periods[] = array('openDay' => 'SUNDAY','closeDay' => 'SUNDAY','openTime' => $wp_grv_gmb_business_open_sun ,'closeTime' => $wp_grv_gmb_business_close_sun);
		    }	
			//MONDAY
			if(($wp_grv_gmb_business_check_box_mon == 'true')&&($wp_grv_gmb_business_24hr_mon == 'true')){
		    	$periods[] = array('openDay' => 'MONDAY','closeDay' => 'MONDAY','openTime' => '00:00','closeTime' => '24:00');
		    }else if($wp_grv_gmb_business_check_box_mon == 'true'){
		    	$periods[] = array('openDay' => 'MONDAY','closeDay' => 'MONDAY','openTime' => $wp_grv_gmb_business_open_mon ,'closeTime' => $wp_grv_gmb_business_close_mon);
		    }
		    //TUESDAY
			if(($wp_grv_gmb_business_check_box_tue == 'true')&&($wp_grv_gmb_business_24hr_tue == 'true')){
		    	$periods[] = array('openDay' => 'TUESDAY','closeDay' => 'TUESDAY','openTime' => '00:00','closeTime' => '24:00');
		    }else if($wp_grv_gmb_business_check_box_tue == 'true'){
		    	$periods[] = array('openDay' => 'TUESDAY','closeDay' => 'TUESDAY','openTime' => $wp_grv_gmb_business_open_tue ,'closeTime' => $wp_grv_gmb_business_close_tue);
		    }
		    //WEDNESDAY
			if(($wp_grv_gmb_business_check_box_wed == 'true')&&($wp_grv_gmb_business_24hr_wed == 'true')){
		    	$periods[] = array('openDay' => 'WEDNESDAY','closeDay' => 'WEDNESDAY','openTime' => '00:00','closeTime' => '24:00');
		    }else if($wp_grv_gmb_business_check_box_wed == 'true'){
		    	$periods[] = array('openDay' => 'WEDNESDAY','closeDay' => 'WEDNESDAY','openTime' => $wp_grv_gmb_business_open_wed ,'closeTime' => $wp_grv_gmb_business_close_wed);
		    }
		    //THURSDAY
			if(($wp_grv_gmb_business_check_box_thu == 'true')&&($wp_grv_gmb_business_24hr_thu == 'true')){
		    	$periods[] = array('openDay' => 'THURSDAY','closeDay' => 'THURSDAY','openTime' => '00:00','closeTime' => '24:00');
		    }else if($wp_grv_gmb_business_check_box_thu == 'true'){
		    	$periods[] = array('openDay' => 'THURSDAY','closeDay' => 'THURSDAY','openTime' => $wp_grv_gmb_business_open_thu ,'closeTime' => $wp_grv_gmb_business_close_thu);
		    }
		    //FRIDAY
			if(($wp_grv_gmb_business_check_box_fri == 'true')&&($wp_grv_gmb_business_24hr_fri == 'true')){
		    	$periods[] = array('openDay' => 'FRIDAY','closeDay' => 'FRIDAY','openTime' => '00:00','closeTime' => '24:00');
		    }else if($wp_grv_gmb_business_check_box_fri == 'true'){
		    	$periods[] = array('openDay' => 'FRIDAY','closeDay' => 'FRIDAY','openTime' => $wp_grv_gmb_business_open_fri ,'closeTime' => $wp_grv_gmb_business_close_fri);
		    }
		    //SATURDAY
			if(($wp_grv_gmb_business_check_box_sat == 'true')&&($wp_grv_gmb_business_24hr_sat == 'true')){
		    	$periods[] = array('openDay' => 'SATURDAY','closeDay' => 'SATURDAY','openTime' => '00:00','closeTime' => '24:00');
		    }else if($wp_grv_gmb_business_check_box_sat == 'true'){
		    	$periods[] = array('openDay' => 'SATURDAY','closeDay' => 'SATURDAY','openTime' => $wp_grv_gmb_business_open_sat ,'closeTime' => $wp_grv_gmb_business_close_sat);
		    }


		    $query = array('regularHours' =>
		                    array('periods' =>$periods) );
		    $request_uri = "https://mybusiness.googleapis.com/v4/".$gmb_location."?validateOnly=False&updateMask=regularHours.periods&access_token=" . $access_token;
		    $curinit = curl_init($request_uri);
		    curl_setopt($curinit, CURLOPT_SSL_VERIFYPEER, false);
		    curl_setopt($curinit, CURLOPT_CUSTOMREQUEST, 'PATCH');
		    curl_setopt($curinit, CURLOPT_POSTFIELDS, json_encode($query));
		    curl_setopt($curinit, CURLOPT_RETURNTRANSFER, true);
		    curl_setopt($curinit, CURLOPT_HTTPHEADER, array(
		      'Content-Type: application/json',
		      'Content-Length: ' . strlen(json_encode($query)))
		    );
		    $json = curl_exec($curinit);
		    $phpObj = json_decode($json, true);
		    var_dump($phpObj); 
		exit();
	}	
	/**
	 * Function for location display
	 * @author Ek
	 */ 
	/*public static function wp_grv_gmb_location_fetch(){ 
		$gmb_fetch_settings 	    		= get_option('gmb_settings');
		$wp_grv_gmb_status 	        		= $gmb_fetch_settings['gmb_status']; 
		if($wp_grv_gmb_status === '1'){
		    $gmb_location_fetch_settings 	= get_option('wp_grv_gmb_location_settings');
		    $wp_grv_gmb_location_name 	    = $gmb_location_fetch_settings['gmb_location_name'];
		    /*if(isset($wp_grv_gmb_location_name) && $wp_grv_gmb_location_name != 'null'){
		        ?>
		        <th><br/><label class="wp_grv_label"><?php echo _e( 'GMB Locations:', 'wp-gratify-lang' ); ?></label></th>
		        <td><?php echo $wp_grv_gmb_location_name; ?></td>
		        <?php
		    }
		    else{*//*
		     	$wp_grv_gmb_fetch_locations = $_POST['wp_grv_gmb_fetch_locations'];
		     	?>
		     	<th><br/><label class="wp_grv_label"><?php echo _e( 'GMB Location:', 'wp-gratify-lang' ); ?></label></th>
		     	<td id="wp_grv_location_drop_refresh">
		         	<select id="wp_grv_location_select" class="wp_grv_select_field">
		         	    <option value=""><?php echo _e( 'Add GMB Location', 'wp-gratify-lang' );    ?></option>
		             	<?php
		             	foreach($wp_grv_gmb_fetch_locations as $loc_val){
		             	    $name = $loc_val['name'];
		             	    $locationName = $loc_val['locationName'];
		             	    ?>
		             	            <option class="wp_grv_location_option" value="<?php echo $name; ?>"><?php echo $locationName; ?></option>
		             	    <?php
		             	}
		             	?>
		            </select>
		        </td>
	 	<?php
		    //}
		}
	 	exit();			
	 }*/
	 public static function wp_grv_gmb_location_fetch(){ 
	 	$gmb_fetch_settings 	    		= get_option('gmb_settings');
		$wp_grv_gmb_status 	        		= $gmb_fetch_settings['gmb_status']; 
		if($wp_grv_gmb_status === '1'){
		    $gmb_location_fetch_settings 	= get_option('wp_grv_gmb_location_settings');
		    $wp_grv_gmb_location_name 	    = $gmb_location_fetch_settings['gmb_location_name'];
		    /* get acess token */
		    $gmb_fetch_sett = get_option('gmb_settings');
			$gmb_id         = $gmb_fetch_sett['gmb_id'];
			$curl 			= curl_init();

			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: */*",
			    "Accept-Encoding: gzip, deflate",
			    "Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Host: wpgratify.com",
			    "cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$json_acess_token_data = trim($response, '"');
			/* fetch accounts in GMB */
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://mybusiness.googleapis.com/v4/accounts/",
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 0,
			  CURLOPT_FOLLOWLOCATION => true,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Content-Type: application/json",
			    "Authorization: Bearer ".$json_acess_token_data
			  ),
			));
			$response = curl_exec($curl);
			curl_close($curl);
			$wp_grv_gmb_account_details_array = json_decode($response,true);
			//print_r($wp_grv_gmb_account_details_array);
			$i = 0;
			$j = 0;
			foreach ($wp_grv_gmb_account_details_array['accounts'] as $value_gmb_account) {
				$wpgrv_account_url  = $value_gmb_account['name'];
				$wpgrv_account_name = $value_gmb_account['accountName'];
				$wpgrv_account_type = $value_gmb_account['type'];
				$curl2 = curl_init();
					curl_setopt_array($curl2, array(
					  CURLOPT_URL => "https://mybusiness.googleapis.com/v4/".$wpgrv_account_url."/locations",
					  CURLOPT_RETURNTRANSFER => true,
					  CURLOPT_ENCODING => "",
					  CURLOPT_MAXREDIRS => 10,
					  CURLOPT_TIMEOUT => 0,
					  CURLOPT_FOLLOWLOCATION => true,
					  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
					  CURLOPT_CUSTOMREQUEST => "GET",
					  CURLOPT_HTTPHEADER => array(
					    "Content-Type: application/json",
					    "Authorization: Bearer ".$json_acess_token_data
					  ),
					));
					$response2 = curl_exec($curl2);
					curl_close($curl2);
					$wp_grv_gmb_location_details_array = json_decode($response2,true);
				if($wpgrv_account_type === 'PERSONAL'){
					if ($i === 0) {
						?>
						<h3 class="wp_grv_gmb_location_manage_head"><?php echo esc_html_e( 'Personal Accounts', 'wp-gratify-lang' ); ?></h3>
						<?php
						$i = $i+1;
					}
					?>
					<div class="wpgrv_gmb_personal_account_section">
						<p><?=$wpgrv_account_name?></p>
						<select class="wp_grv_select_field wp_grv_location_select">
							<option><?php echo esc_html_e( 'Select Location', 'wp-gratify-lang' ); ?></option>
							<?php
							foreach ($wp_grv_gmb_location_details_array['locations'] as $value_gmb_location) {
								?>
								<option class="wp_grv_location_option" value="<?php echo $value_gmb_location['name']; ?>"><?php echo $value_gmb_location['locationName']; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<?php
				}else{
					if ($j === 0) {
						?>
						<h3 class="wp_grv_gmb_location_manage_head"><?php echo esc_html_e( 'Location Group', 'wp-gratify-lang' ); ?></h3>
						<?php
						$j = $j+1;
					}
					?>
					<div class="wpgrv_gmb_location_group_account_section">
						<p><?=$wpgrv_account_name?></p>
						<select class="wp_grv_select_field wp_grv_location_select">
							<option><?php echo esc_html_e( 'Select Location', 'wp-gratify-lang' ); ?></option>
							<?php
							foreach ($wp_grv_gmb_location_details_array['locations'] as $value_gmb_location) {
								?>
								<option class="wp_grv_location_option" value="<?php echo $value_gmb_location['name']; ?>"><?php echo $value_gmb_location['locationName']; ?></option>
								<?php
							}
							?>
						</select>
					</div>
					<?php
				}
			}

		}    
	 	exit();
	 }	
	/**
	 * Function for save location
	 * @author Ek
	 */ 
	 public static function wp_grv_select_location_fetch_fun(){
		$wp_grv_select_location         = $_POST['wp_grv_select_location'];
	 	$wp_grv_select_location_name    = $_POST['wp_grv_select_location_name'];
	 	$gmb_loc 						= get_option( 'wp_grv_gmb_location_settings' );
	 	$wp_grv_selected_locations_db   = $gmb_loc['gmb_selected_locations'];
	 	if($wp_grv_selected_locations_db === 'null'){
	 		$wp_grv_selected_locations_db = array(
	 												$wp_grv_select_location_name => $wp_grv_select_location,
	 											);
	 	}else{
	 		$wp_grv_selected_locations_db[$wp_grv_select_location_name] = $wp_grv_select_location;
	 	}
	 	$gmb_location_settings_dat = array(
		         "gmb_location"         	=> $wp_grv_select_location,
		         "gmb_location_name"    	=> $wp_grv_select_location_name,
		         'gmb_selected_locations' 	=> $wp_grv_selected_locations_db,
		      );
		update_option('wp_grv_gmb_location_settings',$gmb_location_settings_dat);
		$gmb_loc 		= get_option( 'wp_grv_gmb_location_settings' );
		$gmb_loc_fetch 	= $gmb_loc['gmb_location'];
		if(isset($gmb_loc_fetch )) {
			if($gmb_loc_fetch != 'null'){
				include_once 'wp-grv-gmb-business-hours-ajax-call.php';
			}
		}
		exit();
	 }
	/**
	 * Function for select location business hours
	 * @author Ek
	 */ 
	 public static function wp_grv_select_location_for_business_hours(){
		$wp_grv_select_location         = $_POST['wp_grv_select_location'];
	 	$wp_grv_select_location_name    = $_POST['wp_grv_select_location_name'];

	 	// GMB Value fetch
		$gmb_fetch_sett 	= get_option( 'gmb_settings' );
		$gmb_fetch_loc_sett = get_option( 'wp_grv_gmb_location_settings' );
		// acess acesstoken throung rest api
		$gmb_id                = $gmb_fetch_sett['gmb_id'];
		$gmb_location          = $wp_grv_select_location;
		if($gmb_fetch_loc_sett != ''){
			$curl = curl_init();
			curl_setopt_array($curl, array(
			  CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: */*",
			    "Accept-Encoding: gzip, deflate",
			    "Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Host: wpgratify.com",
			    "cache-control: no-cache"
			  ),
			));
			$response = curl_exec($curl);
			$err = curl_error($curl);
			curl_close($curl);
			$access_token = trim($response, '"');

			// fetch location details array
			$curl2 = curl_init();

			curl_setopt_array($curl2, array(
			  CURLOPT_URL => "https://mybusiness.googleapis.com/v4/".$gmb_location,
			  CURLOPT_RETURNTRANSFER => true,
			  CURLOPT_ENCODING => "",
			  CURLOPT_MAXREDIRS => 10,
			  CURLOPT_TIMEOUT => 30,
			  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			  CURLOPT_CUSTOMREQUEST => "GET",
			  CURLOPT_HTTPHEADER => array(
			    "Accept: */*",
			    "Accept-Encoding: gzip, deflate",
			    "Authorization: Bearer ".$access_token,
			    "Cache-Control: no-cache",
			    "Connection: keep-alive",
			    "Host: mybusiness.googleapis.com",
			    "cache-control: no-cache"
			  ),
			));

			$response = curl_exec($curl2);
			$err = curl_error($curl2);

			curl_close($curl2);

			if ($err) {
			  $gmb_connection_status = 'false';
			} else {
			  $gmb_connection_status = 'true';
			}
			 $account_data_array 	 = json_decode($response, TRUE);

			 $gmb_opening_time_array = $account_data_array['regularHours']['periods'];

			 foreach ($gmb_opening_time_array as $gmb_opening_time_array_val) {
			 	//Sun
			 	if($gmb_opening_time_array_val['openDay'] === 'SUNDAY'){
			 		if($gmb_opening_time_array_val['closeTime'] === '24:00'){
			 			$wp_grv_gmb_business_24hr_sun 	= 'true';
			 			$wp_grv_open_close_status_sun 	= 'true';
			 		}else{
			 			$wp_grv_gmb_business_24hr_sun 	= 'false';
			 			$wp_grv_open_close_status_sun 	= 'true';
			 			$wp_grv_gmb_business_open_sun 	= date('h:i a', strtotime($gmb_opening_time_array_val['openTime']));
			 			$wp_grv_gmb_business_close_sun	= date('h:i a', strtotime($gmb_opening_time_array_val['closeTime']));
			 		}
			 	}
			 	//Mon
			 	if($gmb_opening_time_array_val['openDay'] === 'MONDAY'){
			 		if($gmb_opening_time_array_val['closeTime'] === '24:00'){
			 			$wp_grv_gmb_business_24hr_mon 	= 'true';
			 			$wp_grv_open_close_status_mon 	= 'true';
			 		}else{
			 			$wp_grv_gmb_business_24hr_mon 	= 'false';
			 			$wp_grv_open_close_status_mon 	= 'true';
			 			$wp_grv_gmb_business_open_mon 	= date('h:i a', strtotime($gmb_opening_time_array_val['openTime']));
			 			$wp_grv_gmb_business_close_mon	= date('h:i a', strtotime($gmb_opening_time_array_val['closeTime']));
			 		}
			 	}
			 	//Tue
			 	if($gmb_opening_time_array_val['openDay'] === 'TUESDAY'){
			 		if($gmb_opening_time_array_val['closeTime'] === '24:00'){
			 			$wp_grv_gmb_business_24hr_tue 	= 'true';
			 			$wp_grv_open_close_status_tue 	= 'true';
			 		}else{
			 			$wp_grv_gmb_business_24hr_tue 	= 'false';
			 			$wp_grv_open_close_status_tue 	= 'true';
			 			$wp_grv_gmb_business_open_tue 	= date('h:i a', strtotime($gmb_opening_time_array_val['openTime']));
			 			$wp_grv_gmb_business_close_tue	= date('h:i a', strtotime($gmb_opening_time_array_val['closeTime']));
			 		}
			 	}
			 	//Wed
			 	if($gmb_opening_time_array_val['openDay'] === 'WEDNESDAY'){
			 		if($gmb_opening_time_array_val['closeTime'] === '24:00'){
			 			$wp_grv_gmb_business_24hr_wed 	= 'true';
			 			$wp_grv_open_close_status_wed 	= 'true';
			 		}else{
			 			$wp_grv_gmb_business_24hr_wed 	= 'false';
			 			$wp_grv_open_close_status_wed 	= 'true';
			 			$wp_grv_gmb_business_open_wed 	= date('h:i a', strtotime($gmb_opening_time_array_val['openTime']));
			 			$wp_grv_gmb_business_close_wed	= date('h:i a', strtotime($gmb_opening_time_array_val['closeTime']));
			 		}
			 	}
			 	//Thu
			 	if($gmb_opening_time_array_val['openDay'] === 'THURSDAY'){
			 		if($gmb_opening_time_array_val['closeTime'] === '24:00'){
			 			$wp_grv_gmb_business_24hr_thu 	= 'true';
			 			$wp_grv_open_close_status_thu 	= 'true';
			 		}else{
			 			$wp_grv_gmb_business_24hr_thu 	= 'false';
			 			$wp_grv_open_close_status_thu 	= 'true';
			 			$wp_grv_gmb_business_open_thu 	= date('h:i a', strtotime($gmb_opening_time_array_val['openTime']));
			 			$wp_grv_gmb_business_close_thu	= date('h:i a', strtotime($gmb_opening_time_array_val['closeTime']));
			 		}
			 	}
			 	//Fri
			 	if($gmb_opening_time_array_val['openDay'] === 'FRIDAY'){
			 		if($gmb_opening_time_array_val['closeTime'] === '24:00'){
			 			$wp_grv_gmb_business_24hr_fri 	= 'true';
			 			$wp_grv_open_close_status_fri 	= 'true';
			 		}else{
			 			$wp_grv_gmb_business_24hr_fri 	= 'false';
			 			$wp_grv_open_close_status_fri 	= 'true';
			 			$wp_grv_gmb_business_open_fri 	= date('h:i a', strtotime($gmb_opening_time_array_val['openTime']));
			 			$wp_grv_gmb_business_close_fri	= date('h:i a', strtotime($gmb_opening_time_array_val['closeTime']));
			 		}
			 	}
			 	//Sat
			 	if($gmb_opening_time_array_val['openDay'] === 'SATURDAY'){
			 		if($gmb_opening_time_array_val['closeTime'] === '24:00'){
			 			$wp_grv_gmb_business_24hr_sat 	= 'true';
			 			$wp_grv_open_close_status_sat 	= 'true';
			 		}else{
			 			$wp_grv_gmb_business_24hr_sat 	= 'false';
			 			$wp_grv_open_close_status_sat 	= 'true';
			 			$wp_grv_gmb_business_open_sat 	= date('h:i a', strtotime($gmb_opening_time_array_val['openTime']));
			 			$wp_grv_gmb_business_close_sat	= date('h:i a', strtotime($gmb_opening_time_array_val['closeTime']));
			 		}
			 	}
			 }
			// Hours enable check box values
			$wp_grv_business_hours_data   		= get_option( 'wp_grv_business_hours_data' );
			$wp_grv_open_close_status_sun 		= isset($wp_grv_open_close_status_sun)?$wp_grv_open_close_status_sun:'false';
			$wp_grv_open_close_status_mon 		= isset($wp_grv_open_close_status_mon)?$wp_grv_open_close_status_mon:'false';
			$wp_grv_open_close_status_tue 		= isset($wp_grv_open_close_status_tue)?$wp_grv_open_close_status_tue:'false';
			$wp_grv_open_close_status_wed 		= isset($wp_grv_open_close_status_wed)?$wp_grv_open_close_status_wed:'false';
			$wp_grv_open_close_status_thu 		= isset($wp_grv_open_close_status_thu)?$wp_grv_open_close_status_thu:'false';
			$wp_grv_open_close_status_fri 		= isset($wp_grv_open_close_status_fri)?$wp_grv_open_close_status_fri:'false';
			$wp_grv_open_close_status_sat 		= isset($wp_grv_open_close_status_sat)?$wp_grv_open_close_status_sat:'false';
			//open and close time
			$wp_grv_gmb_business_open_sun 		= isset($wp_grv_gmb_business_open_sun)?$wp_grv_gmb_business_open_sun:'';
			$wp_grv_gmb_business_close_sun		= isset($wp_grv_gmb_business_close_sun)?$wp_grv_gmb_business_close_sun:'';
			$wp_grv_gmb_business_open_mon 		= isset($wp_grv_gmb_business_open_mon)?$wp_grv_gmb_business_open_mon:'';
			$wp_grv_gmb_business_close_mon		= isset($wp_grv_gmb_business_close_mon)?$wp_grv_gmb_business_close_mon:'';
			$wp_grv_gmb_business_open_tue 		= isset($wp_grv_gmb_business_open_tue)?$wp_grv_gmb_business_open_tue:'';
			$wp_grv_gmb_business_close_tue		= isset($wp_grv_gmb_business_close_tue)?$wp_grv_gmb_business_close_tue:'';
			$wp_grv_gmb_business_open_wed 		= isset($wp_grv_gmb_business_open_wed)?$wp_grv_gmb_business_open_wed:'';
			$wp_grv_gmb_business_close_wed		= isset($wp_grv_gmb_business_close_wed)?$wp_grv_gmb_business_close_wed:'';
			$wp_grv_gmb_business_open_thu 		= isset($wp_grv_gmb_business_open_thu)?$wp_grv_gmb_business_open_thu:'';
			$wp_grv_gmb_business_close_thu		= isset($wp_grv_gmb_business_close_thu)?$wp_grv_gmb_business_close_thu:'';
			$wp_grv_gmb_business_open_fri 		= isset($wp_grv_gmb_business_open_fri)?$wp_grv_gmb_business_open_fri:'';
			$wp_grv_gmb_business_close_fri		= isset($wp_grv_gmb_business_close_fri)?$wp_grv_gmb_business_close_fri:'';
			$wp_grv_gmb_business_open_sat 		= isset($wp_grv_gmb_business_open_sat)?$wp_grv_gmb_business_open_sat:'';
			$wp_grv_gmb_business_close_sat		= isset($wp_grv_gmb_business_close_sat)?$wp_grv_gmb_business_close_sat:'';
			// 24hours enable check box values
			$wp_grv_gmb_business_24hr_sun 		= isset($wp_grv_gmb_business_24hr_sun)?$wp_grv_gmb_business_24hr_sun:'false';
			$wp_grv_gmb_business_24hr_mon 		= isset($wp_grv_gmb_business_24hr_mon)?$wp_grv_gmb_business_24hr_mon:'false';
			$wp_grv_gmb_business_24hr_tue 		= isset($wp_grv_gmb_business_24hr_tue)?$wp_grv_gmb_business_24hr_tue:'false';
			$wp_grv_gmb_business_24hr_wed 		= isset($wp_grv_gmb_business_24hr_wed)?$wp_grv_gmb_business_24hr_wed:'false';
			$wp_grv_gmb_business_24hr_thu 		= isset($wp_grv_gmb_business_24hr_thu)?$wp_grv_gmb_business_24hr_thu:'false';
			$wp_grv_gmb_business_24hr_fri 		= isset($wp_grv_gmb_business_24hr_fri)?$wp_grv_gmb_business_24hr_fri:'false';
			$wp_grv_gmb_business_24hr_sat 		= isset($wp_grv_gmb_business_24hr_sat)?$wp_grv_gmb_business_24hr_sat:'false';
			?>
			<!--- Sunday -->
			<tr>
				<td><label class="wp_grv_gmb_business_hr_day"> Sunday </label></td>
				<td><label class="wp_grv_gmb_business_hours_check_box_style"><input day="sun" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_status" <?php if($wp_grv_open_close_status_sun === 'true'){echo "checked";} ?> type="checkbox"  name="wp_grv_gmb_business_hr_sun" id="wp_grv_gmb_business_hr_sun"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label></td>
				<td><span class="wp_grv_gmb_business_hours_span wp_grv_gmb_business_hours_span_sun"> Close </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_sun wp_grv_gmb_business_hr_td_visibility_24hr_sun" style="<?php if(($wp_grv_open_close_status_sun === 'false')||($wp_grv_gmb_business_24hr_sun === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Opens at" value="<?php echo $wp_grv_gmb_business_open_sun; ?>" name="wp_grv_gmb_business_hr_sun_open" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_sun_open">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_sun wp_grv_gmb_business_hr_td_visibility_24hr_sun" style="<?php if(($wp_grv_open_close_status_sun === 'false')||($wp_grv_gmb_business_24hr_sun === 'true')){echo "display: none;";} ?>"><span class="wp_grv_gmb_business_hours_span"> - </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_sun wp_grv_gmb_business_hr_td_visibility_24hr_sun" style="<?php if(($wp_grv_open_close_status_sun === 'false')||($wp_grv_gmb_business_24hr_sun === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Closes at" value="<?php echo $wp_grv_gmb_business_close_sun; ?>" name="wp_grv_gmb_business_hr_sun_close" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_sun_close">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_sun" style="<?php if($wp_grv_open_close_status_sun === 'false'){echo "display: none;";} ?>"><label class="wp_grv_gmb_business_hours_check_box_style"><input day="sun" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_time" <?php if($wp_grv_gmb_business_24hr_sun === 'true'){echo "checked";} ?> type="checkbox" name="wp_grv_gmb_business_sun_24hr" id="wp_grv_gmb_business_24hr_sun"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label><span class="wp_grv_gmb_business_hours_span">24 hours</span></td>
			</tr>
			<!--- Monday -->
			<tr>
				<td><label class="wp_grv_gmb_business_hr_day"> Monday </label></td>
				<td><label class="wp_grv_gmb_business_hours_check_box_style"><input day="mon" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_status" type="checkbox" <?php if($wp_grv_open_close_status_mon === 'true'){echo "checked";} ?> name="wp_grv_gmb_business_hr_mon" id="wp_grv_gmb_business_hr_mon"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label></td>
				<td><span class="wp_grv_gmb_business_hours_span wp_grv_gmb_business_hours_span_mon"> Close </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_mon wp_grv_gmb_business_hr_td_visibility_24hr_mon" style="<?php if(($wp_grv_open_close_status_mon === 'false')||($wp_grv_gmb_business_24hr_mon === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Opens at" value="<?php echo $wp_grv_gmb_business_open_mon; ?>" name="wp_grv_gmb_business_hr_mon_open" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_mon_open">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_mon wp_grv_gmb_business_hr_td_visibility_24hr_mon" style="<?php if(($wp_grv_open_close_status_mon === 'false')||($wp_grv_gmb_business_24hr_mon === 'true')){echo "display: none;";} ?>"><span class="wp_grv_gmb_business_hours_span"> - </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_mon wp_grv_gmb_business_hr_td_visibility_24hr_mon" style="<?php if(($wp_grv_open_close_status_mon === 'false')||($wp_grv_gmb_business_24hr_mon === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Closes at" value="<?php echo $wp_grv_gmb_business_close_mon; ?>" name="wp_grv_gmb_business_hr_mon_close" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_mon_close">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_mon" style="<?php if($wp_grv_open_close_status_mon === 'false'){echo "display: none;";} ?>"><label class="wp_grv_gmb_business_hours_check_box_style"><input day="mon" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_time" <?php if($wp_grv_gmb_business_24hr_mon === 'true'){echo "checked";} ?> type="checkbox" name="wp_grv_gmb_business_mon_24hr" id="wp_grv_gmb_business_24hr_mon"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label><span class="wp_grv_gmb_business_hours_span">24 hours</span></td>
			</tr>
			<!--- Tuesday -->
			<tr>
				<td><label class="wp_grv_gmb_business_hr_day"> Tuesday </label></td>
				<td><label class="wp_grv_gmb_business_hours_check_box_style"><input day="tue" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_status" type="checkbox" <?php if($wp_grv_open_close_status_tue === 'true'){echo "checked";} ?> name="wp_grv_gmb_business_hr_tue" id="wp_grv_gmb_business_hr_tue"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label></td>
				<td><span class="wp_grv_gmb_business_hours_span wp_grv_gmb_business_hours_span_tue"> Close </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_tue wp_grv_gmb_business_hr_td_visibility_24hr_tue" style="<?php if(($wp_grv_open_close_status_tue === 'false')||($wp_grv_gmb_business_24hr_tue === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Opens at" value="<?php echo $wp_grv_gmb_business_open_tue; ?>" name="wp_grv_gmb_business_hr_tue_open" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_tue_open">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_tue wp_grv_gmb_business_hr_td_visibility_24hr_tue" style="<?php if(($wp_grv_open_close_status_tue === 'false')||($wp_grv_gmb_business_24hr_tue === 'true')){echo "display: none;";} ?>"><span class="wp_grv_gmb_business_hours_span"> - </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_tue wp_grv_gmb_business_hr_td_visibility_24hr_tue" style="<?php if(($wp_grv_open_close_status_tue === 'false')||($wp_grv_gmb_business_24hr_tue === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Closes at" value="<?php echo $wp_grv_gmb_business_close_tue; ?>" name="wp_grv_gmb_business_hr_tue_close" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_tue_close">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_tue" style="<?php if($wp_grv_open_close_status_tue === 'false'){echo "display: none;";} ?>"><label class="wp_grv_gmb_business_hours_check_box_style"><input day="tue" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_time" <?php if($wp_grv_gmb_business_24hr_tue === 'true'){echo "checked";} ?> type="checkbox" name="wp_grv_gmb_business_tue_24hr" id="wp_grv_gmb_business_24hr_tue"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label><span class="wp_grv_gmb_business_hours_span">24 hours</span></td>
			</tr>
			<!--- Wednesday -->
			<tr>
				<td><label class="wp_grv_gmb_business_hr_day"> Wednesday </label></td>
				<td><label class="wp_grv_gmb_business_hours_check_box_style"><input day="wed" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_status" type="checkbox" <?php if($wp_grv_open_close_status_wed === 'true'){echo "checked";} ?> name="wp_grv_gmb_business_hr_wed" id="wp_grv_gmb_business_hr_wed"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label></td>
				<td><span class="wp_grv_gmb_business_hours_span wp_grv_gmb_business_hours_span_wed"> Close </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_wed wp_grv_gmb_business_hr_td_visibility_24hr_wed" style="<?php if(($wp_grv_open_close_status_wed === 'false')||($wp_grv_gmb_business_24hr_wed === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Opens at" value="<?php echo $wp_grv_gmb_business_open_wed; ?>" name="wp_grv_gmb_business_hr_wed_open" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_wed_open">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_wed wp_grv_gmb_business_hr_td_visibility_24hr_wed" style="<?php if(($wp_grv_open_close_status_wed === 'false')||($wp_grv_gmb_business_24hr_wed === 'true')){echo "display: none;";} ?>"><span class="wp_grv_gmb_business_hours_span"> - </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_wed wp_grv_gmb_business_hr_td_visibility_24hr_wed" style="<?php if(($wp_grv_open_close_status_wed === 'false')||($wp_grv_gmb_business_24hr_wed === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Closes at" value="<?php echo $wp_grv_gmb_business_close_wed; ?>" name="wp_grv_gmb_business_hr_wed_close" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_wed_close">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_wed" style="<?php if($wp_grv_open_close_status_wed === 'false'){echo "display: none;";} ?>"><label class="wp_grv_gmb_business_hours_check_box_style"><input day="wed" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_time" <?php if($wp_grv_gmb_business_24hr_wed === 'true'){echo "checked";} ?> type="checkbox" name="wp_grv_gmb_business_wed_24hr" id="wp_grv_gmb_business_24hr_wed"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label><span class="wp_grv_gmb_business_hours_span">24 hours</span></td>
			</tr>
			<!--- Thursday -->
			<tr>
				<td><label class="wp_grv_gmb_business_hr_day"> Thursday </label></td>
				<td><label class="wp_grv_gmb_business_hours_check_box_style"><input day="thu" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_status" type="checkbox" <?php if($wp_grv_open_close_status_thu === 'true'){echo "checked";} ?> name="wp_grv_gmb_business_hr_thu" id="wp_grv_gmb_business_hr_thu"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label></td>
				<td><span class="wp_grv_gmb_business_hours_span wp_grv_gmb_business_hours_span_thu"> Close </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_thu wp_grv_gmb_business_hr_td_visibility_24hr_thu" style="<?php if(($wp_grv_open_close_status_thu === 'false')||($wp_grv_gmb_business_24hr_thu === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Opens at" value="<?php echo $wp_grv_gmb_business_open_thu; ?>" name="wp_grv_gmb_business_hr_thu_open" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_thu_open">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_thu wp_grv_gmb_business_hr_td_visibility_24hr_thu" style="<?php if(($wp_grv_open_close_status_thu === 'false')||($wp_grv_gmb_business_24hr_thu === 'true')){echo "display: none;";} ?>"><span class="wp_grv_gmb_business_hours_span"> - </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_thu wp_grv_gmb_business_hr_td_visibility_24hr_thu" style="<?php if(($wp_grv_open_close_status_thu === 'false')||($wp_grv_gmb_business_24hr_thu === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Closes at" value="<?php echo $wp_grv_gmb_business_close_thu; ?>" name="wp_grv_gmb_business_hr_thu_close" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_thu_close">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_thu" style="<?php if($wp_grv_open_close_status_thu === 'false'){echo "display: none;";} ?>"><label class="wp_grv_gmb_business_hours_check_box_style"><input day="thu" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_time" <?php if($wp_grv_gmb_business_24hr_thu === 'true'){echo "checked";} ?> type="checkbox" name="wp_grv_gmb_business_thu_24hr" id="wp_grv_gmb_business_24hr_thu"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label><span class="wp_grv_gmb_business_hours_span">24 hours</span></td>
			</tr>
			<!--- Friday -->
			<tr>
				<td><label class="wp_grv_gmb_business_hr_day"> Friday </label></td>
				<td><label class="wp_grv_gmb_business_hours_check_box_style"><input day="fri" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_status" type="checkbox" <?php if($wp_grv_open_close_status_fri === 'true'){echo "checked";} ?> name="wp_grv_gmb_business_hr_fri" id="wp_grv_gmb_business_hr_fri"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label></td>
				<td><span class="wp_grv_gmb_business_hours_span wp_grv_gmb_business_hours_span_fri"> Close </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_fri wp_grv_gmb_business_hr_td_visibility_24hr_fri" style="<?php if(($wp_grv_open_close_status_fri === 'false')||($wp_grv_gmb_business_24hr_fri === 'true')){echo "display: none;";} ?>" >
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Opens at" value="<?php echo $wp_grv_gmb_business_open_fri; ?>" name="wp_grv_gmb_business_hr_fri_open" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_fri_open">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_fri wp_grv_gmb_business_hr_td_visibility_24hr_fri" style="<?php if(($wp_grv_open_close_status_fri === 'false')||($wp_grv_gmb_business_24hr_fri === 'true')){echo "display: none;";} ?>"><span class="wp_grv_gmb_business_hours_span"> - </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_fri wp_grv_gmb_business_hr_td_visibility_24hr_fri" style="<?php if(($wp_grv_open_close_status_fri === 'false')||($wp_grv_gmb_business_24hr_fri === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Closes at" value="<?php echo $wp_grv_gmb_business_close_fri; ?>" name="wp_grv_gmb_business_hr_fri_close" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_fri_close">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_fri" style="<?php if($wp_grv_open_close_status_fri === 'false'){echo "display: none;";} ?>"><label class="wp_grv_gmb_business_hours_check_box_style"><input day="fri" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_time" type="checkbox" <?php if($wp_grv_gmb_business_24hr_fri === 'true'){echo "checked";} ?> name="wp_grv_gmb_business_fri_24hr" id="wp_grv_gmb_business_24hr_fri"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label><span class="wp_grv_gmb_business_hours_span">24 hours</span></td>
			</tr>
			<!--- Saturday -->
			<tr>
				<td><label class="wp_grv_gmb_business_hr_day"> Saturday </label></td>
				<td><label class="wp_grv_gmb_business_hours_check_box_style"><input day="sat" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_status" type="checkbox" <?php if($wp_grv_open_close_status_sat === 'true'){echo "checked";} ?> name="wp_grv_gmb_business_hr_sat" id="wp_grv_gmb_business_hr_sat"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label></td>
				<td><span class="wp_grv_gmb_business_hours_span wp_grv_gmb_business_hours_span_sat"> Close </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_sat wp_grv_gmb_business_hr_td_visibility_24hr_sat" style="<?php if(($wp_grv_open_close_status_sat === 'false')||($wp_grv_gmb_business_24hr_sat === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Opens at" value="<?php echo $wp_grv_gmb_business_open_sat; ?>" name="wp_grv_gmb_business_hr_sat_open" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_sat_open">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_sat wp_grv_gmb_business_hr_td_visibility_24hr_sat" style="<?php if(($wp_grv_open_close_status_sat === 'false')||($wp_grv_gmb_business_24hr_sat === 'true')){echo "display: none;";} ?>"><span class="wp_grv_gmb_business_hours_span"> - </span></td>
				<td class="wp_grv_gmb_business_hr_td_visibility_sat wp_grv_gmb_business_hr_td_visibility_24hr_sat" style="<?php if(($wp_grv_open_close_status_sat === 'false')||($wp_grv_gmb_business_24hr_sat === 'true')){echo "display: none;";} ?>">
					<div class="ui-widget">
		  				<label for="wp_grv_gmb_business_hr_field"></label>
						<input type="text" placeholder="Closes at" value="<?php echo $wp_grv_gmb_business_close_sat; ?>" name="wp_grv_gmb_business_hr_sat_close" class="wp_grv_gmb_business_hr_field" id="wp_grv_gmb_business_hr_sat_close">
					</div>	
				</td>
				<td class="wp_grv_gmb_business_hr_td_visibility_sat" style="<?php if($wp_grv_open_close_status_sat === 'false'){echo "display: none;";} ?>"><label class="wp_grv_gmb_business_hours_check_box_style"><input day="sat" class="wp_grv_gmb_business_check_box wp_grv_gmb_business_check_box_time" <?php if($wp_grv_gmb_business_24hr_sat === 'true'){echo "checked";} ?> type="checkbox" name="wp_grv_gmb_business_sat_24hr" id="wp_grv_gmb_business_24hr_sat"><span class="wp_grv_gmb_business_hours_slider wp_grv_gmb_business_hours_check_box_round"></span></label><span class="wp_grv_gmb_business_hours_span">24 hours</span></td>
			</tr>
		<?php
		}//gmb_fetch_loc_sett if condition ends
		exit();
	 } 
	/**
	 * Function for delete gmb location
	 * @author Ek
	 */ 
	 public static function wp_grv_select_location_delete_fun(){
		$deleted_location         		= $_POST['deleted_location'];
	 	$gmb_loc 						= get_option( 'wp_grv_gmb_location_settings' );
	 	$wp_grv_selected_locations_db   = $gmb_loc['gmb_selected_locations'];
	 	$wp_grv_select_location 		= $gmb_loc['gmb_location'];
	 	$wp_grv_select_location_name 	= $gmb_loc['gmb_location_name'];
	 	$key = array_search($deleted_location, $wp_grv_selected_locations_db);
		if (false !== $key) {
		    unset($wp_grv_selected_locations_db[$key]);
		}
		$wp_grv_selected_location_count = count($wp_grv_selected_locations_db);
		foreach ($wp_grv_selected_locations_db as $key => $value) {
			$wp_grv_select_location 		= $value;
			$wp_grv_select_location_name 	= $key;
		}
		if($wp_grv_selected_location_count == 0){
			$wp_grv_select_location 		= 'null';
			$wp_grv_select_location_name 	= 'null';
			$wp_grv_selected_locations_db 	= 'null';
		}	
	 	$gmb_location_settings_dat = array(
		         "gmb_location"         	=> $wp_grv_select_location,
		         "gmb_location_name"    	=> $wp_grv_select_location_name,
		         'gmb_selected_locations' 	=> $wp_grv_selected_locations_db,
		      );
		update_option('wp_grv_gmb_location_settings',$gmb_location_settings_dat);
		$gmb_loc 		= get_option( 'wp_grv_gmb_location_settings' );
		$gmb_loc_fetch 	= $gmb_loc['gmb_location'];
		if(isset($gmb_loc_fetch )) {
			if($gmb_loc_fetch != 'null'){
				include_once 'wp-grv-gmb-business-hours-ajax-call.php';
			}else{
				?>
				<span class="wp_grv_location_select_notice"><?php echo esc_html_e( 'Location not selected.', 'wp-gratify-lang' );?></span>
				<?php
			}
		}else{
			?>
			<span class="wp_grv_location_select_notice"><?php echo esc_html_e( 'Location not selected.', 'wp-gratify-lang' );?></span>
			<?php
		}
		exit();
	 }
	 /*
	  * function for insert social proofing data to database
	  * return void
	 */ 
	 public static function wp_grv_social_proofing_insert_settings(){
	 	$wp_grv_sc_pr_rating          		  		= $_POST['wp_grv_sc_pr_rating'];
	 	$wp_grv_sc_pr_cat                         	= $_POST['wp_grv_sc_pr_cat'];
	 	$wp_grv_sc_pr_tm_invl                      	= $_POST['wp_grv_sc_pr_tm_invl'];
		$wp_grv_sc_pr_not_stay                      = $_POST['wp_grv_sc_pr_not_stay'];
		$wp_grv_social_proofing_bg_color       		= $_POST['wp_grv_social_proofing_bg_color'];
		$wp_grv_social_proofing_text_size_name     	= $_POST['wp_grv_social_proofing_text_size_name'];
		$wp_grv_social_proofing_text_size_contents 	= $_POST['wp_grv_social_proofing_text_size_contents'];
		$wp_grv_social_proofing_position_sel       	= $_POST['wp_grv_social_proofing_position_sel'];
		$wp_grv_mobile_enable                      	= $_POST['wp_grv_mobile_enable'];
		$wp_grv_sp_title_enable                     = $_POST['wp_grv_sp_title_enable'];
		$wp_grv_sp_powered_by_enable                = $_POST['wp_grv_sp_powered_by_enable'];
		$wp_grv_sp_character_limit                  = $_POST['wp_grv_sp_character_limit'];
		$wp_grv_sp_img_border_radius                = $_POST['wp_grv_sp_img_border_radius'];
		$wp_grv_sp_img_size                         = $_POST['wp_grv_sp_img_size'];
		$wp_grv_sp_font_color_name                  = $_POST['wp_grv_sp_font_color_name'];
		$wp_grv_sp_font_color_review                = $_POST['wp_grv_sp_font_color_review'];
		$social_proofing_settings_dat = array(
		    "social_proofing_rating"    	  		=> $wp_grv_sc_pr_rating,
		    "social_proofing_category"  	  		=> $wp_grv_sc_pr_cat,
		    "social_proofing_time_invl" 	  		=> $wp_grv_sc_pr_tm_invl,
			"social_proofing_notification_stay"     => $wp_grv_sc_pr_not_stay,
		    "social_proofing_bg_color"           	=> $wp_grv_social_proofing_bg_color,
			"social_proofing_text_size_name"     	=> $wp_grv_social_proofing_text_size_name,
			"social_proofing_text_size_contents" 	=> $wp_grv_social_proofing_text_size_contents,
			"social_proofing_position_sel"       	=> $wp_grv_social_proofing_position_sel,
			"social_proofing_mobile_enable"      	=> $wp_grv_mobile_enable,
			"social_proofing_title_enable"      	=> $wp_grv_sp_title_enable,   
			"social_proofing_powered_by_enable"     => $wp_grv_sp_powered_by_enable,
			"social_proofing_character_limit"       => $wp_grv_sp_character_limit,
			"social_proofing_img_border_radius"     => $wp_grv_sp_img_border_radius,
			"social_proofing_img_size"              => $wp_grv_sp_img_size,
			"social_proofing_font_color_name"       => $wp_grv_sp_font_color_name,
			"social_proofing_font_color_review"     => $wp_grv_sp_font_color_review
		  );
		  update_option('social_proofing_settings',$social_proofing_settings_dat);
		exit();
	 }
	 /*
	  * function for insert gmp data to database
	  * return void
	 */ 
	 public static function wp_grv_gmp_insert_settings(){
	  //unic code generation
	  $d                    = date ("d");
	  $m                    = date ("m");
	  $y                    = date ("Y");
	  $t                    = time();
	  $dmt                  = $d+$m+$y+$t;    
	  $ran                  = rand(0,10000000);
	  $dmtran               = $dmt+$ran;
	  $un                   = uniqid();
	  $dmtun                = $dmtran.$un;
	  $mdun                 = md5($dmtran.$un);
	  $unic_code            = substr($mdun, 0, 10);
	  $wp_grv_unic_code     = strtoupper($unic_code);
	  $wp_grv_gmp_id        = $_POST['wp_grv_gmp_id'];
	  if($wp_grv_gmp_id === ''){
		$gmb_unic_id = $wp_grv_unic_code;
	  }
	  else{
		$gmb_unic_id = $wp_grv_gmp_id;
	  }  
		$redirect_url         = admin_url('/admin.php?page=settings-menu#rv_gmb_tab');
		echo 'https://wpgratify.com/gmb-login?auth='.$gmb_unic_id.'&status=1&redirect='.$redirect_url;  
		exit();
	 }
	
	// GMB Reconnect function.
	 public static function wp_grv_gmp_reconnect_fun(){
	  $wp_grv_gmp_id        = $_POST['wp_grv_gmp_id'];
	  $redirect_url         = admin_url('/admin.php?page=settings-menu#rv_gmb_tab');
		echo 'https://wpgratify.com/gmb-login?auth='.$wp_grv_gmp_id.'&status=0&conn=reconnect&redirect='.$redirect_url;  
		exit();
	 }

	 /*
	  * function for insert invitation data to database
	  * return void
	 */ 
	 public static function wp_grv_invite_insert_settings(){
	  $wp_grv_invite_from          = $_POST['wp_grv_invite_from'];
	 	$wp_grv_invite_days          = $_POST['wp_grv_invite_days'];
	 	$wp_grv_invite_email_content = $_POST['wp_grv_invite_email_content'];
	  $wp_grv_invite_link_ckeck       = $_POST['wp_grv_invite_link'];
	  if( substr($wp_grv_invite_link_ckeck, 0, 4) === 'http'){
	   $wp_grv_invite_link            = $wp_grv_invite_link_ckeck;
	  }
	  else {
	   $wp_grv_invite_link            = 'http://'.$wp_grv_invite_link_ckeck;
	  }
	 	$wp_grv_invitation_repeat    = $_POST['wp_grv_invitation_repeat'];
		    $invitation_sett       = array(
		         "invitaion_from"          => $wp_grv_invite_from,
		         "invitaion_days"          => $wp_grv_invite_days,
		         "invitaion_email_content" => $wp_grv_invite_email_content,
		         "invitaion_link"          => $wp_grv_invite_link,
		         "invitation_repeat"       => $wp_grv_invitation_repeat
		      );
		  update_option('invitation_settings',$invitation_sett);
		exit();
	 }
	/*
	  * function for insert invitation data to database
	  * return void
	 */ 
	 public static function wp_grv_rv_intake_insert_settings(){
	 	$wp_grv_disp_with_rating     = $_POST['wp_grv_disp_with_rating'];
	 	$wp_grv_auto_post            = $_POST['wp_grv_auto_post'];
	 	$wp_grv_thk_msg_social_media = $_POST['wp_grv_thk_msg_social_media'];
	 	$wp_grv_thk_msg              = $_POST['wp_grv_thk_msg'];
	 	$wp_grv_usr_img_url          = $_POST['wp_grv_usr_img_url'];
	  $wp_grv_archieve_pg_sel      = $_POST['wp_grv_archieve_pg_sel'];
	  $wp_grv_intake_pg_sel        = $_POST['wp_grv_intake_pg_sel'];
	  $wp_grv_archieve_update_data = array(
		  'ID'           => $wp_grv_archieve_pg_sel,
		  'post_content' => '[wp_grv_review_card]',
	  ); 
	  // Update the post into the database
	  wp_update_post( $wp_grv_archieve_update_data );
	  //for review intake form shortcode
	  $wp_grv_intake_update_data = array(
		  'ID'           => $wp_grv_intake_pg_sel,
		  'post_content' => '[wp_grv_review_intake_form]',
	  ); 
	  // Update intake page id into the database
	  wp_update_post( $wp_grv_intake_update_data );
	  $review_intake_sett        = array(
		         "display_with_rating"        => $wp_grv_disp_with_rating,
		         "auto_post"                  => $wp_grv_auto_post,
		         "thank_you_msg_social_media" => $wp_grv_thk_msg_social_media,
		         "thank_you_msg"              => $wp_grv_thk_msg,
		         "user_image"                 => $wp_grv_usr_img_url,
		         "archieve_page_id"           => $wp_grv_archieve_pg_sel,
		         "review_intake_page_id"      => $wp_grv_intake_pg_sel
		      );
		  update_option('review_intake_settings',$review_intake_sett);
		exit();
	 }
	 /*
	  * function for insert company details data to database
	  * return void
	 */ 
	 public static function wp_grv_cmp_details_insert_settings(){
		$wp_grv_organization_schema_enable     	= $_POST['wp_grv_organization_schema_enable'];
	 	$wp_grv_cmp_name        				= $_POST['wp_grv_cmp_name'];
	 	$wp_grv_cmp_logo_url    				= $_POST['wp_grv_cmp_logo_url'];
	 	$wp_grv_cmp_email       				= $_POST['wp_grv_cmp_email'];
	 	$wp_grv_cmp_adr_1       				= $_POST['wp_grv_cmp_adr_1'];
	 	$wp_grv_cmp_adr_2       				= $_POST['wp_grv_cmp_adr_2'];
	 	$wp_grv_cmp_city        				= $_POST['wp_grv_cmp_city'];
	 	$wp_grv_cmp_state       				= $_POST['wp_grv_cmp_state'];
	 	$wp_grv_cmp_country     				= $_POST['wp_grv_cmp_country'];
	 	$wp_grv_rv_cmp_zip_code 				= $_POST['wp_grv_rv_cmp_zip_code'];
		$cmp_sett_data = array(
				 "organization_schema_enable"         => $wp_grv_organization_schema_enable,
		         "company_name"  					  => $wp_grv_cmp_name,
		         "company_logo"     				  => $wp_grv_cmp_logo_url,
		         "company_email"    				  => $wp_grv_cmp_email,
		         "company_add_l1"   				  => $wp_grv_cmp_adr_1,
		         "company_add_l2"   				  => $wp_grv_cmp_adr_2,
		         "company_city"     				  => $wp_grv_cmp_city,
		         "company_state"    				  => $wp_grv_cmp_state,
		         "company_country"  				  => $wp_grv_cmp_country,
		         "company_zip_code" 				  => $wp_grv_rv_cmp_zip_code
		      );
		  update_option('schema_settings',$cmp_sett_data);
	   ?>
	   <!-- company details changes in admin bar (notification bar) -->
	   <?php $wp_grv_notification_data = get_option('schema_settings');
		    if(strlen($wp_grv_notification_data['company_name']) >= 10){
		      $wp_grv_cmp_name = substr( $wp_grv_notification_data['company_name'], 0, 10).'..';
		    }
		    else{
		      $wp_grv_cmp_name = $wp_grv_notification_data['company_name'];
		    }
		    // taking notification count from comment table
		    global $wpdb;
		    $comment_tbl = $wpdb->prefix . 'comments';
		    $wp_grv_notification_count = '0';
		    $comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC",ARRAY_A);
		    foreach ($comment_tbl_data as $value_comment_tbl_data){
		      $rv_id_fetch = $value_comment_tbl_data['comment_ID'];
		      $key = "comment_extras";
		      $comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
		      foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
		        $wp_grv_notification_flag= $comment_meta_data_fetch_value['review_notification_flag'];
		        if($wp_grv_notification_flag === '1'){
		          $wp_grv_notification_count   = $wp_grv_notification_count + 1;
		        }
		      }
		      if($wp_grv_notification_flag === '0'){
		          //exit();
		      }          
		    }
		?>
		<a class="wp_grv_bell_hover" style="color: #ffff;" href="<?php echo admin_url( '/admin.php?page=all_review_menu' ); ?>"><i class="fa fa-bell"></i></a><span class="wp_grv_notification_count" <?php if($wp_grv_notification_count === '0'){ echo 'style = "display: none"';} ?>><?php echo $wp_grv_notification_count; ?></span>&nbsp;&nbsp;
		<a class="wp_grv_settings_icon_hover" style="color: #ffff;" href="<?php echo admin_url( '/admin.php?page=settings-menu' ); ?>"><i class="fa fa-cog" style="margin-left: 15px;"></i></a></span>&nbsp;&nbsp;&nbsp; 
		<a style="text-decoration: none; color: #ffff;" href="<?php echo admin_url( '/admin.php?page=settings-menu' ); ?>"><span id="wp_grv_notification_user_hover"><img style="width:25px; position: relative; top: 4px;" src="<?php echo $wp_grv_notification_data['company_logo']; ?>" style="width:30px;">&nbsp;&nbsp;<span style="font-size: initial; font-weight: 700;"><?php echo $wp_grv_cmp_name; ?></span></span></a>
		<?php
		exit();
	 }
	 /*
	  * function for insert social review details data to database
	  * return void
	 */ 
	 public static function wp_grv_social_review_insert_settings(){
	 	$wp_grv_google_check        = $_POST['wp_grv_google_check'];
	 	$wp_grv_fb_check            = $_POST['wp_grv_fb_check'];
	 	$wp_grv_twitter_check       = $_POST['wp_grv_twitter_check'];
	 	$wp_grv_custom_check        = $_POST['wp_grv_custom_check'];
	  $wp_grv_google_logo_url     = $_POST['wp_grv_google_logo_url'];
	  $wp_grv_google_link_ckeck   = $_POST['wp_grv_google_link'];
	  if( substr($wp_grv_google_link_ckeck, 0, 4) === 'http'){
	   $wp_grv_google_link        = $wp_grv_google_link_ckeck;
	  }
	  else {
	   $wp_grv_google_link        = 'http://'.$wp_grv_google_link_ckeck;
	  }
	 	$wp_grv_fb_logo_url         = $_POST['wp_grv_fb_logo_url'];
	 	$wp_grv_fb_link_ckeck       = $_POST['wp_grv_fb_link'];
	  if( substr($wp_grv_fb_link_ckeck, 0, 4) === 'http'){
	   $wp_grv_fb_link            = $wp_grv_fb_link_ckeck;
	  }
	  else {
	   $wp_grv_fb_link            = 'http://'.$wp_grv_fb_link_ckeck;
	  }
	 	$wp_grv_twitter_logo_url    = $_POST['wp_grv_twitter_logo_url'];
	  $wp_grv_twitter_link_ckeck  = $_POST['wp_grv_twitter_link'];
	  if( substr($wp_grv_twitter_link_ckeck, 0, 4) === 'http'){
	   $wp_grv_twitter_link       = $wp_grv_twitter_link_ckeck;
	  }
	  else {
	   $wp_grv_twitter_link       = 'http://'.$wp_grv_twitter_link_ckeck;
	  }
	 	$wp_grv_custom_title        = $_POST['wp_grv_custom_title'];
	 	$wp_grv_custom_logo_url     = $_POST['wp_grv_custom_logo_url'];
	  $wp_grv_custom_link_ckeck   = $_POST['wp_grv_custom_link'];
	  if( substr($wp_grv_custom_link_ckeck, 0, 4) === 'http'){
	   $wp_grv_custom_link        = $wp_grv_custom_link_ckeck;
	  }
	  else {
	   $wp_grv_custom_link        = 'http://'.$wp_grv_custom_link_ckeck;
	  }
	 	$wp_grv_custom_title2       = $_POST['wp_grv_custom_title2'];
	 	$wp_grv_custom_logo2_url    = $_POST['wp_grv_custom_logo2_url'];

	  $wp_grv_custom_link2_ckeck  = $_POST['wp_grv_custom_link2'];
	  if( substr($wp_grv_custom_link2_ckeck, 0, 4) === 'http'){
	   $wp_grv_custom_link2       = $wp_grv_custom_link2_ckeck;
	  }
	  else {
	   $wp_grv_custom_link2       = 'http://'.$wp_grv_custom_link2_ckeck;
	  }
	 	$wp_grv_custom_title3       = $_POST['wp_grv_custom_title3'];
	 	$wp_grv_custom_logo3_url    = $_POST['wp_grv_custom_logo3_url'];
	  $wp_grv_custom_link3_ckeck  = $_POST['wp_grv_custom_link3'];
	  if( substr($wp_grv_custom_link3_ckeck, 0, 4) === 'http'){
	   $wp_grv_custom_link3       = $wp_grv_custom_link3_ckeck;
	  }
	  else {
	   $wp_grv_custom_link3       = 'http://'.$wp_grv_custom_link3_ckeck;
	  }
		$social_review_settings_dat = array(
		         "google_check"  => $wp_grv_google_check,
		         "google_logo"   => $wp_grv_google_logo_url,
		         "google_link"   => $wp_grv_google_link,
		         "fb_check"      => $wp_grv_fb_check,
		         "fb_logo"       => $wp_grv_fb_logo_url,
		         "fb_link"       => $wp_grv_fb_link,
		         "twitter_check" => $wp_grv_twitter_check,
		         "twitter_logo"  => $wp_grv_twitter_logo_url,
		         "twitter_link"  => $wp_grv_twitter_link,
		         "custom_check"  => $wp_grv_custom_check,
		         "custom_title"  => $wp_grv_custom_title,
		         "custom_logo"   => $wp_grv_custom_logo_url,
		         "custom_link"   => $wp_grv_custom_link,
		         "custom_title2" => $wp_grv_custom_title2,
		         "custom_logo2"  => $wp_grv_custom_logo2_url,
		         "custom_link2"  => $wp_grv_custom_link2,
		         "custom_title3" => $wp_grv_custom_title3,
		         "custom_logo3"  => $wp_grv_custom_logo3_url,
		         "custom_link3"  => $wp_grv_custom_link3
		      );
		  update_option('social_review_setting',$social_review_settings_dat);
		exit();
	 }
	


   /*
  	* function to insert gmb alert post
  	* return void
  	*/
	public static function wp_grv_gmb_alert_post_insert_settings(){
		$wp_grv_gmb_write_post 					= filter_input(INPUT_POST,'wp_grv_gmb_write_post');
		$wp_grv_gmb_add_alert_post_btn_type 	= filter_input(INPUT_POST,'wp_grv_gmb_add_alert_post_button_list');
		$wp_grv_gmb_add_alert_post_button_link 	= filter_input(INPUT_POST,'add_alert_post_button_link');
		$wp_grv_select_location_name 			= filter_input(INPUT_POST,'wp_grv_select_location_name');
		$wp_grv_select_location 				= filter_input(INPUT_POST,'wp_grv_select_location');
	    /*GMB connection*/
	    $gmb_fetch_sett = get_option( 'gmb_settings' );
		$gmb_fetch_loc_sett = get_option( 'wp_grv_gmb_location_settings' );
		// acess acesstoken throung rest api
		$gmb_id = $gmb_fetch_sett['gmb_id'];
		$gmb_location = $wp_grv_select_location;
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"Accept: */*",
		"Accept-Encoding: gzip, deflate",
		"Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
		"Cache-Control: no-cache",
		"Connection: keep-alive",
		"Host: wpgratify.com",
		"cache-control: no-cache"
		),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$access_token = trim($response, '"');
		/*alert post */
		if($wp_grv_gmb_add_alert_post_btn_type == 'none'){
			$query = array('languageCode' => 'en-US','summary' => $wp_grv_gmb_write_post, 'topicType'=>'ALERT', 'alertType'=>'COVID_19');
	    }else{
		$query = array('languageCode' => 'en-US','summary' => $wp_grv_gmb_write_post, 'topicType'=>'ALERT', 'alertType'=>'COVID_19','callToAction' => array('actionType' => $wp_grv_gmb_add_alert_post_btn_type,'url'=>$wp_grv_gmb_add_alert_post_button_link));
	    }
		$request_uri = "https://mybusiness.googleapis.com/v4/".$gmb_location."/localPosts?access_token=" . $access_token;
		$curinit = curl_init($request_uri);
		curl_setopt($curinit, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curinit, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curinit, CURLOPT_POSTFIELDS, json_encode($query));
		curl_setopt($curinit, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curinit, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen(json_encode($query)))
		);
		$json 	= curl_exec($curinit);
		$phpObj = json_decode($json, true);
		//var_dump($phpObj);
		global $wpdb;
		$wp_grv_gmb_add_alert_posts_tbl = $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
		$wp_grv_gmb_add_alert_posts_data_array = array(
			'alert_post_img_url'		=>$wp_grv_gmb_add_alert_post_img,
			'post_details'				=>$wp_grv_gmb_write_post,
			'alert_post_button' 		=>$wp_grv_gmb_add_alert_post_btn_type,
			'alert_post_button_link' 	=>$wp_grv_gmb_add_alert_post_button_link,
			'alert_post_location_name'	=>$wp_grv_select_location_name,
			'alert_post_location' 		=>$wp_grv_select_location,
			'alert_gmb_post_url' 		=>$phpObj['name']
		);
		$serialized_array_alert_post = serialize($wp_grv_gmb_add_alert_posts_data_array);
		$wpdb->insert($wp_grv_gmb_add_alert_posts_tbl , array(
			'post_type'  		=> 'alert_post',
			'data'    			=> $serialized_array_alert_post
		),
		array( '%s','%s',));   
		exit();
	}



   /*
  	* function to insert gmb new post
  	* return void
  	*/
	public static function wp_grv_gmb_new_post_insert_settings(){
		$wp_grv_gmb_add_new_posts_submit 		= filter_input(INPUT_POST,'save_changes_gmb_new_post');
		$wp_grv_gmb_add_new_post_img  			= filter_input(INPUT_POST,'gmb_add_new_post_image_url');
		$wp_grv_gmb_write_post 					= filter_input(INPUT_POST,'wp_grv_gmb_write_post');
		$wp_grv_gmb_add_new_post_btn_type 		= filter_input(INPUT_POST,'wp_grv_gmb_add_new_post_button_list');
		$wp_grv_gmb_add_new_post_button_link 	= filter_input(INPUT_POST,'add_new_post_button_link');
		$wp_grv_select_location_name 			= filter_input(INPUT_POST,'wp_grv_select_location_name');
		$wp_grv_select_location 				= filter_input(INPUT_POST,'wp_grv_select_location');
	    /*GMB connection*/
	    $gmb_fetch_sett = get_option( 'gmb_settings' );
		$gmb_fetch_loc_sett = get_option( 'wp_grv_gmb_location_settings' );
		// acess acesstoken throung rest api
		$gmb_id = $gmb_fetch_sett['gmb_id'];
		$gmb_location = $wp_grv_select_location;
		$curl = curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"Accept: */*",
		"Accept-Encoding: gzip, deflate",
		"Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
		"Cache-Control: no-cache",
		"Connection: keep-alive",
		"Host: wpgratify.com",
		"cache-control: no-cache"
		),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$access_token = trim($response, '"');
		/*new post */
		if($wp_grv_gmb_add_new_post_btn_type == 'none'){
			$query = array('languageCode' => 'en-US','summary' => $wp_grv_gmb_write_post,'media' => array('mediaFormat' => 'PHOTO','sourceUrl' => $wp_grv_gmb_add_new_post_img));
	    }
		else if($wp_grv_gmb_add_new_post_btn_type == 'call'){
			$query = array('languageCode' => 'en-US','summary' => $wp_grv_gmb_write_post,'callToAction' => array('actionType' => $wp_grv_gmb_add_new_post_btn_type),'media' => array('mediaFormat' => 'PHOTO','sourceUrl' => $wp_grv_gmb_add_new_post_img));
		}
		else{
		$query = array('languageCode' => 'en-US','summary' => $wp_grv_gmb_write_post,'callToAction' => array('actionType' => $wp_grv_gmb_add_new_post_btn_type,'url'=>$wp_grv_gmb_add_new_post_button_link),'media' => array('mediaFormat' => 'PHOTO','sourceUrl' => $wp_grv_gmb_add_new_post_img));
	    }
		$request_uri = "https://mybusiness.googleapis.com/v4/".$gmb_location."/localPosts?access_token=" . $access_token;
		$curinit = curl_init($request_uri);
		curl_setopt($curinit, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curinit, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curinit, CURLOPT_POSTFIELDS, json_encode($query));
		curl_setopt($curinit, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curinit, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen(json_encode($query)))
		);
		$json = curl_exec($curinit);
		$phpObj = json_decode($json, true);
		//var_dump($phpObj);
		global $wpdb;
		$wp_grv_gmb_add_new_posts_tbl = $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
		$wp_grv_gmb_add_new_posts_data_array = array(
			'new_post_img_url'			=>$wp_grv_gmb_add_new_post_img,
			'post_details'				=>$wp_grv_gmb_write_post,
			'new_post_button' 			=>$wp_grv_gmb_add_new_post_btn_type,
			'new_post_button_link' 		=>$wp_grv_gmb_add_new_post_button_link,
			'new_post_location_name'	=>$wp_grv_select_location_name,
			'new_post_location' 		=>$wp_grv_select_location,
			'new_gmb_post_url' 			=>$phpObj['name']
		);
		$serialized_array_new_post = serialize($wp_grv_gmb_add_new_posts_data_array);
		$wpdb->insert($wp_grv_gmb_add_new_posts_tbl , array(
			'post_type'  		=> 'new_post',
			'data'    			=> $serialized_array_new_post
		),
		array( '%s','%s',));   
		exit();
	}
	public static function wp_grv_gmb_event_post_settings(){
    	$wp_grv_gmb_add_new_event_submit 		= filter_input(INPUT_POST,'save_changes_gmb_add_event');
		$wp_grv_gmb_add_new_event_img  			= filter_input(INPUT_POST,'gmb_add_event_image_url');
		$wp_grv_gmb_event_title 				= filter_input(INPUT_POST,'wp_grv_event_title');
		$wp_grv_gmb_add_time 					= filter_input(INPUT_POST,'gmb_add_time');
		$wp_grv_gmb_start_date 					= filter_input(INPUT_POST,'wp_grv_start_date');
		$wp_grv_gmb_start_time 					= filter_input(INPUT_POST,'wp_grv_start_time');
		$wp_grv_gmb_end_date 					= filter_input(INPUT_POST,'wp_grv_end_date');
		$wp_grv_gmb_end_time 					= filter_input(INPUT_POST,'wp_grv_end_time');
		$wp_grv_gmb_event_more_options 			= filter_input(INPUT_POST,'gmb_event_more_options');
		$wp_grv_gmb_event_details 				= filter_input(INPUT_POST,'wp_grv_gmb_event_details');
		$wp_grv_gmb_event_button_type 			= filter_input(INPUT_POST,'wp_grv_gmb_add_event_button_list');
		$wp_grv_gmb_event_button_link 			= filter_input(INPUT_POST,'add_event_button_link');
		$date_split_event_start_date_year 		= date('Y',strtotime($wp_grv_gmb_start_date));
		$date_split_event_start_date_month 		= date('m',strtotime($wp_grv_gmb_start_date));
		$date_split_event_start_date_day 		= date('d',strtotime($wp_grv_gmb_start_date));
		$date_split_event_end_date_year   		= date('Y',strtotime($wp_grv_gmb_end_date));
		$date_split_event_end_date_month  		= date('m',strtotime($wp_grv_gmb_end_date));
		$date_split_event_end_date_day   		= date('d',strtotime($wp_grv_gmb_end_date));
		$time_convert_event_hours_start_time   	= date('H',strtotime($wp_grv_gmb_start_time));
		$time_convert_event_minutes_start_time 	= date('i',strtotime($wp_grv_gmb_start_time));
		$time_convert_event_hours_end_time   	= date('H',strtotime($wp_grv_gmb_end_time));
		$time_convert_event_minutes_end_time 	= date('i',strtotime($wp_grv_gmb_end_time));
		$add_event_select_location_name 		= filter_input(INPUT_POST,'add_event_select_location_name');
		$add_event_select_location  				= filter_input(INPUT_POST,'add_event_select_location');
		/*GMB connection */
		$gmb_fetch_sett 	= get_option( 'gmb_settings' );
		$gmb_fetch_loc_sett = get_option( 'wp_grv_gmb_location_settings' );
		// acess acesstoken throung rest api
		$gmb_id 			= $gmb_fetch_sett['gmb_id'];
		$gmb_location 		= $add_event_select_location;
		$curl 				= curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"Accept: */*",
		"Accept-Encoding: gzip, deflate",
		"Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
		"Cache-Control: no-cache",
		"Connection: keep-alive",
		"Host: wpgratify.com",
		"cache-control: no-cache"
		),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$access_token = trim($response, '"');
		/*event post */
		if($wp_grv_gmb_event_button_type == 'none'){
			$query = array('languageCode' => 'en-US','summary' => $wp_grv_gmb_event_details,'event' => array('title' => $wp_grv_gmb_event_title,'schedule' => array('startDate'=> array('year' => $date_split_event_start_date_year,'month' => $date_split_event_start_date_month,'day'=> $date_split_event_start_date_day),'startTime'=>array('hours'=>$time_convert_event_hours_start_time,'minutes'=>$time_convert_event_minutes_start_time),'endDate'=>array('year' => $date_split_event_end_date_year,'month' => $date_split_event_end_date_month,'day'=> $date_split_event_end_date_day),'endTime'=>array('hours'=>$time_convert_event_hours_end_time,'minutes'=>$time_convert_event_minutes_end_time))),'media' => array('mediaFormat' => 'PHOTO','sourceUrl' => $wp_grv_gmb_add_new_event_img));
		}
		else if($wp_grv_gmb_event_button_type == 'call'){
			$query = array('languageCode' => 'en-US','summary' => $wp_grv_gmb_event_details,'callToAction' => array('actionType' => $wp_grv_gmb_event_button_type),'event' => array('title' => $wp_grv_gmb_event_title,'schedule' => array('startDate'=> array('year' => $date_split_event_start_date_year,'month' => $date_split_event_start_date_month,'day'=> $date_split_event_start_date_day),'startTime'=>array('hours'=>$time_convert_event_hours_start_time,'minutes'=>$time_convert_event_minutes_start_time),'endDate'=>array('year' => $date_split_event_end_date_year,'month' => $date_split_event_end_date_month,'day'=> $date_split_event_end_date_day),'endTime'=>array('hours'=>$time_convert_event_hours_end_time,'minutes'=>$time_convert_event_minutes_end_time))),'media' => array('mediaFormat' => 'PHOTO','sourceUrl' => $wp_grv_gmb_add_new_event_img));
		}
		else{
		$query = array('languageCode' => 'en-US','summary' => $wp_grv_gmb_event_details,'callToAction' => array('actionType' => $wp_grv_gmb_event_button_type,'url'=>$wp_grv_gmb_event_button_link),'event' => array('title' => $wp_grv_gmb_event_title,'schedule' => array('startDate'=> array('year' => $date_split_event_start_date_year,'month' => $date_split_event_start_date_month,'day'=> $date_split_event_start_date_day),'startTime'=>array('hours'=>$time_convert_event_hours_start_time,'minutes'=>$time_convert_event_minutes_start_time),'endDate'=>array('year' => $date_split_event_end_date_year,'month' => $date_split_event_end_date_month,'day'=> $date_split_event_end_date_day),'endTime'=>array('hours'=>$time_convert_event_hours_end_time,'minutes'=>$time_convert_event_minutes_end_time))),'media' => array('mediaFormat' => 'PHOTO','sourceUrl' => $wp_grv_gmb_add_new_event_img));
		}
		$request_uri = "https://mybusiness.googleapis.com/v4/".$gmb_location."/localPosts?access_token=" . $access_token;
		$curinit = curl_init($request_uri);
		curl_setopt($curinit, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curinit, CURLOPT_CUSTOMREQUEST, 'POST');
		curl_setopt($curinit, CURLOPT_POSTFIELDS, json_encode($query));
		curl_setopt($curinit, CURLOPT_RETURNTRANSFER, true);
		curl_setopt($curinit, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen(json_encode($query)))
		);
		$json = curl_exec($curinit);
		$phpObj = json_decode($json, true);
		//var_dump($phpObj); 
		//print_r($phpObj);
		//echo $access_token;
		global $wpdb;
		$wp_grv_gmb_add_new_event_tbl 			= $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
		$wp_grv_gmb_add_new_event_data_array 	= array(
													'event_image_url'			=>$wp_grv_gmb_add_new_event_img,
													'event_title'				=>$wp_grv_gmb_event_title,
													'add_time' 					=>$wp_grv_gmb_add_time,
													'start_date' 				=>$wp_grv_gmb_start_date,
													'start_time' 				=>$wp_grv_gmb_start_time,
													'end_date' 					=>$wp_grv_gmb_end_date,
													'end_time' 					=>$wp_grv_gmb_end_time,
													'gmb_event_more_options'	=>$wp_grv_gmb_event_more_options,
													'event_details' 			=>$wp_grv_gmb_event_details,
													'event_button_type' 		=>$wp_grv_gmb_event_button_type,
													'event_button_link' 		=>$wp_grv_gmb_event_button_link,
													'event_select_location_name'=>$add_event_select_location_name,
													'event_select_location' 	=>$add_event_select_location,
													'event_gmb_post_url' 		=>$phpObj['name']
												);
		$serialized_array_event = serialize($wp_grv_gmb_add_new_event_data_array);
		$wpdb->insert($wp_grv_gmb_add_new_event_tbl , array(
					'post_type'  	=> 'event',
					'data'    		=> $serialized_array_event
					 ),
				array( '%s','%s',));  
		exit();
	}
     /*
	  * function for insert gmb reviews to db 
	  * return void
	  */ 
	public static function wp_grv_gmb_post_fetch_phone(){
	 	$wp_grv_gmb_details_array          =    $_POST['wp_grv_gmb_phone_number']; 
		$phone_number_from_array           =    $wp_grv_gmb_details_array['primaryPhone'];
        echo $phone_number_from_array; 
		exit();
	}
	/*
	  * function for single event post delete 
	  * return update table data
	 */ 
	public static function wp_grv_gmb_event_delete_fun(){
	 	$wp_grv_gmb_event_delete_id = filter_input(INPUT_POST,'wp_grv_gmb_event_delete_id');
	 	$wp_grv_gmb_event_location  = filter_input(INPUT_POST,'wp_grv_gmb_event_location');
	 	global $wpdb;
	 	$gmb_posts_tbl 		= $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
	    $gmb_posts_tbl_gmb_data = $wpdb->get_row( "SELECT data FROM $gmb_posts_tbl WHERE post_type='event' AND post_id = '".$wp_grv_gmb_event_delete_id."'",ARRAY_A);
	    $unserialized_gmb_event_array 	= unserialize( $gmb_posts_tbl_gmb_data['data']);
	    $event_gmb_post_url 			= $unserialized_gmb_event_array['event_gmb_post_url'];
		// delete post from GMB
		$gmb_fetch_sett 	= get_option( 'gmb_settings' );
		$gmb_fetch_loc_sett = get_option( 'wp_grv_gmb_location_settings' );
		// acess acesstoken throung rest api
		$gmb_id 			= $gmb_fetch_sett['gmb_id'];
		$gmb_location 		= $wp_grv_gmb_event_location;
		$curl 				= curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"Accept: */*",
		"Accept-Encoding: gzip, deflate",
		"Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
		"Cache-Control: no-cache",
		"Connection: keep-alive",
		"Host: wpgratify.com",
		"cache-control: no-cache"
		),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$access_token = trim($response, '"');
		$curl2 = curl_init();
		curl_setopt_array($curl2, array(
		  CURLOPT_URL => "https://mybusiness.googleapis.com/v4/".$event_gmb_post_url."?access_token=" . $access_token,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "DELETE",
		));
		$response = curl_exec($curl2);
		curl_close($curl2);

		$wpdb->query(
		    'DELETE FROM '.$wpdb->prefix.'wp_grv_gmb_posts_tbl WHERE post_id = "'.$wp_grv_gmb_event_delete_id.'"'
		);?>
		<thead>
		<tr>
			<th><?php echo _e( 'Event Title', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'Location', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'Start Date', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'End Date', 'wp-gratify-lang' ); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php
			$gmb_posts_tbl 		= $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
	        $gmb_posts_tbl_data = $wpdb->get_results( "SELECT * FROM $gmb_posts_tbl WHERE post_type='event'",ARRAY_A);
			foreach ($gmb_posts_tbl_data as $gmb_event_value){
				$event_id    					= $gmb_event_value['post_id'];
				$unserialized_gmb_event_array 	= unserialize( $gmb_event_value['data']);
				$event_title 					= $unserialized_gmb_event_array['event_title'];
				$event_start_date 				= $unserialized_gmb_event_array['start_date'];
				$event_end_date 				= $unserialized_gmb_event_array['end_date'];
				$event_select_location_name 	= $unserialized_gmb_event_array['event_select_location_name'];
				$event_select_location 			= $unserialized_gmb_event_array['add_event_select_location'];
				$event_gmb_post_url 			= $unserialized_gmb_event_array['event_gmb_post_url'];				
		?>
		<tr class="wp_grv_rv_event_tbl_row">
			<td>
				<span class="wp_grv_rv_delete_set"><a id="wp_grv_rv_event_delete" class="wp_grv_rv_event_delete_effect" location="<?=$event_select_location?>" data_id="<?php echo $event_id; ?>" title="Delete Post" href="#" ><i class="fa fa-trash-o"></i></a>
				</span>
				<span style="margin-left: 15%;"><?php echo _e( $event_title , 'wp-gratify-lang' );?></span>
			</td>
			<td style="text-align: center;"><?php echo _e( $event_select_location_name, 'wp-gratify-lang' ); ?></td>
			<td style="text-align: center;"><?php echo _e( $event_start_date, 'wp-gratify-lang' ); ?></td>
			<td style="text-align: center;"><?php echo _e( $event_end_date, 'wp-gratify-lang' ); ?></td>
		</tr>
				<?php
			}
		exit();
	} 
	/*
	 * function for single new post delete 
	 * return update table data
	 */ 
	public static function wp_grv_gmb_new_post_delete_fun(){
	 	$wp_grv_gmb_new_post_delete_id = filter_input(INPUT_POST,'wp_grv_gmb_new_post_delete_id');
	 	$wp_grv_gmb_new_post_location  = filter_input(INPUT_POST,'wp_grv_gmb_new_post_location');
	 	//gmb post delete
	 	global $wpdb;
	 	$gmb_posts_tbl 		= $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
	    $gmb_posts_tbl_gmb_data = $wpdb->get_row( "SELECT data FROM $gmb_posts_tbl WHERE post_type='new_post' AND post_id = '".$wp_grv_gmb_new_post_delete_id."'",ARRAY_A);
	    $unserialized_gmb_new_array 	= unserialize( $gmb_posts_tbl_gmb_data['data']);
	    $new_gmb_post_url 			= $unserialized_gmb_new_array['new_gmb_post_url'];
		// delete post from GMB
		$gmb_fetch_sett 	= get_option( 'gmb_settings' );
		$gmb_fetch_loc_sett = get_option( 'wp_grv_gmb_location_settings' );
		// acess acesstoken throung rest api
		$gmb_id 			= $gmb_fetch_sett['gmb_id'];
		$gmb_location 		= $wp_grv_gmb_new_post_location;
		$curl 				= curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"Accept: */*",
		"Accept-Encoding: gzip, deflate",
		"Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
		"Cache-Control: no-cache",
		"Connection: keep-alive",
		"Host: wpgratify.com",
		"cache-control: no-cache"
		),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$access_token = trim($response, '"');
		$curl2 = curl_init();
		curl_setopt_array($curl2, array(
		  CURLOPT_URL => "https://mybusiness.googleapis.com/v4/".$new_gmb_post_url."?access_token=" . $access_token,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "DELETE",
		));
		$response = curl_exec($curl2);
		curl_close($curl2);


		$wpdb->query(
		    'DELETE FROM '.$wpdb->prefix.'wp_grv_gmb_posts_tbl WHERE post_id = "'.$wp_grv_gmb_new_post_delete_id.'"'
		);?>
		<thead>
		<tr>
			<th><?php echo _e( 'Post', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'Location', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'Button', 'wp-gratify-lang' ); ?></th>
			
		</tr>
		</thead>
		<tbody>
		<?php
			$gmb_posts_tbl 		= $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
	        $gmb_posts_tbl_data = $wpdb->get_results( "SELECT * FROM $gmb_posts_tbl WHERE post_type='new_post'",ARRAY_A);
			foreach ($gmb_posts_tbl_data as $gmb_new_post_value){
				$new_post_id    					= $gmb_new_post_value['post_id'];
				$unserialized_gmb_new_post_array 	= unserialize( $gmb_new_post_value['data']);
				$new_post_details 					= $unserialized_gmb_new_post_array['post_details'];
				$new_post_button 					= $unserialized_gmb_new_post_array['new_post_button'];
				$new_post_location_name 			= $unserialized_gmb_new_post_array['new_post_location_name'];
				$new_post_location 					= $unserialized_gmb_new_post_array['new_post_location'];
		?>
		<tr class="wp_grv_rv_new_post_tbl_row">
			<td>
				<span class="wp_grv_rv_delete_new_post"><a id="wp_grv_rv_new_post_delete" class="wp_grv_rv_new_post_delete_effect" location="$new_post_location" data_id="<?php echo $new_post_id ; ?>" title="Delete Post" href="#" ><i class="fa fa-trash-o"></i></a>
		
				</span>
				<span style="margin-left: 15%;"><?php echo _e( $new_post_details, 'wp-gratify-lang' );?></span>
			</td>
			<td style="text-align: center;"><?php echo _e( $new_post_location_name, 'wp-gratify-lang' ); ?></td>
			<td style="text-align: center;"><?php echo _e( $new_post_button, 'wp-gratify-lang' ); ?></td>
		</tr>
	<?php
		}
		exit();
	}
	/*
	 * function for single alert post delete 
	 * return update table data
	 */ 
	public static function wp_grv_gmb_alert_post_delete_fun(){
	 	$wp_grv_gmb_alert_post_delete_id = filter_input(INPUT_POST,'wp_grv_gmb_alert_post_delete_id');
	 	$wp_grv_gmb_alert_post_location  = filter_input(INPUT_POST,'wp_grv_gmb_alert_post_location');
	 	//gmb post delete
	 	global $wpdb;
	 	$gmb_posts_tbl 		= $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
	    $gmb_posts_tbl_gmb_data = $wpdb->get_row( "SELECT data FROM $gmb_posts_tbl WHERE post_type='alert_post' AND post_id = '".$wp_grv_gmb_alert_post_delete_id."'",ARRAY_A);
	    $unserialized_gmb_alert_array 	= unserialize( $gmb_posts_tbl_gmb_data['data']);
	    $alert_gmb_post_url 			= $unserialized_gmb_alert_array['alert_gmb_post_url'];
		// delete post from GMB
		$gmb_fetch_sett 	= get_option( 'gmb_settings' );
		$gmb_fetch_loc_sett = get_option( 'wp_grv_gmb_location_settings' );
		// acess acesstoken throung rest api
		$gmb_id 			= $gmb_fetch_sett['gmb_id'];
		$gmb_location 		= $wp_grv_gmb_alert_post_location;
		$curl 				= curl_init();
		curl_setopt_array($curl, array(
		CURLOPT_URL => "https://wpgratify.com/wp-json/wp_grv_gmb/v1/token?id=".$gmb_id,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_ENCODING => "",
		CURLOPT_MAXREDIRS => 10,
		CURLOPT_TIMEOUT => 30,
		CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		CURLOPT_CUSTOMREQUEST => "GET",
		CURLOPT_HTTPHEADER => array(
		"Accept: */*",
		"Accept-Encoding: gzip, deflate",
		"Authorization: Bearer ya29.Il-FB6KV1po6sAXJCdncssMvfOe2MTzeISwQYX29iUt50WARP4C0Lgrz3dJQioK5YPodbxW11oDTWgyfVt2jzoRPhtHvDPqYrM-elbrfMJkdW5p-PLsqzBNxCq8y8TRybA",
		"Cache-Control: no-cache",
		"Connection: keep-alive",
		"Host: wpgratify.com",
		"cache-control: no-cache"
		),
		));
		$response = curl_exec($curl);
		$err = curl_error($curl);
		curl_close($curl);
		$access_token = trim($response, '"');
		$curl2 = curl_init();
		curl_setopt_array($curl2, array(
		  CURLOPT_URL => "https://mybusiness.googleapis.com/v4/".$alert_gmb_post_url."?access_token=" . $access_token,
		  CURLOPT_RETURNTRANSFER => true,
		  CURLOPT_ENCODING => "",
		  CURLOPT_MAXREDIRS => 10,
		  CURLOPT_TIMEOUT => 0,
		  CURLOPT_FOLLOWLOCATION => true,
		  CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
		  CURLOPT_CUSTOMREQUEST => "DELETE",
		));
		$response = curl_exec($curl2);
		curl_close($curl2);


		$wpdb->query(
		    'DELETE FROM '.$wpdb->prefix.'wp_grv_gmb_posts_tbl WHERE post_id = "'.$wp_grv_gmb_alert_post_delete_id.'"'
		);?>
		<thead>
		<tr>
			<th><?php echo _e( 'Post', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'Location', 'wp-gratify-lang' ); ?></th>
			<th><?php echo _e( 'Button', 'wp-gratify-lang' ); ?></th>
			
		</tr>
		</thead>
		<tbody>
		<?php
			$gmb_posts_tbl 		= $wpdb->prefix . 'wp_grv_gmb_posts_tbl';
	        $gmb_posts_tbl_data = $wpdb->get_results( "SELECT * FROM $gmb_posts_tbl WHERE post_type='alert_post'",ARRAY_A);
			foreach ($gmb_posts_tbl_data as $gmb_alert_post_value){
				$alert_post_id    					= $gmb_alert_post_value['post_id'];
				$unserialized_gmb_alert_post_array 	= unserialize( $gmb_alert_post_value['data']);
				$alert_post_details 				= $unserialized_gmb_alert_post_array['post_details'];
				$alert_post_button 					= $unserialized_gmb_alert_post_array['alert_post_button'];
				$alert_post_location_name 			= $unserialized_gmb_alert_post_array['alert_post_location_name'];
				$alert_post_location 				= $unserialized_gmb_alert_post_array['alert_post_location'];
		?>
		<tr class="wp_grv_rv_alert_post_tbl_row">
			<td>
				<span class="wp_grv_rv_delete_alert_post"><a id="wp_grv_rv_alert_post_delete" class="wp_grv_rv_alert_post_delete_effect" location="$alert_post_location" data_id="<?php echo $alert_post_id ; ?>" title="Delete Post" href="#" ><i class="fa fa-trash-o"></i></a>
		
				</span>
				<span style="margin-left: 15%;"><?php echo _e( $alert_post_details, 'wp-gratify-lang' );?></span>
			</td>
			<td style="text-align: center;"><?php echo _e( $alert_post_location_name, 'wp-gratify-lang' ); ?></td>
			<td style="text-align: center;"><?php echo _e( $alert_post_button, 'wp-gratify-lang' ); ?></td>
		</tr>
	<?php
		}
		exit();
	} 



		public static function wp_grv_settings_init(){
			add_action( 'wp_ajax_wp_grv_rv_gmb_business_hour_save_fun', __CLASS__.'::wp_grv_rv_gmb_business_hour_save_fun' );
	 		add_action( 'wp_ajax_nopriv_wp_grv_rv_gmb_business_hour_save_fun', __CLASS__.'::wp_grv_rv_gmb_business_hour_save_fun' ); 
			add_action( 'wp_ajax_wp_grv_gmb_location_fetch', __CLASS__.'::wp_grv_gmb_location_fetch' );
	 		add_action( 'wp_ajax_nopriv_wp_grv_gmb_location_fetch', __CLASS__.'::wp_grv_gmb_location_fetch' ); 
			add_action( 'wp_ajax_wp_grv_select_location_fetch_fun', __CLASS__.'::wp_grv_select_location_fetch_fun' );
			add_action( 'wp_ajax_nopriv_wp_grv_select_location_fetch_fun',__CLASS__.'::wp_grv_select_location_fetch_fun' );    
			add_action( 'wp_ajax_wp_grv_social_proofing_insert_settings', __CLASS__.'::wp_grv_social_proofing_insert_settings' );
			add_action( 'wp_ajax_nopriv_wp_grv_social_proofing_insert_settings',__CLASS__.'::wp_grv_social_proofing_insert_settings' );
			add_action( 'wp_ajax_wp_grv_gmp_insert_settings', __CLASS__.'::wp_grv_gmp_insert_settings' );
			add_action( 'wp_ajax_nopriv_wp_grv_gmp_insert_settings',__CLASS__.'::wp_grv_gmp_insert_settings' );
			add_action( 'wp_ajax_wp_grv_gmp_reconnect_fun', __CLASS__.'::wp_grv_gmp_reconnect_fun' );
			add_action( 'wp_ajax_nopriv_wp_grv_gmp_reconnect_fun',__CLASS__.'::wp_grv_gmp_reconnect_fun' );
			add_action( 'wp_ajax_wp_grv_invite_insert_settings', __CLASS__.'::wp_grv_invite_insert_settings' );
			add_action( 'wp_ajax_nopriv_wp_grv_invite_insert_settings',__CLASS__.'::wp_grv_invite_insert_settings' );
			add_action( 'wp_ajax_wp_grv_rv_intake_insert_settings', __CLASS__.'::wp_grv_rv_intake_insert_settings' );
			add_action( 'wp_ajax_nopriv_wp_grv_rv_intake_insert_settings',__CLASS__.'::wp_grv_rv_intake_insert_settings' );
			add_action( 'wp_ajax_wp_grv_cmp_details_insert_settings', __CLASS__.'::wp_grv_cmp_details_insert_settings' );
			add_action( 'wp_ajax_nopriv_wp_grv_cmp_details_insert_settings',__CLASS__.'::wp_grv_cmp_details_insert_settings' );
			add_action( 'wp_ajax_wp_grv_social_review_insert_settings', __CLASS__.'::wp_grv_social_review_insert_settings' );
			add_action( 'wp_ajax_nopriv_wp_grv_social_review_insert_settings',__CLASS__.'::wp_grv_social_review_insert_settings' );
			add_action( 'wp_ajax_wp_grv_gmb_new_post_insert_settings', __CLASS__.'::wp_grv_gmb_new_post_insert_settings' );
		    add_action( 'wp_ajax_nopriv_wp_grv_gmb_new_post_insert_settings',__CLASS__.'::wp_grv_gmb_new_post_insert_settings' );
			add_action( 'wp_ajax_wp_grv_gmb_event_post_settings', __CLASS__.'::wp_grv_gmb_event_post_settings' );
		    add_action( 'wp_ajax_nopriv_wp_grv_gmb_event_post_settings',__CLASS__.'::wp_grv_gmb_event_post_settings' );
			add_action( 'wp_ajax_wp_grv_gmb_post_fetch_phone', __CLASS__.'::wp_grv_gmb_post_fetch_phone' );
		    add_action( 'wp_ajax_nopriv_wp_grv_gmb_post_fetch_phone',__CLASS__.'::wp_grv_gmb_post_fetch_phone' );
			add_action( 'wp_ajax_wp_grv_gmb_event_delete_fun', __CLASS__.'::wp_grv_gmb_event_delete_fun' );
	        add_action( 'wp_ajax_nopriv_wp_grv_gmb_event_delete_fun',__CLASS__.'::wp_grv_gmb_event_delete_fun' );
			add_action( 'wp_ajax_wp_grv_gmb_new_post_delete_fun', __CLASS__.'::wp_grv_gmb_new_post_delete_fun' );
	        add_action( 'wp_ajax_nopriv_wp_grv_gmb_new_post_delete_fun',__CLASS__.'::wp_grv_gmb_new_post_delete_fun' );
	        add_action( 'wp_ajax_wp_grv_select_location_delete_fun', __CLASS__.'::wp_grv_select_location_delete_fun' );
	        add_action( 'wp_ajax_nopriv_wp_grv_select_location_delete_fun',__CLASS__.'::wp_grv_select_location_delete_fun' );
	        add_action( 'wp_ajax_wp_grv_select_location_for_business_hours', __CLASS__.'::wp_grv_select_location_for_business_hours' );
	        add_action( 'wp_ajax_nopriv_wp_grv_select_location_for_business_hours',__CLASS__.'::wp_grv_select_location_for_business_hours' );
	        add_action( 'wp_ajax_wp_grv_gmb_alert_post_insert_settings', __CLASS__.'::wp_grv_gmb_alert_post_insert_settings' );
	        add_action( 'wp_ajax_nopriv_wp_grv_gmb_alert_post_insert_settings',__CLASS__.'::wp_grv_gmb_alert_post_insert_settings' );
	        add_action( 'wp_ajax_wp_grv_gmb_alert_post_delete_fun', __CLASS__.'::wp_grv_gmb_alert_post_delete_fun' );
	        add_action( 'wp_ajax_nopriv_wp_grv_gmb_alert_post_delete_fun',__CLASS__.'::wp_grv_gmb_alert_post_delete_fun' );		
	}
}
Wp_Grv_Settings_Tbl_Operation::wp_grv_settings_init();
