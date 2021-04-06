<?php
declare(strict_types=1);

namespace rikmeijer\nl\selfupdater\build;

use function rikmeijer\Bootstrap\configure;
use function rikmeijer\Bootstrap\types\path;

return configure(static function (array  $configuration, string $to) : array {
    print PHP_EOL . 'Opening blogs in ' . $configuration['from'];
    $posts = [];
    foreach (glob($configuration['from'] . DIRECTORY_SEPARATOR . '*.md') as $post) {
        print PHP_EOL . 'Parsing `' . basename($post) . '`...';
        post($post, $to, function (string $uri, array $post) use (&$posts) {
            $posts[$uri] = $post;
        });
        print 'done';
    }
    return $posts;
}, [
    'from' => path('storage/sabre/files/blog')
]);