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

function AddThis_enqueue_script($content) {
    // Load the Pinterest script in the footer
    if ( is_single() && 0 == get_option( 'AddThis_disable_button', 0) ) {
	    wp_enqueue_script(
	        'AddThis',
	        '//s7.addthis.com/js/300/addthis_widget.js#pubid=xa-51f5903a227e68e0',
	        array(),
	        null,
	        true

	    );
	}
}

add_action( 'wp_enqueue_scripts', 'AddThis_enqueue_script' );

function AddThis_add_button() {
    if ( is_single() && 0 == get_option( 'AddThis_disable_button', 0) ) {
        

        // Create the AddThis Button HTML
        
        /*
 		$button_html  = '<div class="addthis_toolbox addthis_floating_style addthis_32x32_style" style="left:0px;top:100px
 		;">';
        $button_html .= '<a class="addthis_button_preferred_1"></a>';
        $button_html .= '<a class="addthis_button_preferred_2"></a>';
        $button_html .= '<a class="addthis_button_preferred_3"></a>';
        $button_html .= '<a class="addthis_button_preferred_4"></a>';
        $button_html .= '<a class="addthis_button_preferred_5"></a>';
        $button_html .='<a class="addthis_button_compact"></a>';
        $button_html .= '</div>';        
	
	

        // Append the button to the content
        $content .= $button_html;
    }

    return $content;

*/

    	//I recieved help from Kay Enojado here

    	$button_html .= '<script type="text/javascript">';
        $button_html .= 'addthis.layers({';
        $button_html .= '"theme" : "gray",';
        $button_html .= '"share" : {';
        $button_html .= '"position" : "right",';
        $button_html .= '"Number_Preferred" : <?php echo get_option('Number_Preferred_field', 4) ?>';
        $button_html .= '},';
        $button_html .= '"whatsnext" : {},';
        $button_html .= '"recommended" : {';
        $button_html .= '"title": "Recommended for you:"';
        $button_html .= '}';
        $button_html .= '});';
        $button_html .= '</script>';   
    
   
    }

      echo $button_html;

}




	//Recieved Help From Chris Allen

	

add_action( 'wp_footer', 'AddThis_add_button', 20 );

function AddThis_add_options_page() {
	add_options_page(
		__('AddThis'),
		__('AddThis'),
		'manage_options',
		'AddThis_options_page',
		'AddThis_render_options_page'
	);
}


add_action('admin_menu', 'AddThis_add_options_page');


//Adding in the options page

function AddThis_render_options_page() {
 ?>
    <div class="wrap">
        <?php screen_icon(); ?>

        <h2><?php _e( 'The AddThis Options' ); ?></h2>
        <form action="options.php" method="post">


            <?php settings_fields( 'AddThis_disable_button' ); ?>
            <?php do_settings_sections( 'AddThis_options_page' ); ?>
            

            <p class="submit">
                <input type="submit" name="submit" id="submit" class="button button-primary" value="<?php _e( 'Save Changes' ); ?>">
            </p>


        </form>
    </div>
<?php
}

//Adding a disable button for our settings page

function AddThis_add_disable_button_settings() {
	register_setting(
		'AddThis_disable_button',
		'AddThis_disable_button',
		'absint'					//This is a sanitation function
	);

/*

	register_setting(
		'Position'
		'Position'
		'absint'
	);

	register_setting(
		'Number_Preferred'
		'Number_Preferred'
		'absint'
	);

*/

	add_settings_section(
		'AddThis_main_settings',
		__( 'AddThis Controls' ),
		'AddThis_render_main_settings_section',
		'AddThis_options_page'
	);

	add_settings_field(
		'AddThis_disable_button_field',
		__( 'Disable AddThis Buttons'),
		'AddThis_render_disable_button_input',
		'AddThis_options_page',
		'AddThis_main_settings'
	);

	add_settings_field(
		'Number_Preferred_field',
    	__('How many Share buttons?'),
	    'AddThis_render_Number_Preferred_input',
	    'AddThis_options_page',
	    'AddThis_main_settings'

	);


	add_settings_field(
		'Position_field',
		__('Choose a position'),
		'AddThis_render_Position_input',
		'AddThis_options_page',
		'AddThis_main_settings'
	);

}

add_action ('admin_init', 'AddThis_add_disable_button_settings');

function AddThis_render_main_settings_section() {
	echo "<p>Main settings for the AddThis plugin.</p>";
}

function AddThis_render_disable_button_input() {
	$current = get_option( 'AddThis_disable_button', 0);
	echo '<input name="AddThis_disable_button" '. checked( $current, 1, false) .'  type="checkbox" value="1" />';
}


function AddThis_render_Number_Preferred_input(){
	 $current = get_option('Number_Preferred_field', 4);

echo '<label><input type="radio" name="Number_Preferred_field" value="1"'.
 checked(1, $current, false) .'/> 1 </label>';

 echo '<label><input type="radio" name="Number_Preferred_field" value="2"'.
 checked(2, $current, false) .'/> 2 </label>';

 echo '<label><input type="radio" name="Number_Preferred_field" value="3"'.
 checked(3, $current, false) .'/> 3 </label>';

 echo '<label><input type="radio" name="Number_Preferred_field" value="4"'.
 checked(4, $current, false) .'/> 4 </label>';

 echo '<label><input type="radio" name="Number_Preferred_field" value="5"'.
 checked(5, $current, false) .'/> 5 </label>';

  echo '<label><input type="radio" name="Number_Preferred_field" value="6"'.
 checked(6, $current, false) .'/> 6 </label>';

}



function AddThis_render_Position_input(){
	$current = get_option('Position_field', left);
		echo '<select>';
		echo '<option value="left" style="left">Left</option>';
		echo '<option value="right" style="right">Right</option>';
		echo '</select>';
}

