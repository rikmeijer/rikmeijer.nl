<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Twig\Environment;
use Twig\TwigFunction;

return function (array $configuration): Closure {
    return function(Environment $twig) use ($configuration) {
        $twig->addFunction(new TwigFunction('img', function (string $path, float $size = 1) use ($configuration) {
            if ($size < 1) {
                $width = (100*$size) . '%';
            } else {
                $width = "".$size;
            }
            return '<img src="' . htmlentities($configuration['images'] . $path) . '" width="' . htmlentities($width) . '" />';
        }, ['is_safe' => ['html']]));
    };
};