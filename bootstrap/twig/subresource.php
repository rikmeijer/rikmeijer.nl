<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use rikmeijer\rikmeijernl\Twig\Subresource;
use Twig\Environment;
use Twig\TwigFunction;

return function (array $configuration): Closure {
    return function(Environment $twig) use ($configuration) {
        $twig->addFunction(new TwigFunction('subresource', new Subresource($configuration), ['is_safe' => ['html']]));
    };
};
