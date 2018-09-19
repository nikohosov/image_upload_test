<?php
namespace responses;

use base\core\Component;

abstract class AbstractResponse extends Component
{
    public function getData()
    {
        return $this->data;
    }

    public $data;

    public function setCode(int $code)
    {
        http_response_code($code);
    }


}