<?php
namespace base;

use base\core\Component;
use base\core\Core;
use base\core\ResolveUrlException;
use base\core\CoreException;

class SimpleUrlResolver extends Component
{
    /** @var array $routesMap */
    public $routesMap;

    /**
     * @throws CoreException
     * @throws ResolveUrlException
     */
    public function resolveUrl()
    {
        $url = $_SERVER['REQUEST_URI'];
        $url = $this->filterUrl($url);
        $explodedArr = explode('/', $url);
        $action = $explodedArr[1];
        if (array_key_exists($action, $this->routesMap)) {
            $controller = $this->createController($action);

            if (!array_key_exists('action', $this->routesMap[$action])) {
                throw new ResolveUrlException('Action not set');
            } else {
                $controller->runAction($this->routesMap[$action]['action']);
            }

        } else {
            throw new ResolveUrlException('Can not resolve url');
        }
    }

    /**
     * @param string $name
     * @return mixed
     */
    private function filterUrl(string $name)
    {
        return str_replace('/index.php', '', $name);
    }

    /**
     * @param $action
     * @return mixed
     * @throws CoreException
     * @throws ResolveUrlException
     */
    private function createController($action)
    {
        if (array_key_exists('controller', $this->routesMap[$action])) {
            return Core::$app->createObject($this->routesMap[$action]['controller']);
        }
        throw new ResolveUrlException('Controller class not set');
    }
}