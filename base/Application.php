<?php
namespace base;

use base\core\Component;
use base\core\Core;
use base\core\CoreException;
use base\core\InvalidRequestException;
use base\core\ResolveUrlException;
use base\core\SimpleUrlResolver;

/**
 * Class Application
 * @package base
 * @property DBConnection $db
 * @property SimpleUrlResolver $urlResolver
 * @property AuthorizeComponent $authoriseComponent
 * @property RequestComponent $requestComponent
 * @property ResponseComponent $responseComponent
 * @todo make exceptions for key components call
 */
class Application extends Component
{
    public $user;

    public function run()
    {
        try {
            $this->urlResolver->resolveUrl();
        } catch (ResolveUrlException $e) {
            Core::$app->responseComponent->notFoundResponse->data = $e->getMessage();
            return Core::$app->responseComponent->notFoundResponse->getResponse();
        } catch (UnauthorizedException $e) {
            Core::$app->responseComponent->unauthorizedResponse->data = $e->getMessage();
            return Core::$app->responseComponent->unauthorizedResponse->getResponse();
        } catch (InvalidRequestException $e) {
            Core::$app->responseComponent->invalidRequestResponse->data = $e->getMessage();
            return Core::$app->responseComponent->invalidRequestResponse->getResponse();
        } catch (\Exception $e) {
            Core::$app->responseComponent->serverErrorResponse->data = $e->getMessage();
            return Core::$app->responseComponent->serverErrorResponse->getResponse();
        }

    }
}