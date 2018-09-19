<?php
namespace services;


use base\core\Component;
use base\core\Core;
use repositories\ImageRepository;

class ImageSearchService extends Component
{
    public function getDependenciesArray()
    {
        return [
            'imageRepository' => ImageRepository::class,
        ];
    }

    public function search($data)
    {
        $images =$this->imageRepository->searchByCustomerString($data['search'], Core::$app->user->id);
        return $images;
    }
}