<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

namespace rikmeijer\nl\selfupdater\build;

use DateTime;
use Webmozart\PathUtil\Path;
use function rikmeijer\nl\selfupdater\directory;

return static function (string $post, string $to, callable $posts) : void {
    [
        $dateUnparsed,
        $title
    ] = explode('-', basename($post, '.md'), 2);
    $date = DateTime::createFromFormat('Ymd', $dateUnparsed);

    $uri = '/blog/' . $date->format('Y/m/d/') . $title . '.html';

    $htmlFile = Path::join($to, $uri);
    directory(dirname($htmlFile));
    file_put_contents($htmlFile, md2html($title, $post));

    $posts($uri, [
        'title' => $title,
        'intro' => ""
    ]);
};