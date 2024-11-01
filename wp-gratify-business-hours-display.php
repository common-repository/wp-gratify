<?php

/**
 * Function for display business hours shortcode
 * @author Anusha
 */
function wp_grv_frontend_display_business_hours_function()
{
    ob_start();
    if ( wp_grv()->is_free_plan() ) {
        ?>
				<p> This shortcode only works in <a href="https://wpgratify.com/"> WP Gratify Pro </a></p>
			<?php 
    }
    return ob_get_clean();
}

/**
 * adding display business hours shortcode
 * @author Anusha
 */
add_shortcode( 'wp_grv_business_hours', 'wp_grv_frontend_display_business_hours_function' );