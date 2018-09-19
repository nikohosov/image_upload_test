<?php
namespace entities;


class UploadedImage
{
    public $link;

    public $hash;

    public $extension;

    public $original_name;

    public $status;

    public $errors;


    public static function getStatusName(int $status)
    {
        if ($status === Image::STATUS_PROCESSED) {
            return 'processed';
        } elseif ($status === Image::STATUS_UPLOADED) {
            return 'uploaded';
        } else {
            return 'failed';
        }
    }
}