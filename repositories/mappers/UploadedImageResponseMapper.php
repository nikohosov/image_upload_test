<?php
/**
 * Created by PhpStorm.
 * User: rimato
 * Date: 19.09.18
 * Time: 2:38
 */

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