<?php

namespace App\Util;

interface IParcelService {

    /**
     * @param $shippingLabelId
     * @param $filename
     * @param $referenceName
     * @param $firstName
     * @param $lastName
     * @param $companyName1
     * @param $companyName2
     * @param $streetName
     * @param $streetNumber
     * @param $zip
     * @param $city
     * @param $stateProvinceCode
     * @param $countryId
     * @param $countryName
     * @param $contactPerson
     * @param $contactMail
     * @param $contactPhone
     * @param $isUsk
     * @param $totalInvoice
     * @param $shippingCost
     * @param $itemQuantity
     * @param $weight
     * @param $isPackingStation
     * @param $isExpress
     * @param $items
     * @param $orderType
     * @return ShippingLabelInfo
     */
    public function addShippingLabel($shippingLabelId, $filename, $referenceName, $orderType, $firstName, $lastName, $companyName1, $companyName2, $streetName, $streetNumber, $zip, $city, $stateProvinceCode, $countryId, $countryName, $contactPerson, $contactMail, $contactPhone, $isUsk, $totalInvoice, $shippingCost, $itemQuantity, $weight, $items, $isPackingStation, $isExpress);

    /**
     * @param $shippingLabelId
     * @param $filename
     * @param $referenceName
     * @param $firstName
     * @param $lastName
     * @param $companyName1
     * @param $companyName2
     * @param $streetName
     * @param $streetNumber
     * @param $zip
     * @param $city
     * @param $stateProvinceCode
     * @param $countryId
     * @param $countryName
     * @param $contactPerson
     * @param $contactMail
     * @param $contactPhone
     * @param $isUsk
     * @param $totalInvoice
     * @param $shippingCost
     * @param $itemQuantity
     * @param $weight
     * @param $isPackingStation
     * @param $isExpress
     * @param $codAmount
     * @param string $codCurrency
     * @return ShippingLabelInfo
     */
    public function addShippingLabelCOD($shippingLabelId, $filename, $referenceName, $firstName, $lastName, $companyName1, $companyName2, $streetName, $streetNumber, $zip, $city, $stateProvinceCode, $countryId, $countryName, $contactPerson, $contactMail, $contactPhone, $isUsk, $totalInvoice, $shippingCost, $itemQuantity, $weight, $isPackingStation, $isExpress, $codAmount, $codCurrency='EUR');

}