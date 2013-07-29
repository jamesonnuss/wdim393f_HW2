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

