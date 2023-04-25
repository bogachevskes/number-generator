<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveCalculationStepFail implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();
        
        $data['item']->failLog[] = implode(" ", array_keys($data['modes']));
    }
}