<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

return static function (string $post, string $to, callable $posts) use ($bootstrap): void {
    list($dateUnparsed, $title) = explode('-', basename($post, '.md'), 2);
    $date = DateTime::createFromFormat('Ymd', $dateUnparsed);

    $uri = '/blog/' . $date->format('Y/m/d/') . $title . '.html';

    $htmlFile = Path::join($to, $uri);
    $bootstrap("selfupdater/directory", dirname($htmlFile));
    file_put_contents($htmlFile, $bootstrap("selfupdater/build/md2html", $title, $post));

    $posts($uri, [
        'title' => $title,
        'intro' => ""
    ]);
};