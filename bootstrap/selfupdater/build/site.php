<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

use rikmeijer\Bootstrap\Dependency;

return
    #[Dependency(twig: "twig", posts : "selfupdater/build/posts")]
    function (Closure $twig, Closure $posts): Closure {
        return function(string $to) use ($twig, $posts) : void {
            file_put_contents($to . DIRECTORY_SEPARATOR . 'index.html',
                $twig('index.twig', ['posts' => $posts($to)]));
    };
};