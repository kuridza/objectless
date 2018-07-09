<?php

class Container {
    protected $s = [];
    protected $o = [];
    protected $p = [];

    function __set($k, $c) {
        if(is_callable($c)) {
            $this->s[$k] = $c;
        } else {
            $this->p[$k] = $c;
        }
    }

    function __get($k) {
        if(isset($this->o[$k])) {
            return $this->o[$k];
        }
        if(isset($this->s[$k]) && is_callable($this->s[$k])) {
            $o = $this->s[$k]($this);
            $this->o[$k] = $o;
            return $o;
        }
        return $this->p[$k];
    }
}

$c = new Container;

class a {}
class aa {}
class b {
    function __construct(a $a, aa $aa){ echo PHP_EOL . 'b constructor' . PHP_EOL; }
}

$c->b = function($c) { return new b(new a, new aa); };

$c->d = 'd';

echo '<pre>';
$c->b;
$c->b;
$c->b;
$c->b;
var_dump($c);die();
