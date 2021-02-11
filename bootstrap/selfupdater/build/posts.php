<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

return static function (string $to) use ($configuration, $bootstrap): array {
    print PHP_EOL . 'Opening blogs in ' . $configuration['from'];
    $posts = [];
    foreach (glob($configuration['from'] . DIRECTORY_SEPARATOR . '*.md') as $post) {
        print PHP_EOL . 'Parsing `' . basename($post) . '`...';
        $bootstrap("selfupdater/build/post", $post, $to, function (string $uri, array $post) use (&$posts) {
            $posts[$uri] = $post;
        });
        print 'done';
    }
    return $posts;
};