<?php
require_once('ConnectDatabase.php');
class Car
{
	var $id;
	var $name;
	var $year;
	function Car($mid, $mname, $myear)
	{
		$this->id = $mid;
		$this->name = $mname;
		$this->year = $myear;
	}
	
}
function getAllCar(){
	$query = mysql_query("SELECT * FROM cars");
	if($query){ 
		$cars = array();
		while($row = mysql_fetch_array($query)){
			$id = $row["id"];
			$name = $row["name"];
			$year = $row["year"];
			array_push($cars, new Car($id, $name, $year));
		}
		return $cars;
	}
}
function getOneCar($id){
	$query = mysql_query("SELECT * FROM cars WHERE id = $id");
	if($query){ 
		$cars = array();
		while($row = mysql_fetch_array($query)){
			$id = $row["id"];
			$name = $row["name"];
			$year = $row["year"];
			array_push($cars, new Car($id, $name, $year));
		}
		return $cars;
	}
}
function addCar($name, $year){
	if (strlen($name) >= 5 && strlen($name) <= 40 && !is_numeric($name) && is_numeric($year) && $year >= 1990 && $year <= 2015 ){
		$query = mysql_query("INSERT INTO cars VALUE('?', '$name','$year')");
		if($query){ 
			return array('status' => 'Success');
		}
		else{
			return array('status' => 'Failed');
		}
	}
	else{
		return array('status' => 'Failed',
					'description' => 'Du lieu nhap khong thoa yeu cau');
	}
}
function editCar($id, $name, $year){
    if (strlen($name) >= 5 && strlen($name) <= 40 && !is_numeric($name) && is_numeric($year) && $year >= 1990 && $year <= 2015 ){
    	if(empty(getOneCar($id))){
    		return array('status' => 'Failed',
				'description' => 'No Car found!');
    	}
        $query = mysql_query("UPDATE cars SET name='$name', year='$year' WHERE id='$id'");
		if($query){ 
			return array('status' => 'Success');
		}
		else{
			return array('status' => 'Failed');
		}
	}
	else{
		return array('status' => 'Failed',
					'description' => 'Du lieu nhap khong thoa yeu cau');
	}
}
function deleteCar($id){
    if(empty(getOneCar($id))){
		return array('status' => 'Failed',
			'description' => 'No Car found!');
	}
    $query = mysql_query("DELETE FROM cars WHERE id=$id");
	if($query){ 
		return array('status' => 'Success');
	}
	else{
		return array('status' => 'Failed');
	}
}
?>