<?php declare(strict_types=1);

namespace rikmeijer\nl\twig;

use rikmeijer\Bootstrap\Configuration;
use rikmeijer\rikmeijernl\Twig\Subresource;
use Twig\Environment;
use Twig\TwigFunction;

$configuration = \rikmeijer\nl\twig\subresource\validate([
    'integrity-hashes' => Configuration::default([
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" => "sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm",
        "https://code.jquery.com/jquery-3.2.1.slim.min.js" => "sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN",
        "https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" => "sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q",
        "https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" => "sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
    ])
]);

return static function(Environment $twig) use ($configuration) : void {
    $twig->addFunction(new TwigFunction('subresource', new Subresource($configuration), ['is_safe' => ['html']]));
};
