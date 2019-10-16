<?php

namespace Tnt\Configurator;

use Oak\Session\Facade\Session;
use Tnt\Configurator\Contracts\StepStorageInterface;

class StepStorage implements StepStorageInterface
{
    /**
     * @param $id
     * @return mixed|void
     */
    public function set($id)
    {
        Session::set('configurator_step_id', $id);
        Session::save();
    }

    /**
     * @return mixed
     */
    public function get()
    {
        return Session::get('configurator_step_id');
    }
}