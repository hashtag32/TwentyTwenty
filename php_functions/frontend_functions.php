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

function getScore($stock_diff_array)
{ 
	$score_array=array();
	// Calculate scores
	foreach ($stock_diff_array as $stock_diff){
		$score=2.5+2.5*((int)$stock_diff_array/50);
		array_push($score_array,$score);
	}
	
	// Calculate mean
	if(count($score_array)==0)
	{
		return 0;
	}
	return array_sum($score_array)/count($score_array);
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

?>