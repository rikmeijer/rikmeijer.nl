<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Dependency;
use Webmozart\PathUtil\Path;

return
    #[Dependency(createDirectory: "selfupdater/directory", siteBuilder: "selfupdater/build/site")]
    function (array $configuration, Closure $createDirectory, Closure $siteBuilder): Closure {
    return function () use ($configuration, $createDirectory, $siteBuilder) {
        print PHP_EOL . 'Generating site...';
        $siteBuilder($configuration['to']);
        print 'done';

        print PHP_EOL . 'Generating CSS...';
        $customCSSFile = Path::join($configuration['to'], 'css', 'custom.css');
        $createDirectory(dirname($customCSSFile));
        passthru($configuration['sass-binary'] . ' ' . escapeshellarg($configuration['custom-scss']) . ' ' . escapeshellarg($customCSSFile));
        echo 'done';
    };
};