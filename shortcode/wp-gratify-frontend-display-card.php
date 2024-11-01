<?php
	/*
	 * fuction to create frontend review card
	 * return void
	*/
function wp_grv_frontend_display_card_function( $wp_grv_rv_card_atts ) {
	ob_start();
	global $wpdb;
	?>
		<div class="wp_grv_card_container">
	<?php
	// Shortcode Attributes
	$wp_grv_rv_card_attributes    = shortcode_atts(
		array(
			'count'    => '',
			'category' => '',
			'orderby'  => '',
			'schema'   => 'false',
			
		),
		$wp_grv_rv_card_atts
	);
	$wp_grv_rv_card_count     	  		= $wp_grv_rv_card_attributes['count'];
	$wp_grv_rv_count          	  		= '0';
	$wp_grv_rv_card_category      		= $wp_grv_rv_card_attributes['category'];
	$wp_grv_rv_card_orderby       		= $wp_grv_rv_card_attributes['orderby'];
	$wp_grv_rv_card_schema	      		= $wp_grv_rv_card_attributes['schema'];
	$review_intake_fetch_settings 		= get_option( 'review_intake_settings' );
	$wp_grv_display_rating        		= $review_intake_fetch_settings['display_with_rating'];
	if($review_intake_fetch_settings == ''){
		echo "Please Confirm with wpgratify default review intake settings.";
	}
	if($wp_grv_rv_card_schema === 'true' && $wp_grv_rv_card_category != '' ){
		$category_review_count 				= 0;
		$category_review_count_one_star     = 0;
		$best_review_count_one_star         = 0;
		$category_review_count_two_star     = 0;
		$best_review_count_two_star         = 0;
		$category_review_count_three_star   = 0;
		$best_review_count_three_star       = 0;
		$category_review_count_four_star    = 0;
		$best_review_count_four_star        = 0;
		$category_review_count_five_star    = 0;
		$best_review_count_five_star        = 0;
		$best_review_rating					= 0;
		$total_rating_value					= 0;
		$comment_tbl 						= $wpdb->prefix . 'comments';
		$comment_tbl_data 					= $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review'", ARRAY_A );
		foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
				$rv_id_fetch_notfy       = $value_comment_tbl_data['comment_ID'];
				$key                     = 'comment_extras';
				$comment_meta_data_fetch = get_comment_meta( $rv_id_fetch_notfy, $key );
			
				foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
					$rv_category_fetch 			= $comment_meta_data_fetch_value['review_add_category'];
					$rv_rating_fetch 			= $comment_meta_data_fetch_value['review_rating'];
					if($wp_grv_rv_card_category == $rv_category_fetch){
						$category_review_count = $category_review_count+1;
						if($rv_rating_fetch == '5'){
						$category_review_count_five_star = $category_review_count_five_star+$rv_rating_fetch;
						$best_review_count_five_star = $best_review_count_five_star+1;
						}
						if($rv_rating_fetch == '4'){
						$category_review_count_four_star = $category_review_count_four_star+$rv_rating_fetch;
						$best_review_count_four_star = $best_review_count_four_star+1;
						}
						if($rv_rating_fetch == '3'){
						$category_review_count_three_star = $category_review_count_three_star+$rv_rating_fetch;
						$best_review_count_three_star = $best_review_count_three_star+1;
						}
						if($rv_rating_fetch == '2'){
						$category_review_count_two_star = $category_review_count_two_star+$rv_rating_fetch;
						$best_review_count_two_star = $best_review_count_two_star+1;
						}
						if($rv_rating_fetch == '1'){
						$category_review_count_one_star = $category_review_count_one_star+$rv_rating_fetch;
						$best_review_count_one_star = $best_review_count_one_star+1;
						}
				}
			}
			if($category_review_count != 0){
				$total_rating_value = ($category_review_count_five_star + $category_review_count_four_star + $category_review_count_three_star + $category_review_count_two_star + $category_review_count_one_star)/((int)$category_review_count);
			}
			$max_overall_rating = max($best_review_count_five_star,$best_review_count_four_star,$best_review_count_three_star,$best_review_count_two_star,$best_review_count_one_star);
			if($max_overall_rating != '0'){
			if($max_overall_rating == $best_review_count_five_star)
			$best_review_rating = '5';
			else if($max_overall_rating == $best_review_count_four_star)
			$best_review_rating = '4';
			else if($max_overall_rating == $best_review_count_three_star)
			$best_review_rating = '3';
			else if($max_overall_rating == $best_review_count_two_star)
			$best_review_rating = '2';
			else
			$best_review_rating = '1';
		}
	}
		global $wpdb;
		$category_tbl    	= $wpdb->prefix . 'wp_grv_category_list_tbl';
		$result_category 	= $wpdb->get_row( "SELECT * FROM $category_tbl WHERE category_name='$wp_grv_rv_card_category' ",ARRAY_A);
		$manual_enable 		= $result_category['manual'];
		if($manual_enable === 'true'){
			$total_reviews 	= $result_category['total_reviews'];
			$overall_rating = $result_category['overall_rating'];
			$best_review 	= $result_category['best_review'];
		}else{
			$total_reviews 	= $category_review_count;
			$overall_rating = $total_rating_value;
			$best_review 	= $best_review_rating;	
		}
		$wp_grv_schema_data = get_option( 'schema_settings' );
		?>
			<div class="wpgrv_overall_rating_block_section">
				<?php
				$overall_rating = (string)round($overall_rating);
				if ( $overall_rating === '1' ) {
					?>
								<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
					<?php
				} elseif ( $overall_rating === '2' ) {
					?>
								<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
						<?php
				} elseif ( $overall_rating === '3' ) {
					?>
								<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
					<?php
				} elseif ( $overall_rating === '4' ) {
					?>
								<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
					<?php
				} elseif ( $overall_rating === '5' ) {
					?>
								<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
					<?php
				} elseif ( $overall_rating === '0' ) {
					?>
								<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
					<?php
				} ?>
				<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
					<span itemprop="ratingValue" style="display:none;"><?php echo round($overall_rating);?></span>
   					<span itemprop="reviewCount" style="display:none;"><?php echo $total_reviews;?> </span>
  				</div>
				<p>Overall client rating is <?php echo $overall_rating; ?> out of 5 for <?php echo $wp_grv_schema_data['company_name']; ?> from <?php echo $total_reviews; ?> reviews.</p>
			</div>
		<?php
		


		
	}//schema true condition ends.
		// Checking conditions.
	global $wpdb;
	$comment_tbl = $wpdb->prefix . 'comments';
	if ( $wp_grv_rv_card_orderby != '' ) {
		$comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' AND comment_approved='true' ORDER BY comment_ID " . $wp_grv_rv_card_orderby, ARRAY_A );
	} else {
		$comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' AND comment_approved='true' ORDER BY comment_ID DESC", ARRAY_A );
	}

	foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
		$wp_grv_id_fetch         = $value_comment_tbl_data['comment_ID'];
		$wp_grv_author_fetch_val = $value_comment_tbl_data['comment_author'];
		$wp_grv_date_fetch       = $value_comment_tbl_data['comment_date'];
		$wp_grv_approved         = $value_comment_tbl_data['comment_approved'];
		$wp_grv_content          = $value_comment_tbl_data['comment_content'];
		$key                     = 'comment_extras';
		$comment_meta_data_fetch = get_comment_meta( $wp_grv_id_fetch, $key );
		foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
			$wp_grv_title               = $comment_meta_data_fetch_value['review_title'];
			$wp_grv_rating_fetch        = $comment_meta_data_fetch_value['review_rating'];
			$wp_grv_usr_img             = $comment_meta_data_fetch_value['review_user_image'];
			$wp_grv_category            = $comment_meta_data_fetch_value['review_add_category'];
			$rv_duplicate_details_check = $comment_meta_data_fetch_value['review_duplicate_details_check'];
			$rv_duplicate_name          = $comment_meta_data_fetch_value['review_duplicate_name'];
			$rv_duplicate_reason        = $comment_meta_data_fetch_value['review_duplicate_reason'];

			if ( $rv_duplicate_details_check === 'true' ) {
				$wp_grv_author_fetch = $rv_duplicate_name;
			} else {
				$wp_grv_author_fetch = $wp_grv_author_fetch_val;
			}
			if ( $wp_grv_rv_count == $wp_grv_rv_card_count ) { // if condition for finding count
				break;
			}
			if ( $wp_grv_display_rating === 'all' ) {
				if ( $wp_grv_rv_card_category != '' ) {
					if ( $wp_grv_rv_card_category === $wp_grv_category ) {
						if($wp_grv_rv_card_schema === 'false'){
						?>
								<div id="wp_grv_rv_card">
									<div class="wp_grv_card_img_block">
										<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
									</div>
									<div class="wp_grv_card_content_block">
										<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
										<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
										<div id="wp_grv_rv_star_rating">
									<?php
									if ( $wp_grv_rating_fetch === '1' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '2' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
											<?php
									} elseif ( $wp_grv_rating_fetch === '3' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '4' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '5' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
										<?php
									}
									?>
										</div>
										<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
									</div>
								</div>

							<?php
							$wp_grv_rv_count++;
						}//schema false condition check.
						if($wp_grv_rv_card_schema === 'true'){
							
							?>
							<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
								<span itemprop="ratingValue" style="display:none;"><?php echo round($overall_rating);?></span>
  								<span itemprop="reviewCount" style="display:none;"><?php echo $total_reviews;?></span>
  							</div>
							<div id="wp_grv_rv_card" itemprop="review" itemscope itemtype="http://schema.org/Review">
							<div class="wp_grv_card_img_block">
								<img id="wp_grv_rv_card_usr_img" itemprop="image" src=<?php echo $wp_grv_usr_img;?>>
							</div>
							
							<div class="wp_grv_card_content_block">
								<span itemprop="name" id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
								<span itemprop="description">
								<span itemprop="author" style="display:none;"><?php echo $wp_grv_author_fetch;?></span>
									<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p></span>
									<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
										<span itemprop="ratingValue"style="display:none;"><?php echo $wp_grv_rating_fetch;?></span>
											  <div id="wp_grv_rv_star_rating">
												<?php
												if ( $wp_grv_rating_fetch === '1' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '2' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
														<?php
												} elseif ( $wp_grv_rating_fetch === '3' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '4' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '5' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
													<?php
												}
						
												$wp_grv_rv_count++;
						?>
							</div>

								<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>			
							</div>
							</div>
						</div>
						<?php
						}//schema true condition check.
					}
				} else {
					?>
							<div id="wp_grv_rv_card">
								<div class="wp_grv_card_img_block">
									<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
								</div>
								<div class="wp_grv_card_content_block">
									<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
									<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
									<div id="wp_grv_rv_star_rating">
								<?php
								if ( $wp_grv_rating_fetch === '1' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '2' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '3' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '4' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '5' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
									<?php
								}
								?>
									</div>
									<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
								</div>
							</div>

						<?php
						$wp_grv_rv_count++;
				}
			} elseif ( ( $wp_grv_display_rating === 'below3' ) && ( ( $wp_grv_rating_fetch === '1' ) || ( $wp_grv_rating_fetch === '2' ) ) ) {
				if ( $wp_grv_rv_card_category != '' ) {
					if ( $wp_grv_rv_card_category === $wp_grv_category ) {
						if($wp_grv_rv_card_schema === 'false'){
						?>
								<div id="wp_grv_rv_card">
									<div class="wp_grv_card_img_block">
										<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
									</div>
									<div class="wp_grv_card_content_block">
										<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
										<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
										<div id="wp_grv_rv_star_rating">
									<?php
									if ( $wp_grv_rating_fetch === '1' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '2' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
											<?php
									} elseif ( $wp_grv_rating_fetch === '3' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '4' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '5' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
										<?php
									}
									?>
										</div>
										<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
									</div>
								</div>

							<?php
							$wp_grv_rv_count++;
						}//schema false condition check.
						if($wp_grv_rv_card_schema === 'true'){
							?>
							<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
								<span itemprop="ratingValue" style="display:none;"><?php echo round($overall_rating);?></span>
  								<span itemprop="reviewCount" style="display:none;"><?php echo $total_reviews;?></span>
  							</div>
							<div id="wp_grv_rv_card" itemprop="review" itemscope itemtype="http://schema.org/Review">
							<div class="wp_grv_card_img_block">
								<img id="wp_grv_rv_card_usr_img" itemprop="image" src=<?php echo $wp_grv_usr_img;?>>
							</div>
							
							<div class="wp_grv_card_content_block">
								<span itemprop="name" id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
								<span itemprop="description">
								<span itemprop="author" style="display:none;"><?php echo $wp_grv_author_fetch;?></span>
									<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p></span>
									<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
										<span itemprop="ratingValue"style="display:none;"><?php echo $wp_grv_rating_fetch;?></span>
											  <div id="wp_grv_rv_star_rating">
												<?php
												if ( $wp_grv_rating_fetch === '1' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '2' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
														<?php
												} elseif ( $wp_grv_rating_fetch === '3' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '4' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '5' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
													<?php
												}
						
												$wp_grv_rv_count++;
						?>
							</div>

								<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>			
							</div>
							</div>
						</div>
						<?php
						}//schema true condition check.
					}
				} else {
					?>
							<div id="wp_grv_rv_card">
								<div class="wp_grv_card_img_block">
									<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
								</div>
								<div class="wp_grv_card_content_block">
									<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
									<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
									<div id="wp_grv_rv_star_rating">
								<?php
								if ( $wp_grv_rating_fetch === '1' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '2' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '3' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '4' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '5' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
									<?php
								}
								?>
									</div>
									<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
								</div>
							</div>

						<?php
						$wp_grv_rv_count++;
				}
			} elseif ( ( $wp_grv_display_rating === '3andabove' ) && ( ( $wp_grv_rating_fetch === '3' ) || ( $wp_grv_rating_fetch === '4' ) || ( $wp_grv_rating_fetch === '5' ) ) ) {
				if ( $wp_grv_rv_card_category != '' ) {
					if ( $wp_grv_rv_card_category === $wp_grv_category ) {
						if($wp_grv_rv_card_schema === 'false'){
						?>
								<div id="wp_grv_rv_card">
									<div class="wp_grv_card_img_block">
										<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
									</div>
									<div class="wp_grv_card_content_block">
										<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
										<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
										<div id="wp_grv_rv_star_rating">
									<?php
									if ( $wp_grv_rating_fetch === '1' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '2' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
											<?php
									} elseif ( $wp_grv_rating_fetch === '3' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '4' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '5' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
										<?php
									}
									?>
										</div>
										<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
									</div>
								</div>

							<?php
							$wp_grv_rv_count++;
						}//schema false condition check.
						if($wp_grv_rv_card_schema === 'true'){
							?>
							<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
								<span itemprop="ratingValue" style="display:none;"><?php echo round($overall_rating);?></span>
  								<span itemprop="reviewCount" style="display:none;"><?php echo $total_reviews;?></span>
  							</div>
							<div id="wp_grv_rv_card" itemprop="review" itemscope itemtype="http://schema.org/Review">
							<div class="wp_grv_card_img_block">
								<img id="wp_grv_rv_card_usr_img" itemprop="image" src=<?php echo $wp_grv_usr_img;?>>
							</div>
							
							<div class="wp_grv_card_content_block">
								<span itemprop="name" id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
								<span itemprop="description">
								<span itemprop="author" style="display:none;"><?php echo $wp_grv_author_fetch;?></span>
									<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p></span>
									<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
										<span itemprop="ratingValue"style="display:none;"><?php echo $wp_grv_rating_fetch;?></span>
											  <div id="wp_grv_rv_star_rating">
												<?php
												if ( $wp_grv_rating_fetch === '1' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '2' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
														<?php
												} elseif ( $wp_grv_rating_fetch === '3' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '4' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '5' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
													<?php
												}
						
												$wp_grv_rv_count++;
						?>
							</div>

								<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>			
							</div>
							</div>
						</div>
						<?php
						}//schema true condition check.
					}
				} else {
					?>
							<div id="wp_grv_rv_card">
								<div class="wp_grv_card_img_block">
									<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
								</div>
								<div class="wp_grv_card_content_block">
									<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
									<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
									<div id="wp_grv_rv_star_rating">
								<?php
								if ( $wp_grv_rating_fetch === '1' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '2' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '3' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '4' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '5' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
									<?php
								}
								?>
									</div>
									<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
								</div>
							</div>

						<?php
						$wp_grv_rv_count++;
				}
			} elseif ( ( $wp_grv_display_rating === '4to5' ) && ( ( $wp_grv_rating_fetch === '4' ) || ( $wp_grv_rating_fetch === '5' ) ) ) {
				if ( $wp_grv_rv_card_category != '' ) {
					if ( $wp_grv_rv_card_category === $wp_grv_category ) {
						if($wp_grv_rv_card_schema === 'false'){
						?>
								<div id="wp_grv_rv_card">
									<div class="wp_grv_card_img_block">
										<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
									</div>
									<div class="wp_grv_card_content_block">
										<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
										<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
										<div id="wp_grv_rv_star_rating">
									<?php
									if ( $wp_grv_rating_fetch === '1' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '2' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
											<?php
									} elseif ( $wp_grv_rating_fetch === '3' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '4' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '5' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
										<?php
									}
									?>
										</div>
										<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
									</div>
								</div>

							<?php
							$wp_grv_rv_count++;
						}//schema false condition check.
						if($wp_grv_rv_card_schema === 'true'){
							?>
							<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
								<span itemprop="ratingValue" style="display:none;"><?php echo round($overall_rating);?></span>
  								<span itemprop="reviewCount" style="display:none;"><?php echo $total_reviews;?></span>
  							</div>
							<div id="wp_grv_rv_card" itemprop="review" itemscope itemtype="http://schema.org/Review">
							<div class="wp_grv_card_img_block">
								<img id="wp_grv_rv_card_usr_img" itemprop="image" src=<?php echo $wp_grv_usr_img;?>>
							</div>
							
							<div class="wp_grv_card_content_block">
								<span itemprop="name" id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
								<span itemprop="description">
								<span itemprop="author" style="display:none;"><?php echo $wp_grv_author_fetch;?></span>
									<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p></span>
									<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
										<span itemprop="ratingValue"style="display:none;"><?php echo $wp_grv_rating_fetch;?></span>
											  <div id="wp_grv_rv_star_rating">
												<?php
												if ( $wp_grv_rating_fetch === '1' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '2' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
														<?php
												} elseif ( $wp_grv_rating_fetch === '3' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '4' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
													<?php
												} elseif ( $wp_grv_rating_fetch === '5' ) {
													?>
																<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
													<?php
												}
						
												$wp_grv_rv_count++;
						?>
							</div>

								<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>			
							</div>
							</div>
						</div>
						<?php
						}//schema true condition check.
					}
				} else {
					?>
							<div id="wp_grv_rv_card">
								<div class="wp_grv_card_img_block">
									<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
								</div>
								<div class="wp_grv_card_content_block">
									<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
									<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
									<div id="wp_grv_rv_star_rating">
								<?php
								if ( $wp_grv_rating_fetch === '1' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '2' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '3' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '4' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
									<?php
								} elseif ( $wp_grv_rating_fetch === '5' ) {
									?>
												<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
									<?php
								}
								?>
									</div>
									<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
								</div>
							</div>

						<?php
						$wp_grv_rv_count++;
				}
			}
		}
	}
	?>
		</div><!-- wp_grv_card_container div ends -->
		<?php
		$output = ob_get_clean();
		return $output;
}
/*
 * adding frontend review card shortcode
 *
*/
add_shortcode( 'wp_grv_review_card', 'wp_grv_frontend_display_card_function' );

