<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

namespace rikmeijer\nl\sabre;

use PDO;

$configuration = \rikmeijer\nl\sabre\pdo\validate([]);

return static function() use ($configuration) : PDO {
    $pdo = new PDO($configuration['dsn'], $configuration['username'], $configuration['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $pdo;
};