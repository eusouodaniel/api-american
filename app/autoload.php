<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/** @var ClassLoader $loader */
$loader = require __DIR__.'/../vendor/autoload.php';

$loader->add('Vindi_', __DIR__.'/../vendor/vindi/vindi-php/src');
set_include_path(__DIR__.'/../vendor/vindi/vindi-php/src'.PATH_SEPARATOR.get_include_path());

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

return $loader;
