<?php

/*
 * function to create review dashboard
 * @ return void
*/
function wp_grv_dashboard_review_function()
{
    global  $wpdb ;
    $wp_grv_read = 'read';
    $wp_grv_unread = 'unread';
    $wp_grv_count_1_star = 0;
    $wp_grv_count_2_star = 0;
    $wp_grv_count_3_star = 0;
    $wp_grv_count_4_star = 0;
    $wp_grv_count_5_star = 0;
    $wp_grv_avg_1_star = 0;
    $wp_grv_avg_2_star = 0;
    $wp_grv_avg_3_star = 0;
    $wp_grv_avg_4_star = 0;
    $wp_grv_avg_5_star = 0;
    $wp_grv_percentage_1_star = 0;
    $wp_grv_percentage_2_star = 0;
    $wp_grv_percentage_3_star = 0;
    $wp_grv_percentage_4_star = 0;
    $wp_grv_percentage_5_star = 0;
    $wp_grv_total_count_star = 0;
    /* Fetch datas from wp_comments table */
    $comment_tbl = $wpdb->prefix . 'comments';
    $comment_tbl_data = $wpdb->get_results( "SELECT * FROM {$comment_tbl} WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC", ARRAY_A );
    foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
        $rv_id_fetch = $value_comment_tbl_data['comment_ID'];
        $key = "comment_extras";
        $comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
        foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
            $wp_grv_rating_fetch = $comment_meta_data_fetch_value['review_rating'];
            
            if ( $wp_grv_rating_fetch === '1' ) {
                $wp_grv_count_1_star = $wp_grv_count_1_star + 1;
            } else {
                
                if ( $wp_grv_rating_fetch === '2' ) {
                    $wp_grv_count_2_star = $wp_grv_count_2_star + 1;
                } else {
                    
                    if ( $wp_grv_rating_fetch === '3' ) {
                        $wp_grv_count_3_star = $wp_grv_count_3_star + 1;
                    } else {
                        
                        if ( $wp_grv_rating_fetch === '4' ) {
                            $wp_grv_count_4_star = $wp_grv_count_4_star + 1;
                        } else {
                            $wp_grv_count_5_star = $wp_grv_count_5_star + 1;
                        }
                    
                    }
                
                }
            
            }
            
            $wp_grv_total_count_star = $wp_grv_total_count_star + 1;
        }
    }
    
    if ( $wp_grv_total_count_star != '0' ) {
        // finding percentage
        $wp_grv_percentage_1_star = round( $wp_grv_count_1_star / $wp_grv_total_count_star * 100 );
        $wp_grv_percentage_2_star = round( $wp_grv_count_2_star / $wp_grv_total_count_star * 100 );
        $wp_grv_percentage_3_star = round( $wp_grv_count_3_star / $wp_grv_total_count_star * 100 );
        $wp_grv_percentage_4_star = round( $wp_grv_count_4_star / $wp_grv_total_count_star * 100 );
        $wp_grv_percentage_5_star = round( $wp_grv_count_5_star / $wp_grv_total_count_star * 100 );
        $wp_grv_total_percentage = $wp_grv_percentage_1_star + $wp_grv_percentage_2_star + $wp_grv_percentage_3_star + $wp_grv_percentage_4_star + $wp_grv_percentage_5_star;
        $wp_grv_max_percentage_value = max(
            $wp_grv_percentage_1_star,
            $wp_grv_percentage_2_star,
            $wp_grv_percentage_3_star,
            $wp_grv_percentage_4_star,
            $wp_grv_percentage_5_star
        );
        
        if ( $wp_grv_total_percentage != '100' ) {
            //$wp_grv_percentage_5_star = $wp_grv_total_percentage;
            
            if ( $wp_grv_total_percentage > '100' ) {
                $wp_grv_diff = $wp_grv_total_percentage - 100;
                
                if ( $wp_grv_percentage_1_star === $wp_grv_max_percentage_value ) {
                    $wp_grv_percentage_1_star = $wp_grv_percentage_1_star - $wp_grv_diff;
                } else {
                    
                    if ( $wp_grv_percentage_2_star === $wp_grv_max_percentage_value ) {
                        $wp_grv_percentage_2_star = $wp_grv_percentage_2_star - $wp_grv_diff;
                    } else {
                        
                        if ( $wp_grv_percentage_3_star === $wp_grv_max_percentage_value ) {
                            $wp_grv_percentage_3_star = $wp_grv_percentage_3_star - $wp_grv_diff;
                        } else {
                            
                            if ( $wp_grv_percentage_4_star === $wp_grv_max_percentage_value ) {
                                $wp_grv_percentage_4_star = $wp_grv_percentage_4_star - $wp_grv_diff;
                            } else {
                                if ( $wp_grv_percentage_5_star === $wp_grv_max_percentage_value ) {
                                    $wp_grv_percentage_5_star = $wp_grv_percentage_5_star - $wp_grv_diff;
                                }
                            }
                        
                        }
                    
                    }
                
                }
            
            }
            
            
            if ( $wp_grv_total_percentage < '100' ) {
                $wp_grv_diff = 100 - $wp_grv_total_percentage;
                
                if ( $wp_grv_percentage_1_star === $wp_grv_max_percentage_value ) {
                    $wp_grv_percentage_1_star = $wp_grv_percentage_1_star + $wp_grv_diff;
                } else {
                    
                    if ( $wp_grv_percentage_2_star === $wp_grv_max_percentage_value ) {
                        $wp_grv_percentage_2_star = $wp_grv_percentage_2_star + $wp_grv_diff;
                    } else {
                        
                        if ( $wp_grv_percentage_3_star === $wp_grv_max_percentage_value ) {
                            $wp_grv_percentage_3_star = $wp_grv_percentage_3_star + $wp_grv_diff;
                        } else {
                            
                            if ( $wp_grv_percentage_4_star === $wp_grv_max_percentage_value ) {
                                $wp_grv_percentage_4_star = $wp_grv_percentage_4_star + $wp_grv_diff;
                            } else {
                                if ( $wp_grv_percentage_5_star === $wp_grv_max_percentage_value ) {
                                    $wp_grv_percentage_5_star = $wp_grv_percentage_5_star + $wp_grv_diff;
                                }
                            }
                        
                        }
                    
                    }
                
                }
            
            }
        
        }
        
        // finding average for animation
        $wp_grv_avg_1_star = $wp_grv_count_1_star / $wp_grv_total_count_star;
        $wp_grv_avg_2_star = $wp_grv_count_2_star / $wp_grv_total_count_star;
        $wp_grv_avg_3_star = $wp_grv_count_3_star / $wp_grv_total_count_star;
        $wp_grv_avg_4_star = $wp_grv_count_4_star / $wp_grv_total_count_star;
        $wp_grv_avg_5_star = $wp_grv_count_5_star / $wp_grv_total_count_star;
    }
    
    /* function to convert reviewed time to hours,minute or second */
    function review_timeago( $reviewtime )
    {
        $get_review_time = time() - $reviewtime;
        if ( $get_review_time < 1 ) {
            return 'less than 1 second ago';
        }
        $rv_timeago_conditions = array(
            24 * 60 * 60 => 'day',
            60 * 60      => 'hour',
            60           => 'minute',
            1            => 'second',
        );
        foreach ( $rv_timeago_conditions as $rv_secs => $rv_str ) {
            $rv_days = $get_review_time / $rv_secs;
            
            if ( $rv_days >= 1 ) {
                $rv_days_round = round( $rv_days );
                return $rv_days_round . ' ' . $rv_str . (( $rv_days_round > 1 ? 's' : '' )) . ' ago';
            }
        
        }
    }
    
    ?>
