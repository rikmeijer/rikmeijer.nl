<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Dependency;
use Webmozart\PathUtil\Path;

return
    #[Dependency(storage: "selfupdater/storage", builder: "selfupdater/build")]
    function (
        array $configuration,
        Closure $storage,
        Closure $builder
    ): Closure {
        $stage = $this->resource('selfupdater/stages/' . $configuration['stage']);
        return function (string $workingDir) use ($configuration, $stage, $storage, $builder) {
            chdir($workingDir);

            $stage($configuration['php-binary'] . ' composer.phar install');

            $createDirectory = $storage(Path::join($workingDir, 'storage'));
            array_map($createDirectory, $configuration['storages']);

            $builder();
        };
    };