/* specific review display shortcode */
function wp_grv_frontend_display_single_card_function( $wp_grv_rv_card_atts ) {
	ob_start();
	global $wpdb;
	$comment_tbl = $wpdb->prefix . 'comments';
	$wp_grv_rv_card_attributes    = shortcode_atts(
		array(
			'id'    => '',
			'schema' => 'false',
		),
		$wp_grv_rv_card_atts
	);
	$wp_grv_rv_card_id     = $wp_grv_rv_card_attributes['id'];
	$wp_grv_rv_card_schema = $wp_grv_rv_card_attributes['schema'];
	if($wp_grv_rv_card_id !='' && $wp_grv_rv_card_schema === 'false'){
		$comment_tbl_data = $wpdb->get_row( "SELECT * FROM $comment_tbl WHERE comment_ID=$wp_grv_rv_card_id AND comment_approved='true'", ARRAY_A );

		$wp_grv_author_fetch_val = $comment_tbl_data['comment_author'];
		$wp_grv_date_fetch       = $comment_tbl_data['comment_date'];
		$wp_grv_approved         = $comment_tbl_data['comment_approved'];
		$wp_grv_content          = $comment_tbl_data['comment_content'];
		$key                     = 'comment_extras';
		$comment_meta_data_fetch = get_comment_meta( $wp_grv_rv_card_id, $key );
		foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
			$wp_grv_title               = $comment_meta_data_fetch_value['review_title'];
			$wp_grv_rating_fetch        = $comment_meta_data_fetch_value['review_rating'];
			$wp_grv_usr_img             = $comment_meta_data_fetch_value['review_user_image'];
			$wp_grv_category            = $comment_meta_data_fetch_value['review_add_category'];
			$rv_duplicate_details_check = $comment_meta_data_fetch_value['review_duplicate_details_check'];
			$rv_duplicate_name          = $comment_meta_data_fetch_value['review_duplicate_name'];
			$rv_duplicate_reason        = $comment_meta_data_fetch_value['review_duplicate_reason'];


				if ( $rv_duplicate_details_check === 'true' ) {
					$wp_grv_author_fetch = $rv_duplicate_name;
				} else {
					$wp_grv_author_fetch = $wp_grv_author_fetch_val;
				}
							?>
					<div id="wp_grv_rv_card">
						<div class="wp_grv_card_img_block">
							<img id="wp_grv_rv_card_usr_img" src="<?php echo $wp_grv_usr_img; ?>">
						</div>
						<div class="wp_grv_card_content_block">
							<span id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
							<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p>
							<div id="wp_grv_rv_star_rating">
						<?php
						if ( $wp_grv_rating_fetch === '1' ) {
							?>
										<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
							<?php
						} elseif ( $wp_grv_rating_fetch === '2' ) {
							?>
										<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
								<?php
						} elseif ( $wp_grv_rating_fetch === '3' ) {
							?>
										<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
							<?php
						} elseif ( $wp_grv_rating_fetch === '4' ) {
							?>
										<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
							<?php
						} elseif ( $wp_grv_rating_fetch === '5' ) {
							?>
										<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
							<?php
						}
						?>
							</div>
							<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch; ?></p>								
						</div>
					</div>
				<?php
		}
	}//schema false check if ends.	
	if($wp_grv_rv_card_id !='' && $wp_grv_rv_card_schema === 'true'){
		$comment_tbl_data = $wpdb->get_row( "SELECT * FROM $comment_tbl WHERE comment_ID=$wp_grv_rv_card_id", ARRAY_A );

		$wp_grv_author_fetch_val = $comment_tbl_data['comment_author'];
		$wp_grv_date_fetch       = $comment_tbl_data['comment_date'];
		$wp_grv_approved         = $comment_tbl_data['comment_approved'];
		$wp_grv_content          = $comment_tbl_data['comment_content'];
		$key                     = 'comment_extras';
		$comment_meta_data_fetch = get_comment_meta( $wp_grv_rv_card_id, $key );
		foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
			$wp_grv_title               = $comment_meta_data_fetch_value['review_title'];
			$wp_grv_rating_fetch        = $comment_meta_data_fetch_value['review_rating'];
			$wp_grv_usr_img             = $comment_meta_data_fetch_value['review_user_image'];
			$wp_grv_category            = $comment_meta_data_fetch_value['review_add_category'];
			$rv_duplicate_details_check = $comment_meta_data_fetch_value['review_duplicate_details_check'];
			$rv_duplicate_name          = $comment_meta_data_fetch_value['review_duplicate_name'];
			$rv_duplicate_reason        = $comment_meta_data_fetch_value['review_duplicate_reason'];


				if ( $rv_duplicate_details_check === 'true' ) {
					$wp_grv_author_fetch = $rv_duplicate_name;
				} else {
					$wp_grv_author_fetch = $wp_grv_author_fetch_val;
				}

		?>
		<div id="wp_grv_rv_card" itemprop="review" itemscope itemtype="http://schema.org/Review">
			<meta itemprop="itemreviewed" content="<?php echo $wp_grv_content; ?>"/>
			<div class="wp_grv_card_img_block">
				<img id="wp_grv_rv_card_usr_img" itemprop="image" src=<?php echo $wp_grv_usr_img;?>>
			</div>
			<div class="wp_grv_card_content_block">
				<span itemprop="name" id="wp_grv_rv_card_title"><?php echo $wp_grv_title; ?></span>	
				<span itemprop="description">
					<p id="wp_grv_rv_card_review_content"><?php echo $wp_grv_content; ?></p></span>
                     <span itemprop="author" style="display:none;"><?php echo $wp_grv_author_fetch;?></span>
					<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
						<span itemprop="ratingValue" style="display:none;"><?php echo $wp_grv_rating_fetch ;?></span>
							  <div id="wp_grv_rv_star_rating">
									<?php
									if ( $wp_grv_rating_fetch === '1' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '2' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
											<?php
									} elseif ( $wp_grv_rating_fetch === '3' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '4' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
										<?php
									} elseif ( $wp_grv_rating_fetch === '5' ) {
										?>
													<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
										<?php
									}
									?>
						
					</div>
 					<p id="wp_grv_rv_card_author_name"><?php echo $wp_grv_author_fetch;?></p>
			</div>
	</div>
<?php
		}

	}//schema true if condition ends.
	$output = ob_get_clean();
	return $output;
}
/*
 * adding frontend single review card shortcode
 *
*/
add_shortcode( 'wp_grv_single_review_card', 'wp_grv_frontend_display_single_card_function' );

