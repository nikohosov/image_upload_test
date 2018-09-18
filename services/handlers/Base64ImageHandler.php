<?php
namespace services\handlers;

use base\core\Component;

class Base64ImageHandler extends Component implements ImageHandlerInterface
{
    public function upload(array $data)
    {
        echo '64'; exit;
    }
}