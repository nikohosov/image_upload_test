<?php
namespace base;

use base\core\Component;
use base\core\Core;
use base\core\CoreException;

class Application extends Component
{
    public function run()
    {
        var_dump(Core::$app->db); exit;

        echo 'asds'; exit;
    }
}