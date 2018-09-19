<?php
namespace base;

use base\core\Component;
use base\core\Core;
use repositories\UserRepository;

/**
 * Class AuthorizeComponent
 * @package base
 * @property UserRepository $useRepository
 */
class AuthorizeComponent extends Component
{
    /**
     * @throws UnauthorizedException
     */
    public function authorize()
    {
        $request = Core::$app->requestComponent->getRequest();
        if (!array_key_exists('clientId', $request)) {
            throw new UnauthorizedException('client_id not set');
        }
        $user = $this->userRepository->findUserByClientId($request['clientId']);
        if ($user) {
            Core::$app->user = $user[0];
            return $user[0];
        }
        throw new UnauthorizedException('Not authorized');
    }
}