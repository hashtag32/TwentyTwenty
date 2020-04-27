<?php


// Voting related functions
function getDaysLeft($date_due)
{
	// Due date
	$due_date_date=date("d-m-Y H:i:s",strtotime('+30 days',strtotime($date_due)));
	$date_due_DateTime=new DateTime($due_date_date);
  
	// Date now
	$date_now_date=date("d-m-Y H:i:s");
	$date_now_DateTime=new DateTime($date_now_date);
  
	// Diff
	$interval = date_diff($date_now_DateTime,$date_due_DateTime);
	return $interval->format('%r%a');
}

function getStockDiff($symbol, $prediction, $stockValue=0)
{ 
	if($stockValue==0)
	{
		// Read from SQL
		$stockValue=getStockValue($symbol);
	}

	// division by zero
	// todo: use nan instead of -100
	if($stockValue==0)
	{
		return -100;
	}
	return ( $prediction / $stockValue - 1) * 100;
}


function getPredictionScore($symbol)
{ 
	$dataArr=fetch_fmpcloud_feed($symbol, "rating")[0];
	
	return $dataArr["ratingScore"];
}

function fetch_stock_search($symbol)
{
	$feed_url='https://fmpcloud.io/api/v3/search?query=' . $symbol  . '&limit=10&apikey=fd1432a9b894108cc5852e4a0f4a29ba';
	$dataArr=fetch_fmpcloud_feed($symbol, "search", $feed_url);

	$stock_array=array(); 

	foreach( $dataArr as $dataEle)
	{
		$obj = new stdClass;
		$obj->name=$dataEle["name"];
		$obj->slug="stocks/" . $dataEle["symbol"];
		$obj->taxonomy="category";

		array_push($stock_array,  $obj );

		$category_id=checkCategory($dataEle["symbol"]); // if true -> category already exists, else get_term (cat_id)
		// category_id currently not usable because wp_insert_category returns an element that is not usable in content-search.php
		// Maybe do it through jquery would be the correct way
		// if($category_id==true){
		// 	array_push($stock_array,  get_term($category_id) );
		// }  
	}
	// sleep(1); //wait for elements to sql - shouldn't be required (waiting for data to be loaded to SQL)
	return $stock_array;
}

function getPercentage($value)
{
	return $value*100;
}

// todo: should be cronjob
function getScore($user_id)
{ 
	// Collect stock_diffs
	$stock_diff_array=array();
	foreach (getVotings($user_id) as $voting_array)
	{ 
		$stock_diff=getStockDiff($voting_array["symbol"],(int)$voting_array["voting"]);
		array_push($stock_diff_array,$stock_diff);



	}

	// Calculate scores 
	$score_array=array();
	foreach ($stock_diff_array as $stock_diff_element){
		$stock_diff_value=(float)$stock_diff_element;
		$stock_diff_value=abs($stock_diff_value);
		
		// y=5*0.972^stock_diff
		// y=2.5 -> should be at stock_diff=25
		$score=5*pow(0.9726549474,$stock_diff_value); 
		array_push($score_array,$score);
	}
	
	if(count($score_array)==0)
	{
		return 0;
	}
	
	return round(array_sum($score_array)/count($score_array),2);
}

function getVotings( $user_id)
{
	$conn = connectDB();
	//3 columns in MySQL: symbol, data, voting
	// SELECT * FROM `votingTable` WHERE `user_id` = 1
	$sql = "SELECT symbol, date, voting, user_id FROM votingTable";
	$result = mysqli_query($conn, $sql);

	// output data of each row
	while ($row = mysqli_fetch_assoc($result)) {
		// echo "id: " . $row["symbol"]. " - Name: " . $row["current_price"]. " " . $row["lastname"]. "<br>";
		if ($row["user_id"] == $user_id) {
			$array_votings[] = $row;
		}
	}
	return $array_votings;
}


function delete_all_votes($user_id)
{
	$conn = connectDB();
	$sql = 'DELETE FROM `votingTable` WHERE `user_id` = ' . $user_id;
	$result = mysqli_query($conn, $sql);

	return $result;
}

function getStockName($symbol)
{
	$conn = connectDB();
	$sql = "SELECT SymbolName, StockName FROM SymbolNameToStockName";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		// just get the first value -> Cleanup manual required
		if ($row["SymbolName"] == $symbol) {
			return $row["StockName"];
		}
	}
	if(empty($row["StockName"]))
	{
		//Get stockName from API
		fetchStockName($symbol);
	}
}

