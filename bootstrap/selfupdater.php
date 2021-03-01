<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

namespace rikmeijer\nl;

use rikmeijer\Bootstrap\Configuration;
use Webmozart\PathUtil\Path;
use function rikmeijer\nl\selfupdater\build;
use function rikmeijer\nl\selfupdater\directory;

$configuration = selfupdater\validate([
    'storages' => Configuration::default(['twig', 'sabre', 'sabre/data', 'sabre/files', 'sabre/files/blog']),
]);

return static function (string $workingDir) use ($configuration): void {
    chdir($workingDir);

    $createStorage = directory(Path::join($workingDir, 'storage'));
    array_map($createStorage, $configuration['storages']);

    build();
};