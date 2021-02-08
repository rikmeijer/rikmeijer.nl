<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

return function (array $configuration): Closure {
    return function(string $composerCommand) use ($configuration) : void {
        exec( $composerCommand . '  --no-dev');
    };
};
