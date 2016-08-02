<?php

namespace Domain;


/**
 * Abstract Class AutoMaintenance: Principal guideline of all common auto maintenance tasks and properties.
 *
 * Created by PhpStorm.
 * Author: Saad
 * Date: 021, 21, Jun, 2016
 * Time: 5:50 PM
 */
abstract class AutoMaintenance
{
    /**
     * Make of the vehicle.
     *
     * @var string
     */
    private $_vehicleMake;

    /**
     * Model of the vehicle.
     *
     * @var string
     */
    private $_vehicleModel;

    /**
     * Year of the vehicle.
     *
     * @var string
     */
    private $_vehicleYear;

    /**
     * ODO meter reading of the vehicle at check-in.
     *
     * @var string
     */
    private $_odoMeter;

    /**
     * Whether maintenance is completed and vehicle is ready to go.
     *
     * @var bool
     */
    private $_maintenanceStatus;

    /**
     * @return string
     */
    public function GetVehicleMake()
    {
        return $this->_vehicleMake;
    }

    /**
     * @param $make string
     */
    public function SetVehicleMake($make)
    {
        $this->_vehicleMake = $make;
    }

    /**
     * @return string
     */
    public function GetVehicleModel()
    {
        return $this->_vehicleModel;
    }

    /**
     * @param $model string
     */
    public function SetVehicleModel($model)
    {
        $this->_vehicleModel = $model;
    }

    /**
     * @return string
     */
    public function GetVehicleYear()
    {
        return $this->_vehicleYear;
    }

    /**
     * @param $year string
     */
    public function SetVehicleYear($year)
    {
        $this->_vehicleYear = $year;
    }

    /**
     * @return string
     */
    public function GetOdoMeter()
    {
        return $this->_odoMeter;
    }

    /**
     * @param $odoReading string
     */
    public function SetOdoMeter($odoReading)
    {
        $this->_odoMeter = $odoReading;
    }

    /**
     * @return bool
     */
    public function GetMaintenanceStatus()
    {
        return $this->_maintenanceStatus;
    }

    /**
     * @param $status bool true if maintenance completed; false otherwise.
     */
    public function SetMaintenanceStatus($status)
    {
        $this->_maintenanceStatus = $status;
    }

    /**
     * Stub function as there's no useful implementation in scope as of yet. For a start, the view dispatches
     * vehicle ID to it (which is un-used at the moment).
     * 
     * @param $vehicleId
     * @return string
     */
    public function RotateTires($vehicleId)
    {
        return json_encode(array(
            'flag' => 'success',
            'msg' => 'Tires rotated.'
        ));
    }
}
