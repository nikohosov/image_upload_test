<?php
namespace responses;


class ServerErrorResponse extends AbstractResponse
{
    public function getResponse()
    {
        header('Content-type: application/json');
        $this->setCode(500);
        echo json_encode($this->data);
    }
}