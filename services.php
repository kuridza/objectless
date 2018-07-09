<?php

$c['LeagueCsvReader'] = function($c) {
    return \League\Csv\Reader::createFromPath($c['Config']->get('csv'))
        ->setDelimiter(';');
};

class Menu extends DataWrapper {}

$c['Menu'] = function($c) {
    $data = iterator_to_array($c['LeagueCsvReader']->fetchColumn(0), false);
    return new Menu($data);
};

$c['DoctrineORMEntityManager'] = function($c) {
    return \Doctrine\ORM\EntityManager::create([
        'driver' => 'pdo_sqlite',
        'path' => __DIR__ . '/db.sqlite',
    ], \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration([__DIR__ . '/e'], true));
};

$c['LeaguePlatesEngine'] = function($c) {
    return new \League\Plates\Engine(__DIR__ . '/templates');
};
