<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

namespace rikmeijer\nl\selfupdater\build;

use rikmeijer\Bootstrap\Configuration;

$configuration = \rikmeijer\nl\selfupdater\build\posts\validate([
    'from' => Configuration::path('storage', 'sabre', 'files', 'blog')
]);

return static function (string $to) use ($configuration): array {
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
};