<?php /** @noinspection GlobalVariableUsageInspection */

$bootstrap = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';

$server = $bootstrap->resource('sabre');

// All we need to do now, is to fire up the server
$server->exec();