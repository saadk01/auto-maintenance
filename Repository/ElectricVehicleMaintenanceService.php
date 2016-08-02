<?php

namespace Repository;
use Domain;
if (PHP_SESSION_NONE == session_status()) {
    session_start();
}

/**
 * Class ElectricVehicleMaintenanceService: Manager for CRUD and related functionality for ElectricVehicleMaintenance.
 *
 * Created by PhpStorm.
 * User: Saad
 * Date: 021, 21, Jun, 2016
 * Time: 10:45 PM
 */
class ElectricVehicleMaintenanceService extends Domain\ElectricVehicleMaintenance
{
    private $_electricVehicles = array();

    /**
     * Returns all electric vehicles in the shop.
     *
     * @return array
     */
    public function GetAllElectricVehicles()
    {
        // Method to be used in lieu of actual DB
        // Only load test data if it's a new run
        if (isset($_SESSION['electricVehicles'])) {
            $this->_electricVehicles = $_SESSION['electricVehicles'];
        } else {
            $this->LoadTestData();
            $_SESSION['electricVehicles'] = $this->_electricVehicles;
        }
        
        return $this->_electricVehicles;
    }

    /**
     * Adds a electric vehicle to the queue in shop.
     *
     * @param $params Array of all properties needed to create an instance of the given vehicle
     * @return string
     */
    public function AddVehicle($params)
    {
        try {
            $ev = new Domain\ElectricVehicleMaintenance();
            $ev->SetVehicleMake($params[0]);
            $ev->SetVehicleModel($params[1]);
            $ev->SetVehicleYear($params[2]);
            $ev->SetOdoMeter(number_format($params[3]));
            $ev->SetMaintenanceStatus(false);

            $this->_electricVehicles = $_SESSION['electricVehicles'];
            $this->_electricVehicles[] = $ev;
            $_SESSION['electricVehicles'] = $this->_electricVehicles;

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
     * Raises the flag that maintenance is completed.
     *
     * @param $vehicleId
     * @return string
     */
    public function CompleteMaintenance($vehicleId)
    {
        $this->_electricVehicles = $_SESSION['electricVehicles'];

        if (!count($this->_electricVehicles)) {
            $this->_electricVehicles = $_SESSION['electricVehicles'];
        }
        $this->_electricVehicles[$vehicleId]->SetMaintenanceStatus(true);
        $_SESSION['electricVehicles'] = $this->_electricVehicles;

        return json_encode(array(
            'flag' => 'success',
            'msg' => 'Maintenance completed.'
        ));
    }

    /**
     * Checks out (removes) an electric vehicle from the queue in shop.
     *
     * @param $vehicleId
     * @return string
     */
    public function CheckoutVehicle($vehicleId)
    {
        $this->_electricVehicles = $_SESSION['electricVehicles'];
        
        if (!count($this->_electricVehicles)) {
            $this->_electricVehicles = $_SESSION['electricVehicles'];
        }
        unset($this->_electricVehicles[$vehicleId]);
        $_SESSION['electricVehicles'] = $this->_electricVehicles;

        return json_encode(array(
            'flag' => 'success',
            'msg' => 'Vehicle checked out.'
        ));
    }

    /**
     * Provides test data (Electric vehicles present at shop) in absence of database.
     *
     * Note: The given array key index is considered as the record's ID (equivalent to a DB primary key).
     *
     * @return array
     */
    private function LoadTestData()
    {
        $v1 = new Domain\ElectricVehicleMaintenance();
        $v1->SetVehicleMake('Nissan');
        $v1->SetVehicleModel('LEAF');
        $v1->SetVehicleYear('2016');
        $v1->SetOdoMeter('7,221');
        $v1->SetMaintenanceStatus(false);
        $this->_electricVehicles[0] = $v1;

        $v2 = new Domain\ElectricVehicleMaintenance();
        $v2->SetVehicleMake('Ford');
        $v2->SetVehicleModel('Focus Electric');
        $v2->SetVehicleYear('2015');
        $v2->SetOdoMeter('24,314');
        $v2->SetMaintenanceStatus(false);
        $this->_electricVehicles[1] = $v2;

        $v3 = new Domain\ElectricVehicleMaintenance();
        $v3->SetVehicleMake('Tesla');
        $v3->SetVehicleModel('Model S');
        $v3->SetVehicleYear('2016');
        $v3->SetOdoMeter('997');
        $v3->SetMaintenanceStatus(false);
        $this->_electricVehicles[2] = $v3;

        unset($v1, $v2, $v3);

        // For first run, make sure there isn't any session variable sored
        if (isset($_SESSION['electricVehicles'])) {
            unset($_SESSION['electricVehicles']);
        }
    }
}