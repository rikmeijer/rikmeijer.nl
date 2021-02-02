<?php declare(strict_types=1);

use Webmozart\PathUtil\Path;

return [
    'selfupdater' => [
        'stage' => 'production'
    ],
    'twig' => [ // must be same as basename of resource loader
        'templates' => Path::join(__DIR__, 'resources', 'twig'),
        'cache' => Path::join(__DIR__, 'storage', 'twig')
    ],
    'twig/img' => [
        'images' => "/img/"
    ]
];