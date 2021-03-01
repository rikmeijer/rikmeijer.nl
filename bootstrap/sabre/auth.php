<?php declare(strict_types=1);

namespace rikmeijer\nl\sabre;

use rikmeijer\Bootstrap\Configuration;
use Sabre\DAV\Auth\Backend\PDO;
use Sabre\DAV\Auth\Plugin;

$configuration = auth\validate([
    'realm' => Configuration::default('BaikalDAV')
]);

return static function () use ($configuration): Plugin {
    $authBackend = new PDO(pdo());
    $authBackend->setRealm($configuration['realm']);
    return new Plugin($authBackend);
};
