<?php

use Symfony\Component\DependencyInjection;

include __DIR__ . '/../vendor/autoload.php';

class a
{
    private $b;

    public function __construct(b $b)
    {
        echo PHP_EOL . 'a constructor'. PHP_EOL;
        $this->b = $b;
    }

}

class b {}

$c = new DependencyInjection\ContainerBuilder();

$c->register('b', 'b');
$c->register('a', 'a')->addArgument(new DependencyInjection\Reference('b'));

$c->get('a');
$c->get('a');
$c->get('a');
$c->get('a');

echo '<pre>';
var_dump($c->get('a'));

$c->compile();
$dumper = new DependencyInjection\Dumper\PhpDumper($c);
file_put_contents('cache', $dumper->dump());
