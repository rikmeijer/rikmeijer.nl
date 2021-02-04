<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Sabre\DAV\Auth;

return function (array $configuration) : Closure {
    return function(PDO $pdo) use ($configuration) : Auth\Plugin {
        $authBackend = new Auth\Backend\PDO($pdo);
        $authBackend->setRealm($configuration['realm']);
        return new Auth\Plugin($authBackend);
    };
};
