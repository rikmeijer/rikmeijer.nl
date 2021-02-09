<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);
use Twig\Environment;
use Twig\Loader\FilesystemLoader;
use rikmeijer\Bootstrap\Dependency;

return
    #[Dependency(img: "twig/img", subresource : "twig/subresource")]
    function (array $configuration, Closure $img, Closure $subresource): Closure {
    $loader = new FilesystemLoader($configuration['templates']);

    $options = [];
    if (is_null($configuration['cache']) === false) {
        $options['cache'] = $configuration['cache'];
    }

    $twig = new Environment($loader, $options);
    $img($twig);
    $subresource($twig);
    return function(string $name, array $context) use ($twig) {
        return $twig->render($name, $context);
    };
};