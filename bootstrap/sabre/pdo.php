<?php
declare(strict_types=1);

namespace rikmeijer\nl\sabre;

use PDO as _PDO;

return pdo\configure(static function (array $configuration) : _PDO {
    $pdo = new _PDO($configuration['dsn'], $configuration['username'], $configuration['password']);
    $pdo->setAttribute(_PDO::ATTR_ERRMODE, _PDO::ERRMODE_EXCEPTION);
    return $pdo;
}, []);