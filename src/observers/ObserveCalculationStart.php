<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveCalculationStart implements ObserverInterface
{
    public function observe(Message $message): void
    {
        //
    }
}