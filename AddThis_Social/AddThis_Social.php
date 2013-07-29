<?php
/*
Plugin Name: AddThis Social
Plugin URI: http://github.com/jamesonnuss/wdim393f
Version: 1.0
Description: Adds social media icons to single post pages.
Author: Jameson Nuss
Author URI: http://addthis.com
License: GNU General Public License v2 or later
*/

function AddThis_enqueue_scripts(){
	if ( is_single() && 0 == get_option( ' pimple_disable_button',0) ) {
	wp_enqueue_script(
		'addThis - Social',
		'//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51f6a88714752a90',
		array(
			'jquery',
			'underscore'
		),
		null,
		true

	);

	}

}

add_action('wp_enqueue_scripts','AddThis_enqueue_scripts');


function AddThis_add_button( $content ){
	if ( is_single() && 0 == get_option( ' AddThis_disable_button',0) ) {
		
		 // Create the AddThis Button HTML
		$button_html .= '<div class="addthis_toolbox addthis_default_style addthis_32x32_style">'
		$button_html .= '<a class="addthis_button_preferred_1"></a>'
		$button_html .= '<a class="addthis_button_preferred_2"></a>'
		$button_html .= '<a class="addthis_button_preferred_3"></a>'
		$button_html .= '<a class="addthis_button_preferred_4"></a>'
		$button_html .= '<a class="addthis_button_compact"></a>'
		$button_html .= '<a class="addthis_counter addthis_bubble_style"></a>'
		$button_html .= '</div>'

        // Append the button to the content
        $content .= $button_html;
	}

	return $content;
}

