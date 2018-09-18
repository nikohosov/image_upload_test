<?php
namespace services\handlers;


interface ImageHandlerInterface
{
    public function upload(array $data, string $folder);
}