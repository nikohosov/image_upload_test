<?php

namespace base\core;


abstract class Component
{

    /**
     * Component constructor.
     * @param array $dependencies
     * @param array $properties
     * @throws CoreException
     */
    public function __construct(array $dependencies = [], array $properties = [])
    {
        $this->setDependenciesArray($dependencies);
        $this->setProperties($properties);
    }

    /**
     * @param $name
     * @return mixed
     * @throws DependencyNotExistException
     * @throws PropertyNotExistException
     */
    public function __get($name)
    {
        if (!$this->checkDependencyExist($name)) {
            throw  new PropertyNotExistException('Property ' . $name . ' is not exist');
        }
        return $this->getDependency($name);
    }

    private $container = [];


    /**
     * @param array $dependencies
     * @throws CoreException
     */
    public function setDependenciesArray(array $dependencies)
    {
        foreach ($dependencies as $name => $item) {
            $this->setDependency($name, $item);
        }
    }

    /**
     * @param $name
     * @param $item
     * @throws CoreException
     */
    public function setDependency($name, $item)
    {
        if (is_string($item)) {
            $this->container[$name] = $this->createObject($item);

        } elseif (is_array($item)) {
            $this->setNewDependencyByConfig($item, $name);
        }
    }

    /**
     * @param string $name
     * @return mixed
     * @throws DependencyNotExistException]
     */
    public function getDependency(string $name)
    {
        if (!$this->checkDependencyExist($name)) {
            throw new DependencyNotExistException('Component not exist');
        }

        return $this->container[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function checkDependencyExist(string $name)
    {
        return array_key_exists($name, $this->container) ? true : false;
    }

    /**
     * @param array $array
     * @param string $name
     * @throws CoreException
     */
    private function setNewDependencyByConfig(array $array, string $name)
    {
        if (!array_key_exists('className', $array)) {
            throw new CoreException('Config array must contain className');
        }

        $dependencies = [];
        $properties = [];
        if (array_key_exists('dependencies', $array)) {

            if (!is_array($array['dependencies'])) {
                throw  new CoreException('Dependencies must be an array');
            }
            $dependencies = $array['dependencies'];
        }

        if (array_key_exists('properties', $array)) {

            if (!is_array($array['properties'])) {
                throw  new CoreException('Params must be an array');
            }
            $properties = $array['properties'];
        }
        $this->container[$name] = $this->createObject($array['className'], $dependencies, $properties);
    }

    /**
     * @param string $name
     * @param array $dependencies
     * @param array $params
     * @return mixed
     * @throws CoreException
     */
    public function createObject(string $name, $dependencies = [], $params = [])
    {
        if (!class_exists($name)) {
            throw new CoreException('Class ' . $name . ' is not exist');
        }
        return new $name($dependencies, $params);
    }

    /**
     * @param array $properties
     * @throws PropertyNotExistException
     */
    private function setProperties(array $properties)
    {
        foreach ($properties as $name => $property) {
            if (property_exists($this, $name)) {
                $this->$name = $property;
            } elseif (method_exists($this, 'set' . ucfirst($name))) {
                $setterName = 'set' . ucfirst($name);
                $this->$setterName($property);
            } else {
                throw new PropertyNotExistException('Property ' . $name . ' is not exist');
            }
        }
    }

}