<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

return function (array $configuration): Closure {
    return function(string $workingDir) use ($configuration) {
        chdir($workingDir);

        $this->resource('selfupdater/stages/' . $configuration['stage'])($configuration['php-binary'] . ' composer.phar install');

        $createDirectory = $this->resource('selfupdater/storage')(Path::join($workingDir, 'storage'));
        array_map($createDirectory, $configuration['storages']);

        passthru($configuration['php-binary'] . ' build.php');
    };
};