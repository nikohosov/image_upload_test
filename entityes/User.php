<?php
class User extends \base\Entity
{
    const USER_STATUS_ACTIVE = 1;

    public $id;

    public $client_id;

    public $status;
}