<?php
namespace services\handlers;


class LinkImageHandler extends AbstractImageHandler
{
    /**
     * @param array $data
     * @param string $folder
     * @return \entities\UploadedImage|mixed
     */
    public function upload(array $data, string $folder)
    {
        $uploadedImage = $this->createUploadImageModel();
        $uploadedImage = $this->setImageData($data['link'], $uploadedImage);
        $uploadedImage->hash = $data['hash'];
        $url = $data['link'];
        $file = file_get_contents($url);
        $uploadedImage->link = $folder . '/' . $data['hash'] . '.' . $uploadedImage->extension;
        file_put_contents($uploadedImage->link, $file);
        return $uploadedImage;
    }

    /**
     * @param string $imageLink
     * @param $uploadedImage
     * @return mixed
     */
    private function setImageData(string $imageLink, $uploadedImage)
    {
        $URL = urldecode($imageLink);
        $image_name = (stristr($URL,'?',true))?stristr($URL,'?',true):$URL;
        $pos = strrpos($image_name,'/');
        $image_name = substr($image_name,$pos+1);

        /**
         * @todo use exif_read_data() for extension
         */
        $uploadedImage->extension = str_replace('.', '', stristr($image_name,'.'));
        $uploadedImage->original_name = $image_name;
        return $uploadedImage;
    }
}