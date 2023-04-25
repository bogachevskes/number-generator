<?php

namespace app;

class DTO
{
    public int $num1 = 0;
    public int $num2 = 0;
    public int $total = 0;
    public int $iterationsCount = 0;
    public array $log = [];
    public array $failLog = [];
    public bool $isResultSucceed = false;
}