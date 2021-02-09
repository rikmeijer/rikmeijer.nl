<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;
use rikmeijer\Bootstrap\Dependency;

return
    #[Dependency(md2html: "selfupdater/build/md2html", createDirectory : "selfupdater/directory")]
    function (Closure $md2html, Closure $createDirectory): Closure {
    return function(string $post, string $to, callable $posts) use ($md2html, $createDirectory) : void {
        list($dateUnparsed, $title) = explode('-', basename($post, '.md'), 2);
        $date = DateTime::createFromFormat('Ymd', $dateUnparsed);

        $uri = '/blog/' . $date->format('Y/m/d/') . $title . '.html';

        $htmlFile = Path::join($to, $uri);
        $createDirectory(dirname($htmlFile));
        file_put_contents($htmlFile, $md2html($title, $post));

        $posts($uri, [
            'title' => $title,
            'intro' => ""
        ]);
    };
};