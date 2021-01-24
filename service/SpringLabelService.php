<?php
namespace App\Service;

use App\Model\Address;
use App\Model\Country;
use App\Model\Person;
use App\Commands\OrderShipmentCommand;
use App\Commands\GetShipmentLabelCommand;
use Exception;


class SpringParcelService extends ParcelServiceBasic {


    const TOKEN = '';
    const UNTRACKED_SERVICE = 'UNTR';
    const DEFAULT_LABEL_FORMAT = 'PDF';
    const NOT_ALLOWED_COUNTRY_ID = 1;

    public string $filePath;
    public string $labelFormat;
    public string $service;

   
    private function __construct(string $token, string $labelFormat = self::DEFAULT_LABEL_FORMAT, string $service = self::UNTRACKED_SERVICE) 
    {
        $this->token = $token; 
        $this->labelFormat = $labelFormat;
        $this->service = $service;
        $this->countryCode = $this->select('SELECT id as country_id, iso_code_2, region, name, zip_min, zip_max FROM shipping_country');
    }

    public static function init(string $token) {
        return new self($token);
    }

    public function setLabelFormat($format)
    {
        $this->labelFormat = $format;
    }

    public function setService($service)
    {
        $this->service = $service;
    }

    /** @return ShippingLabelInfo */
    public function addShippingLabel(
        $shippingLabelId, 
        $filename, 
        $referenceName, 
        $orderType, 
        $firstName, 
        $lastName, 
        $companyName1, 
        $companyName2, 
        $streetName, 
        $streetNumber, 
        $zip, 
        $city, 
        $stateProvinceCode, 
        $countryId, 
        $countryName, 
        $contactPerson, 
        $contactMail, 
        $contactPhone, 
        $isUsk, 
        $totalInvoice, 
        $shippingCost, 
        $itemQuantity,
        $weight, 
        $items, 
        $isPackingStation, 
        $isExpress) {

        try {

            if (!isset($this->countryCode[$countryId])) {
                throw new Exception("Missing region for country code: '. $countryId");
            }

            $company = empty($companyName1) ? (
                (empty($companyName2)) ? '' : $companyName2 
                ) : $companyName1;
         
            $consignee = Person::createConsignee(
                $firstName, 
                $lastName, 
                $contactMail,
                $contactPhone,  
                $company);

           
            $countryCode = $this->countryCode[$countryId]->iso_code_2;

            $country = new Country($countryName, $countryCode, '');
            $address = Address::create($streetName, $streetNumber, $city, $zip, $country);

            $orderShipment = $this->createOrderShipmentCommand($referenceName);
            // $items, $itemQuantity
            $this->orderShipment($orderShipment, $consignee, $address);
            return new ShippingLabelInfo(true);
               
        } catch (Exception $e) {
            return new ShippingLabelInfo(false, $e->getMessage());
        }
    }   

    
    public function createOrderShipmentCommand(string $reference): OrderShipmentCommand {
        return new OrderShipmentCommand($this->labelFormat, $reference, $this->service);
    }

    public function createGetShipmentLabelCommand(string $reference): GetShipmentLabelCommand {
        return new GetShipmentLabelCommand($this->labelFormat, $reference, $this->service);
    }



    public function orderShipment(OrderShipmentCommand $shipment,  Person $consignee, Address $address)
    {   

    }

}