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

    public function executeSQL(string $sql, $bindParams = [])
    {
        $this->setConnection();
        $stmt = $this->connection->prepare($sql);
        $stmt->execute($bindParams);
        $result = $stmt->fetchAll();
        $this->deleteConnection();
        return $result;
    }

    private function deleteConnection()
    {
        $this->connection = null;
    }


}