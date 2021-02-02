<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Twig\Environment;
use Twig\TwigFunction;
use Webmozart\PathUtil\Path;

return function (array $configuration): Closure {
    return function(Environment $twig) use ($configuration) {
        $twig->addFunction(new TwigFunction('subresource', function (string $url) use ($configuration) {
            $attributes = [];
            if (Path::isLocal($url) === false) {
                $attributes[] = 'crossorigin="anonymous"';
            }

            if (array_key_exists($url, $configuration['integrity-hashes'])) {
                $attributes[] = 'integrity="' . htmlentities($configuration['integrity-hashes'][$url]) . '"';
            }

            switch (Path::getExtension($url)) {
                case 'css':
                    return '<link href="' . htmlentities($url) . '" rel="stylesheet" ' . implode(' ', $attributes) . '>';

                case 'js':
                    return '<script src="' . htmlentities($url) . '" ' . implode(' ', $attributes) . '></script>';

                case 'pgp':
                    return '<link href="' . htmlentities($url) . '" rel="pgpkey">';

                default:
                    return '';
            }
        }, ['is_safe' => ['html']]));
    };
};
