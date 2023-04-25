<?php

ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);

require __DIR__ . '/../vendor/autoload.php';

use app\{
    DTO,
    Event,
    CalculationHandler,
};

use app\strategies\{
    DivisionStrategy,
    MultiplyStrategy,
    SubtractionStrategy,
    SumStrategy,
};

use app\observers\{
    ObserveCalculationDone,
    ObserveCalculationModeDone,
    ObserveCalculationModeStart,
    ObserveCalculationStart,
    ObserveCalculationStepFail,
    ObserveCalculationStepStart,
};

use app\components\EventDispatcher;

$eventDispatcher = new EventDispatcher;

$eventDispatcher->attach(Event::CALCULATION_START, new ObserveCalculationStart);
$eventDispatcher->attach(Event::CALCULATION_DONE, new ObserveCalculationDone);
$eventDispatcher->attach(Event::CALCULATION_STEP_START, new ObserveCalculationStepStart);
$eventDispatcher->attach(Event::CALCULATION_STEP_FAIL, new ObserveCalculationStepFail);
$eventDispatcher->attach(Event::CALCULATION_MODE_START, new ObserveCalculationModeStart);
$eventDispatcher->attach(Event::CALCULATION_MODE_DONE, new ObserveCalculationModeDone);


$model = new DTO;

$handler = new CalculationHandler($eventDispatcher);

$handler->addMode(new DivisionStrategy);
$handler->addMode(new MultiplyStrategy);
$handler->addMode(new SubtractionStrategy);
$handler->addMode(new SumStrategy);

$handler->handle($model);