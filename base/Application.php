<?php
namespace base;

use base\core\Component;
use base\core\Core;
use base\core\CoreException;
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
        $this->urlResolver->resolveUrl();
    }
}