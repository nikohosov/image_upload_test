<?php
namespace services\handlers;

use base\core\Component;
use entities\UploadedImage;

class Base64ImageHandler extends Component implements ImageHandlerInterface
{
    private $uploadedImage;

    public function upload(array $data, string $folder)
    {

        $uploadedImage = new UploadedImage();
        $uploadedImage->extension = $this->getImageExtension($data['base64']);

        $explodedData = explode( ',', $data['base64']);
        $uploadedImage->link = $folder . '/' . $data['hash'] .'.' . $uploadedImage->extension;
        $uploadedImage->original_name = $data['originalName'];

        $ifp = fopen($uploadedImage->link, 'wb' );
        fwrite($ifp, base64_decode($explodedData[1]));
        fclose( $ifp );
        return $uploadedImage;
    }

    private function getImageExtension($base64string)
    {
        return  substr($base64string, 11, strpos($base64string, ';')-11);
    }
}