<?php
function InsertDataToDB($tableName,$parameterArray)
{
    $conn = connectDB();
    $sql=construct_sqlArray($tableName, $parameterArray);
	$result = $conn->query($sql);
	return $result;
} 


// Returns 
function queryResultToArray($sqlQueryResult, $rowName=false)
{
	// $symbol=strtoupper($symbol);
	$element_array=array();
	if (mysqli_num_rows($sqlQueryResult) > 0) {
		// output data of each row
		while ($row = mysqli_fetch_assoc($sqlQueryResult)) {
			// echo "id: " . $row["symbol"]. " - Name: " . $row["current_price"]. " " . $row["lastname"]. "<br>";
            if($rowName!=false)
            {
				array_push($element_array,$row[$rowName]); 
            }
            else
            {
                array_push($element_array,$row); 
            }
        }
	} else {
		// echo "0 results";
	}

    return $element_array;
}

function search_strDB($tableName,$columns_array,$search_string)
{
    $sqlString = "SELECT * FROM " . $tableName . " WHERE ";

    foreach($columns_array as $column)
    {
        $sqlString=$sqlString . $column . " LIKE '%" . $search_string . "%' ";
        if(end($columns_array)!=$column)
        {
            $sqlString=$sqlString . " OR ";
        }
    }

    $sqlResult=executeSQLCommand($sqlString);
    $string_array=queryResultToArray($sqlResult);

    return $string_array;
}

function executeSQLCommand($sqlString)
{
    $conn = connectDB();
	$result = $conn->query($sqlString);
	return $result;
}

function construct_sqlArray($tableName, $parameterArray)
{
    $sqlString = "INSERT INTO " . $tableName;
    $sqlString=$sqlString . " (";

    foreach($parameterArray as $key => $value)
    {
        $sqlString=$sqlString . $key;
        if(array_key_last($parameterArray)!=$key)
        {
            $sqlString=$sqlString . ",";
        }
    }

    $sqlString=$sqlString . ") VALUES (";

    foreach($parameterArray as $key => $value)
    {
        $sqlString=$sqlString . "'" . $value . "'";
        if(array_key_last($parameterArray)!=$key)
        {
            $sqlString=$sqlString . ",";
        }
    }

    $sqlString=$sqlString . ") ";
    return $sqlString;
}
?>