<?php

/*
Plugin Name: WP Gratify
Description: WP Gratify — is a Review based plugin
Version: 1.0.3
Author: Midnay
Author URI: https://midnay.com
Textdomain: wp-gratify-lang
License: GPLv2 or later
*/
if ( !defined( 'ABSPATH' ) ) {
    exit;
}

if ( function_exists( 'wp_grv' ) ) {
    wp_grv()->set_basename( false, __FILE__ );
} else {
    
    if ( !function_exists( 'wp_grv' ) ) {
        // Create a helper function for easy SDK access.
        function wp_grv()
        {
            global  $wp_grv ;
            
            if ( !isset( $wp_grv ) ) {
                // Include Freemius SDK.
                require_once dirname( __FILE__ ) . '/freemius/start.php';
                $wp_grv = fs_dynamic_init( array(
                    'id'             => '4110',
                    'slug'           => 'wp-grv',
                    'type'           => 'plugin',
                    'public_key'     => 'pk_b64816001bf472737243cb7b660a2',
                    'is_premium'     => false,
                    'premium_suffix' => 'WPGratify Pro',
                    'has_addons'     => false,
                    'has_paid_plans' => true,
                    'menu'           => array(
                    'override_exact' => true,
                    'first-path'     => 'admin.php?page=settings-menu',
                    'support'        => false,
                    'parent'         => array(
                    'slug' => 'plugins.php',
                ),
                ),
                    'is_live'        => true,
                ) );
            }
            
            return $wp_grv;
        }
        
        // Init Freemius.
        wp_grv();
        // Signal that SDK was initiated.
        do_action( 'wp_grv_loaded' );
    }
    
    /*
     * including sub php files
    */
    include_once 'wp-gratify-review-db.php';
    include_once 'class-wp-gratify-review-meta-box.php';
    register_activation_hook( __FILE__, 'wp_grv_create_plugin_database_table' );
    include_once 'pages/wp-gratify-review-dashboard-page.php';
    include_once 'pages/wp-gratify-all-review-page.php';
    include_once 'pages/wp-gratify-category-page.php';
    include_once 'pages/wp-gratify-settings-page.php';
    include_once 'pages/wp-gratify-help-page.php';
    include_once 'pages/wp-gratify-add-new-review-page.php';
    include_once 'schema/class-wp-grv-schema.php';
    include_once 'shortcode/wp-gratify-intake-form.php';
    include_once 'wp-gratify-business-hours-display.php';
    include_once 'wp-grv-tbl-operations/class-wp-grv-settings-tbl-operation.php';
    include_once 'wp-grv-tbl-operations/class-wp-grv-tbl-operation.php';
    include_once 'shortcode/class-wp-gratify-intake-form-ajax.php';
    include_once 'wp-grv-social-proofing/class-wp-grv-social-proofing-ajax.php';
    include_once 'shortcode/wp-gratify-frontend-display-card.php';
    include_once 'blocks/class-wp-grv-gutenberg-blocks.php';
    // Exit if accessed directly.
    if ( !defined( 'ABSPATH' ) ) {
        exit;
    }
    /*
     * adding frontend review intake form shortcode
     *
    */
    add_shortcode( 'wp_grv_review_intake_form', 'wp_grv_intake_function' );
    /**
     * Block Initializer.
     */
    require_once plugin_dir_path( __FILE__ ) . 'src/class-wpgrv_init.php';
    /*
     * function to enqueue frontend style and script
     * return void
    */
    class Wp_Gratify_Review
    {
        //Add documentation link on the plugin page
        public static function wp_grv_add_plugin_links( $links, $file )
        {
            
            if ( $file == plugin_basename( dirname( __FILE__ ) . '/class-wp-gratify-review.php' ) ) {
                $links[] = '<a href="https://wpgratify.com" target="_blank">' . esc_html__( 'Visit Plugin Site', 'wp-grv-text-domain' ) . '</a>';
                $links[] = '<a href="https://wpgratify.com/wpgratify-documentation/" target="_blank">' . esc_html__( 'Help', 'wp-grv-text-domain' ) . '</a>';
                
                if ( wp_grv()->is_free_plan() ) {
                    $wp_grv_upgrade_url = admin_url( '/admin.php?billing_cycle=annual&page=wp-grv-pricing' );
                    $links[] = '<a href="' . $wp_grv_upgrade_url . '">' . esc_html__( 'WpGratify Pro', 'wp-grv-text-domain' ) . '</a>';
                }
            
            }
            
            return $links;
        }
        
        public static function wp_grv_admin_notice_upgrade()
        {
            
            if ( wp_grv()->is_free_plan() ) {
                $wp_grv_upgrade_url = admin_url( '/admin.php?billing_cycle=annual&page=wp-grv-pricing' );
                ?>
    		<div class="updated notice is-dismissible">
        	<p><?php 
                _e( 'Upgrade to ' . '<a href="' . $wp_grv_upgrade_url . '">' . 'WPGratify Pro' . '</a>', 'wp-grv-text-domain' );
                ?></p>
    		</div>
    		<?php 
            }
        
        }
        
        public static function plugin_enqueue_front_end()
        {
            wp_enqueue_script( 'jquery' );
            wp_enqueue_style(
                'wp-grv-frontend-card-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/front-end-review-card.css',
                false,
                '1.0.0'
            );
            //Plugin frontend card style.
            wp_enqueue_style(
                'wp-grv-front-end-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/front-end-style.css',
                false,
                '1.0.0'
            );
            //Plugin general.
            wp_enqueue_style(
                'wp-grv-front-end-review-intake-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/wp-grv-front-end-review-intake-form-style.css',
                false,
                '1.0.0'
            );
            //Plugin frontend intake form style.
            wp_enqueue_style(
                'wp-grv-front-end-social-proofing-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/wp-grv-frond-end-social-proofing-style.css',
                false,
                '1.0.0'
            );
            //Plugin frontend social proofing style.
            wp_enqueue_style(
                'wp-grv_font-awesome',
                '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
                false,
                '1.0.0'
            );
            wp_enqueue_script(
                'wp-grv_front_end_gn_script',
                plugin_dir_url( __FILE__ ) . '/assets/js/script-front-end.js',
                false,
                '1.0.0'
            );
            wp_enqueue_script(
                'wp-grv-scroll-to-top-script',
                plugin_dir_url( __FILE__ ) . '/assets/external/js/wp-grv-scroll-to-top.js',
                false,
                '1.0.0'
            );
            //Script for scroll to top.
            wp_enqueue_script(
                'wp-grv-ajax',
                plugin_dir_url( __FILE__ ) . '/assets/js/wp-grv-frontend-ajax-script.js',
                false,
                '1.0.0'
            );
            wp_localize_script( 'wp-grv-ajax', 'wp_grv_ajax_script', array(
                'wp_grv_ajaxurl' => admin_url( 'admin-ajax.php' ),
            ) );
            global  $post ;
            $wp_grv_btn_check = get_post_meta( $post->ID, '_wp_grv_social_proofing_meta_box_btn', true );
            
            if ( $wp_grv_btn_check != 'false' ) {
                wp_enqueue_script(
                    'wp-grv-social_proofing_notify',
                    plugin_dir_url( __FILE__ ) . '/assets/js/notify.js',
                    false,
                    '1.0.0'
                );
                wp_enqueue_script(
                    'wp_grv_social_proofing_ajax',
                    plugin_dir_url( __FILE__ ) . '/assets/js/wp-grv-social-proofing-ajax-script.js',
                    false,
                    '1.0.0'
                );
                wp_localize_script( 'wp_grv_social_proofing_ajax', 'wp_grv_social_proofing_ajax_script', array(
                    'wp_grv_social_proofing_ajaxurl' => admin_url( 'admin-ajax.php' ),
                ) );
            }
        
        }
        
        /*
         * function to enqueue backend style and script
         * return void
         */
        public static function plugin_enqueue_back_end()
        {
            wp_enqueue_script( 'jquery' );
            wp_enqueue_media();
            wp_enqueue_script( 'jquery-ui-tabs' );
            wp_enqueue_script(
                'wp-grv-back-end-script',
                plugin_dir_url( __FILE__ ) . '/assets/js/admin/script-back-end.js',
                false,
                '1.0.0'
            );
            //Backend general script.
            wp_enqueue_script(
                'wp-grv-upload-image-script',
                plugin_dir_url( __FILE__ ) . '/assets/js/admin/upload-image-script.js',
                false,
                '1.0.0'
            );
            //Script for upload image.
            wp_enqueue_script(
                'wp-grv-ajax',
                plugin_dir_url( __FILE__ ) . '/assets/js/admin/wp-grv-backend-ajax-script.js',
                false,
                '1.0.0'
            );
            //Backend General Ajax script.
            wp_localize_script( 'wp-grv-ajax', 'wp_grv_ajax_script', array(
                'wp_grv_ajaxurl' => admin_url( 'admin-ajax.php' ),
            ) );
            wp_enqueue_script(
                'wp-grv-tbl-js',
                plugin_dir_url( __FILE__ ) . '/assets/external/js/wp_grv_datatables.min.js',
                false,
                '1.0.0'
            );
            //Table functional script.
            wp_enqueue_script(
                'wp-grv-min-js',
                plugin_dir_url( __FILE__ ) . '/assets/external/js/wp_grv_circliful.min.js',
                false,
                '1.0.0'
            );
            //Dashboard circular function script.
            wp_enqueue_script(
                'wp-grv-circle',
                plugin_dir_url( __FILE__ ) . '/assets/external/js/wp_grv_circle_progress.js',
                false,
                '1.0.0'
            );
            //Backend circle progress.
            wp_enqueue_style(
                'wp-grv-back-end-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/back-end-style.css',
                false,
                '1.0.0'
            );
            //Backend General style.
            wp_enqueue_style(
                'wp-grv-dashboard-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/dashboard-style.css',
                false,
                '1.0.0'
            );
            //Backend style for dashboard.
            wp_enqueue_script(
                'wp-grv-dashboard-script',
                plugin_dir_url( __FILE__ ) . '/assets/js/admin/wp-grv-dashboard-script.js',
                false,
                '1.0.0'
            );
            //Backend script for dashboard.
            wp_enqueue_style(
                'wp-grv-font-awesome',
                '//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css',
                false,
                '1.0.0'
            );
            //Script for font-owesome icons.
            wp_enqueue_style(
                'wp-grv-tbl-pagenation',
                plugin_dir_url( __FILE__ ) . '/assets/external/css/wp_grv_datatables.min.css',
                false,
                '1.0.0'
            );
            //Style for backend tables.
            wp_enqueue_style(
                'wp-grv-invitation-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-invitation-style.css',
                false,
                '1.0.0'
            );
            //Backend style for invitation.
            wp_enqueue_style(
                'wp-grv-category-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-category-style.css',
                false,
                '1.0.0'
            );
            //Backend style for category page.
            wp_enqueue_style(
                'wp-grv-all-review-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-all-review-style.css',
                false,
                '1.0.0'
            );
            //Backend style for all review page.
            wp_enqueue_style(
                'wp-grv-tooltip-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-tooltip-style.css',
                false,
                '1.0.0'
            );
            //Backend style for tooltip.
            wp_enqueue_style(
                'wp-grv-add-review-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-add-new-review-style.css',
                false,
                '1.0.0'
            );
            //Backend style for add new review page.
            wp_enqueue_style(
                'wp-grv-help-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-help-style.css',
                false,
                '1.0.0'
            );
            //Backend style for help page.
            wp_enqueue_style(
                'wp-grv-social-proofing-meta-box-style',
                plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-social-proofing-meta-box-style.css',
                false,
                '1.0.0'
            );
            //Backend style for social proofing meta box.
            wp_enqueue_style(
                'wp-grv-font-family',
                plugin_dir_url( __FILE__ ) . '/assets/font/css/WpGratifyIcon.css',
                false,
                '1.0.0'
            );
            //gratify font for admin menu icon.
            wp_enqueue_script(
                'wp-grv-loader-script',
                plugin_dir_url( __FILE__ ) . '/assets/external/js/wp_grv_modernizr.js',
                false,
                '1.0.0'
            );
            //Backend loader effect.
            $screen = get_current_screen();
            
            if ( $screen->id === 'wpgratify_page_settings-menu' || $screen->id === 'wpgratify_page_gmb_menu' ) {
                wp_enqueue_script(
                    'wp-grv-jquery-ui-js',
                    '//code.jquery.com/ui/1.12.1/jquery-ui.js',
                    false,
                    '1.0.0'
                );
                wp_enqueue_script(
                    'wp-grv-settings-script',
                    plugin_dir_url( __FILE__ ) . '/assets/js/admin/wp-grv-settings-script.js',
                    false,
                    '1.0.0'
                );
                //Settings script.
                wp_enqueue_style(
                    'wp-grv-settings-style',
                    plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-settings-style.css',
                    false,
                    '1.0.0'
                );
                //Backend style for settings page.
                wp_enqueue_style(
                    'rv_jquery_tab_style',
                    plugin_dir_url( __FILE__ ) . '/assets/external/css/wp_grv_jquery_ui.css',
                    false,
                    '1.0.0'
                );
                wp_enqueue_script(
                    'wp-grv-gmb-add-post-script',
                    plugin_dir_url( __FILE__ ) . '/assets/js/admin/wp-grv-gmb-add-post-script.js',
                    false,
                    '1.0.0'
                );
                //gmb add new post script
                wp_enqueue_style(
                    'wp-grv-gmb-add-post-style',
                    plugin_dir_url( __FILE__ ) . '/assets/css/admin/wp-grv-gmb-add-post-style.css',
                    false,
                    '1.0.0'
                );
                wp_enqueue_script(
                    'wp-grv-add-autocomplete',
                    'https://code.jquery.com/ui/1.12.1/jquery-ui.js',
                    false,
                    '1.0.0'
                );
                //for autocomplete
            }
        
        }
        
        /*
         * function to add admin menus
         * return void
         */
        public static function wp_grv_add_admin_menu()
        {
            $wp_grv_user_role = wp_get_current_user();
            
            if ( in_array( 'administrator', (array) $wp_grv_user_role->roles ) ) {
                $invitation_fetch_sett = get_option( 'invitation_settings' );
                $wp_grv_invitation_from = $invitation_fetch_sett['invitaion_from'];
                $wp_grv_invitation_link = $invitation_fetch_sett['invitaion_link'];
                //The user has the "administrator" role
                add_menu_page(
                    __( 'All Review' ),
                    __( 'WPGratify' ),
                    'manage_options',
                    'review_slug',
                    'wp_grv_dashboard_review_function',
                    'dashicons-WpGratifyIcon',
                    6
                );
                add_submenu_page(
                    'review_slug',
                    "Dashboard",
                    "Dashboard",
                    "manage_options",
                    "review_slug"
                );
                add_submenu_page(
                    'review_slug',
                    "All review",
                    "Reviews",
                    "manage_options",
                    "all_review_menu",
                    "wp_grv_all_review_function"
                );
                add_submenu_page(
                    'review_slug',
                    "add new page",
                    "Add New",
                    "manage_options",
                    "add-new-menu",
                    "wp_grv_add_new_page_function"
                );
                add_submenu_page(
                    'review_slug',
                    "category page",
                    "Categories",
                    "manage_options",
                    "category-menu",
                    "wp_grv_category_page_function"
                );
                add_submenu_page(
                    'review_slug',
                    "settings page",
                    "Settings",
                    "manage_options",
                    "settings-menu",
                    "wp_grv_settings_function"
                );
                add_submenu_page(
                    'review_slug',
                    "help page",
                    "Help",
                    "manage_options",
                    "help-menu",
                    "wp_grv_help_page_function"
                );
                if ( wp_grv()->is_free_plan() ) {
                    add_submenu_page(
                        'review_slug',
                        "upgrade page",
                        "Upgrade",
                        "manage_options",
                        "wp-grv-upgrade-menu",
                        __CLASS__ . '::wp_grv_upgrade'
                    );
                }
            }
        
        }
        
        /*
         * function for redirect setup page when install the plugin
         *
         */
        public static function wp_grv_upgrade()
        {
            wp_redirect( admin_url( '/admin.php?billing_cycle=annual&page=wp-grv-pricing' ) );
        }
        
        /*
         * function for update notice for backend
         *
         */
        public static function wp_grv_update_admin_notice_success()
        {
            $screen = get_current_screen();
            
            if ( $screen->id === 'wpgratify_page_settings-menu' ) {
                ?>
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp" style="display: none">
				<p><?php 
                _e( 'Settings successfully saved', 'wp-grv-text-domain' );
                ?></p>
			    </div>
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp2" style="display: none">
				<p><?php 
                _e( 'Settings successfully saved', 'wp-grv-text-domain' );
                ?></p>
			    </div>
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp3" style="display: none">
				<p><?php 
                _e( 'Settings successfully saved', 'wp-grv-text-domain' );
                ?></p>
			    </div>
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp4" style="display: none">
				<p><?php 
                _e( 'Settings successfully saved', 'wp-grv-text-domain' );
                ?></p>
			    </div>
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp5" style="display: none">
				<p><?php 
                _e( 'Settings successfully saved', 'wp-grv-text-domain' );
                ?></p>
			    </div>
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp6" style="display: none">
				<p><?php 
                _e( 'Settings successfully saved', 'wp-grv-text-domain' );
                ?></p>
			    </div>
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp7" style="display: none">
				<p><?php 
                _e( 'Settings successfully saved', 'wp-grv-text-domain' );
                ?></p>
			    </div>
				<div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp8" style="display: none">
				<p><?php 
                _e( 'post successfully saved', 'wp-grv-text-domain' );
                ?></p>
			    </div>
			    <!-- for add review notification -->
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp_add_rv_update" style="display: none">
				<p><?php 
                _e( 'Review successfully update', 'wp-grv-text-domain' );
                ?></p>
			    </div>
			    <!-- for delete category notification -->
			    <div class="notice notice-success is-dismissible wp_grv_update_successfull_msg_wp_cat_delete" style="display: none">
				<p><?php 
                _e( 'Delete successfully', 'wp-grv-text-domain' );
                ?></p>
			    </div>
	    <?php 
            }
        
        }
        
        /*
         * fuction to create schedule event hook
         *
         */
        public static function wp_grv_event_schedule_hook()
        {
            if ( !wp_next_scheduled( 'wp_grv_daily_event' ) ) {
                wp_schedule_event( time(), 'daily', 'wp_grv_daily_event' );
            }
        }
        
        public static function wp_grv_deactivation()
        {
            wp_clear_scheduled_hook( 'wp_grv_daily_event' );
            /* clear login details */
            $gmb_fetch_sett = get_option( 'gmb_settings' );
            
            if ( isset( $gmb_fetch_sett ) ) {
                $gmb_id = $gmb_fetch_sett['gmb_id'];
                $gmp_settings_dat = array(
                    'gmb_id'             => $gmb_id,
                    'gmb_status'         => '0',
                    'token_time'         => 'null',
                    'token_refresh_time' => 'null',
                );
                $gmb_location_settings_dat = array(
                    'gmb_location'      => 'null',
                    'gmb_location_name' => 'null',
                );
                update_option( 'wp_grv_gmb_location_settings', $gmb_location_settings_dat );
                update_option( 'gmb_settings', $gmp_settings_dat );
            }
        
        }
        
        //allow redirection, even if wordpress starts to send output to the browser
        public static function wp_grv_do_output_buffer()
        {
            ob_start();
        }
        
        public static function wp_grv_page_creation_plugin_activation()
        {
            if ( !current_user_can( 'activate_plugins' ) ) {
                return;
            }
            global  $wpdb ;
            
            if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'review-intake'", 'ARRAY_A' ) ) {
                $current_user = wp_get_current_user();
                // create post object
                $page = array(
                    'post_title'   => __( 'Review Intake' ),
                    'post_status'  => 'publish',
                    'post_content' => __( '[wp_grv_review_intake_form]' ),
                    'post_author'  => $current_user->ID,
                    'post_type'    => 'page',
                );
                // insert the post into the database
                wp_insert_post( $page );
            }
            
            
            if ( null === $wpdb->get_row( "SELECT post_name FROM {$wpdb->prefix}posts WHERE post_name = 'review-archive'", 'ARRAY_A' ) ) {
                $current_user = wp_get_current_user();
                // create post object
                $page_archive = array(
                    'post_title'   => __( 'Review Archive' ),
                    'post_status'  => 'publish',
                    'post_content' => __( '[wp_grv_review_card]' ),
                    'post_author'  => $current_user->ID,
                    'post_type'    => 'page',
                );
                // insert the post into the database
                wp_insert_post( $page_archive );
            }
        
        }
        
        public static function wp_grv_review_init()
        {
            add_filter(
                'plugin_row_meta',
                __CLASS__ . '::wp_grv_add_plugin_links',
                10,
                2
            );
            add_action( 'admin_notices', __CLASS__ . '::wp_grv_admin_notice_upgrade' );
            add_action( 'admin_enqueue_scripts', __CLASS__ . '::plugin_enqueue_back_end' );
            //For admin scripts.
            add_action( 'wp_enqueue_scripts', __CLASS__ . '::plugin_enqueue_front_end' );
            //For front end scripts.
            add_action( 'admin_menu', __CLASS__ . '::wp_grv_add_admin_menu' );
            add_action( 'admin_notices', __CLASS__ . '::wp_grv_update_admin_notice_success' );
            register_activation_hook( __FILE__, __CLASS__ . '::wp_grv_event_schedule_hook' );
            register_activation_hook( __FILE__, __CLASS__ . '::wp_grv_page_creation_plugin_activation' );
            register_deactivation_hook( __FILE__, __CLASS__ . '::wp_grv_deactivation' );
            add_action( 'init', __CLASS__ . '::wp_grv_do_output_buffer' );
        }
    
    }
    Wp_Gratify_Review::wp_grv_review_init();
}

//security condition ends.