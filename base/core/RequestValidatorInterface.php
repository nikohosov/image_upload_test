<?php
namespace base\core;


interface RequestValidatorInterface
{
    function validate(array $data);
}