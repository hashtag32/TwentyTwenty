<?php

/****** Server logic ************/
// serverside function
function send_votingToServer()
{
    $voting_number = $_POST['voting_number'];
    $stockName = $_POST['stockName'];

    $responseData = array("Data received + Response: ");
    array_push($responseData, "voting_number:", $voting_number, "stockName: ", $stockName);
    echo json_encode($responseData);
    vote($stockName, $voting_number);
    wp_die();
}
add_action('wp_ajax_nopriv_send_votingToServer', 'send_votingToServer');
add_action('wp_ajax_send_votingToServer', 'send_votingToServer');


function request_votingfromServer()
{
    $stockName = $_POST['stockName'];

    // $responseData = array("Data received + Response: ");
    // array_push($responseData, "voting_number:", $voting_number, "stockName: ", $stockName);
    $voting_number = getVoting($stockName);
    echo json_encode($voting_number);
    wp_die();
}
add_action('wp_ajax_nopriv_request_votingfromServer', 'request_votingfromServer');
add_action('wp_ajax_request_votingfromServer', 'request_votingfromServer');
