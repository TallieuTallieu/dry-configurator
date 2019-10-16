<?php

namespace Tnt\Configurator\Facade;

use Oak\Facade;
use Tnt\Configurator\Contracts\ConfiguratorInterface;

class Configurator extends Facade
{
    protected static function getContract(): string
    {
        return ConfiguratorInterface::class;
    }
}