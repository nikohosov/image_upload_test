<?php
namespace repositories\mappers;


use entities\UploadedImage;

class SearchedImagesMapper
{
    public function map($searchedImage)
    {
        return [
            'originalName' => $searchedImage['original_name'],
            'hash' => $searchedImage['hash'],
            'link' => "http://" . $_SERVER['SERVER_NAME'] . $searchedImage['link'],
            'status' => UploadedImage::getStatusName( $searchedImage['status'])
        ];
    }
}