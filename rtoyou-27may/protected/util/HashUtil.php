<?php
class HashUtil {

	private static $length = 20;
	
	public static function getHash($length=0) {
		if(!isset($length) && $length ==0 ) $length=self::$length;

		$confirm_code=md5(uniqid(rand()));
		return $confirm_code;
		$random = '';
		for ($i = 0; $i < $length; $i++) {
			$random .= chr(mt_rand(33, 126));
		}
		return $random;
		
		$confirm_code=md5(uniqid(rand()));
		return $confirm_code;
	}

}
