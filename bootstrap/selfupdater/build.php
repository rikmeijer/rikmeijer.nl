<?php
declare(strict_types=1);

namespace rikmeijer\nl\selfupdater;

use rikmeijer\Bootstrap\Configuration;
use Webmozart\PathUtil\Path;
use function rikmeijer\nl\selfupdater\build\site;

$configuration = build\validate([
    'to' => Configuration::path('public'),
    'custom-scss' => Configuration::path('resources','scss','custom.scss'),
    'sass-binary' => static function(?string $path) {
        if (file_exists($path) === false) {
            trigger_error('sass-binary does not exist', E_USER_ERROR);
        } elseif (str_contains($path, ' ')) {
            return '"' . $path . '"';
        }
        return $path;
    }
]);

return static function () use ($configuration) {
    print PHP_EOL . 'Generating site...';
    site($configuration['to']);
    print 'done';

    print PHP_EOL . 'Generating CSS...';
    $customCSSFile = Path::join($configuration['to'], 'css', 'custom.css');
    directory(dirname($customCSSFile));
    passthru($configuration['sass-binary'] . ' ' . escapeshellarg($configuration['custom-scss']) . ' ' . escapeshellarg($customCSSFile));
    echo 'done';
};