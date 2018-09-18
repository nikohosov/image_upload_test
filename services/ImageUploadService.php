<?php
namespace services;

use base\core\Component;
use repositories\ImageRepository;
use services\handlers\Base64ImageHandler;
use services\handlers\LinkImageHandler;

/**
 * Class ImageUploadService
 * @package services
 * @property ImageRepository $imageRepository
 */
class ImageUploadService extends Component
{
    public function getDependenciesArray()
    {
        return [
            'imageRepository' => ImageRepository::class,
            'base64ImageHandler' => Base64ImageHandler::class,
            'linkImageHandler' => LinkImageHandler::class
        ];
    }

    public function uploadImages(array $data)
    {
        $images = $this->prepareImages($data['images']);
        foreach ($images as $image) {
            $this->handleImage($image);
        }
    }

    /**
     * @param array $images
     * @return array
     * @throws \Exception]
     */
    private function prepareImages(array $images)
    {
        $preparedArray = [];

        foreach ($images as $image) {
            $hash = base64_encode(random_bytes(10));
            $preparedArray[$hash] = $image;
        }
        $this->imageRepository->writePreparedImages($preparedArray);
        return $preparedArray;
    }

    private function handleImage($image)
    {
        if (array_key_exists('link', $image)) {
            $handler = $this->linkImageHandler;
        } elseif (array_key_exists('base64', $image)) {
            $handler = $this->base64ImageHandler;
        }

        $handler->upload($image);
    }

}