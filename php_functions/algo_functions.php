<?php

/*******Server API functions****/
function vote($symbol, $voting_number)
{
	$conn = connectDB();
	$result = insertEntryvotingTable($conn, $symbol, date("d-m-Y H:i:s"), $voting_number);
	// $forecast = readForecast($conn, $symbol);
}

function getVoting($symbol)
{
	$conn = connectDB();
	$forecast = readForecast($conn, $symbol);
	return $forecast;
}

function getStockData($symbol)
{
	$conn = connectDB();
	$actual_value =	readStockValue($conn, $symbol);
	return $actual_value;
}

function getActualValues($symbol)
{
	$stock_data = Wpau_Stock_Ticker::get_stock_from_db($symbol);
	// var_dump($stock_data);
	return $stock_data[$symbol]["last_close"];
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

function insertEntryvotingTable($conn, $symbol, $date, $voting_number)
{
	$sql = "INSERT INTO votingTable (symbol, date, voting) VALUES ('{$symbol}', '{$date}', '{$voting_number}')";
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
				$a[] = $row["voting"];
			}
		}
	} else {
		// echo "0 results";
	}
	$a = array_filter($a);
	$average = array_sum($a) / count($a);
	$average = round($average);
	return $average;
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
				$last_close_value[] = $row["last_close"];
				$last_refreshed = $row["last_refreshed"];
			}
		}
	} else {
		// echo "0 results";
	}
	$last_close_value = array_filter($last_close_value);
	return $last_close_value;
}
