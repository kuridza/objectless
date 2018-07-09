<?php

include __DIR__ . '/../vendor/autoload.php';

$c = new \Pimple\Container();

class a {
    function __construct(){ echo PHP_EOL . 'a constructor' . PHP_EOL; }
}

$c['a'] = function() { return new a; };

$c['r'] = $c->protect(function () {
    return rand();
});

$c->extend('a', function($s, $c) {
    $s->foo = 'bar';
    return $s;
});

echo '<pre>';

$c['a'];
$c['a'];
$c['a'];
$c['a'];

var_dump($c['a']);
