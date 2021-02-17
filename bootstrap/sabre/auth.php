<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Configuration;
use Sabre\DAV\Auth;

$configuration = $validate([
    'realm' => Configuration::default('BaikalDAV')
]);

return static function() use ($configuration, $bootstrap) : Auth\Plugin {
    $authBackend = new Auth\Backend\PDO($bootstrap('sabre/pdo'));
    $authBackend->setRealm($configuration['realm']);
    return new Auth\Plugin($authBackend);
};
