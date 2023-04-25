<?php

namespace app\components;

class Message
{
    public function __construct(private mixed $data){ }

    public function getMessage()
    {
        return $this->data;
    }
}