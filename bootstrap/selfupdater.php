<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

$configuration = $validate([]);

return static function (string $workingDir) use ($configuration, $bootstrap): void {
    chdir($workingDir);

    $composerCommand = $configuration['php-binary'] . ' composer.phar install';
    if ($configuration['load-development-libraries'] === false) {
        $composerCommand .= ' --no-dev';
    }
    exec($composerCommand);

    $createStorage = $bootstrap("selfupdater/directory", Path::join($workingDir, 'storage'));
    array_map($createStorage, $configuration['storages']);

    $bootstrap("selfupdater/build");
};