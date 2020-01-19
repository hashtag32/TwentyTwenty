<?php

/****** Server logic ************/
// serverside function
function serversidefunction()
{
    $voting_number = $_POST['voting_number'];
    $stockName = $_POST['stockName'];

    $responseData = array("Data received + Response: ");
    array_push($responseData, "voting_number:", $voting_number, "stockName: ", $stockName);
    echo json_encode($responseData);
    vote($stockName, $voting_number);
}


add_action('wp_ajax_nopriv_serversidefunction', 'serversidefunction');
add_action('wp_ajax_serversidefunction', 'serversidefunction');
