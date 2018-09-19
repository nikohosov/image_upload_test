<?php
namespace responses;


class NotFoundResponse extends AbstractResponse
{
    public function getResponse()
    {
        header('Content-type: application/json');
        $this->setCode(404);
        echo json_encode($this->data);
    }
}