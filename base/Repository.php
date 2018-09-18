<?php
namespace base;

use base\core\Component;
use base\core\MapperInterface;

class Repository extends Component
{
    private $mapper;

    /**
     * @param $item
     * @param bool $mapper
     * @return mixed
     */
    public function mapItem($item, $mapper = false)
    {
        if($mapper) {
            $this->mapper = $mapper;
        }
        return $this->mapper->map($item);
    }

    /**
     * @param array $items
     * @param $mapper
     * @return array
     */
    public function mapArray(array $items, MapperInterface $mapper)
    {
        $this->mapper = $mapper;
        $result = [];
        foreach ($items as $item) {
            $result[] = $this->mapItem($item);
        }
        return $result;
    }
}