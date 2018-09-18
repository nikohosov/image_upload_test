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

    public $imageFolder = 'images';

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
            $hash = base64_encode(random_bytes(12));
            $image['hash'] = $this->generateRandomHash(12);
            $preparedArray[$hash] = $image;
        }
        $this->imageRepository->writePreparedImages($preparedArray);
        return $preparedArray;
    }

    /**
     * @param $image
     */
    private function handleImage($image)
    {
        if (array_key_exists('link', $image)) {
            $handler = $this->linkImageHandler;
        } elseif (array_key_exists('base64', $image)) {
            $handler = $this->base64ImageHandler;
        }

        $handler->upload($image, $this->imageFolder);
    }

    /**
     * @param $length
     * @param string $keyspace
     * @return string
     * @throws \Exception
     * @todo move to standalone component
     */
    function generateRandomHash($length)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

}