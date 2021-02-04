<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Sabre\DAV;

return function (array $configuration): DAV\Server {
    $rootDirectory = new DAV\FS\Directory($configuration['files-path']);

    $pdo = $this->resource('sabre/pdo');

    $principalBackend = new Sabre\DAVACL\PrincipalBackend\PDO($pdo);

    $server = new DAV\Server([
        new Sabre\DAVACL\PrincipalCollection($principalBackend),
        new Sabre\CalDAV\CalendarRoot($principalBackend, new Sabre\CalDAV\Backend\PDO($pdo)),
        new Sabre\CardDAV\AddressBookRoot($principalBackend, new Sabre\CardDAV\Backend\PDO($pdo)),
        $rootDirectory
    ]);
    $server->setBaseUri('/dav');

    $pdo = $this->resource('sabre/pdo');

    $lockBackend = new DAV\Locks\Backend\PDO($pdo);
    $lockPlugin = new DAV\Locks\Plugin($lockBackend);
    $server->addPlugin($lockPlugin);

    $caldavPlugin = new Sabre\CalDAV\Plugin();
    $server->addPlugin($caldavPlugin);

    $carddavPlugin = new Sabre\CardDAV\Plugin();
    $server->addPlugin($carddavPlugin);

    $server->addPlugin($this->resource('sabre/auth')($pdo));

    $aclPlugin = new Sabre\DAVACL\Plugin();
    $server->addPlugin($aclPlugin);

    $server->addPlugin(
        new Sabre\DAV\Sync\Plugin()
    );

    $server->addPlugin(new DAV\Browser\Plugin());


    return $server;
};
