<?php
declare(strict_types=1);

namespace rikmeijer\nl\sabre;

use PDO as _PDO;
use function rikmeijer\Bootstrap\configure;
use function rikmeijer\Bootstrap\types\string;

return configure(static function (array $configuration) : _PDO {
    $pdo = new _PDO($configuration['dsn'], $configuration['username'], $configuration['password']);
    $pdo->setAttribute(_PDO::ATTR_ERRMODE, _PDO::ERRMODE_EXCEPTION);
    return $pdo;
}, [
    'dsn' => string(null),
    'username' => string(null),
    'password' => string(null),
]);