<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

return function (array $configuration): Closure {
    return function(string $path) use ($configuration) : void {
        if (is_dir($path)) {
            return;
        }

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
    };
};
