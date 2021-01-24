<?php

namespace App\Util;


class File {   

    public string $type;
    public string $reference;
    public string $handler;
    public string $content;

    public function __construct($type, $reference) {
        $this->type = $type;
        $this->reference = $reference . '.' . $this->type;;
        $this->handler = null;
        $this->content = null;
    }

    public static function existFile($pathToFile): bool
    {
        return file_exists($pathToFile);
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getReference(): string 
    {
        return $this->reference;
    }

    public function open(string $mode): self
    {
        $this->handler = fopen($this->reference, $mode);
        return $this;
    }

    public function openReadOnly(): self
    {
        return $this->open('r');
    }

    public function openWriteOnly(): self
    {
        return $this->open('w');
    }


    public function write(string $string): self
    {
        fwrite($this->handler, $string);
        return $this;
    }

    public function read(): self
    {
        $this->content = fread($this->handler, filesize($this->reference));
        return $this;
    }

    public function close(): self
    {
        fclose($this->handler);
        return $this;
    }

    public function delete(): bool
    {
        return unlink($this->reference);
    }

    public function exist(): bool
    {
       return self::existFile($this->reference);
    }
   
}