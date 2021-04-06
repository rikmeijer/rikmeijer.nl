<?php declare(strict_types=1);

namespace rikmeijer\nl\twig;

use Twig\Environment;
use Twig\TwigFunction;
use function rikmeijer\Bootstrap\configure;
use function rikmeijer\Bootstrap\types\string;

return configure(static function (array $configuration, Environment $twig) : void {
    $twig->addFunction(new TwigFunction('img', function (string $path, float $size = 1) use ($configuration) {
        if ($size < 1) {
            $width = (100*$size) . '%';
        } else {
            $width = "".$size;
        }
        return '<img src="' . htmlentities($configuration['images'] . $path) . '" class="img-fluid" width="' . htmlentities($width) . '" />';
    }, ['is_safe' => ['html']]));
}, [
    'images' => string("/img")
]);
