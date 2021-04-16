<?php declare(strict_types=1);
namespace rikmeijer\nl{
    function __open(string $resourcePath) {
        $resourcePath = str_replace("\\", chr(47), $resourcePath);
        static $closures = [];
        if (!isset($closures[$resourcePath])) {
             $closures[$resourcePath] = require substr(__FILE__, 0, -4) . DIRECTORY_SEPARATOR . $resourcePath;
        }
        return $closures[$resourcePath];
    }
}namespace rikmeijer\nl { 
    if (function_exists("rikmeijer\nl\parsedown") === false) {
    function parsedown(string $markdown)
{
	return \rikmeijer\nl\__open('/parsedown.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl\selfupdater{
    function __open(string $resourcePath) {
        $resourcePath = str_replace("\\", chr(47), $resourcePath);
        static $closures = [];
        if (!isset($closures[$resourcePath])) {
             $closures[$resourcePath] = require substr(__FILE__, 0, -4) . DIRECTORY_SEPARATOR . $resourcePath;
        }
        return $closures[$resourcePath];
    }
}namespace rikmeijer\nl\selfupdater\build{
    function __open(string $resourcePath) {
        $resourcePath = str_replace("\\", chr(47), $resourcePath);
        static $closures = [];
        if (!isset($closures[$resourcePath])) {
             $closures[$resourcePath] = require substr(__FILE__, 0, -4) . DIRECTORY_SEPARATOR . $resourcePath;
        }
        return $closures[$resourcePath];
    }
}namespace rikmeijer\nl\selfupdater\build { 
    if (function_exists("rikmeijer\nl\selfupdater\build\md2html") === false) {
    function md2html(string $title, string $post)
{
	return \rikmeijer\nl\selfupdater\build\__open('\\selfupdater\\build/md2html.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl\selfupdater\build { 
    if (function_exists("rikmeijer\nl\selfupdater\build\post") === false) {
    function post(string $post, string $to, callable $posts)
{
	return \rikmeijer\nl\selfupdater\build\__open('\\selfupdater\\build/post.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl\selfupdater\build { 
    if (function_exists("rikmeijer\nl\selfupdater\build\posts") === false) {
    function posts(string $to)
{
	return \rikmeijer\nl\selfupdater\build\__open('\\selfupdater\\build/posts.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl\selfupdater\build { 
    if (function_exists("rikmeijer\nl\selfupdater\build\site") === false) {
    function site(string $to)
{
	return \rikmeijer\nl\selfupdater\build\__open('\\selfupdater\\build/site.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl\selfupdater { 
    if (function_exists("rikmeijer\nl\selfupdater\directory") === false) {
    function directory(string $directory)
{
	return \rikmeijer\nl\selfupdater\__open('\\selfupdater/directory.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl { 
    if (function_exists("rikmeijer\nl\selfupdater") === false) {
    function selfupdater(string $workingDir)
{
	return \rikmeijer\nl\__open('/selfupdater.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl\twig{
    function __open(string $resourcePath) {
        $resourcePath = str_replace("\\", chr(47), $resourcePath);
        static $closures = [];
        if (!isset($closures[$resourcePath])) {
             $closures[$resourcePath] = require substr(__FILE__, 0, -4) . DIRECTORY_SEPARATOR . $resourcePath;
        }
        return $closures[$resourcePath];
    }
}namespace rikmeijer\nl\twig { 
    if (function_exists("rikmeijer\nl\twig\img") === false) {
    function img(\Twig\Environment $twig)
{
	return \rikmeijer\nl\twig\__open('\\twig/img.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl\twig { 
    if (function_exists("rikmeijer\nl\twig\subresource") === false) {
    function subresource(\Twig\Environment $twig)
{
	return \rikmeijer\nl\twig\__open('\\twig/subresource.php')(...func_get_args());
}

    }
}namespace rikmeijer\nl { 
    if (function_exists("rikmeijer\nl\twig") === false) {
    function twig(string $name, array $context)
{
	return \rikmeijer\nl\__open('/twig.php')(...func_get_args());
}

    }
}