/* specific review info shortcode */
function wp_grv_frontend_display_review_info_function( $wp_grv_rv_card_atts ) {
	ob_start();
	$wp_grv_rv_card_attributes    = shortcode_atts(
		array(
			'category' => '',
			
		),
		$wp_grv_rv_card_atts
	);
	
	$wp_grv_rv_card_category      		= $wp_grv_rv_card_attributes['category'];
	if( $wp_grv_rv_card_category != '' ){
		$category_review_count 				= 0;
		$category_review_count_one_star     = 0;
		$best_review_count_one_star         = 0;
		$category_review_count_two_star     = 0;
		$best_review_count_two_star         = 0;
		$category_review_count_three_star   = 0;
		$best_review_count_three_star       = 0;
		$category_review_count_four_star    = 0;
		$best_review_count_four_star        = 0;
		$category_review_count_five_star    = 0;
		$best_review_count_five_star        = 0;
		$best_review_rating					= 0;
		$total_rating_value					= 0;
		global $wpdb;
		$comment_tbl 						= $wpdb->prefix . 'comments';
		$comment_tbl_data 					= $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review'", ARRAY_A );
		foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
				$rv_id_fetch_notfy       = $value_comment_tbl_data['comment_ID'];
				$key                     = 'comment_extras';
				$comment_meta_data_fetch = get_comment_meta( $rv_id_fetch_notfy, $key );
				foreach ($comment_meta_data_fetch as $comment_meta_data_fetch_value) {
					$rv_category_fetch 			= $comment_meta_data_fetch_value['review_add_category'];
					$rv_rating_fetch 			= $comment_meta_data_fetch_value['review_rating'];
					if($wp_grv_rv_card_category == $rv_category_fetch){
						$category_review_count = $category_review_count+1;
						if($rv_rating_fetch == '5'){
						$category_review_count_five_star = $category_review_count_five_star+$rv_rating_fetch;
						$best_review_count_five_star = $best_review_count_five_star+1;
						}
						if($rv_rating_fetch == '4'){
						$category_review_count_four_star = $category_review_count_four_star+$rv_rating_fetch;
						$best_review_count_four_star = $best_review_count_four_star+1;
						}
						if($rv_rating_fetch == '3'){
						$category_review_count_three_star = $category_review_count_three_star+$rv_rating_fetch;
						$best_review_count_three_star = $best_review_count_three_star+1;
						}
						if($rv_rating_fetch == '2'){
						$category_review_count_two_star = $category_review_count_two_star+$rv_rating_fetch;
						$best_review_count_two_star = $best_review_count_two_star+1;
						}
						if($rv_rating_fetch == '1'){
						$category_review_count_one_star = $category_review_count_one_star+$rv_rating_fetch;
						$best_review_count_one_star = $best_review_count_one_star+1;
						}
				}
			}
			if($category_review_count != 0){
				$total_rating_value = ($category_review_count_five_star + $category_review_count_four_star + $category_review_count_three_star + $category_review_count_two_star + $category_review_count_one_star)/((int)$category_review_count);
			}
			$max_overall_rating = max($best_review_count_five_star,$best_review_count_four_star,$best_review_count_three_star,$best_review_count_two_star,$best_review_count_one_star);
			if($max_overall_rating != '0'){
			if($max_overall_rating == $best_review_count_five_star)
			$best_review_rating = '5';
			else if($max_overall_rating == $best_review_count_four_star)
			$best_review_rating = '4';
			else if($max_overall_rating == $best_review_count_three_star)
			$best_review_rating = '3';
			else if($max_overall_rating == $best_review_count_two_star)
			$best_review_rating = '2';
			else
			$best_review_rating = '1';
		}
	}
		global $wpdb;
		$category_tbl    	= $wpdb->prefix . 'wp_grv_category_list_tbl';
		$result_category 	= $wpdb->get_row( "SELECT * FROM $category_tbl WHERE category_name='$wp_grv_rv_card_category' ",ARRAY_A);
		$manual_enable 		= $result_category['manual'];
		$schema_enable 		= $result_category['schema_enable'];
		if($schema_enable === 'true'){
			if($manual_enable === 'true'){
				$total_reviews 	= $result_category['total_reviews'];
				$overall_rating = $result_category['overall_rating'];
				$best_review 	= $result_category['best_review'];
			}else{
				$total_reviews 	= $category_review_count;
				$overall_rating = $total_rating_value;
				$best_review 	= $best_review_rating;	
			}
			$wp_grv_schema_data = get_option( 'schema_settings' );
			?>
				<div class="wpgrv_overall_rating_block_section">
				 <div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
					<span itemprop="ratingValue" style="display:none;"><?php echo round($overall_rating);?></span>
   					<span itemprop="reviewCount" style="display:none;"><?php echo $total_reviews;?> </span>
  				</div>
				<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating">
      				<span itemprop="bestRating" style="display:none;"><?php echo '5';?></span>
    			</div>
					<?php
					$overall_rating = (string)round($overall_rating);
					if ( $overall_rating === '1' ) {
						?>
									<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
						<?php
					} elseif ( $overall_rating === '2' ) {
						?>
									<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
							<?php
					} elseif ( $overall_rating === '3' ) {
						?>
									<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
						<?php
					} elseif ( $overall_rating === '4' ) {
						?>
									<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
						<?php
					} elseif ( $overall_rating === '5' ) {
						?>
									<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>&nbsp;<i class="wp_grv_star_checked fa fa-star"></i>
						<?php
					} elseif ( $overall_rating === '0' ) {
						?>
									<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>&nbsp;<i class="fa fa-star"></i>
						<?php
					} ?>
					<p>Overall client rating is <?php echo $overall_rating; ?> out of 5 for <?php echo $wp_grv_schema_data['company_name']; ?> from <?php echo $total_reviews; ?> reviews.</p>
				</div>
			<?php
		}//schema enable check condition
		else{
			echo  "Please enable schema option in category page.";
		}		
	}//category check condition ends.
	else{
		echo "Please add a category."; 
	}
	$output = ob_get_clean();
	return $output;
}
/*
 * adding frontend single review card shortcode
 *
*/
add_shortcode( 'wp_grv_review_info', 'wp_grv_frontend_display_review_info_function' );
?>
