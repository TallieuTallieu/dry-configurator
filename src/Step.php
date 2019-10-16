<?php

namespace Tnt\Configurator;

use dry\http\Request;
use Tnt\Configurator\Concerns\HasSteps;
use Tnt\Configurator\Contracts\ConfiguratorInterface;
use Tnt\Configurator\Contracts\HasStepsInterface;

abstract class Step implements HasStepsInterface
{
	use HasSteps;

	/**
	 * @var ConfiguratorInterface $configurator
	 */
	private $configurator;

	/**
	 * @return mixed
	 */
	abstract public function getId();

	/**
	 * @return string
	 */
	abstract public function getTitle(): string;

	/**
	 * @return ConfiguratorInterface
	 */
	public function getConfigurator(): ConfiguratorInterface
	{
		$configurator = $this->getParent();

		while ($configurator->getParent()) {
			$configurator = $configurator->getParent();
		}

		return $configurator;
	}

	/**
	 * @param Request $request
	 */
	abstract public function forward(Request $request);

	/**
	 * @return mixed
	 */
	abstract public function backward();

	/**
	 * @return null|Step
	 */
	final public function getNextStep(): ?Step
	{
		$currentStepId = $this->getId();
		$parentStep = $this->getParent();

		if ($parentStep) {

			$stepIds = array_keys($parentStep->getSteps());
			$currentStepIndex = array_search($currentStepId, $stepIds);

			if (isset($stepIds[$currentStepIndex+1]) && $parentStep->hasStep($stepIds[$currentStepIndex+1])) {
				return $parentStep->getStep($stepIds[$currentStepIndex+1]);
			}
		}

		return null;
	}

	/**
	 * @return null|Step
	 */
	final public function getPreviousStep(): ?Step
	{
		$currentStepId = $this->getId();
		$parentStep = $this->getParent();

		if ($parentStep) {

			$stepIds = array_keys($parentStep->getSteps());
			$currentStepIndex = array_search($currentStepId, $stepIds);

			if (isset($stepIds[$currentStepIndex-1]) && $parentStep->hasStep($stepIds[$currentStepIndex-1])) {
				return $parentStep->getStep($stepIds[$currentStepIndex-1]);
			}
		}

		return null;
	}
}