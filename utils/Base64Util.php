<?php

namespace App\Util;

/**
 * @author tmastalirsch
 */
class Base64Util {


    public static function decode(string $string)
    {
        return base64_decode($string);
    }

    public static function encode(string $string)
    {
        return base64_encode($string);
    }


    /**  @param File $reference */
    public static function decodeFile(File $reference) 
    {
        $content = $reference->openReadOnly()->read()->getContent();
        return self::decode($content);
    } 



}