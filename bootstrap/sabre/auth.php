<?php declare(strict_types=1);

namespace rikmeijer\nl\sabre;

use Sabre\DAV\Auth\Backend\PDO;
use Sabre\DAV\Auth\Plugin;
use function rikmeijer\Bootstrap\configuration\string;

return auth\configure(static function (array $configuration) : Plugin {
    $authBackend = new PDO(pdo());
    $authBackend->setRealm($configuration['realm']);
    return new Plugin($authBackend);
}, [
    'realm' => string('BaikalDAV')
]);
