<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveCalculationDone implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();

        $item = $data['item'];
        
        if ($item->isResultSucceed === false) {
            throw new \RuntimeException('Не удалось найти комбинацию, удовлетворяющую всем условиям');
        }

        echo 'Найдена удачная комбинация:<br>';
        echo 'Число 1 - ' . $item->num1 . '<br>';
        echo 'Число 2 - ' . $item->num2 . '<br>';
        echo 'Последовательность действий:<br>';
        echo implode(" ", array_keys($data['modes'])) . '<br>';
        echo "Выполнено итераций " . $item->iterationsCount . '<br>';
        echo "Лог выполнения:<br>" . implode('<br>', $item->log);
        
        echo '<br>';
        
        echo "Неудачные комбинации:<br>" . implode('<br>', $item->failLog);
    }
}