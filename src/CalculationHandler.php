<?php

namespace app;

use app\components\{
    EventDispatcher,
    Message,
};

use app\strategies\StrategyInterface;

class CalculationHandler
{
    private $modes = [];

    public function __construct(private EventDispatcher $eventDispatcher) { }
    
    public function addMode(StrategyInterface $mode): void
    {
        $this->modes[$mode->getName()] = $mode;
    }
    
    public function removeMode(StrategyInterface $mode): void
    {
        if (isset($this->modes[$mode->getName()]) === false) {
            return;
        }
        
        unset($this->modes[$mode->getName()]);
    }

    private function generate(DTO $context): void
    {
        $iteration = 0;
        
        $firstNumStep = 5;
        $secondNumStep = 1;
        
        do {
            $iteration++;
            
            $succeedSteps = 0;
            $context->log = [];
            $context->total = 0;
            
            $context->num1 += $firstNumStep;
            $context->num2 += $secondNumStep;
            
            uksort($this->modes, function() { return (int) (rand() > rand()); });

            $this->eventDispatcher->trigger(Event::CALCULATION_STEP_START, new Message([
                'item' => $context,
                'modes' => $this->modes,
            ]));
            
            foreach ($this->modes as $mode) {

                $this->eventDispatcher->trigger(Event::CALCULATION_MODE_START, new Message([
                    'item' => $context,
                    'mode' => $mode,
                ]));
                
                try {
                    
                    $mode->calculate($context);
                    
                    $this->eventDispatcher->trigger(Event::CALCULATION_MODE_DONE, new Message([
                        'item' => $context,
                        'mode' => $mode,
                    ]));
                    
                    $succeedSteps++;
                    
                } catch (\LogicException $e) {
                    // ignore
                }
            }
            
            if ($succeedSteps !== count($this->modes)) {

                $this->eventDispatcher->trigger(Event::CALCULATION_STEP_FAIL, new Message([
                    'item' => $context,
                    'modes' => $this->modes,
                ]));
            }
            
        } while ($succeedSteps !== 4 || $iteration > 50);

        $context->isResultSucceed = $succeedSteps === count($this->modes);

        $context->iterationsCount = $iteration;
    }
    
    private function beforeGenerate(DTO $context): void
    {
        $this->eventDispatcher->trigger(Event::CALCULATION_START, new Message([
            'item' => $context,
            'modes' => $this->modes,
        ]));
    }

    private function afterGenerate(DTO $context): void
    {
        $this->eventDispatcher->trigger(Event::CALCULATION_DONE, new Message([
            'item' => $context,
            'modes' => $this->modes,
        ]));
    }
    
    public function handle(DTO $context): void
    {
        $this->beforeGenerate($context);
        $this->generate($context);
        $this->afterGenerate($context);
    }
}