<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

return function (array $configuration): Closure {
    $buildPost = $this->resource('selfupdater/build/post');
    return function(string $to) use ($configuration, $buildPost) : array {
        print PHP_EOL . 'Opening blogs in ' . $configuration['from'];
        $posts = [];
        foreach (glob($configuration['from'] . DIRECTORY_SEPARATOR . '*.md') as $post) {
            print PHP_EOL . 'Parsing `' . basename($post) . '`...';
            $buildPost($post, $to, function(string $uri, array $post) use (&$posts) {
                $posts[$uri] = $post;
            });
            print 'done';
        }
        return $posts;
    };
};