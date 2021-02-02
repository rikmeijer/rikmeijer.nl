<?php /** @noinspection StaticClosureCanBeUsedInspection */
declare(strict_types=1);

return function (array $configuration): Closure {
    return function(string $workingDir) use ($configuration) {
        chdir($workingDir);
        switch ($configuration['stage']) {
            case 'production':
                exec('composer install --no-dev');
                break;

            case 'testing':
            case 'development':
                exec('composer install');
                break;
        }
    };
};