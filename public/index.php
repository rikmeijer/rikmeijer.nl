<?php

$bootstrap = require dirname(__DIR__) . DIRECTORY_SEPARATOR . 'bootstrap.php';
$twig = $bootstrap->resource('twig');
$template = $twig->load('index.twig');
print $template->render();