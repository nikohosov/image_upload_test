<?php
namespace responses;


class UnauthorizedResponse extends AbstractResponse
{
    public function getResponse()
    {
        header('Content-type: application/json');
        $this->setCode(401);
        echo json_encode($this->data);
    }
}