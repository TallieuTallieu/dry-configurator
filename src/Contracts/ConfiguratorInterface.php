<?php

namespace Tnt\Configurator\Contracts;

use Tnt\Configurator\Step;

interface ConfiguratorInterface
{
	/**
	 * @return Step
	 */
	public function getCurrentStep(): Step;

	/**
	 * @param Step $step
	 * @return mixed
	 */
	public function goTo(Step $step);

	/**
	 * @return mixed
	 */
	public function next();

	/**
	 * @return mixed
	 */
	public function previous();
}