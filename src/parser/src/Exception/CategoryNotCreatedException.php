<?php

namespace Parser\Exception;

use Exception;

class CategoryNotCreatedException extends Exception
{
    protected $code = 1;

    public function __construct($message = "")
    {
        parent::__construct($message, $this->code, null);
    }
}