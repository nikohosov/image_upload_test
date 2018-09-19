<?php
namespace repositories\mappers;


use base\core\BaseMapper;
use entities\UploadedImage;

class UploadedImageResponseMapper
{
    public function map(UploadedImage $uploadedImage)
    {
        return [
            'original_name' => $uploadedImage->original_name,
            'hash' => $uploadedImage->original_name,
            'link' => "http://" . $_SERVER['SERVER_NAME'] . $uploadedImage->link,
            'status' => $uploadedImage->getStatus()
        ];
    }
}