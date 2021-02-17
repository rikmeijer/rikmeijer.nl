<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

$configuration = $validate([]);

return static function () use ($configuration, $bootstrap) {
    print PHP_EOL . 'Generating site...';
    $bootstrap("selfupdater/build/site", $configuration['to']);
    print 'done';

    print PHP_EOL . 'Generating CSS...';
    $customCSSFile = Path::join($configuration['to'], 'css', 'custom.css');
    $bootstrap("selfupdater/directory", dirname($customCSSFile));
    passthru($configuration['sass-binary'] . ' ' . escapeshellarg($configuration['custom-scss']) . ' ' . escapeshellarg($customCSSFile));
    echo 'done';
};