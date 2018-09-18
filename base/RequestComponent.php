<?php
namespace base;

use base\core\Component;

class RequestComponent extends Component
{
    /**
     * @return bool|mixed
     */
    public function getRequest()
    {
        $data = false;

        if (count($_POST) > 0) {
            $data = $_POST;
        }

        if (!$data) {
            $data = json_decode(file_get_contents('php://input'), true);
        }
        return $data;
    }
}