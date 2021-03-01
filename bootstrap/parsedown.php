<?php declare(strict_types=1);

namespace rikmeijer\nl;

use Parsedown;

return static function (string $markdown) : string {
    $parsedown = new Parsedown();
    return $parsedown->parse($markdown);
};