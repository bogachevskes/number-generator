<?php

namespace app\strategies;

use App\DTO;

class SumStrategy implements StrategyInterface
{
    public function getName(): string
    {
        return 'сложение';
    }

    public function calculate(DTO $item): void
    {
        if ($item->total < 0) {
            throw new \LogicException();
        }
        
        $item->total = $item->num1 + $item->num2;
    }
}