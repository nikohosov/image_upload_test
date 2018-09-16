<?php
namespace base;

use base\core\Component;
use base\core\Core;
use base\core\CoreException;
use base\core\SimpleUrlResolver;

/**
 * Class Application
 * @package base
 * @property $db
 * @property SimpleUrlResolver $urlResolver
 * @property AuthorizeComponent $authoriseComponent
 * @property RequestComponent $requestComponent
 * @todo make exceptions for key components call
 */
class Application extends Component
{
    public $user;

    public function run()
    {
        $responce = $this->urlResolver->resolveUrl();
        var_dump(Core::$app->db); exit;

        echo 'asds'; exit;
    }
}