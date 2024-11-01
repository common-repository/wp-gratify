<?php
/*
 * creating gutenberg blocks
 *
*/
if ( function_exists( 'register_block_type' ) ) { // Checking whether gutenberg install or not.
	/*
	 * function to create wp-grv review block
	 * return void
	*/
	class Wp_Grv_Gutenberg_Blocks {

		public static function wp_grv_gutenberg_review_block() {
			wp_register_script(
				'wpgrvgutenberg-review-block-editor',
				plugins_url( 'script/wp-grv-gutenberg-blocks-script.js', __FILE__ ),
				array( 'wp-blocks', 'wp-element' )
			);
			wp_register_style(
				'wpgrvgutenberg-review-block-editor',
				plugins_url( 'style/wp-grv-gutenberg-blocks-style.css', __FILE__ ),
				array( 'wp-edit-blocks' ),
				filemtime( plugin_dir_path( __FILE__ ) . 'style/wp-grv-gutenberg-blocks-style.css' )
			);

			register_block_type(
				'wpgrvgutenberg/wpgrvreviewblock',
				array(
					'editor_script' => 'wpgrvgutenberg-review-block-editor',
					'editor_style'  => 'wpgrvgutenberg-review-block-editor',
				)
			);
		}
		public static function wp_grv_gutenberg_block_init() {
			add_action( 'init', __CLASS__ . '::wp_grv_gutenberg_review_block' );
		}
	}
	Wp_Grv_Gutenberg_Blocks::wp_grv_gutenberg_block_init();
}//If condition ends
