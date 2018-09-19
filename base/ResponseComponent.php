<?php
namespace base;


use base\core\Component;
use responses\InvalidRequestResponse;
use responses\NotFoundResponse;
use responses\ServerErrorResponse;
use responses\SuccessResponse;
use responses\UnauthorizedResponse;

class ResponseComponent extends Component
{
    public function getDependenciesArray()
    {
        return [
            'successResponse' => SuccessResponse::class,
            'notFoundResponse' => NotFoundResponse::class,
            'unauthorizedResponse' => UnauthorizedResponse::class,
            'invalidRequestResponse' => InvalidRequestResponse::class,
            'serverErrorResponse' => ServerErrorResponse::class
        ];
    }
}