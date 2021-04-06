<?php /** @noinspection GlobalVariableUsageInspection */

use function rikmeijer\nl\sabre;

require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
putenv("BOOTSTRAP_CONFIGURATION_PATH=" . dirname(__DIR__));
sabre();