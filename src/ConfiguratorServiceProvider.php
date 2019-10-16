<?php

namespace Tnt\Configurator;

use Oak\Config\Facade\Config;
use Oak\Contracts\Container\ContainerInterface;
use Oak\ServiceProvider;
use Tnt\Configurator\Contracts\ConfiguratorInterface;
use Tnt\Configurator\Contracts\StepStorageInterface;

class ConfiguratorServiceProvider extends ServiceProvider
{
    public function boot(ContainerInterface $app)
    {
        //
    }

    public function register(ContainerInterface $app)
    {
        $app->set(StepStorageInterface::class, Config::get('configurator.step_storage', StepStorage::class));
        $app->singleton(ConfiguratorInterface::class, Config::get('configurator.configurator', Configurator::class));
    }
}