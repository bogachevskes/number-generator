<?php

namespace app\strategies;

use App\DTO;

interface StrategyInterface
{
    function getName(): string;

    function calculate(DTO $item): void;
}