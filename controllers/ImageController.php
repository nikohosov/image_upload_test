<?php
namespace controllers;

use base\core\BaseController;
use base\core\Core;
use controllers\validators\ImageUploadValidator;
use repositories\mappers\UploadedImageResponseMapper;
use services\ImageUploadService;

class ImageController extends BaseController
{
    public function actionValidators() : array
    {
        return [
            'upload' => [
                ImageUploadValidator::class
            ]
        ];
    }

    public function actionUpload()
    {
        $service = new ImageUploadService();
        $result = $service->uploadImages(Core::$app->requestComponent->getRequest());
        $formattedResult = [];
        $mapper = new UploadedImageResponseMapper();
        foreach ($result as $image) {
            $formattedResult[] = $mapper->map($image);
        }
        return $formattedResult;
    }
}