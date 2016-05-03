<?php
require_once("RestHandler.php");

$q = "";
if (isset($_GET["q"]))
	$q = $_GET["q"];

$format = "html";
if (isset($_GET["format"]))
	$format = $_GET["format"];

$id = "-1";
if (isset($_GET["id"]))
	$id = $_GET["id"];

$name = "";
if (isset($_GET["name"]))
	$name = $_GET["name"];

$year = "";
if (isset($_GET["year"]))
	$year = $_GET["year"];

switch ($q) {
	case 'selectall':
		$restHandler = new RestHandler();
		$restHandler->getAllCar($format);
		break;

	case 'selectone':
		$restHandler = new RestHandler();
		$restHandler->getOneCar($format, $id);
		break;
	
	case 'add':
		$restHandler = new RestHandler();
		$restHandler->addCar($format, $name, $year);
		break;

	case 'edit':
		$restHandler = new RestHandler();
		$restHandler->editCar($format, $id, $name, $year);
		break;

	case 'delete':
		$restHandler = new RestHandler();
		$restHandler->deleteCar($format, $id);
		break;
		break;
}
?>