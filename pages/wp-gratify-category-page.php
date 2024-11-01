<?php

/*
 * function for adding categories
 * return void
*/
function wp_grv_category_page_function()
{
    /*
     * inserting category to category table
     *
    */
    $wp_grv_add_cat_sub = filter_input( INPUT_POST, 'add_cat_sub' );
    $rv_update_cat_sub = filter_input( INPUT_POST, 'wp_grv_update_cat_sub' );
    $wp_grv_update_cat_id = filter_input( INPUT_POST, 'wp_grv_update_cat_id_hidden' );
    $wp_grv_cat_slug = filter_input( INPUT_POST, 'cat_slug' );
    $wp_grv_cat_name = filter_input( INPUT_POST, 'cat_name' );
    $wp_grv_cat_description = filter_input( INPUT_POST, 'cat_description' );
    $wp_grv_schema_enable = filter_input( INPUT_POST, 'schema_enable' );
    $wp_grv_manual = filter_input( INPUT_POST, 'manual_enable' );
    $wp_grv_total_reviews = filter_input( INPUT_POST, 'total_reviews' );
    $wp_grv_total_reviews_hidden = filter_input( INPUT_POST, 'hidden_tot_reviews' );
    $wp_grv_overall_rating = filter_input( INPUT_POST, 'overall_review' );
    $wp_grv_overall_rating_hidden = filter_input( INPUT_POST, 'hidden_ovrall_reviews' );
    $wp_grv_best_review = filter_input( INPUT_POST, 'best_review' );
    $wp_grv_best_review_hidden = filter_input( INPUT_POST, 'hidden_best_reviews' );
    $wp_grv_cat_generate = filter_input( INPUT_POST, 'generate_cat_sub' );
    
    if ( isset( $wp_grv_add_cat_sub ) ) {
        global  $wpdb ;
        
        if ( $wp_grv_cat_slug == '' ) {
            $cat_slug = strtolower( $wp_grv_cat_name );
        } else {
            $cat_slug = $wp_grv_cat_slug;
        }
        
        
        if ( $wp_grv_cat_description == '' ) {
            $cat_description = "no description";
        } else {
            $cat_description = $wp_grv_cat_description;
        }
        
        if ( $wp_grv_schema_enable != 'true' ) {
            $wp_grv_schema_enable = 'false';
        }
        if ( $wp_grv_manual != 'true' ) {
            $wp_grv_manual = 'false';
        }
        $wp_grv_total_reviews = 0;
        $wp_grv_overall_rating = 0;
        $wp_grv_best_review = 0;
        $category_name = $wp_grv_cat_name;
        $cat_slug_no_space = str_replace( " ", "-", $cat_slug );
        $category_slug = $cat_slug_no_space;
        $category_description = $cat_description;
        $category_tbl = $wpdb->prefix . 'wp_grv_category_list_tbl';
        $wpdb->insert( $category_tbl, array(
            'category_name'        => $category_name,
            'category_slug'        => $category_slug,
            'category_description' => $category_description,
            'schema_enable'        => $wp_grv_schema_enable,
            'manual'               => $wp_grv_manual,
            'total_reviews'        => $wp_grv_total_reviews,
            'overall_rating'       => $wp_grv_overall_rating,
            'best_review'          => $wp_grv_best_review,
        ), array(
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
        ) );
    }
    
    
    if ( isset( $rv_update_cat_sub ) ) {
        global  $wpdb ;
        
        if ( $wp_grv_cat_slug == '' ) {
            $cat_slug = strtolower( $wp_grv_cat_name );
        } else {
            $cat_slug = $wp_grv_cat_slug;
        }
        
        
        if ( $wp_grv_cat_description == '' ) {
            $cat_description = "no description";
        } else {
            $cat_description = $wp_grv_cat_description;
        }
        
        if ( $wp_grv_schema_enable != 'true' ) {
            $wp_grv_schema_enable = 'false';
        }
        if ( $wp_grv_manual != 'true' ) {
            $wp_grv_manual = 'false';
        }
        
        if ( $wp_grv_manual == 'false' ) {
            $wp_grv_total_reviews = $wp_grv_total_reviews_hidden;
            $wp_grv_overall_rating = $wp_grv_overall_rating_hidden;
            $wp_grv_best_review = $wp_grv_best_review_hidden;
        }
        
        $category_name = $wp_grv_cat_name;
        $cat_slug_no_space = str_replace( " ", "-", $cat_slug );
        $category_slug = $cat_slug_no_space;
        $category_description = $cat_description;
        $category_tbl = $wpdb->prefix . 'wp_grv_category_list_tbl';
        $wpdb->update(
            $category_tbl,
            array(
            'category_name'        => $category_name,
            'category_slug'        => $category_slug,
            'category_description' => $category_description,
            'schema_enable'        => $wp_grv_schema_enable,
            'manual'               => $wp_grv_manual,
            'total_reviews'        => $wp_grv_total_reviews,
            'overall_rating'       => $wp_grv_overall_rating,
            'best_review'          => $wp_grv_best_review,
        ),
            array(
            'category_id' => $wp_grv_update_cat_id,
        ),
            array(
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s',
            '%s'
        ),
            array( '%d' )
        );
    }
    
    ?>
<!-- div shows loader icon -->
<div class="se-pre-con"></div>
<!-- Ends --> 
<div id="wp_grv_add_category_page">
 	<!-- category page notification bar (admin bar) -->
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
 	<div class="wp_grv_header_width"><h3 id="wp_grv_add_category_heading"><b><?php 
    echo  _e( 'Add New Category', 'wp-gratify-lang' ) ;
    ?></b></h3></div>
 	<div class="wp_grv_page_block_border">
    <form action="" method="POST">
    	<table id="wp_grv_add_category_form_block">
			
	    	<tr><th><label><?php 
    echo  _e( 'Name:', 'wp-gratify-lang' ) ;
    ?></label></th>
	    	<td><input type="text" name="cat_name" class="wp_grv_field" id="rv_add_cat_name" autocomplete="off" required /></td></tr>
	    	<tr><th><label><?php 
    echo  _e( 'Slug:', 'wp-gratify-lang' ) ;
    ?></label></th>
	    	<td><input type="text" name="cat_slug" class="wp_grv_field" id="rv_add_cat_slug" autocomplete="off" /></td></tr>
	    	<tr><th><label><?php 
    echo  _e( 'Description:', 'wp-gratify-lang' ) ;
    ?></label></th>
	    	<td><textarea id="rv_add_cat_description" class="wp_grv_field" name="cat_description" rows="4" cols="50"></textarea></td></tr>
			<tr id="wp_grv_cat_schema_enable">
                  <th><br/><label class="wp_grv_label"><?php 
    echo  _e( 'Schema Enable:', 'wp-gratify-lang' ) ;
    ?> </label></th><td><br/><label class="wp_grv_cat_main"><input type="checkbox" name="schema_enable" id="wp_grv_schema_enable_cat" value="true"/><span class="grv_rv_slider_cat grv_rv_round_cat"></span></label><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="for enabling schema on current category"><i class="fa fa fa-question-circle questain_mark"></i></a></td>
            </tr>
			<tr id="wp_grv_manual" class="wp_grv_schema_category_block">
                  <th><br/><label class="wp_grv_label"><?php 
    echo  _e( 'Manual:', 'wp-gratify-lang' ) ;
    ?> </label></th><td><br/><label class="wp_grv_cat_main"><input type="checkbox" name="manual_enable" id="wp_grv_manual_enable" value="true"/><span class="grv_rv_slider_cat grv_rv_round_cat"></span></label><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="To manually edit the ratings"><i class="fa fa fa-question-circle questain_mark"></i></a></td>
            </tr>
			<tr id="wp_grv_total_reviews" class="wp_grv_schema_category_block"><th><label><?php 
    echo  _e( 'Total Reviews:', 'wp-gratify-lang' ) ;
    ?></label></th>
	    	<td><input type="number" disabled="true" name="total_reviews" class="wp_grv_field wp_grv_schema_field" id="rv_total_reviews" autocomplete="off" /><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="To display total number of reviews recieved on current category"><i class="fa fa fa-question-circle questain_mark"></i></a></td>
			</tr>
			<tr id="wp_grv_overall_rating" class="wp_grv_schema_category_block"><th><label><?php 
    echo  _e( 'Overall Rating:', 'wp-gratify-lang' ) ;
    ?></label></th>
	    	<td><input type="number" disabled="true" name="overall_review" class="wp_grv_field wp_grv_schema_field" id="rv_overall_reviews" autocomplete="off" /><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="To display the overall rating recieved"><i class="fa fa fa-question-circle questain_mark"></i></a></td>
			</tr>
			<tr id="wp_grv_best_review" class="wp_grv_schema_category_block"><th><label><?php 
    echo  _e( 'Best Review:', 'wp-gratify-lang' ) ;
    ?></label></th>
	    	<td><input type="number" disabled="true" name="best_review" class="wp_grv_field wp_grv_schema_field" id="rv_best_reviews" autocomplete="off" /><a href="https://wpgratify.com/wpgratify-documentation/wpgratify-shortcode-doc/" target="_blank" title="To display the most rated value"><i class="fa fa fa-question-circle questain_mark"></i></a></td>
			</tr>
	    	<tr><td colspan="2"><input type="submit" name="add_cat_sub" class="wp_grv_btn_sub" id="rv_add_cat_sub" value="<?php 
    echo  _e( 'Add New Category', 'wp-gratify-lang' ) ;
    ?>" /></td></tr>
    	</table>
    </form><!-- add category form ends -->
    <div class="wp_grv_table_section">
		<div><h2 id="wp_grv_categories_heading"><b><?php 
    echo  _e( 'Categories', 'wp-gratify-lang' ) ;
    ?></b></h2></div><br/>
		<!-- for scrolling icon -->
		<div class="wp_grv_scroll_icon_border">
			<h3>Scroll &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<i class="fa fa-angle-double-right wp_grv_scroll_arrow_icon"></i></h3>
		</div>
		<!-- scrolling icon div ends -->
		<table id="wp_grv_add_cat_list_tbl"><!-- Show added categories. -->
			<thead>
		    	<tr>
		    		<th><?php 
    echo  _e( 'Name', 'wp-gratify-lang' ) ;
    ?></th>
		    		<th><?php 
    echo  _e( 'Description', 'wp-gratify-lang' ) ;
    ?></th>
		    		<th><?php 
    echo  _e( 'Slug', 'wp-gratify-lang' ) ;
    ?></th>
		    		<th><?php 
    echo  _e( 'Shortcode', 'wp-gratify-lang' ) ;
    ?></th>
		    	</tr>
		    </thead>
		    <tbody>
		<?php 
    global  $wpdb ;
    $category_tbl = $wpdb->prefix . 'wp_grv_category_list_tbl';
    $result_category = $wpdb->get_results( "SELECT * FROM {$category_tbl} ", ARRAY_A );
    foreach ( $result_category as $value_category ) {
        $category_id = $value_category['category_id'];
        $category_name_dat = $value_category['category_name'];
        $category_slug_dat = $value_category['category_slug'];
        $category_description_dat = $value_category['category_description'];
        $wp_grv_schema_enable = $value_category['schema_enable'];
        $manual_enable = $value_category['manual'];
        ?>
				<tr class="wp_grv_rv_cat_tbl_row">
					<td>
						<span class="wp_grv_rv_delete_set"><?php 
        
        if ( $category_name_dat != 'General Category' ) {
            ?><a id="wp_grv_rv_cat_delete" class="wp_grv_rv_cat_delete_effect" data_id="<?php 
            echo  $category_id ;
            ?>" title="Delete Category" href="#" ><i class="fa fa-trash-o"></i></a>
					<?php 
        }
        
        ?>
						</span>
						<span style="margin-left: 15%;"><?php 
        echo  _e( $category_name_dat, 'wp-gratify-lang' ) ;
        ?></span>
						<span style="float: right;"><?php 
        
        if ( $category_name_dat != 'General Category' ) {
            ?>
							<a title="Edit category" data_id="<?php 
            echo  $category_id ;
            ?>" id="wp_grv_rv_cat_edit" class="wp_grv_rv_cat_edit_effect" >
								<i class="fa fa-pencil-square-o"></i>
							</a>
				<?php 
        }
        
        ?>	
						</span>
					</td>
					<td style="text-align: center;"><?php 
        echo  _e( $category_description_dat, 'wp-gratify-lang' ) ;
        ?></td>
					<td style="text-align: center;"><?php 
        echo  _e( $category_slug_dat, 'wp-gratify-lang' ) ;
        ?></td>
					<td style="text-align: center;"><?php 
        echo  '[wp_grv_review_card category="' . $category_name_dat . '" schema="' . $wp_grv_schema_enable . '"]' ;
        ?></td>
				</tr>
				<?php 
    }
    ?>
			</tbody>		
		</table>
	 	</div>
	</div><!-- wp_grv_table_section div ends --> 
	</div><!-- wp_grv_invite_page_block ends --> 
<?php 
}
