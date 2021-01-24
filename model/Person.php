<?php
namespace App\Model;

use Exception;
/**
 * @description Represent a consignor or consignee for Spring labels
 * @author
 */
class Person {

    const AVAILABLE_CHAR_LENGTH = 44;

    /** @var string */
    public $firstName;
    /** @var string */
    public $lastName;
    /** @var string */
    public $email;
    /** @var string */
    public $phone;
    /** @var string */
    public $company;

    /** @var bool */
    private $isConsignor;


    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone
     * @param string $company
     * @param bool $isConsignor
     */
    public function __construct($firstName, $lastName, $email, $phone, $company , $isConsignor)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->email = $email;
        $this->phone = $phone;
        $this->company = $company;
        $this->isConsignor = $isConsignor;
    } 

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone is optional by default empty
     * @param string $company is optional by default empty
     * @throws Exception
     * @return self
     */
    public static function createConsignor($firstName, $lastName, $email, $phone = '', $company = '') {
        return self::create($firstName, $lastName, $email, $phone, $company,true);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone is optional by default empty
     * @param string $company is optional by default empty
     * @throws Exception
     * @return self
     */
    public static function createConsignee($firstName, $lastName, $email, $phone = '', $company = '') {
        return self::create($firstName, $lastName, $email, $phone, $company,false);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone
     * @param string $company
     * @throws Exception
     * @return self
     */
    public static function create($firstName, $lastName, $email, $phone, $company, $isConsignor) {

        if(empty($firstName) || empty($lastName)) {
            throw new Exception("First name and last name fields are required");
        }

        if(!self::isFullNameValid($firstName, $lastName)){
            throw new Exception('Full name not longer than' . self::AVAILABLE_CHAR_LENGTH . ' chars');
        }

        if(!self::isStrLenValid($company)) {
            throw new Exception('Company name not longer than' . self::AVAILABLE_CHAR_LENGTH . ' chars');
        }

        return new self($firstName, $lastName, $email, $phone, $company, $isConsignor);
    }

    /**
     * @param string $firstName
     * @param string $lastName
     * @return bool
     */    
    public static function isFullNameValid($firstName, $lastName) {
        $fullName = $firstName + ' ' + $lastName;
        return self::isStrLenValid($fullName);
    }

    /**
     * @param string $input
     * @return bool
     */ 
    public static function isStrLenValid($input) {
        if ((strlen($input) > self::AVAILABLE_CHAR_LENGTH) || (
            strpos($input, '|') !== false )) {
            return false;
        }
        return true;
    }


    /** @return string */
    public function  getFirstName() {
        return $this->firstName;
    }

    /** @return string */
    public function  getLastName() {
        return $this->LastName;
    }

    /** @return string */
    public function getEmail() {
        $this->email;
    }

    /** @return string */
    public function getPhone() {
        return $this->phone;
    }

    /** @return string */
    public function getCompany() {
       return $this->company;
    }
    
    /** @return bool */
    public function hastPhone() {
        return empty($this->phone);
    }

    /** @return bool */
    public function hastCompany() {
        return empty($this->company);
    }

    /** @return bool */
    public function isConsignor() {
        return $this->isConsignor;
    }

    /** @return bool */
    public function isConsignee() {
        return !$this->isConsignor;
    }

    /** @return string */
    public function getFullName() {
        return $this->firstName . ' ' . $this->lastName;  
    } 
}