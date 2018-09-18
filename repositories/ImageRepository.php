<?php
namespace repositories;

use base\core\Core;
use base\Repository;
use entities\Image;
use entities\UploadedImage;

class ImageRepository extends Repository
{
    /**
     * @param array $images
     */
    public function writePreparedImages(array $images)
    {
        $sql = 'INSERT INTO image (hash, status, created_at, updated_at) VALUES (?, ?, ?, ?)';
        $bindArray = [];
        foreach ($images as $key => $image) {
            $bindArray[] = [ $key, Image::STATUS_PROCESSED, time(), time()];
        }
        Core::$app->db->insertMultiple($sql, $bindArray);
    }


    public function updateImageByHash(UploadedImage $image, $status)
    {
        $sql = 'UPDATE image SET original_name=?, status=?, link=?, updated_at=? WHERE hash=?';
        $data = [$image->original_name, $status, $image->link, time(), $image->hash];
        Core::$app->db->update($sql, $data);
    }
}