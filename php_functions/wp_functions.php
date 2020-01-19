<?php

// hook ajax script
function hook_ajax_script()
{
	wp_enqueue_script('ajax_scripts_name', get_template_directory_uri() . '/js/send_receive.js', array(), $theme_version);

	wp_localize_script(
		'ajax_scripts_name',
		'ajax_unique',
		array(
			'ajaxurl' => admin_url('admin-ajax.php'),
			'title' => get_the_title()
		)
	);
}

add_action('wp_enqueue_scripts', 'hook_ajax_script');
add_action('admin_enqueue_scripts', 'hook_ajax_script');


wp_enqueue_script('build_template_script_name', get_template_directory_uri() . '/js/build_template.js', array(), $theme_version);



/****** Server logic ************/
// serverside function
function serversidefunction()
{
	$voting_number = $_POST['voting_number'];

	$responseData = array("Data received + Response: ");
	array_push($responseData, "blue", "voting_number:", $voting_number);
	echo json_encode($responseData);
	vote("TSLA", $voting_number);
}


add_action('wp_ajax_nopriv_serversidefunction', 'serversidefunction');
add_action('wp_ajax_serversidefunction', 'serversidefunction');
