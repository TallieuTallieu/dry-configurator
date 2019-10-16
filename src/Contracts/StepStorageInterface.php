<?php

namespace Tnt\Configurator\Contracts;

interface StepStorageInterface
{
	/**
	 * @param $id
	 * @return mixed
	 */
	public function set($id);

	/**
	 * @return mixed
	 */
	public function get();
}