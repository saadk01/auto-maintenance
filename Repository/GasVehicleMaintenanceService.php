<?php

namespace Repository;
use Domain;
if (PHP_SESSION_NONE == session_status()) {
    session_start();
}
/**
 * Class GasVehicleMaintenanceService: Manager for CRUD and related functionality for GasVehicleMaintenance.
 *
 * Created by PhpStorm.
 * User: Saad
 * Date: 021, 21, Jun, 2016
 * Time: 10:32 PM
 * @package Repository
 */
class GasVehicleMaintenanceService extends Domain\GasVehicleMaintenance
{
    private $_gasVehicles = array();

    /**
     * Returns all gasoline vehicles in the shop.
     *
     * @return array
     */
    public function GetAllGasVehicles()
    {
        // Method to be used in lieu of actual DB
        // Only load test data if it's a new run
        if (isset($_SESSION['gasVehicles'])) {
            $this->_gasVehicles = $_SESSION['gasVehicles'];
        } else {
            $this->LoadTestData();
            $_SESSION['gasVehicles'] = $this->_gasVehicles;
        }

        return $this->_gasVehicles;
    }

    /**
     * Adds a gasoline vehicle to the queue in shop.
     *
     * @param $params Array of all properties needed to create an instance of the given vehicle
     * @return string
     */
    public function AddVehicle($params)
    {
        try {
            $gv = new Domain\GasVehicleMaintenance();
            $gv->SetVehicleMake($params[0]);
            $gv->SetVehicleModel($params[1]);
            $gv->SetVehicleYear($params[2]);
            $gv->SetOdoMeter(number_format($params[3]));
            $gv->SetMaintenanceStatus(false);

            $this->_gasVehicles = $_SESSION['gasVehicles'];
            $this->_gasVehicles[] = $gv;
            $_SESSION['gasVehicles'] = $this->_gasVehicles;

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

    }

    /**
     * Raises the flag that maintenance is completed (update).
     *
     * @param $vehicleId
     * @return string
     */
    public function CompleteMaintenance($vehicleId)
    {
        if (!count($this->_gasVehicles)) {
            $this->_gasVehicles = $_SESSION['gasVehicles'];
        }
        $this->_gasVehicles[$vehicleId]->SetMaintenanceStatus(true);
        $_SESSION['gasVehicles'] = $this->_gasVehicles;

        return json_encode(array(
            'flag' => 'success',
            'msg' => 'Maintenance completed.'
        ));
    }

    /**
     * Checks out (removes) a gasoline vehicle from the queue in shop.
     * 
     * @param $vehicleId
     * @return string
     */
    public function CheckoutVehicle($vehicleId)
    {
        if (!count($this->_gasVehicles)) {
            $this->_gasVehicles = $_SESSION['gasVehicles'];
        }
        unset($this->_gasVehicles[$vehicleId]);
        $_SESSION['gasVehicles'] = $this->_gasVehicles;

        return json_encode(array(
            'flag' => 'success',
            'msg' => 'Vehicle checked out.'
        ));
    }

    /**
     * Provides test data (Gas vehicles present at shop) in absence of database.
     *
     * Note: The given array key index is considered as the record's ID (equivalent to a DB primary key).
     * 
     * @return array
     */
    private function LoadTestData()
    {
        $v1 = new Domain\GasVehicleMaintenance();
        $v1->SetVehicleMake('Toyota');
        $v1->SetVehicleModel('Corolla');
        $v1->SetVehicleYear('2014');
        $v1->SetOdoMeter('108,221');
        $v1->SetMaintenanceStatus(false);
        $this->_gasVehicles[0] = $v1;

        $v2 = new Domain\GasVehicleMaintenance();
        $v2->SetVehicleMake('Mazda');
        $v2->SetVehicleModel('Mazda 6');
        $v2->SetVehicleYear('2009');
        $v2->SetOdoMeter('184,214');
        $v2->SetMaintenanceStatus(true);
        $this->_gasVehicles[1] = $v2;

        $v3 = new Domain\GasVehicleMaintenance();
        $v3->SetVehicleMake('Hyundai');
        $v3->SetVehicleModel('Genesis');
        $v3->SetVehicleYear('2012');
        $v3->SetOdoMeter('98,214');
        $v3->SetMaintenanceStatus(false);
        $this->_gasVehicles[2] = $v3;

        unset($v1, $v2, $v3);

        // For first run, make sure there isn't any session variable sored
        if (isset($_SESSION['gasVehicles'])) {
            unset($_SESSION['gasVehicles']);
        }
    }
}