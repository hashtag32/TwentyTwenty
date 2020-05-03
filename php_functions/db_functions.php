<?php
function InsertDataToDB($tableName,$parameterArray)
{
    $conn = connectDB();
    $sql=construct_sqlArray($tableName, $parameterArray);
	$result = $conn->query($sql);
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