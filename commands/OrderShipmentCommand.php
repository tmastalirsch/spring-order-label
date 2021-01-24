<?php
namespace App\Commands;

use Exception;
use App\Model\Person;

/**
 * @description Represent an Spring order shipment command
 * @see https://mailingtechnology.com/uploads/doc/76/76258/XBS-Customer-API-Manual.pdf
 * @author 
 */
class OrderShipmentCommand extends ShipmentCommand {


    public Person $consignor;    
    public Person $consignee;
    public int $amount;

    public function __construct(string $labelFormat, string $reference, string $service) 
    {
        parent::__construct($labelFormat, $reference, $service);
        $this->command = Command::OrderShipment;
        $this->consignor = null;
        $this->consignee = null;
        $this->amount = 0;
    }

    public function setConsignee(Person $consignee) {
        $this->consignee = $consignee;
    }

    public function setConsignor(Person $consignor) {
        $this->consignor = $consignor;
    }

    public function getConsignee(): Person {
        return $this->consignee;
    }

    public function getConsignor(): Person
    {
        return $this->consignor;
    }

    public function buildContainer(): array {

        $consignee = $this->getConsignee();
        $consignor = $this->getConsignor();

        if(
            !(isset($consignee) && isset($consignor))
        ) throw new Exception('Consignee & Consignor must be set');

        if(!$consignee->isConsignee()) throw new Exception('Consignee is required');
        if(!$consignor->isConsignor()) throw new Exception('Consignor is required');

        $year = date('Y');
        $month = date('m');
        $day = date('d');

 
        return [
            'LabelFormat' => $this->labelFormat,
            'ShipperReference' => $this->reference,
            'OrderDate' => $year . '-' . $month . '-' . $day,
            'Service' => $this->service,
            'Weight' => $this->weight,
            'Value' => $this->amount,
            'ConsignorAddress' => $this->consignor,
            'ConsigneeAddress' => $this->consignee,
            'Products' => $this->container 
        ];
    }
 
}