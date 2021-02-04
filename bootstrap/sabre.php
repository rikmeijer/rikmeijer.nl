<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Sabre\DAV;

return function (array $configuration): DAV\Server {
    $rootDirectory = new DAV\FS\Directory($configuration['public-path']);

    $server = new DAV\Server($rootDirectory);

    $server->setBaseUri('/dav');

    $lockBackend = new DAV\Locks\Backend\File($configuration['data-path'] . '/locks');
    $lockPlugin = new DAV\Locks\Plugin($lockBackend);
    $server->addPlugin($lockPlugin);

    $server->addPlugin(new DAV\Browser\Plugin());

    return $server;
};
