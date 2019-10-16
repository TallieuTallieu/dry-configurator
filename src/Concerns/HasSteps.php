<?php

namespace Tnt\Configurator\Concerns;

use Tnt\Configurator\Contracts\HasStepsInterface;
use Tnt\Configurator\Step;

trait HasSteps
{
	/**
	 * @var HasStepsInterface $parent
	 */
	private $parent;

	/**
	 * @var array $steps
	 */
	public $steps = [];

	/**
	 * @param HasStepsInterface $parent
	 */
	public function setParent(HasStepsInterface $parent)
	{
		$this->parent = $parent;
	}

	/**
	 * @return null|HasStepsInterface
	 */
	public function getParent(): ?HasStepsInterface
	{
		return $this->parent;
	}

	/**
	 * @param Step $step
	 * @return HasStepsInterface
	 */
	public function addStep(Step $step): HasStepsInterface
	{
		$step->setParent($this);
		$this->steps[$step->getId()] = $step;
		return $this;
	}

	/**
	 * @param $id
	 * @return null|Step
	 */
	public function getStep($id): ?Step
	{
		return $this->steps[$id] ?? null;
	}

	/**
	 * @param $id
	 * @return bool
	 */
	public function hasStep($id): bool
	{
		return isset($this->steps[$id]);
	}

	/**
	 * @return array
	 */
	public function getSteps(): array
	{
		return $this->steps;
	}

	/**
	 * @return bool
	 */
	public function hasSteps(): bool
	{
		return (count($this->steps));
	}

	/**
	 * @return Step
	 */
	public function getFirstStep(): Step
	{
		reset($this->steps);
		return current($this->steps);
	}

	/**
	 * @return Step
	 */
	public function getLastStep(): Step
	{
		end($this->steps);
		return current($this->steps);
	}
}