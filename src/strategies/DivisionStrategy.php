<?php

namespace app\strategies;

use App\DTO;

class DivisionStrategy implements StrategyInterface
{
    public function getName(): string
    {
        return 'деление';
    }

    public function calculate(DTO $item): void
    {
        if ($item->total <= 1000) {
            throw new \LogicException();
        }
        
        $item->total = $item->num1 / $item->num2;
    }
}