<?php
declare(strict_types=1);

namespace rikmeijer\nl;

use Webmozart\PathUtil\Path;
use Webmozart\PathUtil\Path as WMPath;
use function rikmeijer\Bootstrap\configure;
use function rikmeijer\Bootstrap\types\arr;
use function rikmeijer\Bootstrap\types\binary;
use function rikmeijer\Bootstrap\types\path;
use function rikmeijer\nl\selfupdater\build\site;
use function rikmeijer\nl\selfupdater\directory;

return configure(static function (array $configuration, string $workingDir) : void {
    chdir($workingDir);

    $createStorage = directory(Path::join($workingDir, 'storage'));
    array_map($createStorage, $configuration['storages']);

    print PHP_EOL . 'Generating site...';
    site($configuration['to']);
    print 'done' . PHP_EOL;

    $customCSSFile = WMPath::join($configuration['to'], 'css', 'custom.css');
    directory(dirname($customCSSFile));
    $configuration['sass-binary']('Generating CSS...', $configuration['custom-scss'], $customCSSFile);
    echo 'done';
}, [
    'storages' => arr(['twig']),
    'to' => path('public'),
    'custom-scss' => path('resources/scss/custom.scss'),
    'sass-binary' => binary()
]);