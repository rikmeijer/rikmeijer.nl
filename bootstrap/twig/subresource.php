<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use rikmeijer\rikmeijernl\Twig\Subresource;
use Twig\Environment;
use Twig\TwigFunction;

$configuration = $validate([]);

return static function(Environment $twig) use ($configuration) : void {
    $twig->addFunction(new TwigFunction('subresource', new Subresource($configuration), ['is_safe' => ['html']]));
};
