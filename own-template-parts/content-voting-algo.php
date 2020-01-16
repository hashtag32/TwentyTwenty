<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 * @subpackage Twenty_Twenty
 * @since 1.0.0
 */

?>

<?php
	function connectDB()
	{
		$conn = new mysqli(constant("DB_HOST"), constant("DB_USER"), constant("DB_PASSWORD"), constant("DB_NAME"));
		// Check connection
		if ($conn->connect_error) {
			die("Connection failed: " . $conn->connect_error);
		}
		return $conn;
	}

	function alert($msg) {
		$msg="pre".$msg;
		echo "<script type='text/javascript'>alert('$msg');</script>";
	}

	function insertEntry($conn, $symbol, $date, $voting_number)
	{
		alert($date);
		$sql = "INSERT INTO votingTable (symbol, date, voting) VALUES ('{$symbol}', '{$date}', '{$voting_number}')";
		$result = $conn->query($sql);
		return $result;
	}

	function readForecast($conn, $symbol)
	{
		//todo: voting as global table name
		$sql = "SELECT symbol, date, voting FROM votingTable";
		$result = mysqli_query($conn, $sql);

		// Build array with votings of forecasts 
		// -> calculate average and return it 
		if (mysqli_num_rows($result) > 0) {
			// output data of each row
			while($row = mysqli_fetch_assoc($result)) {
				// echo "id: " . $row["symbol"]. " - Name: " . $row["current_price"]. " " . $row["lastname"]. "<br>";
				if($row["symbol"]=="Test2")
				{
					return $row["voting"];
				}
			}
		} else { 
			echo "0 results";
		}
	}

	function vote()
	{
		$symbol="TSLA";
		$voting_number = $_POST['voting_number'];

		$conn = connectDB();
		$result=insertEntry($conn, $symbol, date("d-m-Y H:i:s"), $voting_number);
		$forecast=readForecast($conn, $symbol);
	}

	
	if (!empty($_POST['album']))
	{
		alert("test");
		// vote();
	}

	// $albumname = $_GET['album'];
	// echo $albumname;
?>