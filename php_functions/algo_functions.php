<?php

/*******Server API functions****/
function vote($symbol, $voting_number,$user_id)
{
	checkCategory($symbol);
	
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

function createCategory($symbolName)
{
	$stockName=getStockName($symbolName);

	//Define the category
	// TODO: cat_name is Tesla, nice_name is tsla!!! 
	$wpdocs_cat = array('cat_name' => $stockName, 'category_nicename' => $symbolName );
	
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
	$sql = "SELECT * FROM SymbolDatePrice";
	$result = mysqli_query($conn, $sql);

	// Search in the DB first
	if (mysqli_num_rows($result) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($result)) {
			if ($row["symbol"] == $symbol) {
				//todo: Get newest date (currently through order)
				$date_db = $row["date"];
				$price_db=$row["price"];
			}
		}
	} else {
		// Symbol is not even in there -> insert
	}

	$date_now=date("d-m-Y H:i:s");
	$hours_diff=getHoursDiff($date_now, $date_db);

	if($hours_diff>2)
	{
		// Get from Alpha Vantage
		$price=updateStockValue($symbol, $date_now);
		if($price_av==0)
		{
			return $price_db;
		}
	}

	// Read from DB
	return $price=$price_db;
}
 
function updateStockValue($symbol, $date_now) 
{
	// Get newest value from alpha vantage

	// Re-Try 3 times | Current problem: Unresolved Bad API Problem occur very often -> read from datebase as soon as possible
	$price=0;
	for ($i = 0; ($i <= 3) && ($price==0); $i++) {
		$data_arr=fetch_alphavantage_feed($symbol);
		$price=$data_arr["price"];
	}
	
	// Insert if not erroneus
	if($price!=0)
	{
		insertStockValue($symbol, $date_now, $price);
	}
	// Not successful
	return $price; 
}

function getHoursDiff($date1,$date2)
{
	// Due date
	$date1_date=date("d-m-Y H:i:s",strtotime($date1));
	$date1_DateTime=new DateTime($date1_date);
  
	// Date now
	$date2_date=date("d-m-Y H:i:s",strtotime($date2));
	$date2_DateTime=new DateTime($date2_date);
  
	// Diff
	$interval = date_diff($date1_DateTime,$date2_DateTime);
	return $interval->format('%h');
}

function insertStockValue($symbol, $date_now, $price)
{
	$conn = connectDB();
	$sql = "INSERT INTO SymbolDatePrice (symbol, date, price) VALUES ('{$symbol}', '{$date_now}', '{$price}')";
	$result = $conn->query($sql);
	return $result;
}

function fetch_alphavantage_feed( $symbol ) {

	// self::log( "Fetching data for symbol {$symbol}..." );

	// Get defaults (for API key)
	// $defaults = $this->defaults;

	// Exit if we don't have API Key
	// if ( empty( $defaults['avapikey'] ) ) {
	// 	return 'Stock Ticker Fatal Error: AlphaVantage.co API key has not set';
	// }

	// Define AplhaVantage API URL
	// self::log( "Using GLOBAL_QUOTE for {$symbol}..." );
	$feed_url = 'https://www.alphavantage.co/query?function=GLOBAL_QUOTE&apikey=XKWVUWQ9QOUW98DB&datatype=json&symbol=' . $symbol;

	//todoSet timer to fetch according to alpha vantage restraints
	$wparg = array(
		// 'timeout' => intval( $defaults['timeout'] ),
	);

	// self::log( 'Fetching data from AV: ' . $feed_url );
	$response = wp_remote_get( $feed_url, $wparg );

	// Initialize empty $json variable
	$data_arr = '';

	// If we have WP error log it and return none
	if ( is_wp_error( $response ) ) {
		return 'Stock Ticker got error fetching feed from AlphaVantage.co: ' . $response->get_error_message();
	} else {
		// Get response from AV and parse it - look for error
		$json = wp_remote_retrieve_body( $response );
		$response_arr = json_decode( $json, true );
		// If we got some error from AV, log to self::log and return none
		if ( ! empty( $response_arr['Error Message'] ) ) {
			return 'Stock Ticker connected to AlphaVantage.co but got error: ' . $response_arr['Error Message'];
		} else if ( ! empty( $response_arr['Information'] ) ) {
			return 'Stock Ticker connected to AlphaVantage.co and got response: ' . $response_arr['Information'];
		} 
		else if ( ! isset( $response_arr['Global Quote'] ) ) {
			// return array_keys($response_arr['Global Quote']);
			// return $response_arr['Global Quote'];
			// return 'Bad API';
			return 'Bad API response: Stock Ticker connected to AlphaVantage.co and received response w/o Global Quote object!';
		} else {
			// Crunch data from AlphaVantage for symbol and prepare compact array
			// self::log( "We got some data from AlphaVantage for $symbol, so now let we crunch them and save to database if possible..." );

			// GLOBAL_QUOTE
			$quote = $response_arr['Global Quote'];
			if ( empty( $quote['07. latest trading day'] ) ) {
				return 'Bad API response: Stock Ticker connected to AlphaVantage.co and received empty Global Quote object.';
			}
			$data_arr = array(
				't'   => $symbol,
				'pc'  => $quote['08. previous close'],
				'c'   => $quote['09. change'],
				'cp'  => str_replace( '%', '', $quote['10. change percent'] ),
				'price'   => $quote['05. price'], // $last_close,
				'lt'  => $quote['07. latest trading day'], // $last_trade_refresh,
				'ltz' => 'US/Eastern', // default US/Eastern
				'r'   => "{$quote['04. low']} - {$quote['03. high']}", // $range,
				'o'   => $quote['02. open'], // $last_open,
				'h'   => $quote['03. high'], // $last_high,
				'low' => $quote['04. low'], // $last_low,
				'v'   => $quote['06. volume'], // $last_volume,
			);
			// self::log( 'data_arr w/o raw JSON: ' . print_r( $data_arr, 1 ) );
			$data_arr['raw'] = $json;

		}
		unset( $response_arr );
	}

	return $data_arr;

} // END function fetch_alphavantage_feed( $symbol )


?>