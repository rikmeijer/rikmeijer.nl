<?php declare(strict_types=1);
$bootstrap = require __DIR__ . DIRECTORY_SEPARATOR . 'bootstrap.php';
$deployer = $bootstrap->resource('selfupdater');
$deployer(__DIR__);
