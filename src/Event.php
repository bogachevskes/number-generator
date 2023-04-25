<?php

namespace app;

enum Event: string
{
    case CALCULATION_START = 'calculation_start';
    
    case CALCULATION_DONE = 'calculation_done';

    case CALCULATION_STEP_START = 'calculation_step_start';

    case CALCULATION_STEP_FAIL = 'calculation_step_fail';

    case CALCULATION_MODE_START = 'calculation_mode_start';

    case CALCULATION_MODE_DONE = 'calculation_mode_done';
}