<?php 

use CurlHandle;

class Curl {
	
    private static function init(): CurlHandle
    {
		return curl_init();
	}
	
    private static function exec(CurlHandle $ch): string 
    {
		$result = curl_exec($ch);
		self::close($ch);
		return $result;
	}
	
    private static function close($ch): void
    {
		curl_close($ch);
	}
		
	
    private static function setURL(CurlHandle $ch, string $url): void
    {
		curl_setopt($ch, CURLOPT_URL, $url);
	}
	
    private static function setPOST(CurlHandle $ch, string $json): void
    {
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
		curl_setopt( $ch, CURLOPT_HTTPHEADER, array('Accept-Type: application/json'));
		curl_setopt($ch, CURLOPT_POSTFIELDS, $json);
		curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true);
	}
	

    public static function post(string $url, string $json): ?string
    {
		$ch = self::init();
		self::setURL($ch, $url);
		self::setPOST($ch, $json);
		$response = self::exec($ch);
		return json_decode($response, true);
	}
}