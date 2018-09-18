<?php
namespace entities;

use base\Entity;

class Image extends Entity
{
    const STATUS_PROCESSED = 1;

    const STATUS_UPLOADED = 2;

    const STATUS_FAILED = 3;

    public $id;

    public $original_name;

    public $hash;

    public $status;

    public $created_at;

    public $updated_at;
}