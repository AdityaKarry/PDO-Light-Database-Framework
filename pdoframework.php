<?php
/*
Light Database Operations Framework
Implementation of the DatabaseOp using PDO.
Version : 1.0
*/



class MyFrameWork
{
public $con = null;

/*Create connection*/

public function initialize()
{
	try
	{
		global $con;
		$con = new PDO('mysql:host=localhost;dbname=name_of_database',"username","password");
	}

	catch(PDOException $e)
	{
		print $e->getMessage();
		echo "<br/>";
	}
}

/*Viewing Records from the table*/

public function viewRecords($tablename,$fieldname)
{
	$this->initialize();
	global $con;
	$qry = "select * from " . $tablename;
	$stmt = $con->prepare($qry);
	$stmt->execute();
	while($row = $stmt->fetch())
	{
		echo $row[$fieldname]." ";
	}
}

/*Viewing Records from table by specifying the id of the entry */

public function viewRecordById($tablename,$id,$num)
{
	global $con;
	$this->initialize();
	$qry = "select * from " . $tablename . " where " . $id . " = $num ";
	$stmt = $con->prepare($qry);
	$stmt->execute();
/*	while($row1 = $stmt->fetch())
	{
		foreach($row1 as $values)
		{
		echo $values." ";
		}
	}
*/

       $row = $stmt->fetch(PDO::FETCH_ASSOC);// can use PDO::FETCH_NUM or PDO::FETCH_BOTH, BOTH gives records by indexing and fieldname both.
	return $row;
}

public function insertData($tablename,$fields,$values)
{
    global $con;
    $this->initialize();
    /*
    $tablename -> Name of the table
    $fields -> array of fields of the table . Ex: $fields = array("field1","field2",...,"fieldn");
    $values -> array of values passed according to the fields of table . Ex: $values = array("value1","value2","value3",...);
    */
    $qry = "insert into " . $tablename . "( " . $fields . " ) values(" . $values . ")";
    $stmt = $con->prepare($qry);
    $stmt->execute();
}


?>
