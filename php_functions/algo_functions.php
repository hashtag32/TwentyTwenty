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
		return createCategory($symbolName); 
	}
	return true;
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
	require_once( ABSPATH . '/wp-admin/includes/taxonomy.php');

	$stockName=getStockName($symbolName);

	//Define the category
	$category_to_insert = array('cat_name' => $stockName, 'category_nicename' => $symbolName, 'category_parent' => '187'  );
	
	// Create the category
	$category_to_insert_id = wp_insert_category($category_to_insert);
	return $category_to_insert_id;
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


function fetchStockName($symbol)
{
	// Get name from API
	$data_arr=fetch_fmpcloud_feed($symbol, "quote");
	$stockName=$data_arr["name"];
	
	// Insert into DB
	insertStockName($symbol,$stockName);

	return $stockName;
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

	$data_arr=fetch_fmpcloud_feed($symbol, "quote");
	$price=$data_arr["price"];
	 
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

function insertStockName($symbolName, $stockName)
{
	$conn = connectDB();
	$sql = "INSERT INTO SymbolNameToStockName (symbolName, stockName) VALUES ('{$symbolName}', '{$stockName}')";
	$result = $conn->query($sql);
	return $result;

}

function insertStockValue($symbol, $date_now, $price)
{
	$conn = connectDB();
	$sql = "INSERT INTO SymbolDatePrice (symbol, date, price) VALUES ('{$symbol}', '{$date_now}', '{$price}')";
	$result = $conn->query($sql);
	return $result;
}

function fetch_fmpcloud_feed( $symbol, $type ) {
	if ($type=="search") {
		$feed_url = 'https://fmpcloud.io/api/v3/search?query=' . $symbol . '&limit=3&apikey=fd1432a9b894108cc5852e4a0f4a29ba';
	}
	else
	{
		$feed_url = 'https://fmpcloud.io/api/v3/'. $type . '/' . $symbol . '?apikey=fd1432a9b894108cc5852e4a0f4a29ba';
	}
	
	//todoSet timer to fetch according to alpha vantage restr aints
	$wparg = array(
		// 'timeout' => intval( $defaults['timeout'] ), 
	);

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
		if($type=="search")
		{
			$data_arr=$response_arr;
		}
		else
		{
			$data_arr=$response_arr[0];
		}
		unset( $response_arr );
	}

	return $data_arr; 

} 


?>