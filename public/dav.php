<?php /** @noinspection GlobalVariableUsageInspection */

$bootstrap = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';
$server = $bootstrap('sabre');
$server->exec();