<?php declare(strict_types=1);

use function rikmeijer\nl\selfupdater;

require __DIR__ . DIRECTORY_SEPARATOR . 'vendor/autoload.php';
selfupdater(__DIR__);
