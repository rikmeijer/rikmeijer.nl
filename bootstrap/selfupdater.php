<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Configuration;
use Webmozart\PathUtil\Path;

$configuration = $validate([
    'load-development-libraries' => Configuration::default(false),
    'storages' => Configuration::default(['twig', 'sabre', 'sabre/data', 'sabre/files', 'sabre/files/blog']),
    'php-binary' => static function(?string $path) {
        if (file_exists($path) === false) {
            trigger_error('php-binary does not exist', E_USER_ERROR);
        } elseif (str_contains($path, ' ')) {
            return '"' . $path . '"';
        }
        return $path;
    }
]);

return static function (string $workingDir) use ($configuration, $bootstrap): void {
    chdir($workingDir);

    $composerCommand = $configuration['php-binary'] . ' composer.phar install';
    if ($configuration['load-development-libraries'] === false) {
        $composerCommand .= ' --no-dev';
    }
    exec($composerCommand);

    $createStorage = $bootstrap("selfupdater/directory", Path::join($workingDir, 'storage'));
    array_map($createStorage, $configuration['storages']);

    $bootstrap("selfupdater/build");
};