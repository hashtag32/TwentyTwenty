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
			'title' => get_the_title()
		)
	);
}
add_action('wp_enqueue_scripts', 'send_receive_ajax_script');


function build_template_scripts()
{
	wp_enqueue_script('build_template_script_name', get_template_directory_uri() . '/js/build_template.js');
}
add_action('wp_enqueue_scripts', 'build_template_scripts');

// build_template.js script for building the template of voting_template.html (normal way to include a js script)
