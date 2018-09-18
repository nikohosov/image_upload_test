<?php
namespace services\handlers;

use base\core\Component;

class LinkImageHandler extends Component implements ImageHandlerInterface
{
    public function upload(array $data, string $folder)
    {
        var_dump($data, 'asd'); exit;
        // TODO: Implement upload() method.
    }
}