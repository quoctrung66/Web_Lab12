<?php
require_once("SimpleRest.php");
require_once("Car.php");
		
class RestHandler extends SimpleRest {

	var $statusCode = 0;
	var $statusQ = false;

	function getAllCar($format) {	

		$rawData = getAllCar();

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Car found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($format,'json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($format,'html') !== false){
			$response = $this->encodeHtml($rawData, $statusCode);
			echo $response;
		} else if(strpos($format,'xml') !== false){
			$response = $this->encodeXml($rawData, $statusCode);
			echo $response;
		}
	}

	function getOneCar($format, $id) {	

		$rawData = getOneCar($id);

		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Car found!');		
		} else {
			$statusCode = 200;
		}

		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($format,'json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($format,'xml') !== false){
			$response = $this->encodeXml($rawData, $statusCode);
			echo $response;
		}
	}

	function addCar($format, $name, $year){
		$rawData = addCar($name, $year);
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Car found!');		
		} else {
			$statusCode = 200;
			$statusQ = true;
		}
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($format,'json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($format,'xml') !== false){
			$response = $this->encodeXml($rawData, $statusCode, $statusQ);
			echo $response;
		}
	}

	function editCar($format, $id, $name, $year){
		$rawData = editCar($id, $name, $year);
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Car found!');		
		} else {
			$statusCode = 200;
			$statusQ = true;
		}
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($format,'json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($format,'xml') !== false){
			$response = $this->encodeXml($rawData, $statusCode, $statusQ);
			echo $response;
		}
	}

	function deleteCar($format, $id){
		$rawData = deleteCar($id);
		if(empty($rawData)) {
			$statusCode = 404;
			$rawData = array('error' => 'No Car found!');		
		} else {
			$statusCode = 200;
			$statusQ = true;
		}
		$requestContentType = $_SERVER['HTTP_ACCEPT'];
		$this ->setHttpHeaders($requestContentType, $statusCode);
				
		if(strpos($format,'json') !== false){
			$response = $this->encodeJson($rawData);
			echo $response;
		} else if(strpos($format,'xml') !== false){
			$response = $this->encodeXml($rawData, $statusCode, $statusQ);
			echo $response;
		}
	}
	
	public function encodeHtml($responseData, $statusCode) {
		$htmlResponse = "<table>";
		if ($statusCode == 404){
			foreach($responseData as $key=>$value) {
    			$htmlResponse .= "<tr><td>". $key. "</td><td>". $value. "</td></tr>";
			}
			$htmlResponse .= "</table>";
			return $htmlResponse;
		}
		$htmlResponse .= '<tr><td align="left"><b>ID</b></td><td align="left"><b>Name</b></td><td align="left"><b>Year</b></td><td align="left"><b>Tool</b></td></tr>';
		foreach($responseData as $item) {
			$htmlResponse .= "<tr>";
    		foreach($item as $key=>$value) {
    			$htmlResponse .= "<td>". $value. "</td>";
			}
			$htmlResponse .= '<td align="left">
								<input type="button" value="Oke" class="oke" style="display:none"/>
								<input type="button" value="Cancel" class="cancel" style="display:none"/>
								<input type="button" value="Edit" class="edit"/>
								<input type="button" value="Delete" class="del"/>
							</td>';
			$htmlResponse .= "</tr>";
		}
		$htmlResponse .= '<tr>
							<td align="center" colspan="4">
								<label>Name: </label><input type="text" id="name" value=""/>
								<label>Year: </label><input type="text" id="year" value=""/>
								<input type="button" value="Add" class="add"/>
							</td>
						</tr>';
		$htmlResponse .= "</table>";
		return $htmlResponse;		
	}
	
	public function encodeJson($responseData) {
		$jsonResponse = json_encode($responseData);
		return $jsonResponse;		
	}
	
	public function encodeXml($responseData, $statusCode, $statusQ) {
		$xml = new SimpleXMLElement('<?xml version="1.0"?><car></car>');
		if ($statusCode == 404 || $statusQ){
			foreach($responseData as $key=>$value) {
				$xml->addChild($key, $value);
			}
			return $xml->asXML();
		}
		foreach($responseData as $item) {
			$car = $xml->addChild('item','');
			foreach($item as $key=>$value) {
				$car->addChild($key, $value);
			}
		}
		return $xml->asXML();
	}
}
?>