<?php

namespace App\Model;

class Country {

    /** @var string */
    public $country;
    /** @var string */
    public $countryCode;
    /** @var string */
    public $state;

    /**
     * @param string $country
     * @param string $countryCode
     * @param string $state
     */
    public function __construct($country, $countryCode, $state) {
        $this->country = $country;
        $this->countryCode = $countryCode;
        $this->state = $state;
    }


    public function isValid() {
        return (strlen($this->countryCode) !== 2) ?  false : true; 
    }


    public function getCountry() {
        return $this->country;
    }

    public function getCountryCode() {
        return $this->countryCode;
    }

    public function getState() {
        return $this->state;
    }




}