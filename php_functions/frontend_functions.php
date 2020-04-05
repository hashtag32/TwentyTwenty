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

function getStockDiff($symbol, $prediction)
{ 
	$currentStockValue=getStockValue($symbol);
	return ($currentStockValue /  $prediction - 1) * 100;
}

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
	return 0;
}

?>