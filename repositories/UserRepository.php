<?php
namespace repositories;

use base\core\Core;
use entities\User;
use repositories\mappers\UserMapper;

class UserRepository extends \base\Repository
{

    /**
     * @param string $clientId
     * @return array
     * @throws \base\core\CoreException
     */
    public function findUserByClientId(string $clientId)
    {
        $res = Core::$app->db->executeSQL(
            'SELECT * FROM user WHERE client_id=:client_id AND status=:status', [
                'client_id' => $clientId,
                'status' => User::USER_STATUS_ACTIVE
            ]);
        return $this->mapArray($res, new UserMapper());
    }
}