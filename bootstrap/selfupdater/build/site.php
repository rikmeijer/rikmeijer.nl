<?php declare(strict_types=1);

namespace rikmeijer\nl\selfupdater\build;

use function rikmeijer\nl\twig;

return static function (string $to) : void {
    file_put_contents($to . DIRECTORY_SEPARATOR . 'index.html', twig('index.twig', ['posts' => posts($to)]));
};