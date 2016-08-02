<?php

use PHPUnit\Framework\TestCase;

class GasVehicleMaintenanceServiceTest extends TestCase
{
    protected function setUp() {
        // Equivalent to session var
        $this->vehicles = array(
            new GasVehicleMaintenance('Mazda', 'Mazda 3', '2012', '67,321', false),
            new GasVehicleMaintenance('Toyota', 'Camry', '2007', '136,436', true),
            new GasVehicleMaintenance('Nissan', 'Sentra', '2012', '98,965', false),
        );
    }


    /**
     * @dataProvider provider
     */
    public function testChangeOil($sampleResponse)
    {

        $this->assertEquals($sampleResponse['msg'], 'Oil changed.');
    }

    public function provider()
    {
        return array(
            'flag' => 'success',
            'msg' => 'Oil changed.'
        );
    }

    public function testVehiclesArray()
    {
        $regularVehicles = array();

        $regularVehicles = $this->vehicles;

        $this->assertEquals($regularVehicles, $this->vehicles);
    }

    public function testUpdateVehicle()
    {
        $this->vehicles[2]->SetMaintenanceStatus(true);
        $this->assertTrue($this->vehicles[2]->GetMaintenanceStatus());
    }

    public function testAddVehicle()
    {
        $countBeforeAddition = count($this->vehicles);
        $this->vehicles[] = new GasVehicleMaintenance('Honda', 'Pilot', '2003', '198,965', false);

        $this->assertGreaterThan(count($this->vehicles), $countBeforeAddition);
    }

    public function testRemoveVehicle()
    {
        $countBeforeRemoval = count($this->vehicles);
        unset($this->vehicles[2]);

        $this->assertLessThan(count($this->vehicles), $countBeforeRemoval);
    }
}