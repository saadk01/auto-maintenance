<?php

namespace Repository;
use Domain;
if (PHP_SESSION_NONE == session_status()) {
    session_start();
}

/**
 * Class DieselVehicleMaintenanceService: Manager for CRUD and related functionality for DieselVehicleMaintenance.
 *
 * Created by PhpStorm.
 * User: Saad
 * Date: 021, 21, Jun, 2016
 * Time: 10:32 PM
 */
class DieselVehicleMaintenanceService extends Domain\DieselVehicleMaintenance
{
    private $_dieselVehicles = array();

    /**
     * Returns all diesel vehicles in the shop.
     *
     * @return array
     */
    public function GetAllDieselVehicles()
    {
        // Method to be used in lieu of actual DB
        // Only load test data if it's a new run
        if (isset($_SESSION['dieselVehicles'])) {
            $this->_dieselVehicles = $_SESSION['dieselVehicles'];
        } else {
            $this->LoadTestData();
            $_SESSION['dieselVehicles'] = $this->_dieselVehicles;
        }
        
        return $this->_dieselVehicles;
    }

    /**
     * Adds a diesel vehicle to the queue in shop.
     *
     * @param $params Array of all properties needed to create an instance of the given vehicle
     * @return string
     */
    public function AddVehicle($params)
    {
        try {
            $dv = new Domain\DieselVehicleMaintenance();
            $dv->SetVehicleMake($params[0]);
            $dv->SetVehicleModel($params[1]);
            $dv->SetVehicleYear($params[2]);
            $dv->SetOdoMeter(number_format($params[3]));
            $dv->SetMaintenanceStatus(false);

            $this->_dieselVehicles = $_SESSION['dieselVehicles'];
            $this->_dieselVehicles[] = $dv;
            $_SESSION['dieselVehicles'] = $this->_dieselVehicles;

            return json_encode(array(
                'flag' => 'success',
                'msg' => 'Vehicle added successfully.'
            ));
        } catch (Exception $e) {
            return json_encode(array(
                'flag' => 'failure',
                'msg' => 'Vehicle couldn\'t be added to shop; please contact support.'
            ));
        }

        exit;
    }

    /**
     * Raises the flag that maintenance is completed.
     *
     * @param $vehicleId
     * @return string
     */
    public function CompleteMaintenance($vehicleId)
    {
        $this->_dieselVehicles = $_SESSION['dieselVehicles'];

        if (!count($this->_dieselVehicles)) {
            $this->_dieselVehicles = $_SESSION['dieselVehicles'];
        }
        $this->_dieselVehicles[$vehicleId]->SetMaintenanceStatus(true);
        $_SESSION['dieselVehicles'] = $this->_dieselVehicles;

        return json_encode(array(
            'flag' => 'success',
            'msg' => 'Maintenance completed.'
        ));
    }

    /**
     * Checks out (removes) a diesel vehicle from the queue in shop.
     *
     * @param $vehicleId
     * @return string
     */
    public function CheckoutVehicle($vehicleId)
    {
        $this->_dieselVehicles = $_SESSION['dieselVehicles'];
        
        if (!count($this->_dieselVehicles)) {
            $this->_dieselVehicles = $_SESSION['dieselVehicles'];
        }
        unset($this->_dieselVehicles[$vehicleId]);
        $_SESSION['dieselVehicles'] = $this->_dieselVehicles;

        return json_encode(array(
            'flag' => 'success',
            'msg' => 'Vehicle checked out.'
        ));
    }

    /**
     * Provides test data (Diesel vehicles present at shop) in absence of database.
     *
     * Note: The given array key index is considered as the record's ID (equivalent to a DB primary key).
     *
     * @return array
     */
    private function LoadTestData()
    {
        $v1 = new Domain\DieselVehicleMaintenance();
        $v1->SetVehicleMake('Dodge');
        $v1->SetVehicleModel('Ram 3500');
        $v1->SetVehicleYear('2010');
        $v1->SetOdoMeter('88,221');
        $v1->SetMaintenanceStatus(false);
        $this->_dieselVehicles[0] = $v1;

        $v2 = new Domain\DieselVehicleMaintenance();
        $v2->SetVehicleMake('Volkswagen');
        $v2->SetVehicleModel('Beetle TDI');
        $v2->SetVehicleYear('2011');
        $v2->SetOdoMeter('97,214');
        $v2->SetMaintenanceStatus(false);
        $this->_dieselVehicles[1] = $v2;

        $v3 = new Domain\DieselVehicleMaintenance();
        $v3->SetVehicleMake('Mazda');
        $v3->SetVehicleModel('CX-5');
        $v3->SetVehicleYear('2015');
        $v3->SetOdoMeter('23,992');
        $v3->SetMaintenanceStatus(false);
        $this->_dieselVehicles[2] = $v3;

        unset($v1, $v2, $v3);

        // For first run, make sure there isn't any session variable sored
        if (isset($_SESSION['dieselVehicles'])) {
            unset($_SESSION['dieselVehicles']);
        }
    }
}