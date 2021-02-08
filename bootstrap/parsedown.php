<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

return function (): Closure {
    $parsedown = new Parsedown();
    return function(string $markdown) use ($parsedown) : string {
        return $parsedown->parse($markdown);
    };
};