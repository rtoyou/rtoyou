<?php
class ImageUtil {

	/*
	 * $type - error,success
	* $message - response message
	* $errorCode - 0 for success - default
	* $data - response array
	* $resType - json,xml,txt default-json
	*/
	public static function download($url=null) {
		try{
			$fileName=time();
			$file = file_get_contents($url);
			$ext = pathinfo($url,PATHINFO_EXTENSION);
			if(!$ext) {
				$ext = "jpg";
			}
			$filepointer = fopen(CConfig::get('ImageServerPath').'profile'.DS.$fileName.'.'.$ext, "w");
			fwrite($filepointer, $file);
			chmod(CConfig::get('ImageServerPath').$fileName.'.'.$ext,0777);
			fclose($filepointer);

			return $fileName.'.'.$ext;
		} catch(Exception $e) {
			return false;
		}
	}

	/*
	 * Returns
	* filename on success
	* 0 - unknown error
	* 1 - format error
	* 2 - size exceed maximum - 5MB
	* 3 - file not found
	*/

	public static function uploadImage($imagearray=array(),$profile=false) {
		$success = 0;
		try {
			if(!empty($imagearray)){
				$validformats = CConfig::get('imageformat');
				$imageName = time();
				$tmpname = $imagearray['tmp_name'];
				$size = $imagearray['size'];
				$ext = $imagearray['ext'];
				$part = explode('/', $ext);
				$extension=$part[1];
				if(in_array($ext, $validformats)) {
					if($size <= CConfig::get('maxfilesize')){
						if($tmpname){
							$type=$profile?'profile':'posts';
							if(move_uploaded_file($tmpname, CConfig::get('ImageServerPath').$type.DS.$imageName.'.'.$extension)){
								chmod(CConfig::get('ImageServerPath').$type.DS.$imageName.'.'.$extension, 0777);
								return $imageName.'.'.$extension;
							}
						} else {
							return  (int) 3;
						}
					} else {
						return (int) 2;
					}
				} else {
					return (int) 1;
				}
			}
			return 0;
		}catch(Exception $e) {
			return false;
		}
	}
}
