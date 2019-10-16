<?php

namespace Tnt\Configurator;

use Oak\Dispatcher\Facade\Dispatcher;
use Tnt\Configurator\Concerns\HasSteps;
use Tnt\Configurator\Contracts\ConfiguratorInterface;
use Tnt\Configurator\Contracts\HasStepsInterface;
use Tnt\Configurator\Contracts\StepStorageInterface;
use Tnt\Ecommerce\Contracts\CartInterface;
use Tnt\Configurator\Events\StepChange;

/**
 * Class Configurator
 * @package Tnt\Configurator
 */
class Configurator implements ConfiguratorInterface, HasStepsInterface
{
    use HasSteps;

    /**
     * @var StepStorageInterface $stepStorage
     */
    private $stepStorage;

    /**
     * Configurator constructor.
     * @param CartInterface $cart
     */
    public function __construct(StepStorageInterface $stepStorage)
    {
        $this->stepStorage = $stepStorage;
    }

    /**
     * @return Step
     */
    public function getCurrentStep(): Step
    {
        $stepId = $this->stepStorage->get();

        if ($stepId) {
            if (! $this->hasStep($stepId)) {
                foreach ($this->getSteps() as $step) {
                    if ($step->hasStep($stepId)) {
                        return $step->getStep($stepId);
                    }
                }
            }

            return $this->getStep($stepId);
        }

        // Return to the first step
        $firstKey = array_keys($this->steps)[0];
        return $this->steps[$firstKey];
    }

    /**
     * @param Step $step
     * @return mixed|void
     */
    public function goTo(Step $step)
    {
        $this->stepStorage->set($step->getId());
        Dispatcher::dispatch(StepChange::class, new StepChange($step));
    }

    /**
     * @return mixed|void
     */
    public function next()
    {
        $this->goTo($this->getNextStep());
    }

    /**
     * @return mixed|void
     */
    public function previous()
    {
        $this->goTo($this->getPreviousStep());
    }

    /**
     * @return null|Step
     */
    public function getNextStep(): ?Step
    {
        $currentStep = $this->getCurrentStep();
        $currentStepId = $currentStep->getId();
        $parentStep = $currentStep->getParent();

        $stepIds = array_keys($parentStep->getSteps());
        $currentStepIndex = array_search($currentStepId, $stepIds);

        if (isset($stepIds[$currentStepIndex+1]) && $parentStep->hasStep($stepIds[$currentStepIndex+1])) {
            return $parentStep->getStep($stepIds[$currentStepIndex+1]);
        }

        return null;
    }

    /**
     * @return null|Step
     */
    public function getPreviousStep(): ?Step
    {
        $currentStep = $this->getCurrentStep();
        $currentStepId = $currentStep->getId();
        $parentStep = $currentStep->getParent();

        $stepIds = array_keys($parentStep->getSteps());
        $currentStepIndex = array_search($currentStepId, $stepIds);

        if (isset($stepIds[$currentStepIndex-1]) && $parentStep->hasStep($stepIds[$currentStepIndex-1])) {
            return $parentStep->getStep($stepIds[$currentStepIndex-1]);
        }

        return null;
    }
}