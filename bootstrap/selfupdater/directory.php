<?php
declare(strict_types=1);

namespace rikmeijer\nl\selfupdater;

use rikmeijer\Bootstrap\Configuration;
use RuntimeException;
use Webmozart\PathUtil\Path;

$configuration = \rikmeijer\nl\selfupdater\directory\validate([
    'www-user' => Configuration::default('www-data'), // Ubuntu
    'www-group' => Configuration::default('www-data') // Ubuntu
]);

return $creator = static function (string $path) use (&$creator, $configuration): callable {
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
};
