<?php

/****** Server logic ************/
// serverside function
function send_votingToServer()
{
    $voting_number = $_POST['voting_number'];
    $symbolName = $_POST['symbolName'];
    $user_id = $_POST['user_id'];

    // Required for sending 'success' to ajax function in js
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


function delete_votesServer()
{
    $user_id = $_POST['user_id'];
    $result=delete_all_votes($user_id);

    echo json_encode($result);
    wp_die(); // avoiding 0
}
add_action('wp_ajax_nopriv_delete_votesServer', 'delete_votesServer');
add_action('wp_ajax_delete_votesServer', 'delete_votesServer');

function php_function_call()
{
    $aResult = array();

    if( !isset($_POST['functionname']) ) { $aResult['error'] = 'No function name!'; }
    if( !isset($_POST['arguments']) ) { $aResult['error'] = 'No function arguments!'; }
    if( !isset($aResult['error']) ) {
        switch($_POST['functionname']) {
            case 'AddContractData':
               if( !is_array($_POST['arguments']) || (count($_POST['arguments']) < 2) ) {
                   $aResult['error'] = 'Error in arguments!';
                }
                else {
                    $argumentList=$_POST['arguments'];
                    $parameterArray = array("contract_address" => $argumentList[0],  
                        "due_date" => $argumentList[1], 
                        "creationDate" => $argumentList[2]
                        );
                    $aResult['result'] = InsertDataToDB("ContractActionBAF_creation", $parameterArray);
               }
               break; 

            default:
               $aResult['error'] = 'Not found function '.$_POST['functionname'].'!';
               break;
        }
    }

    echo json_encode($aResult);
    wp_die(); // avoiding 0

}
add_action('wp_ajax_nopriv_php_function_call', 'php_function_call');
add_action('wp_ajax_php_function_call', 'php_function_call');
