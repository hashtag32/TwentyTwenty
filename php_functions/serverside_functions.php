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
    // Send to MySQL
    vote($stockName, $voting_number);
    wp_die(); // avoiding 0
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
    wp_die(); // avoiding 0
}
add_action('wp_ajax_nopriv_request_votingfromServer', 'request_votingfromServer');
add_action('wp_ajax_request_votingfromServer', 'request_votingfromServer');


function request_actual_valuefromServer()
{
    // 	var_dump($stock_data);
    // 	echo $stock_data["AAPL"]["last_open"];
    // }
    $stockName = $_POST['stockName'];


    // $stock_data = Wpau_Stock_Ticker::get_stock_from_db($stockName);
    $actual_value = getStockData($stockName);
    // $actual_value = 100;

    // $responseData = array("Data received + Response: ");
    // array_push($responseData, "voting_number:", $voting_number, "stockName: ", $stockName);
    // $voting_number = getVoting($stockName);
    echo json_encode($actual_value);
    wp_die(); // avoiding 0
}
add_action('wp_ajax_nopriv_request_actual_valuefromServer', 'request_actual_valuefromServer');
add_action('wp_ajax_request_actual_valuefromServer', 'request_actual_valuefromServer');
