<?php

require __DIR__ . '/index.php';

$em = $c['DoctrineORMEntityManager'];
return \Doctrine\ORM\Tools\Console\ConsoleRunner::createHelperSet($em);
