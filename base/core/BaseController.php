<?php
namespace base\core;


class BaseController extends Component
{
    public function beforeAction()
    {

    }

    public function afterAction()
    {

    }

    /**
     * @param string $action
     * @return mixed
     * @throws CoreException
     * @throws ResolveUrlException
     */
    public function runAction(string $action)
    {
        $methodName = 'action' . ucfirst($action);
        if (method_exists($this, $methodName)) {
            $this->authorize();
            $this->beforeAction();
            $response = $this->$methodName();
            $this->afterAction();
            return $response;
        }
        throw new ResolveUrlException('Action is not exist');
    }

    private function authorize()
    {
        if (!Core::$app->checkDependencyExist('authorizeComponent')) {
            throw new CoreException('Authorize component not set');
        }
        Core::$app->user = Core::$app->authorizeComponent->getUser();
    }
}