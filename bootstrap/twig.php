<?php
declare(strict_types=1);

namespace rikmeijer\nl;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

use function rikmeijer\Bootstrap\configuration\path;
use function rikmeijer\nl\twig\img;
use function rikmeijer\nl\twig\subresource;

return twig\configure(static function (array $configuration, string $name, array $context) : string {
    $loader = new FilesystemLoader($configuration['templates']);

    $options = [];
    if (is_null($configuration['cache']) === false) {
        $options['cache'] = $configuration['cache'];
    }

    $twig = new Environment($loader, $options);
    img($twig);
    subresource($twig);

    return $twig->render($name, $context);
}, [
    'templates' => path('resources', 'twig'),
    'cache' => path('storage', 'twig')
]);