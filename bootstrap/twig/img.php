<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Configuration;
use Twig\Environment;
use Twig\TwigFunction;

$configuration = $validate([
    'images' => Configuration::default("/img")
]);

return static function (Environment $twig) use ($configuration) : void {
    $twig->addFunction(new TwigFunction('img', function (string $path, float $size = 1) use ($configuration) {
        if ($size < 1) {
            $width = (100*$size) . '%';
        } else {
            $width = "".$size;
        }
        return '<img src="' . htmlentities($configuration['images'] . $path) . '" class="img-fluid" width="' . htmlentities($width) . '" />';
    }, ['is_safe' => ['html']]));
};
