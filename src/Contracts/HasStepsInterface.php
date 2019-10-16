<?php

namespace Tnt\Configurator\Contracts;

use Tnt\Configurator\Step;

/**
 * Interface HasStepsInterface
 * @package Tnt\Configurator\Contracts
 */
interface HasStepsInterface
{
	/**
	 * @param HasStepsInterface $parent
	 * @return mixed
	 */
	public function setParent(HasStepsInterface $parent);

	/**
	 * @return null|HasStepsInterface
	 */
	public function getParent(): ?HasStepsInterface;

	/**
	 * @param Step $step
	 * @return mixed
	 */
	public function addStep(Step $step): HasStepsInterface;

	/**
	 * @param $id
	 * @return null|Step
	 */
	public function getStep($id): ?Step;

	/**
	 * @param $id
	 * @return bool
	 */
	public function hasStep($id): bool;

	/**
	 * @return array
	 */
	public function getSteps(): array;

	/**
	 * @return bool
	 */
	public function hasSteps(): bool;

	/**
	 * @return Step
	 */
	public function getFirstStep(): Step;

	/**
	 * @return Step
	 */
	public function getLastStep(): Step;

	/**
	 * @return null|Step
	 */
	public function getNextStep(): ?Step;

	/**
	 * @return null|Step
	 */
	public function getPreviousStep(): ?Step;
}