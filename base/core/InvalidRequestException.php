<?php
namespace base\core;

use Throwable;

class InvalidRequestException extends CoreException
{
    public $errors = [];
}