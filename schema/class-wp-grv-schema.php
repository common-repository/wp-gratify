<?php
/*
 *function to create review json data
 * @ return void
 */
class Wp_Grv_Schema {

	public static function wp_grv_getreviewschema() {
		$rv_pg_id        = get_the_ID();
		$rv_content_post = get_post( $rv_pg_id );
		$rv_content      = $rv_content_post->post_content;
		global $wpdb;
		$comment_tbl = $wpdb->prefix . 'comments';
		$comment_id  = $wpdb->get_results( "SELECT comment_ID FROM $comment_tbl WHERE comment_type='wp_grv_review' and comment_approved='true'", ARRAY_A );
		
		if ( has_shortcode( $rv_content, 'wp_grv_review_card' ) ) {
			$json         = array();
			$company      = array();
			$schema_array = array();
			preg_match_all( '!\d+!', $rv_content, $rv_count_matches );
			if ( isset( $rv_count_matches[0][0] ) ) {
				$rv_count = $rv_count_matches[0][0];
			}
			// Fetch datas from wp_commnent table
			$comment_tbl_data = $wpdb->get_results( "SELECT * FROM $comment_tbl WHERE comment_type='wp_grv_review' and comment_approved='true' ORDER BY comment_ID DESC ", ARRAY_A );
			// Fetch datas from wp_option table
			$schema_fetch_sett             = get_option( 'schema_settings' );
			$company['@context']           = 'http://schema.org';
			$company['@type']              = 'Organisation';
			$company['company_name']       = $schema_fetch_sett['company_name'];
			$company['company_logo']       = $schema_fetch_sett['company_logo'];
			$company['company_email']      = $schema_fetch_sett['company_email'];
			$company['company_addr_line1'] = $schema_fetch_sett['company_add_l1'];
			$company['company_addr_line2'] = $schema_fetch_sett['company_add_l2'];
			$company['company_city']       = $schema_fetch_sett['company_city'];
			$company['company_state']      = $schema_fetch_sett['company_state'];
			$company['company_country']    = $schema_fetch_sett['company_country'];
			$company['company_zip_code']   = $schema_fetch_sett['company_zip_code'];

			// Fetch datas from wp_comment table
			/*if ( isset( $rv_count ) ) {
				$i = '0';
				// for($i=0;$i<$rv_count;$i++){
				foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
					$i = $i + 1;
					if ( $i <= $rv_count ) {
						$rv_id_fetch           = $value_comment_tbl_data['comment_ID'];
						$json['@type']         = 'Review';
						$json['author']        = $value_comment_tbl_data['comment_author'];
						$json['datePublished'] = $value_comment_tbl_data['comment_date'];
						$json['reviewBody']    = $value_comment_tbl_data['comment_content'];
						// Fetch datas from wp_commnent_meta table
						$key                     = 'comment_extras';
						$comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
						foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
							$json['reviewRating'] = array( 'ratingValue' => $comment_meta_data_fetch_value['review_rating'] );
						}
						// echo $i;
						$schema_array[] = $json;
					}//echo $rv_count;
				}
			} else {
				foreach ( $comment_tbl_data as $value_comment_tbl_data ) {
					$rv_id_fetch           = $value_comment_tbl_data['comment_ID'];
					$json['@type']         = 'Review';
					$json['author']        = $value_comment_tbl_data['comment_author'];
					$json['datePublished'] = $value_comment_tbl_data['comment_date'];
					$json['reviewBody']    = $value_comment_tbl_data['comment_content'];
					// Fetch datas from wp_commnent_meta table
					$key                     = 'comment_extras';
					$comment_meta_data_fetch = get_comment_meta( $rv_id_fetch, $key );
					foreach ( $comment_meta_data_fetch as $comment_meta_data_fetch_value ) {
						$json['reviewRating'] = array( 'ratingValue' => $comment_meta_data_fetch_value['review_rating'] );
					}
					$schema_array[] = $json;
				}
			}
			array_push( $company, $schema_array );*/
			$schema_json_data = json_encode( $company, JSON_UNESCAPED_SLASHES );
			echo '<script type="application/ld+json">' . $schema_json_data . '</script>';

		}
		$schema_fetch_sett  = get_option( 'schema_settings' );
		$company_logo  		= $schema_fetch_sett['company_logo'];
		?>
		<meta property="og:image" content="<?php echo $company_logo; ?>"/>
		<?php
	}
	public static function wp_grv_schema_init() {
	$schema_fetch_sett = get_option( 'schema_settings' );
		$organization_enable = $schema_fetch_sett['organization_schema_enable'];
 	if($organization_enable == 'true'){
		add_action( 'wp_head', __CLASS__ . '::wp_grv_getreviewschema' );
	}
	}
}
Wp_Grv_Schema::wp_grv_schema_init();
