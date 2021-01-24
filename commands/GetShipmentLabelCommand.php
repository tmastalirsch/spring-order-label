<?php

namespace App\Commands;

class GetShipmentLabelCommand extends ShipmentCommand {


    public function __construct(string $labelFormat, string $reference, string $service) 
    {
        parent::__construct($labelFormat, $reference, $service);
        $this->command = Command::GetShipmentLabel;
    }


    public function buildContainer(): array
    {
        return [
            'LabelFormat' => $this->labelFormat,
            'TrackingNumber' => "",
            'ShipperReference' => $this->reference
        ];
    }

}