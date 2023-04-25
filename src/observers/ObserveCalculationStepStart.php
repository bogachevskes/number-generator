<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveCalculationStepStart implements ObserverInterface
{
    public function observe(Message $message): void
    {
        //
    }
}