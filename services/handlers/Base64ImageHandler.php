<?php
namespace services\handlers;

use entities\UploadedImage;

class Base64ImageHandler extends AbstractImageHandler
{
    /**
     * @param array $data
     * @param string $folder
     * @return UploadedImage
     */
    public function upload(array $data, string $folder)
    {
        $uploadedImage = $this->createUploadImageModel();
        $uploadedImage->extension = $this->getImageExtension($data['base64']);
        $uploadedImage->hash = $data['hash'];
        $explodedData = explode( ',', $data['base64']);
        $uploadedImage->link = $folder . '/' . $data['hash'] .'.' . $uploadedImage->extension;
        $uploadedImage->original_name = $data['originalName'];

        $ifp = fopen($uploadedImage->link, 'wb' );
        fwrite($ifp, base64_decode($explodedData[1]));
        fclose( $ifp );

        return $uploadedImage;
    }

    /**
     * @param $base64string
     * @return bool|string
     */
    private function getImageExtension($base64string)
    {
        return  substr($base64string, 11, strpos($base64string, ';')-11);
    }
}