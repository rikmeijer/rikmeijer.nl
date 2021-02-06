<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

return function (array $configuration): Closure {
    return function(string $workingDir) use ($configuration) {

        chdir($workingDir);
        switch ($configuration['stage']) {
            case 'production':
                exec('composer install --no-dev');
                break;

            case 'testing':
            case 'development':
                exec('composer install');
                break;
        }

        $createDirectory = $this->resource('selfupdater/storage')(Path::join($workingDir, 'storage'));
        array_map($createDirectory, $configuration['storages']);

        exec('php build.php');
    };
};