<?php
class ResponseUtil {

	private static $key	=	"Response";

	/*
	 * $type - error,success 
	 * $message - response message
	 * $errorCode - 0 for success - default
	 * $data - response array
	 * $resType - json,xml,txt default-json
	 */
	public static function setResponse($type='error',$message='',$errorCode=0,$data,$resType='json') {
		if($resType == 'json') {
			return self::getJSON($type,$message,$errorCode,$data);	
		} else if($resType == 'xml') {
			return self::getXML($type,$message,$errorCode,$data);
		} else if($resType == 'txt') {
			return self::getText($type,$message,$errorCode,$data);
		}else {
			return self::getJSON($type,$message,$errorCode,$data);
		}
		return null;
	}

	private static function getJSON($type,$message,$errorCode,$data){
		header('Content-type: application/json');
		return json_encode(array('success'=>$type,'message'=>$message,'ErrorCode'=>$errorCode,'data'=>$data));
	}

	private static function getText($type,$message,$errorCode,$data) {
		header('Content-type: plain/text');
		return implode(',',array('success'=>$type,'message'=>$message,'ErrorCode'=>$errorCode,'data'=>$data));
	}

	private static function getXML($type='error',$message='',$errorCode=0,$data) {

		header('Content-type: text/xml');
		header('Pragma: public');
		header('Cache-control: private');
		header('Expires: -1');

		try {
			$xml  = new SimpleXMLElement('<rtoyou></rtoyou>');
			$xml->addChild('Error',$type);
			$xml->addChild('ErrorCode',$errorCode);
			$xml->addChild('Message',$message);
				
			$response = $xml->addChild('data');
			if(count($data)>1){
				$response->addAttribute("multiple", true);
			} else {
				$response->addAttribute("multiple", false);
			}
			self::array_to_xml($data, $response);

			return $xml->asXML();
		}catch(Exception $e){
			var_dump($e);
		}

	}

	private static function array_to_xml($array, &$xml) {
		foreach($array as $key => $value) {
			if(is_array($value)) {
				if(!is_numeric($key)){
					$subnode = $xml->addChild("$key");
					self::array_to_xml($value, $subnode);
				} else {
					$c = $xml->addChild(self::$key.$key);
					self::array_to_xml($value, $c);
				}
			} else {
				$xml->addChild("$key","$value");
			}
		}
	}
}