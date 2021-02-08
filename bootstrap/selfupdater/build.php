<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use Webmozart\PathUtil\Path;

return function (array $configuration): Closure {
    return function () use ($configuration) {
        print 'Opening blogs in ' . $configuration['from'];

        $parsedown = $this->resource('parsedown');

        $twig = $this->resource('twig');
        $createDirectory = $this->resource('selfupdater/directory');
        $posts = [];
        foreach (glob($configuration['from'] . DIRECTORY_SEPARATOR . 'blog' . DIRECTORY_SEPARATOR . '*.md') as $post) {
            print PHP_EOL . 'Parsing ' . basename($post) . '...';
            list($dateUnparsed, $title) = explode('-', basename($post, '.md'), 2);
            $date = DateTime::createFromFormat('Ymd', $dateUnparsed);

            $uri = '/blog/' . $date->format('Y/m/d/') . $title . '.html';

            $htmlFile = Path::join($configuration['to'], $uri);
            $createDirectory(dirname($htmlFile));
            file_put_contents($htmlFile,
                $twig->render('blog/post.twig', ['title' => $title, 'content' => $parsedown(file_get_contents($post))]));

            $posts[$uri] = [
                'title' => $title,
                'intro' => ""
            ];
        }

        print PHP_EOL . 'Generating index...';
        file_put_contents($configuration['to'] . DIRECTORY_SEPARATOR . 'index.html', $twig->render('index.twig', ['posts' => $posts]));
        print PHP_EOL . 'done';

        print PHP_EOL . 'Generating CSS...';
        $customCSSFile = Path::join($configuration['to'], 'css', 'custom.css');
        $createDirectory(dirname($customCSSFile));
        passthru($configuration['sass-binary'] . ' ' . escapeshellarg($configuration['custom-scss']) . ' ' . escapeshellarg($customCSSFile));
        echo 'done';
    };
};