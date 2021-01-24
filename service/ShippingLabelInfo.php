<?php

namespace App\Service;

class ShippingLabelInfo {

    public $success;
    public $message;

    public function __construct(bool $success, string $message = '')
    {
        $this->success = $success;
        $this->message = $message;
    }

    public static function successful($message)
    {
        return new self(true, $message);
    }

    public static function failed($message)
    {
        return new self(false, $message);
    }
}