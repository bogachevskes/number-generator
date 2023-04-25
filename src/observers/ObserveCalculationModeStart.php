<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveCalculationModeStart implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();

        $data['item']->log[] = 'Текущий результат ' . $data['item']->total;
    }
}