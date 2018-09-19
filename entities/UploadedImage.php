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

    /**
     * @return string
     */
    public function getStatus()
    {
        if ($this->status === Image::STATUS_PROCESSED) {
            return 'processed';
        } elseif ($this->status === Image::STATUS_UPLOADED) {
            return 'uploaded';
        } else {
            return 'failed';
        }
    }
}