<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

return function (): Closure {
    $twig = $this->resource('twig');
    $posts = $this->resource('selfupdater/build/posts');
    return function(string $to) use ($twig, $posts) : void {
        file_put_contents($to . DIRECTORY_SEPARATOR . 'index.html',
            $twig('index.twig', ['posts' => $posts($to)]));
    };
};