<div id="wp_grv_dashboard_container">
	<!-- div shows loader icon -->
	<div class="se-pre-con"></div>
	<!-- help page notification bar (admin bar) -->
	<div id="wp_grv_ajax_notification_load" class="wp_grv_header_notification_bar">
	    <?php 
    $wp_grv_notification_data = get_option( 'schema_settings' );
    
    if ( strlen( $wp_grv_notification_data['company_name'] ) >= 10 ) {
        $wp_grv_cmp_name = substr( $wp_grv_notification_data['company_name'], 0, 10 ) . '..';
    } else {
        $wp_grv_cmp_name = $wp_grv_notification_data['company_name'];
    }
    
    // taking notification count from comment table
    global  $wpdb ;
    $comment_tbl = $wpdb->prefix . 'comments';
    $wp_grv_notification_count = '0';
    $comment_tbl_data = $wpdb->get_results( "SELECT * FROM {$comment_tbl} WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC", ARRAY_A );
    foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
        $rv_id_fetch = $value_comment_tbl_data['comment_ID'];
        $key = "comment_extras";
        $comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
        foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
            $wp_grv_notification_flag = $comment_meta_data_fetch_value['review_notification_flag'];
            if ( $wp_grv_notification_flag === '1' ) {
                $wp_grv_notification_count = $wp_grv_notification_count + 1;
            }
        }
        if ( $wp_grv_notification_flag === '0' ) {
            break;
        }
    }
    /*GMB Login status ends*/
    ?>
	    <a class="wp_grv_bell_hover" style="color: #ffff;" href="<?php 
    echo  admin_url( '/admin.php?page=all_review_menu' ) ;
    ?>"><i class="fa fa-bell"></i></a><span class="wp_grv_notification_count" <?php 
    if ( $wp_grv_notification_count === '0' ) {
        echo  'style = "display: none"' ;
    }
    ?>><?php 
    echo  $wp_grv_notification_count ;
    ?></span>&nbsp;&nbsp;
	    <a class="wp_grv_settings_icon_hover" style="color: #ffff;" href="<?php 
    echo  admin_url( '/admin.php?page=settings-menu' ) ;
    ?>"><i class="fa fa-cog" style="margin-left: 15px;"></i></a></span>&nbsp;&nbsp;&nbsp; 
	    <a style="text-decoration: none; color: #ffff;" href="<?php 
    echo  admin_url( '/admin.php?page=settings-menu' ) ;
    ?>"><span class="wp_grv_notification_user_hover"><img style="width:25px; position: relative; top: 4px;" src="<?php 
    echo  $wp_grv_notification_data['company_logo'] ;
    ?>" style="width:30px;">&nbsp;&nbsp;<span style="font-size: initial; font-weight: 700;"><?php 
    echo  $wp_grv_cmp_name ;
    ?></span></span></a>
	</div>
	<!-- Ends notification bar -->
	<div class="wp_grv_dashboard_width"><div><h2><?php 
    _e( 'Dashboard', 'wp-gratify-lang' );
    ?></h2></div></div>
	<!-- read or unread block -->
	<div class="wp_grv_read_dashboard_container">
		<div class="wp_grv_read_unread_block">
			<input type="button" name="wp_grv_unread_btn" class="wp_grv_btn" onclick="window.location.href='<?php 
    echo  admin_url( '/admin.php?page=all_review_menu&mode=' . $wp_grv_unread ) ;
    ?>'" id="wp_grv_unread_btn" title="Unread reviews" value="<?php 
    echo  _e( 'Unread', 'wp-gratify-lang' ) ;
    ?>">&nbsp;<input type="button" name="wp_grv_read_btn" title="Read reviews" onclick="window.location.href='<?php 
    echo  admin_url( '/admin.php?page=all_review_menu&mode=' . $wp_grv_read ) ;
    ?>'" class="wp_grv_btn" id="wp_grv_read_btn" value="<?php 
    echo  _e( 'Read', 'wp-gratify-lang' ) ;
    ?>">
		</div>
		<!-- read or unread block ends -->
		<div class = 'wp_grv_dashboard'>
			<div class = 'wp_grv_circle_div'>
			  	<div class='wp_grv_circle_progress1'>
			  		<table>
			  			<tr>
			  				<td>
							    <div id='wp_grv_circle1'>
							    	<h1 class="wp_grv_percentage_text"><?php 
    echo  $wp_grv_percentage_5_star . '%' ;
    ?></h1>
								    <input type='hidden' id='wp_grv_rate_value1' value='<?php 
    echo  $wp_grv_avg_5_star ;
    ?>' />
								</div>
							</td>	
						</tr>	
					</table>
				</div>
				<div class ='wp_grv_circle_progress'>
					<table  class="wp_grv_counter_set" style="display: block;">
						<tr>
							<td>
								<div id='wp_grv_circle2'>
								    <h1  class="wp_grv_circles_percentage_position"><?php 
    echo  $wp_grv_percentage_4_star . '%' ;
    ?></h1>
								    <input type='hidden' id='wp_grv_rate_value2' value='<?php 
    echo  $wp_grv_avg_4_star ;
    ?>'/>
								</div>
							</td>
							<td>
								<div id ='wp_grv_circle3'>
								    <h1  class="wp_grv_circles_percentage_position"><?php 
    echo  $wp_grv_percentage_3_star . '%' ;
    ?></h1>
								    <input type='hidden' id='wp_grv_rate_value3' value='<?php 
    echo  $wp_grv_avg_3_star ;
    ?>' />
								</div>
							</td>		
							<td>
								<div id='wp_grv_circle4'>
								     <h1  class="wp_grv_circles_percentage_position"><?php 
    echo  $wp_grv_percentage_2_star . '%' ;
    ?></h1>
								    <input type='hidden' id='wp_grv_rate_value4' value='<?php 
    echo  $wp_grv_avg_2_star ;
    ?>' />
								</div>
							</td>
							<td style="padding: 0px;">
								<div id='wp_grv_circle5'>
								     <h1 class="wp_grv_circles_percentage_position"><?php 
    echo  $wp_grv_percentage_1_star . '%' ;
    ?></h1>
								    <input type='hidden' id='wp_grv_rate_value5' value='<?php 
    echo  $wp_grv_avg_1_star ;
    ?>' />
								</div>
							</td>
						</tr>
					</table>
					<div class = 'wp_grv_color_dots'>
						<span class="wp_grv_dot_set_1">
							<div class = 'wp_grv_dot' id = 'wp_grv_dot_div5' ></div><div class = 'wp_grv_dot_div'><span><?php 
    echo  _e( '5 Star', 'wp-gratify-lang' ) ;
    ?></span></div>
						 	<div class = 'wp_grv_dot' id = 'wp_grv_dot_div4' ></div><div class = 'wp_grv_dot_div'><span><?php 
    echo  _e( '4 Star', 'wp-gratify-lang' ) ;
    ?></span></div>
					  		<div class = 'wp_grv_dot' id = 'wp_grv_dot_div3' ></div><div class = 'wp_grv_dot_div'><span><?php 
    echo  _e( '3 Star', 'wp-gratify-lang' ) ;
    ?></span></div>
					 	</span>
					 	<span class="wp_grv_dot_set_2">
						  	<div class = 'wp_grv_dot' id = 'wp_grv_dot_div2' class="wp_grv_dot_pos"></div><div class = 'wp_grv_dot_div'><span><?php 
    echo  _e( '2 Star', 'wp-gratify-lang' ) ;
    ?></span></div>	  
							<div class = 'wp_grv_dot' id = 'wp_grv_dot_div1' class="wp_grv_dot_pos"></div><div class = 'wp_grv_dot_div'><span><?php 
    echo  _e( '1 Star', 'wp-gratify-lang' ) ;
    ?></span></div>	
						</span>		  	
				 	</div>
				</div>
			</div><!-- wp_grv_circle_div ends -->
		</div><!-- wp_grv_dashboard div ends -->	
	</div><!-- wp_grv_read_dashboard_container div ends -->

	<div class = 'wp_grv_div1'>
	  <h3 class = 'wp_grv_dashboard_text'><?php 
    echo  _e( 'Basic Analysis', 'wp-gratify-lang' ) ;
    ?></h3>
		<ul class ='wp_grv_analysis'>	
	  	  <li>
			<div class='wp_grv_rate_count' id = 'wp_grv_rate_count5'><i class="fa fa-star-o"></i></div>
			<div class = 'wp_grv_analysis_rate'><h3><?php 
    echo  _e( '5 Star', 'wp-gratify-lang' ) ;
    ?></h3></div>
			<div class = 'wp_grv_analysis_unit'><h5><?php 
    echo  $wp_grv_count_5_star . ' ' . _e( 'Unit ', 'wp-gratify-lang' ) ;
    ?></h5></div>
		   </li>
		   <hr width="80%"/>		
		   <li>
          	<div class='wp_grv_rate_count' id = 'wp_grv_rate_count4'><i class="fa fa-star-o"></i></i></div>
			<div  class = 'wp_grv_analysis_rate'><h3><?php 
    echo  _e( '4 Star', 'wp-gratify-lang' ) ;
    ?></h3></div>
			<div class = 'wp_grv_analysis_unit'><h5><?php 
    echo  $wp_grv_count_4_star . ' ' . _e( 'Unit ', 'wp-gratify-lang' ) ;
    ?></h5></div>
		   </li>
		   <hr width="80%"/>
		   <li>
	        <div class='wp_grv_rate_count' id = 'wp_grv_rate_count3'><i class="fa fa-star-o"></i></i></div>
			<div  class = 'wp_grv_analysis_rate'><h3><?php 
    echo  _e( '3 Star', 'wp-gratify-lang' ) ;
    ?></h3></div>
			<div class = 'wp_grv_analysis_unit'><h5><?php 
    echo  $wp_grv_count_3_star . ' ' . _e( 'Unit ', 'wp-gratify-lang' ) ;
    ?></h5></div>
		   </li>
		   <hr width="80%"/>
		   <li>
		  	<div class='wp_grv_rate_count' id = 'wp_grv_rate_count2'><i class="fa fa-star-o"></i></div>
			<div  class = 'wp_grv_analysis_rate'><h3><?php 
    echo  _e( '2 Star', 'wp-gratify-lang' ) ;
    ?></h3></div>
			<div class = 'wp_grv_analysis_unit'><h5><?php 
    echo  $wp_grv_count_2_star . ' ' . _e( 'Unit ', 'wp-gratify-lang' ) ;
    ?></h5></div>
		    </li>
		    <hr width="80%"/>
		    <li>		 	
			<div class='wp_grv_rate_count' id = 'wp_grv_rate_count1'><i class="fa fa-star-o"></i></div>
			<div  class = 'wp_grv_analysis_rate'><h3><?php 
    echo  _e( '1 Star', 'wp-gratify-lang' ) ;
    ?></h3></div>					
			<div class = 'wp_grv_analysis_unit'><h5><?php 
    echo  $wp_grv_count_1_star . ' ' . _e( 'Unit ', 'wp-gratify-lang' ) ;
    ?></h5></div>
		    </li>
		 </ul>
		
	 
	 
	</div>
	<div class = 'wp_grv_div3'>
	  <h3 class = 'wp_grv_dashboard_text'>Notifications</h3>
	  <ul class = 'wp_grv_list'>	
	<?php 
    $wp_grv_i_notification = '1';
    $comment_tbl_data = $wpdb->get_results( "SELECT comment_ID,comment_author,comment_date FROM {$comment_tbl} WHERE comment_type='wp_grv_review' ORDER BY comment_ID DESC LIMIT 5", ARRAY_A );
    foreach ( $comment_tbl_data as $comment_tbl_data_value ) {
        $review_author = $comment_tbl_data_value['comment_author'];
        $rv_author_name = $review_author[0];
        $rv_date_fetch = $comment_tbl_data_value['comment_date'];
        $rv_id_fetch = $comment_tbl_data_value['comment_ID'];
        ?>
		<li>
			
			<div class="wp_grv_notification_circle"><div class ="<?php 
        echo  'wp_grv_circles' . $wp_grv_i_notification ;
        ?> wp_grv_circles"> <h2><?php 
        echo  strtoupper( $rv_author_name ) ;
        ?></h2></div></div>		
	        <?php 
        $wp_grv_i_notification = $wp_grv_i_notification + 1;
        $key = "comment_extras";
        $comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
        foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
            $rv_rating_fetch = $comment_meta_data_fetch_value['review_rating'];
            ?>
			<div class = 'wp_grv_review'><?php 
            echo  '<span>' . $review_author . ' rated review with' . ' ' . $rv_rating_fetch . ' ' . 'Stars' . '<br>' . '</span>' ;
            echo  '<div>' . review_timeago( strtotime( $rv_date_fetch ) ) . '</div>' ;
            ?></div>
			<div class = 'wp_grv_star_rate'> 	
				<div id="rv_star_rating_size">
		    				<span class="fa fa-star <?php 
            if ( $rv_rating_fetch == '1' || $rv_rating_fetch == '2' || $rv_rating_fetch == '3' || $rv_rating_fetch == '4' || $rv_rating_fetch == '5' ) {
                echo  'rv_checked' ;
            }
            ?>"></span>
		    				<span class="fa fa-star <?php 
            if ( $rv_rating_fetch == '2' || $rv_rating_fetch == '3' || $rv_rating_fetch == '4' || $rv_rating_fetch == '5' ) {
                echo  'rv_checked' ;
            }
            ?>"></span>
		    				<span class="fa fa-star <?php 
            if ( $rv_rating_fetch == '3' || $rv_rating_fetch == '4' || $rv_rating_fetch == '5' ) {
                echo  'rv_checked' ;
            }
            ?>"></span>
		    				<span class="fa fa-star <?php 
            if ( $rv_rating_fetch == '4' || $rv_rating_fetch == '5' ) {
                echo  'rv_checked' ;
            }
            ?>" ></span>
		    				<span class="fa fa-star <?php 
            if ( $rv_rating_fetch == '5' ) {
                echo  'rv_checked' ;
            }
            ?>" ></span>
		    		</div>
			</div>
			
		</li>
		
             <?php 
        }
    }
    ?>
	</ul>

	</div>
</div> <!-- dashboard container ends -->
<?php 
}
