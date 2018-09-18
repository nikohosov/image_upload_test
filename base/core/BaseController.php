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

    public function actionValidators() : array
    {
        return [];
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
            $this->validateRequest($action);
            echo 'after_validate'; exit;
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
        return Core::$app->user = Core::$app->authorizeComponent->authorize();
    }

    /**
     * @param string $action
     * @throws CoreException
     * @throws InvalidRequestException
     */
    private function validateRequest(string $action)
    {

        $validators = $this->actionValidators();
        $errors = [];

        if (array_key_exists($action, $validators)) {
            $actionValidators = $validators[$action];

            foreach ($actionValidators as $validator) {
                /** @var RequestValidatorInterface $validatorObject */
                $validatorObject = $actionValidator = Core::$app->createObject($validator);
                $error = $validatorObject->validate(Core::$app->requestComponent->getRequest());
                if ($error) {
                    $errors[] = $error;
                }
            }
        }

        if (count($errors) > 0) {
            $error = new InvalidRequestException();
            $error->errors = $errors;
            throw $error;
        }
    }
}