<?php

namespace base\core;


class Component
{

    private $container = [];


    public function __construct(array $config)
    {
        foreach ($config as $name => $item) {
            $this->setDependency($config[$name], $item);
        }
    }

    /**
     * @param $name
     * @param $item
     */
    public function setDependency($name, $item)
    {
        if (is_string($item)) {
            $this->container[$name] = $item;
        } elseif (is_array($item)) {
            $this->setDependencyFromArray($item);
        }

    }

    /**
     * @param string $name
     * @return mixed
     * @throws CoreException
     */
    public function getDependency(string $name)
    {
        if (!array_key_exists($name, $this->container)) {
            throw new CoreException('Component not exist');
        }

        if (is_object($this->container[$name])) {
            return $this->container[$name];
        }

        if (is_string($this->container[$name])) {

            if (!class_exists($this->container[$name])) {
                throw new CoreException('Can not create class');
            }

            return new $this->container[$name];
        }

        throw new CoreException('Can not resolve dependency ' . $name);
    }

    private function setDependencyFromArray(array $array)
    {

    }

}