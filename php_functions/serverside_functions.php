<?php

/****** Server logic ************/
// serverside function
function send_votingToServer()
{
    $voting_number = $_POST['voting_number'];
    $symbolName = $_POST['symbolName'];
    $user_id = $_POST['user_id'];

    $responseData = array("Data received + Response: ");
    array_push($responseData, "voting_number:", $voting_number, "symbolName: ", $symbolName, "user_id: ", $user_id);
    echo json_encode($responseData);
    // Send to MySQL
    vote($symbolName, $voting_number, $user_id);
    wp_die(); // avoiding 0
}
add_action('wp_ajax_nopriv_send_votingToServer', 'send_votingToServer');
add_action('wp_ajax_send_votingToServer', 'send_votingToServer');


function request_votingfromServer()
{
    $symbolName = $_POST['symbolName'];

    $actual_value = getStockValue($symbolName);
    $voting_number = getVoting($symbolName);
    $request_votingArray = array(
        "actual_value" => $actual_value,
        "voting_number" => $voting_number,
        "symbolName" => $symbolName
    );

    echo json_encode($request_votingArray);
    wp_die(); // avoiding 0
}
add_action('wp_ajax_nopriv_request_votingfromServer', 'request_votingfromServer');
add_action('wp_ajax_request_votingfromServer', 'request_votingfromServer');
