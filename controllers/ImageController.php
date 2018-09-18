<?php
namespace controllers;

use base\core\BaseController;
use base\core\Core;
use controllers\validators\ImageUploadValidator;
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
        $service->uploadImages(Core::$app->requestComponent->getRequest());
        echo 'image upload'; exit;
    }
}