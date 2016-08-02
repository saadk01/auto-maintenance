<?php
/**
 * Instantiate relevant service and calls suitable method to do the work.
 *
 * Created by PhpStorm.
 * User: Saad
 * Date: 022, 22, Jun, 2016
 * Time: 5:51 AM
 */

spl_autoload_extensions(".php");
spl_autoload_register();

// 1) Get relevant parameters
$service = $_REQUEST['type'];
$operation = $_REQUEST['op'];

if (isset($_REQUEST['additional_params'])) {
    $vehicleMake = $_REQUEST['make'];
    $vehicleModel = $_REQUEST['model'];
    $vehicleYear = $_REQUEST['year'];
    $vehicleOdo = $_REQUEST['odo'];
} else {
    $vehicleId = $_REQUEST['vehicle_id'];
}

// 2) Parse the class and method names here through a number of steps rather than taking all of it as-is from JS
$service = str_replace('_', ' ', $service);
$service = ucwords($service);
$service = str_replace(' ', '', $service);
$service = 'Repository' . '\\' . $service . 'MaintenanceService';

$operation = str_replace('_', ' ', $operation);
$operation = ucwords($operation);
$operation = str_replace(' ', '', $operation);

// 3) Invoke relevant service class and method with appropriate parameters and return response
try {
    // Instantiate the service explicitly to avoid strict standard issue
    // Ref: http://wordpress.stackexchange.com/a/82247
    $serviceInstance = new $service();
    if (method_exists($serviceInstance, $operation)) {
        // For vehicle addition, dispatch the array of params; else dispatch just the ID
        if (isset($_REQUEST['additional_params'])) {
            $params = array($vehicleMake, $vehicleModel, $vehicleYear, $vehicleOdo);
        } else {
            $params = $vehicleId;
        }

        echo call_user_func(array($serviceInstance, $operation), $params);
    } else {
        throw new Exception();
    }
} catch (Exception $e) {
    echo json_encode(array(
        'flag' => 'failure',
        'msg' => "Can't complete the request as invalid parameters received."
    ));
}