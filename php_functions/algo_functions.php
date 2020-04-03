<?php

/*******Server API functions****/
function vote($symbol, $voting_number,$user_id)
{
	checkCategory($symbolName);

	$conn = connectDB();
	$result = insertEntryvotingTable($conn, $symbol, date("d-m-Y H:i:s"), $voting_number, $user_id);
}

function getVoting($symbol)
{
	$conn = connectDB();
	$forecast = readForecast($conn, $symbol);
	return $forecast;
}

function getStockValue($symbolName)
{
	$conn = connectDB();
	$actual_value =	readStockValue($conn, $symbolName);
	return $actual_value;
}

//****Categories****/// 
function checkCategory($symbolName)
{
	// Check if catgeory is already existing
	if(!existsCategory($symbolName))
	{
		createCategory($symbolName);
	}
}

function existsCategory($symbolName)
{
	$args = array(
		'hide_empty'      => false,
	);
	 
	foreach( get_categories($args) as $category ) {
		if ($symbolName == $category->name) {
			return true;
		}
		else {
			// Print warning: No row found";
		}
	}
	return false; 
}

function createCategory($category)
{
	//Define the category
	// TODO: cat_name is Tesla, nice_name is tsla!!! 
	$wpdocs_cat = array('cat_name' => $category);
	
	// Create the category
	$wpdocs_cat_id = wp_insert_category($wpdocs_cat);
}

/*******Database related functions****/
function connectDB()
{
	$conn = new mysqli(constant("DB_HOST"), constant("DB_USER"), constant("DB_PASSWORD"), constant("DB_NAME"));
	// Check connection
	if ($conn->connect_error) {
		die("Connection failed: " . $conn->connect_error);
	}
	return $conn;
}

function insertEntrystockValuation($conn, $symbol, $currentValue)
{
	$sql = "INSERT INTO stockValuation (symbol, currentValue) VALUES ('{$symbol}', '{$currentValue}')";
	$result = $conn->query($sql);
	return $result;
}

function insertEntryvotingTable($conn, $symbol, $date, $voting_number, $user_id)
{
	$sql = "INSERT INTO votingTable (symbol, date, voting, user_id) VALUES ('{$symbol}', '{$date}', '{$voting_number}', '{$user_id}')";
	$result = $conn->query($sql);
	return $result;
}

function readForecast($conn, $symbol)
{
	//3 columns in MySQL: symbol, data, voting
	$sql = "SELECT symbol, date, voting FROM votingTable";
	$result = mysqli_query($conn, $sql);

	// Build array with votings of forecasts 
	// -> calculate average and return it 
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			// echo "id: " . $row["symbol"]. " - Name: " . $row["current_price"]. " " . $row["lastname"]. "<br>";
			if ($row["symbol"] == $symbol) {
				$array_votings[] = $row["voting"];
			}
		}
	} else {
		// echo "0 results";
	}
	if (count($array_votings) > 0) {
		$array_votings = array_filter($array_votings);
		$average = array_sum($array_votings) / count($array_votings);
		$average = round($average);
		$result = $average;
	} else {
		// Default value (no votings available)
		$result = 0;
	}

	return $result;
}

function readStockValue($conn, $symbol)
{
	//3 columns in MySQL: symbol, data, voting
	$sql = "SELECT * FROM wp_stock_ticker_data";
	$result = mysqli_query($conn, $sql);

	// Build array with votings of forecasts 
	// -> calculate average and return it 
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row["symbol"] == $symbol) {
				$last_close_value = (int)$row["last_close"];
			}
		}
	} else {
		// echo "0 results";
	}

	return $last_close_value;
}
?>