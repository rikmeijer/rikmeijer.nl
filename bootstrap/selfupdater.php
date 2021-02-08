<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

return function (array $configuration): Closure {
    return function(string $workingDir) use ($configuration) {
        chdir($workingDir);
        $composerCommand = $configuration['php-binary'] . ' composer.phar install';
        switch ($configuration['stage']) {
            case 'production':
                exec( $composerCommand . '  --no-dev');
                break;

            case 'testing':
            case 'development':
                exec($composerCommand);
                break;
        }

        $createDirectory = $this->resource('selfupdater/storage')(Path::join($workingDir, 'storage'));
        array_map($createDirectory, $configuration['storages']);

        exec($configuration['php-binary'] . ' build.php');
    };
};