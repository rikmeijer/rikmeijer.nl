<?php /** @noinspection PhpUndefinedVariableInspection */
declare(strict_types=1);

return function (string $markdown) : string {
    $parsedown = new Parsedown();
    return $parsedown->parse($markdown);
};