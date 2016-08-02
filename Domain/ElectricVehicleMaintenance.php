<?php

namespace Domain;

/**
 * Class ElectricVehicleMaintenance: Maintenance tasks for electric powered vehicle.
 *
 * Created by PhpStorm.
 * User: Saad
 * Date: 021, 21, Jun, 2016
 * Time: 6:04 PM
 */
class ElectricVehicleMaintenance extends AutoMaintenance
{
    /**
     * Stub function as there's no useful implementation in scope as of yet. For a start, the view dispatches
     * vehicle ID to it (which is un-used at the moment).
     *
     * @param $vehicleId
     * @return string
     */
    public function ChargeBattery($vehicleId)
    {
        return json_encode(array(
            'flag' => 'success',
            'msg' => 'Battery charged.'
        ));
    }
}

