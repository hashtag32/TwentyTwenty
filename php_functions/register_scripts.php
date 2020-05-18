<?php
// Used for the send_receive transmission between the php and javascript site 
// This way is required because of the ajax connection
// Source: https://www.user-mind.de/ajax-richtig-in-wordpress-nutzen/
function send_receive_ajax_script()
{
	wp_enqueue_script('send_receive_scriptName', get_template_directory_uri() . '/js/send_receive.js');

	wp_localize_script(
		'send_receive_scriptName',
		'ajax_unique',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'title' => get_the_title(),
			'user_id' => get_current_user_id()
		)
	);
}
add_action('wp_enqueue_scripts', 'send_receive_ajax_script');


function smart_contracts_scripts()
{
	foreach( glob( get_template_directory(). '/js/*.js' ) as $file ) {
		$filename = substr($file, strrpos($file, '/') + 1);
        wp_enqueue_script( $file, get_template_directory_uri() . '/js/' . $filename);
    }
}
add_action('wp_enqueue_scripts', 'smart_contracts_scripts');
