<?php
namespace base;

use base\core\Component;
use base\core\Core;

class AuthorizeComponent extends Component
{
    public function getUser()
    {
        $request = Core::$app->requestComponent->getRequest();
        if (!array_key_exists('client_id')) {
            throw new UnauthorizedException('client_id not set');
        }

    }
}