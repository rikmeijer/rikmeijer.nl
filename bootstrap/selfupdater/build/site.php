<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

return static function (string $to) use ($bootstrap): void {
    file_put_contents($to . DIRECTORY_SEPARATOR . 'index.html', $bootstrap("twig", 'index.twig', ['posts' => $bootstrap("selfupdater/build/posts", $to)]));
};