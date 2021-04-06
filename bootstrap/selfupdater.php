<?php
declare(strict_types=1);

namespace rikmeijer\nl;

use Webmozart\PathUtil\Path;
use function rikmeijer\Bootstrap\configure;
use function rikmeijer\Bootstrap\types\arr;
use function rikmeijer\nl\selfupdater\build;
use function rikmeijer\nl\selfupdater\directory;

return configure(static function (array $configuration, string $workingDir) : void {
    chdir($workingDir);

    $createStorage = directory(Path::join($workingDir, 'storage'));
    array_map($createStorage, $configuration['storages']);

    build();
}, [
    'storages' => arr(['twig', 'sabre', 'sabre/data', 'sabre/files', 'sabre/files/blog']),
]);