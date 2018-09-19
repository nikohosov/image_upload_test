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
    public function writePreparedImages(array $images, int $customerId)
    {

        $sql = 'INSERT INTO image (hash, status, created_at, updated_at, user_id) VALUES (?, ?, ?, ?, ?)';
        $bindArray = [];
        foreach ($images as $key => $image) {
            $bindArray[] = [ $key, Image::STATUS_PROCESSED, time(), time(), $customerId];
        }
        Core::$app->db->insertMultiple($sql, $bindArray);
    }


    public function updateImageByHash(UploadedImage $image)
    {
        $sql = 'UPDATE image SET original_name=?, status=?, link=?, updated_at=? WHERE hash=?';
        $data = [$image->original_name, $image->status, $image->link, time(), $image->hash];
        Core::$app->db->update($sql, $data);
    }

    public function searchByCustomerString(string $search, int $userId)
    {
        $likeSearch = '%' . $search .'%';
        $sql = 'SELECT * FROM image where user_id=? and (hash=? or link like(?) )';
        $params = [$userId, $search, $likeSearch];
        return Core::$app->db->executeSQL($sql, $params);

    }
}