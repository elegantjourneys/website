<?php
include_once(BASEPATH."class/first-class.php");
final class ip2location_lite extends FirstClass{
	protected $errors = array();
	protected $service = 'api.ipinfodb.com';
	protected $version = 'v3';
	protected $apiKey = 'f2a1699e7e2662e37434b7cf95380c2d6a15eb7cdb686a61a972796f835ca3c2';

	public function __construct(){}

	public function __destruct(){}

	public function setKey($key){
		if(!empty($key)) $this->apiKey = $key;
	}

	public function getError(){
		return implode("\n", $this->errors);
	}

	public function getCountry($host){
		return $this->getResult($host, 'ip-country');
	}

	public function getCity($host){
		
		return $this->getResult($host, 'ip-city');
	}

	private function getResult($host, $name){
		$ip = @gethostbyname($host);
			
			$xml = @file_get_contents('http://' . $this->service . '/' . $this->version . '/' . $name . '/?key=' . $this->apiKey . '&ip=' . $ip . '&format=xml');


			if (get_magic_quotes_runtime()){
				$xml = @stripslashes($xml);
			}

			try{
				$response = @new SimpleXMLElement($xml);

				foreach($response as $field=>$value){
					$result[(string)$field] = (string)$value;
				}

				return $result;
			}
			catch(Exception $e){
				$this->errors[] = $e->getMessage();
				return;
			}
		

		$this->errors[] = '"' . $host . '" is not a valid IP address or hostname.';
		return;
	}


	function getUserIpDetail($remoteAddress)
	{
		
	 	//Load the class
		$this->setKey('f2a1699e7e2662e37434b7cf95380c2d6a15eb7cdb686a61a972796f835ca3c2');
		//Get errors and locations
		$locations = $this->getCity($remoteAddress);
		return $locations;
	}



}
?>