<?php
namespace base\core;

abstract class BaseMapper extends Component implements MapperInterface
{
    abstract function getEntity();

    public function __construct(array $dependencies = [], array $properties = [])
    {
        $this->entity = Core::$app->createObject($this->getEntity());
        parent::__construct($dependencies, $properties);
    }

    public $entity;

    public function createNewEntity()
    {
        return Core::$app->createObject($this->getEntity());
    }
}