function getSymbolName($stockName)
{
	$conn = connectDB();
	$sql = "SELECT SymbolName, StockName FROM SymbolNameToStockName";
	$result = mysqli_query($conn, $sql);

	while ($row = mysqli_fetch_assoc($result)) {
		// just get the first value -> Cleanup manual required
		if ($row["StockName"] == $stockName) {
			return $row["SymbolName"];
		}
	}
	return "";
}


function getAllSymbols()
{
	$conn = connectDB();
	$sql = "SELECT SymbolName FROM SymbolNameToStockName";
	$result = mysqli_query($conn, $sql);

	$symbolList=array();
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($symbolList, $row["SymbolName"]);
		}
	}

	return $symbolList;
}


 
// Getter for stock analysis

function RDExpenseGrowth($symbol)
{
	$stock_values=getValues_quarterly($symbol,"financial-growth", "rdexpenseGrowth");
	return mean_yearly($stock_values);
}


function RevenueGrowth($symbol)
{
	$stock_values=getValues_quarterly($symbol,"financial-growth", "revenueGrowth");
	return mean_yearly($stock_values);
}

function GrossProfitgrowth($symbol)
{
	$stock_values=getValues_quarterly($symbol,"financial-growth", "grossProfitGrowth");
	return mean_yearly($stock_values);
}

function EPSGrowth($symbol)
{
	$stock_values=getValues_quarterly($symbol,"financial-growth", "epsgrowth");
	return mean_yearly($stock_values);
}


function OpCFGrowth($symbol)
{
	$stock_values=getValues_quarterly($symbol,"financial-growth", "operatingCashFlowGrowth");
	return mean_yearly($stock_values);
}


function EPS_Mean($symbol)
{
	$stock_values=getValues_quarterly($symbol,"income-statement", "eps");
	return mean_yearly($stock_values);
}



function fmp_key_first($symbol, $fmp_category, $key)
{
	return fetch_fmpcloud_feed($symbol, $fmp_category)[0][$key];
}


function getMostVotedStocks($max_count) 
{
	$conn = connectDB();
	// SQL in format (TSLA,51), get sorted list by count of symbol
	$sql = "SELECT symbol, count(symbol) as count FROM votingTable GROUP BY symbol ORDER BY count DESC LIMIT " . $max_count;
	$result = mysqli_query($conn, $sql);

	$symbolSortedList=array();
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($symbolSortedList, $row["symbol"]);
		}
	}

	return $symbolSortedList;
}

function getHighestConfidence($max_count) 
{
	$conn = connectDB();
	// SQL in format (TSLA,51), get sorted list by count of symbol
	$sql="SELECT symbol, stockName, stockPrice, votingPrice, stockDiff FROM StockTable ORDER BY stockDiff DESC LIMIT " . $max_count;
	$result = mysqli_query($conn, $sql);

	$symbolSortedList=array();
	if (mysqli_num_rows($result) > 0) {
		while ($row = mysqli_fetch_assoc($result)) {
			array_push($symbolSortedList, $row["symbol"]);
		}
	}

	return $symbolSortedList;
}


// General functions
function getValues_quarterly($symbol, $fmp_category, $key)
{
	$feed_url='https://fmpcloud.io/api/v3/' . $fmp_category . '/' . $symbol . '?period=quarter&apikey=fd1432a9b894108cc5852e4a0f4a29ba';
	$stock_data=fetch_fmpcloud_feed($symbol, $fmp_category, $feed_url);
	
	$value_array=array();

	$i=0;
	foreach($stock_data as $item)
	{
		if($i>11)  
		{ 
			break;
		}
		array_push($value_array,$item[$key]);
		$i++;
	}
	return $value_array; 
}


// General functions
function getValues_quarterly_income_statement($symbol, $fmp_category, $key)
{
	$feed_url='https://fmpcloud.io/api/v3/' . $fmp_category . '/' . $symbol . '?period=quarter&apikey=fd1432a9b894108cc5852e4a0f4a29ba';
	$stock_data=fetch_fmpcloud_feed($symbol, $fmp_category, $feed_url);
	
	$value_array=array();

	$i=0;
	foreach($stock_data as $item)
	{
		if($i>11)  
		{ 
			break;
		}
		array_push($value_array,$item[$key]);
		$i++;
	}
	return $value_array; 
}

function mean_yearly($list_quarterly)
{
	return mean($list_quarterly)*4;
}

function mean($list)
{
	// Filter empty values
	$list= array_filter($list);
	$average = floatval(array_sum($list)/count($list));
	return $average;
}


function display_eval_nr($number)
{
	return round($number,2);
}





// // Getter for the pmi
// function getMostVoted()
// {
// 	// Get all categories

// 	// iterate


// }

?>