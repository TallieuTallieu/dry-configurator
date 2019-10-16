<?php

namespace Tnt\Configurator\Events;

use Oak\Dispatcher\Event;
use Tnt\Configurator\Step;

class StepChange extends Event
{
    /**
     * @var Step $step
     */
    private $step;

    /**
     * StepChange constructor.
     * @param Step $step
     */
    public function __construct(Step $step)
    {
        $this->step = $step;
    }

    /**
     * @return Step
     */
    public function getStep(): Step
    {
        return $this->step;
    }
}