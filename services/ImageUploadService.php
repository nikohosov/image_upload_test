<?php
namespace services;

use base\core\Component;
use entities\Image;
use entities\UploadedImage;
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

    /**
     * @var array
     * @todo move to config
     */
    public $allowedExtensions = ['jpeg', 'png', 'gif', 'bmp'];

    public $allowedSize = 5000000;

    public function getDependenciesArray()
    {
        return [
            'imageRepository' => ImageRepository::class,
            'base64ImageHandler' => Base64ImageHandler::class,
            'linkImageHandler' => LinkImageHandler::class
        ];
    }

    /**
     * @param array $data
     * @return array
     * @throws \Exception
     */
    public function uploadImages(array $data)
    {
        $images = $this->prepareImages($data['images']);
        $result = [];
        foreach ($images as $image) {
            $result[] = $this->handleImage($image);
        }
        return $result;
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
            $image['hash'] = $hash;
            $preparedArray[$hash] = $image;
        }
        $this->imageRepository->writePreparedImages($preparedArray, Core::$app->user->id);
        return $preparedArray;
    }

    /**
     * @param $image
     * @return mixed
     */
    private function handleImage($image)
    {
        if (array_key_exists('link', $image)) {
            $handler = $this->linkImageHandler;
        } elseif (array_key_exists('base64', $image)) {
            $handler = $this->base64ImageHandler;
        }

        $uploadedImage =  $handler->upload($image, $this->imageFolder);
        return $this->updateUploadedImage($uploadedImage);
    }

    /**
     * @param $length
     * @param string $keyspace
     * @return string
     * @throws \Exception
     * @todo move to standalone component
     */
    public function generateRandomHash($length)
    {
        return substr(str_shuffle(str_repeat($x='0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ', ceil($length/strlen($x)) )),1,$length);
    }

    /**
     * @param UploadedImage $image
     * @return array
     */
    public function updateUploadedImage(UploadedImage $image)
    {
        $this->validateUploadedImage($image);
        if (!is_null($image->errors) && count($image->errors) > 0) {
            $image->status = Image::STATUS_FAILED;
            unlink($image->link);
            $image->link = null;
        }
        $image->status = Image::STATUS_UPLOADED;
        $this->imageRepository->updateImageByHash($image);
        return $image;
    }

    /**
     * @param UploadedImage $image
     * @return UploadedImage
     */
    private function validateUploadedImage(UploadedImage $image)
    {
        if (!in_array(strtolower($image->extension), $this->allowedExtensions)) {
            $image->errors[] = 'Unsupported format';
        }

        if (filesize($image->link) > $this->allowedSize) {
            $image->errors[] = 'File size can not exceed ' . $this->allowedSize . ' bytes';
        }
        return $image;
    }

}