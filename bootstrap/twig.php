<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use rikmeijer\Bootstrap\Configuration;

$configuration = $validate([ // must be same as basename of resource loader
    'templates' => Configuration::path('resources', 'twig'),
    'cache' => Configuration::path('storage', 'twig')
]);

return static function (string $name, array $context) use ($configuration, $bootstrap): string {
    $loader = new FilesystemLoader($configuration['templates']);

    $options = [];
    if (is_null($configuration['cache']) === false) {
        $options['cache'] = $configuration['cache'];
    }

    $twig = new Environment($loader, $options);
    $bootstrap("twig/img", $twig);
    $bootstrap("twig/subresource", $twig);

    return $twig->render($name, $context);
};