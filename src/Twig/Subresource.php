<?php declare(strict_types=1);
namespace rikmeijer\rikmeijernl\Twig;

use Webmozart\PathUtil\Path;

class Subresource
{
    private array $configuration;

    public function __construct(array $configuration)
    {
        $configurationDefaults = [
            'integrity-hashes' => []
        ];
        $this->configuration = array_merge($configurationDefaults, $configuration);
    }

    public function __invoke(string $url) : string
    {
        $attributes = [''];
        if (Path::isLocal($url) === false) {
            $attributes[] = 'crossorigin="anonymous"';
        }

        if (array_key_exists($url, $this->configuration['integrity-hashes'])) {
            $attributes[] = 'integrity="' . htmlentities($this->configuration['integrity-hashes'][$url]) . '"';
        }

        switch (Path::getExtension($url)) {
            case 'css':
                return '<link href="' . htmlentities($url) . '" rel="stylesheet"' . implode(' ', $attributes) . '>';

            case 'js':
                return '<script src="' . htmlentities($url) . '"' . implode(' ', $attributes) . '></script>';

            case 'pgp':
                return '<link href="' . htmlentities($url) . '" rel="pgpkey">';

            default:
                return '';
        }
    }
}