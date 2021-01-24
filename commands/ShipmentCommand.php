<?php

namespace App\Commands;

abstract class ShipmentCommand {


    protected string $labelFormat;
    protected string $shipperReference;
    protected array $container = [];

    protected ?Command $command = NULL;

    public function __construct($labelFormat, $reference) {
        $this->labelFormat = $labelFormat;
        $this->reference = $reference;
    }

    abstract public function buildContainer(): array;

}