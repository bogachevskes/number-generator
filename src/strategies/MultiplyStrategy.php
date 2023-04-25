<?php

namespace app\strategies;

use App\DTO;

class MultiplyStrategy implements StrategyInterface
{
    public function getName(): string
    {
        return 'умножение';
    }

    public function calculate(DTO $item): void
    {
        if ($item->total <= 10) {
            throw new \LogicException();
        }
        
        $item->total = $item->num1 * $item->num2;
    }
}