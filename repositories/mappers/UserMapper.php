<?php
namespace  repositories\mappers;

use base\core\BaseMapper;
use entities\User;

class UserMapper extends BaseMapper
{
    public function getEntity()
    {
        return User::class;
    }


    /**
     * @param array $data
     * @param $entity
     * @return mixed
     */
    public function map(array $data)
    {
        $entity = $this->createNewEntity();
        foreach ($data as $name => $value) {
            if (property_exists($entity, $name)) {
                $entity->$name = $value;
            }
        }
        return $entity;
    }
}