<?php
declare(strict_types=1);

namespace rikmeijer\nl;

use Sabre\CalDAV\CalendarRoot;
use Sabre\CardDAV\AddressBookRoot;
use Sabre\DAV;
use Sabre\DAV\Locks\Plugin;
use Sabre\DAVACL\PrincipalBackend\PDO;
use Sabre\DAVACL\PrincipalCollection;
use function rikmeijer\Bootstrap\configuration\path;
use function rikmeijer\nl\sabre\auth;
use function rikmeijer\nl\sabre\pdo;

return sabre\configure(static function (array $configuration) : void {
    $pdo = pdo();
    $rootDirectory = new DAV\FS\Directory($configuration['files-path']);
    $principalBackend = new PDO($pdo);

    $server = new DAV\Server([
        new PrincipalCollection($principalBackend),
        new CalendarRoot($principalBackend, new \Sabre\CalDAV\Backend\PDO($pdo)),
        new AddressBookRoot($principalBackend, new \Sabre\CardDAV\Backend\PDO($pdo)),
        $rootDirectory
    ]);
    $server->setBaseUri('/dav');

    $lockBackend = new DAV\Locks\Backend\PDO($pdo);
    $lockPlugin = new Plugin($lockBackend);
    $server->addPlugin($lockPlugin);

    $caldavPlugin = new \Sabre\CalDAV\Plugin();
    $server->addPlugin($caldavPlugin);

    $carddavPlugin = new \Sabre\CardDAV\Plugin();
    $server->addPlugin($carddavPlugin);

    $server->addPlugin(auth($pdo));

    $aclPlugin = new \Sabre\DAVACL\Plugin();
    $server->addPlugin($aclPlugin);

    $server->addPlugin(
        new DAV\Sync\Plugin()
    );

    $server->addPlugin(new DAV\Browser\Plugin());

    $server->exec();
}, [
    'files-path' => path('storage', 'sabre', 'files')
]);
