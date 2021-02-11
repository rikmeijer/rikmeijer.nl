<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

return static function() use ($configuration) : PDO {
    $pdo = new PDO($configuration['dsn'], $configuration['username'], $configuration['password']);
    $pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    return $pdo;
};