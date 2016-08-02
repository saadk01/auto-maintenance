<?php
/**
 * Created by PhpStorm.
 * User: Saad
 * Date: 022, 22, Jun, 2016
 * Time: 9:37 PM
 */
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
            <a class="navbar-brand" href="index.php">Auto Maintenance</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li><a href="index.php">Home</a></li>
                <li class="active"><a href="#">Add</a></li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>

<div class="container">

    <div class="starter-template"><br/><br/>
        <h1>Auto Maintenance Shop</h1>

        <h3>Add Vehicle</h3>

        <div style="float: right;"><span id="add_v_result_msg"></span></div>
        <br/>

        <form id="add_v_form">
            <div class="form-group">
                <label for="Type" class="col-sm-2 control-label">Type</label>
                <div class="col-sm-10">
                    <select id="type" class="form-control" name="type">
                        <option value="gas_vehicle">Gasoline</option>
                        <option value="diesel_vehicle">Diesel</option>
                        <option value="electric_vehicle">Electric</option>
                    </select>
                </div>
            </div>
            <br/><br/><br/>

            <div class="form-group">
                <label for="Make" class="col-sm-2 control-label">Make</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="make" name="make">
                </div>
            </div>
            <br/><br/>

            <div class="form-group">
                <label for="Model" class="col-sm-2 control-label">Model</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="model" name="model">
                </div>
            </div>
            <br/><br/>

            <div class="form-group">
                <label for="Year" class="col-sm-2 control-label">Year</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="year" name="year">
                </div>
            </div>
            <br/><br/>

            <div class="form-group">
                <label for="Make" class="col-sm-2 control-label">ODO Reading</label>
                <div class="col-sm-10">
                    <input type="text" class="form-control" id="odo" name="odo">
                </div>
            </div>
            <br/><br/><br/>

            <input type="hidden" id="op" name="op" value="add_vehicle" >
            <input type="hidden" id="additional_params" name="additional_params" value="1" >

            <input type="submit" value="Submit" class="btn btn-primary">
    </div>

</div><!-- /.container -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"
        integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS"
        crossorigin="anonymous"></script>
<script src="scripts.js"></script>
</body>
</html>