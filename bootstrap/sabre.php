<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Sabre\DAV;
use rikmeijer\Bootstrap\Dependency;

return
    #[Dependency(pdo: "sabre/pdo", auth: "sabre/auth")]
    function (array $configuration, PDO $pdo, Closure $auth): DAV\Server {
    $rootDirectory = new DAV\FS\Directory($configuration['files-path']);

    $principalBackend = new Sabre\DAVACL\PrincipalBackend\PDO($pdo);

    $server = new DAV\Server([
        new Sabre\DAVACL\PrincipalCollection($principalBackend),
        new Sabre\CalDAV\CalendarRoot($principalBackend, new Sabre\CalDAV\Backend\PDO($pdo)),
        new Sabre\CardDAV\AddressBookRoot($principalBackend, new Sabre\CardDAV\Backend\PDO($pdo)),
        $rootDirectory
    ]);
    $server->setBaseUri('/dav');

    $lockBackend = new DAV\Locks\Backend\PDO($pdo);
    $lockPlugin = new DAV\Locks\Plugin($lockBackend);
    $server->addPlugin($lockPlugin);

    $caldavPlugin = new Sabre\CalDAV\Plugin();
    $server->addPlugin($caldavPlugin);

    $carddavPlugin = new Sabre\CardDAV\Plugin();
    $server->addPlugin($carddavPlugin);

    $server->addPlugin($auth($pdo));

    $aclPlugin = new Sabre\DAVACL\Plugin();
    $server->addPlugin($aclPlugin);

    $server->addPlugin(
        new Sabre\DAV\Sync\Plugin()
    );

    $server->addPlugin(new DAV\Browser\Plugin());


    return $server;
};
