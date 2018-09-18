<?php
/**
 * Created by PhpStorm.
 * User: rimato
 * Date: 19.09.18
 * Time: 1:05
 */

namespace services\handlers;


use base\core\Component;
use entities\UploadedImage;

abstract class AbstractImageHandler extends Component implements ImageHandlerInterface
{
    protected function createUploadImageModel()
    {
        return new UploadedImage();
    }
}