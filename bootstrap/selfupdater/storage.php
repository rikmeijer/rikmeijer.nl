<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

return function (array $configuration): Closure {
    return function(string $storageDirectory) use ($configuration) : Closure {
        $createDirectory = $this->resource('selfupdater/directory');
        $createDirectory($storageDirectory);
        return function(string $storage) use ($storageDirectory, $createDirectory) {
            return $createDirectory(Path::join($storageDirectory, $storage));
        };
    };
};
