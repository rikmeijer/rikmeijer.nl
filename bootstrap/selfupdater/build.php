<?php
declare(strict_types=1);

namespace rikmeijer\nl\selfupdater;

use Webmozart\PathUtil\Path as WMPath;
use function rikmeijer\Bootstrap\configuration\path;
use function rikmeijer\nl\selfupdater\build\site;

return build\configure(static function(array $configuration) {
    print PHP_EOL . 'Generating site...';
    site($configuration['to']);
    print 'done';

    print PHP_EOL . 'Generating CSS...';
    $customCSSFile = WMPath::join($configuration['to'], 'css', 'custom.css');
    directory(dirname($customCSSFile));
    passthru($configuration['sass-binary'] . ' ' . escapeshellarg($configuration['custom-scss']) . ' ' . escapeshellarg($customCSSFile));
    echo 'done';
}, [
    'to' => path('public'),
    'custom-scss' => path('resources','scss','custom.scss'),
    'sass-binary' => static function(?string $path) {
        if (file_exists($path) === false) {
            trigger_error('sass-binary does not exist', E_USER_ERROR);
        } elseif (str_contains($path, ' ')) {
            return '"' . $path . '"';
        }
        return $path;
    }
]);