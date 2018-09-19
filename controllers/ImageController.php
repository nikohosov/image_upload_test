<?php
namespace controllers;

use base\core\BaseController;
use base\core\Core;
use controllers\validators\ImageSearchValidator;
use controllers\validators\ImageUploadValidator;
use repositories\mappers\SearchedImagesMapper;
use repositories\mappers\UploadedImageResponseMapper;
use services\ImageSearchService;
use services\ImageUploadService;

class ImageController extends BaseController
{
    public function actionValidators() : array
    {
        return [
            'upload' => [
                ImageUploadValidator::class
            ],
            'search' => [
                ImageSearchValidator::class
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

    public function actionSearch()
    {
        $service = new ImageSearchService();
        $result = $service->search(Core::$app->requestComponent->getRequest());
        $formattedResult = [];
        $mapper = new SearchedImagesMapper();
        foreach ($result as $image) {
            $formattedResult[] = $mapper->map($image);
        }
        return $formattedResult;
    }
}