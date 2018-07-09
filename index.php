<?php

$uri = $_SERVER['REQUEST_URI'];
extract(parse_url($uri));
$path = trim($path, '/');
$path = explode('/', $path);
$method = $_SERVER['REQUEST_METHOD'];

$cnt = implode('/', $path);
$params = [];

while($cnt) {
    if(file_exists(__DIR__ . '/controllers/' . $cnt . '.php')) {
        include __DIR__ . '/controllers/' . $cnt . '.php';
        break;
    }
    if(isset($f)) $params[] = $f;
    $f = array_pop($path);
    $cnt = implode('/', $path);
}

if(! $cnt) {
    include __DIR__ . '/controllers/default.php';
}
$cnt = str_replace('/', '\\', $cnt);
if(! isset($f)) $f = '';

$GLOBALS['action'] = $f;
if(! function_exists($cnt . '\\' . $f)) {
    $params[] = $f;
    $f = $cnt .  '\\' . 'index';
} else {
    $f = $cnt . '\\' . $f;
}

$GLOBALS['cnt'] = $cnt;
$GLOBALS['f'] = $f;
$GLOBALS['params'] = $params;

include __DIR__ . '/vendor/autoload.php';

$c = new \Pimple\Container();

class DataWrapper {
    public $data = [];
    function __construct($data) {$this->data = $data;}
    function get($key, $default = null){return $this->data[$key] ?? $default;}
}
class Config extends DataWrapper {}

$c['Config'] = function($c) {
    $data = require __DIR__ . '/config.php';
    return new Config($data);
};

include __DIR__ . '/services.php';

foreach([$cnt . '\\' . '_warmup', $f] as $a) {
    $r = new ReflectionFunction($a);
    $args = [];
    foreach($r->getParameters() as $i => $p) {
        $requestParameter = _request($p->name);
        if($requestParameter !== null) {
            $args[] = $requestParameter;
            continue;
        }
        $type = (string) $p->getType();
        $type = str_replace('\\', '', $type);
        $args[] = $type ? $c[$type] : array_pop($params);
    }
    $data = call_user_func_array($a, $args);
    if(is_array($data)) extract($data);
}
extract($_REQUEST);

if(isset($layout)) {
    $templates = new \League\Plates\Engine(__DIR__ . '/templates');
    echo $templates->render($template, $GLOBALS);
}

function _redirect($l = '/')
{
    header('Location: ' . $l); die();
}

function _json($d)
{
    echo json_encode($d); die();
}

function _dump($d)
{
    echo '<pre>';
    var_dump($d);
    echo '</pre>';
}

function _request($key, $default = null)
{
    return $_REQUEST[$key] ?? $default;
}
