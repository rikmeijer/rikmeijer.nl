<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Dependency;

return
    #[Dependency(twig: "twig", parsedown : "parsedown")]
    function (Closure $twig, Closure $parsedown): Closure {
    return function(string $title, string $post) use ($parsedown, $twig) : string {
        return $twig('blog/post.twig', [
            'title' => $title,
            'content' => $parsedown(file_get_contents($post))
        ]);
    };
};