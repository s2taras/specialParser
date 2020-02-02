<?php

class ProductNotCreatedException extends Exception
{
    protected $code = 2;

    public function __construct($message = "")
    {
        parent::__construct($message, $this->code, null);
    }
}