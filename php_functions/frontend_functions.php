<?php


// Voting related functions
function getVotings($user_id)
{
	$conn = connectDB();
	return userVotings($conn, $user_id);
}

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
	// return gettype($currentStockValue);
	// $percentage=($prediction / $currentStockValue );
	return ($currentStockValue /  $prediction - 1) * 100;
	// return $percentage;
}

function getScore($percentage_array)
{ 
	$currentStockValue=getStockValue($symbol);
	// return gettype($currentStockValue);
	// $percentage=($prediction / $currentStockValue );
	return ($currentStockValue /  $prediction - 1) * 100;
	// return $percentage;
}

function userVotings($conn, $user_id)
{
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
?>