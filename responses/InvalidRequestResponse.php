<?php
namespace responses;


class InvalidRequestResponse extends AbstractResponse
{
    public function getResponse()
    {
        header('Content-type: application/json');
        $this->setCode(400);
        echo json_encode($this->data);
    }
}