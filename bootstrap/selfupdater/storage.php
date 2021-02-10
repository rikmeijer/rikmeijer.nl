<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Dependency;
use Webmozart\PathUtil\Path;

return
    #[Dependency(createDirectory: "selfupdater/directory")]
    function (Closure $createDirectory): Closure {
    return function(string $storageDirectory) use ($createDirectory) : Closure {
        $createDirectory($storageDirectory);
        return function(string $storage) use ($storageDirectory, $createDirectory) {
            return $createDirectory(Path::join($storageDirectory, $storage));
        };
    };
};
