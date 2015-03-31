<?php

require __DIR__.'/vendor/autoload.php';

use Bfeaver\AwsHelper\Command\S3SignedUrlCommand;
use Symfony\Component\Console\Application;

date_default_timezone_set('UTC');

$application = new Application();
$application->add(new S3SignedUrlCommand());
$application->run();
