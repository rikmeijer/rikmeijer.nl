<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

return static function (string $title, string $post) use ($bootstrap): string {
    return $bootstrap('twig', 'blog/post.twig', [
        'title' => $title,
        'content' => $bootstrap('parsedown', file_get_contents($post))
    ]);
};