<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Configuration;
use Webmozart\PathUtil\Path;

$configuration = $validate([
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