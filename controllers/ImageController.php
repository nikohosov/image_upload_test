<?php
namespace controllers;

use base\core\BaseController;
use controllers\validators\ImageUploadValidator;

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
        echo 'image upload'; exit;
    }
}