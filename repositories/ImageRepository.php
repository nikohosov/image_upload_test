<?php
namespace repositories;

use base\core\Core;
use base\Repository;
use entities\Image;

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
}