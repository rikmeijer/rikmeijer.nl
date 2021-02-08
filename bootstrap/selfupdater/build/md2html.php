<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

return function (): Closure {
    $parsedown = $this->resource('parsedown');
    $twig = $this->resource('twig');
    return function(string $title, string $post) use ($parsedown, $twig) : string {
        return $twig('blog/post.twig', [
            'title' => $title,
            'content' => $parsedown(file_get_contents($post))
        ]);
    };
};