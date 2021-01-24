<?php
namespace App\Model;

use Exception;
/**
 * @description Represent a consignee address for Spring labels
 * @author 
 */
class Address {


    public function __construct(string $street, string $number, string $city, string $zip , Country $country)
    {
        $this->$street = $street;
        $this->$number = $number;
        $this->city = $city;
        $this->zip = $zip;
        $this->country = $country;
    }


    public static function createGermanyAddress(string $street, string $number, string $city, string $zip): self {
        $country = new Country( 'Germany', 'DE' , '');
        return self::create($street, $number, $city, $zip, $country);
    }


    public static function create(string $street, string $number, string $city, string $zip, Country $country): self {
        if(!$country->isValid()){
            throw new Exception('Country code is not 2 letter ISO code');
        }
        return new self($street, $number, $city, $zip, $country);
    }

}