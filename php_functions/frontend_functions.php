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
	$due_date_date=date($date_due);
	$date_due_DateTime=new DateTime($date_due);
	// $due_date_time= strtotime($due_date); 
    // $due_date_date=date("d-m-Y H:i:s", $due_date_time);
  
	// Date now
	$date_now_date=date("d-m-Y H:i:s");
	$date_now_DateTime=new DateTime($date_now_date);
	// $interval = date_diff($due_date_date, $date_now_date); 
  
	// Diff
	$interval = $date_due_DateTime->diff($date_now_DateTime);
	return $interval->format('%a');
}

function getStockDiff($symbol, $prediction)
{
	$currentStockValue=getStockValue($symbol);
	// return gettype($currentStockValue);
	// $percentage=($prediction / $currentStockValue );
	return ($prediction /  $currentStockValue - 1) * 100;
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