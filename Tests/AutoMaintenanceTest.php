<?php

use PHPUnit\Framework\TestCase;

class AutoMainenanceTest extends TestCase
{
    /**
     * @dataProvider provider
     */
    public function testRotateTires($sampleResponse)
    {

        $this->assertEquals($sampleResponse['msg'], 'Tires rotated.');
    }

    public function testSetMaintenanceStatus()
    {
        $maintenanceCompleted = true;
        $this->assertTrue($maintenanceCompleted);

        $maintenanceIncomplete = false;
        $this->assertFalse($maintenanceIncomplete);

    }

    public function provider()
    {
        return array(
            'flag' => 'success',
            'msg' => 'Tires rotated.'
        );
    }
}