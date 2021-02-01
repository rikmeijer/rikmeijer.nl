<?php declare(strict_types=1);
return [
    'twig' => [ // must be same as basename of resource loader
        'templates' => __DIR__ . DIRECTORY_SEPARATOR . 'resources' . DIRECTORY_SEPARATOR . 'twig',
        'cache' => __DIR__ . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'twig'
    ]
];