<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Dependency;

return
    #[Dependency(buildPost: "selfupdater/build/post")]
    function (array $configuration, Closure $buildPost): Closure {
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