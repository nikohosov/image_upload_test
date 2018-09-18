<?php
namespace base;

use base\core\Component;

class DBConnection extends Component
{
    public $test;

    public $host;

    public $db_name;

    public $username;

    public $password;

    private $connection;

    public function setConnection()
    {
        $this->connection = new \PDO("mysql:host=$this->host;dbname=$this->db_name", $this->username, $this->password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    }

    /**
     * @param string $sql
     * @param array $bindParams
     * @return mixed
     */
    public function executeSQL(string $sql, $bindParams = [])
    {
        $this->setConnection();
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($bindParams);
        $result = $stmt->fetchAll();
        $this->deleteConnection();
        return $result;
    }

    /**
     * @param string $sql]
     */
    public function prepareSQL(string $sql)
    {
        $this->connection->prepare($sql);
    }


    private function deleteConnection()
    {
        $this->connection = null;
    }

    /**
     * @param string $sql
     * @param array $data
     */
    public function insertMultiple(string $sql, array $data)
    {
        $this->setConnection();
        $stmt = $this->connection->prepare($sql);
        foreach ($data as $item) {
            $stmt->execute($item);
        }
        $this->deleteConnection();
    }

    /**
     * @param string $sql
     * @param array $data
     */
    public function update(string $sql, array $data)
    {
        $this->setConnection();
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($data);
        $this->deleteConnection();
    }
}