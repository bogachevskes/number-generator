<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveCalculationModeDone implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();

        $item = $data['item'];

        $item->log[] = 'Выполнено действие: ' . $data['mode']->getName() . '. Результат ' . $item->total;
    }
}