<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

return function (array $configuration): Closure {
    return function () use ($configuration) {

        $createDirectory = $this->resource('selfupdater/directory');

        print PHP_EOL . 'Generating site...';
        $this->resource('selfupdater/build/site')($configuration['to']);
        print 'done';

        print PHP_EOL . 'Generating CSS...';
        $customCSSFile = Path::join($configuration['to'], 'css', 'custom.css');
        $createDirectory(dirname($customCSSFile));
        passthru($configuration['sass-binary'] . ' ' . escapeshellarg($configuration['custom-scss']) . ' ' . escapeshellarg($customCSSFile));
        echo 'done';
    };
};