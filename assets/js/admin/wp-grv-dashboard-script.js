/*
 * Script for Dashboard
 *
*/
jQuery( document ).ready(
	function(){
		// dashboard review circle progress bar
		var wp_grv_rate = jQuery( '#wp_grv_rate_value1' ).val();
		jQuery( '#wp_grv_circle1' ).circleProgress(
			{
				value: wp_grv_rate,
				size: 220,
				startAngle:1.5,
				fill: {
					gradient: [ "#57c0eb" , "#57c0eb", "#57c0eb"]
				}
			}
		);
		var wp_grv_rate = jQuery( '#wp_grv_rate_value2' ).val();
		jQuery( '#wp_grv_circle2' ).circleProgress(
			{
				value: wp_grv_rate,
				startAngle:1.5,
				size: 130,
				fill: {
					gradient: ["#3badb7", "#3badb7", "#3badb7"]
				}
			}
		);
		var wp_grv_rate = jQuery( '#wp_grv_rate_value3' ).val();
		jQuery( '#wp_grv_circle3' ).circleProgress(
			{
				value: wp_grv_rate,
				startAngle:1.5,
				size: 130,
				fill: {
					gradient: ["#52e3c2", "#52e3c2", "#52e3c2"]
				}
			}
		);
		var wp_grv_rate = jQuery( '#wp_grv_rate_value4' ).val();
		jQuery( '#wp_grv_circle4' ).circleProgress(
			{
				value: wp_grv_rate,
				startAngle:1.5,
				size: 130,
				fill: {
					gradient: ["#acd403", "#acd403", "#acd403"]
				}
			}
		);
		var wp_grv_rate = jQuery( '#wp_grv_rate_value5' ).val();
		jQuery( '#wp_grv_circle5' ).circleProgress(
			{
				value: wp_grv_rate,
				startAngle:1.5,
				size: 130,
				fill: {
					gradient: ["#c03e3e", "#c03e3e", "#c03e3e"]
				}
			}
		);
	}
);
