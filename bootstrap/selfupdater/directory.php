<?php
declare(strict_types=1);

namespace rikmeijer\nl\selfupdater;

use RuntimeException;
use Webmozart\PathUtil\Path;
use function rikmeijer\Bootstrap\configuration\string;

return $creator = directory\configure(static function (array $configuration, string $path) use (&$creator): callable {
    if (!is_dir($path)) {
        print PHP_EOL . 'Creating ' . $path . '...';
        if (!@mkdir($path, 0777, true) && !is_dir($path)) {
            throw new RuntimeException(sprintf('Directory "%s" was not created', $path));
        }
        print 'done';

        print PHP_EOL . 'Setting rights and ownership on ' . $path . '...';
        chmod($path, 0775);
        chown($path, $configuration['www-user']);
        chgrp($path, $configuration['www-group']);
        print 'done';
    }

    return static function(string $directory) use ($creator, $path) : callable {
        return $creator(Path::join($path, $directory));
    };
}, [
    'www-user' => string('www-data'),
    'www-group' => string('www-data')
]);
