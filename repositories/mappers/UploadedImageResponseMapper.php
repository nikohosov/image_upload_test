<?php
namespace repositories\mappers;


use base\core\BaseMapper;
use entities\UploadedImage;

class UploadedImageResponseMapper
{
    public function map(UploadedImage $uploadedImage)
    {
        return [
            'originalName' => $uploadedImage->original_name,
            'hash' => $uploadedImage->original_name,
            'link' => "http://" . $_SERVER['SERVER_NAME'] . $uploadedImage->link,
            'status' => UploadedImage::getStatusName($uploadedImage->status)
        ];
    }
}