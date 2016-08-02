<?php

namespace Domain;

/**
 * Interface TraditionalAutoMaintenanceTasks: Tasks for traditional (petroleum based) vehicles.
 *
 * Created by PhpStorm.
 * User: Saad
 * Date: 021, 21, Jun, 2016
 * Time: 7:25 PM
 */
interface TraditionalAutoMaintenanceTasks
{
    public function ChangeOil($vehicleId);
}