<?php

namespace app\observers;

use app\components\{
    ObserverInterface,
    Message,
};

class ObserveCalculationDoneConsole implements ObserverInterface
{
    public function observe(Message $message): void
    {
        $data = $message->getMessage();

        $item = $data['item'];
        
        if ($item->isResultSucceed === false) {
            throw new \RuntimeException('Не удалось найти комбинацию, удовлетворяющую всем условиям');
        }

        echo "\033[0;32mНайдена удачная комбинация:\033[0m" . PHP_EOL;
        echo 'Число 1 - ' . $item->num1 . PHP_EOL;
        echo 'Число 2 - ' . $item->num2 . PHP_EOL;
        echo "\033[0;32mПоследовательность действий:\033[0m" . PHP_EOL;;
        echo "\033[0;33m" . implode(" ", array_keys($data['modes'])) . "\033[0m" . PHP_EOL;
        echo "\033[0;36mВыполнено итераций " . $item->iterationsCount . "\033[0m" . PHP_EOL;
        echo "Лог выполнения:" . PHP_EOL . implode(PHP_EOL, $item->log);
        
        echo PHP_EOL;
        
        echo "\033[0;31mНеудачные комбинации:" . PHP_EOL . implode(PHP_EOL, $item->failLog) . "\033[0m" . PHP_EOL;
    }
}