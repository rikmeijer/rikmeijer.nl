<?php declare(strict_types=1);

namespace rikmeijer\nl\selfupdater\build;

use function rikmeijer\nl\parsedown;
use function rikmeijer\nl\twig;

return static function (string $title, string $post) : string {
    return twig('blog/post.twig', [
        'title' => $title,
        'content' => parsedown(file_get_contents($post))
    ]);
};