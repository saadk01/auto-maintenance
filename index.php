<?php
    use Repository;
    spl_autoload_extensions(".php");
    spl_autoload_register();
?>

<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Auto Maintenance Shop</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
          integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css"
          integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
</head>

<body>

<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Auto Maintenance</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="#">Home</a></li>
                <li><a href="addvehicle.php">Add</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter-template">
        <h1>Auto Maintenance Shop</h1>

        <h3>Gas Vehicles in the Shop</h3>

        <div style="float: right;"><span id="gv_result_msg"></span></div>
        <br/>
        <table class="table">
            <thead>
                <th>Make</th>
                <th>Model</th>
                <th>Year</th>
                <th>ODO Reading (km)</th>
                <th>Maintenance Status</th>
                <th>Actions</th>
            </thead>
            <?php
                $gasMaintenance = new Repository\GasVehicleMaintenanceService();
                $gasVehicles = $gasMaintenance->GetAllGasVehicles();
                $gasVehicles = $gasMaintenance->GetAllGasVehicles();
            ?>
            <?php foreach ($gasVehicles as $id => $gv) { ?>
                <tr>
                    <td><?php echo $gv->GetVehicleMake() ?></td>
                    <td><?php echo $gv->GetVehicleModel() ?></td>
                    <td><?php echo $gv->GetVehicleYear() ?></td>
                    <td><?php echo $gv->GetOdoMeter() ?></td>
                    <td><?php echo (false == $gv->GetMaintenanceStatus())? 'Required': 'Completed' ?></td>
                    <td>
                        <div id="gv_tasks_<?php echo $id ?>" class="v_tasks">
                            <?php if (!$gv->GetMaintenanceStatus()) { ?>
                                <button class="btn-xs btn-primary" data-type="gas_vehicle" data-op="change_oil"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="gv">Change Oil</button>&nbsp;
                                <button class="btn-xs btn-primary" data-type="gas_vehicle" data-op="rotate_tires"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="gv">Rotate Tires</button>&nbsp;
                                <button class="btn-xs btn-primary" data-type="gas_vehicle" data-op="complete_maintenance"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="gv">Maintenance Complete</button>
                            <?php } else { ?>
                                    <button class="btn-xs btn-primary" data-type="gas_vehicle" data-op="checkout_vehicle"
                                            data-v_id="<?php echo $id ?>" data-vehicle_type="gv">Check Out</button>
                        <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <h3>Diesel Vehicles in the Shop</h3>

        <div style="float: right;"><span id="dv_result_msg"></span></div>
        <br/>
        <table class="table">
            <thead>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>ODO Reading (km)</th>
            <th>Maintenance Status</th>
            <th>Actions</th>
            </thead>
            <?php
            $dieselMaintenance = new Repository\DieselVehicleMaintenanceService();
            $dieselVehicles = $dieselMaintenance->GetAllDieselVehicles();
            ?>
            <?php foreach ($dieselVehicles as $id => $dv) { ?>
                <tr>
                    <td><?php echo $dv->GetVehicleMake() ?></td>
                    <td><?php echo $dv->GetVehicleModel() ?></td>
                    <td><?php echo $dv->GetVehicleYear() ?></td>
                    <td><?php echo $dv->GetOdoMeter() ?></td>
                    <td><?php echo (false === $dv->GetMaintenanceStatus())? 'Required': 'Completed' ?></td>
                    <td>
                        <div id="dv_tasks_<?php echo $id ?>" class="v_tasks">
                            <?php if (!$dv->GetMaintenanceStatus()) { ?>
                                <button class="btn-xs btn-primary" data-type="diesel_vehicle" data-op="change_oil"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="dv">Change Oil</button>&nbsp;
                                <button class="btn-xs btn-primary" data-type="diesel_vehicle" data-op="rotate_tires"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="dv">Rotate Tires</button>&nbsp;
                                <button class="btn-xs btn-primary" data-type="diesel_vehicle" data-op="complete_maintenance"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="dv">Maintenance Complete</button>
                            <?php } else { ?>
                                <button class="btn-xs btn-primary" data-type="diesel_vehicle" data-op="checkout_vehicle"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="dv">Check Out</button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>

        <h3>Electric Vehicles in the Shop</h3>

        <div style="float: right;"><span id="ev_result_msg"></span></div>
        <br/>
        <table class="table">
            <thead>
            <th>Make</th>
            <th>Model</th>
            <th>Year</th>
            <th>ODO Reading (km)</th>
            <th>Maintenance Status</th>
            <th>Actions</th>
            </thead>
            <?php
            $electricMaintenance = new Repository\ElectricVehicleMaintenanceService();
            $electricVehicles = $electricMaintenance->GetAllElectricVehicles();
            ?>
            <?php foreach ($electricVehicles as $id => $ev) { ?>
                <tr>
                    <td><?php echo $ev->GetVehicleMake() ?></td>
                    <td><?php echo $ev->GetVehicleModel() ?></td>
                    <td><?php echo $ev->GetVehicleYear() ?></td>
                    <td><?php echo $ev->GetOdoMeter() ?></td>
                    <td><?php echo (false === $ev->GetMaintenanceStatus())? 'Required': 'Completed' ?></td>
                    <td>
                        <div id="ev_tasks_<?php echo $id ?>" class="v_tasks">
                            <?php if (!$ev->GetMaintenanceStatus()) { ?>
                                <button class="btn-xs btn-primary" data-type="electric_vehicle" data-op="charge_battery"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="ev">Charge Battery</button>&nbsp;
                                <button class="btn-xs btn-primary" data-type="electric_vehicle" data-op="rotate_tires"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="ev">Rotate Tires</button>&nbsp;
                                <button class="btn-xs btn-primary" data-type="electric_vehicle" data-op="complete_maintenance"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="ev">Maintenance Complete</button>
                            <?php } else { ?>
                                <button class="btn-xs btn-primary" data-type="electric_vehicle" data-op="checkout_vehicle"
                                        data-v_id="<?php echo $id ?>" data-vehicle_type="ev">Check Out</button>
                            <?php } ?>
                        </div>
                    </td>
                </tr>
            <?php } ?>
        </table>
    </div>

</div><!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<script src="scripts.js"></script>
</body>
</html>
