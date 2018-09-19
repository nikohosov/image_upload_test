<?php

namespace responses;


class SuccessResponse extends AbstractResponse
{
    public function getResponse()
    {
        header('Content-type: application/json');
        $this->setCode(201);
        echo json_encode($this->data);
    }

}