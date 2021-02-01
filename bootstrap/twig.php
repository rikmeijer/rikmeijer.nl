<?php declare(strict_types=1);

use rikmeijer\Bootstrap\Bootstrap;
use Twig\Environment;
use Twig\Loader\FilesystemLoader;

return static function (Bootstrap $bootstrap, array $configuration): Environment {
    $loader = new FilesystemLoader($configuration['templates']);
    return new Environment($loader, [
        'cache' => $configuration['cache'],
    ]);
};