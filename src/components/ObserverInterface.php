<?php

namespace app\components;

interface ObserverInterface
{
    function observe(Message $message): void;
}