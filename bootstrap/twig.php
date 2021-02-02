<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
return function (array $configuration): Environment {
    $loader = new FilesystemLoader($configuration['templates']);

    $options = [];
    if (is_null($configuration['cache']) === false) {
        $options['cache'] = $configuration['cache'];
    }

    $twig = new Environment($loader, $options);
    $this->resource('twig/img')($twig);
    return $twig;
};