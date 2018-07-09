<?php

function _warmup(Menu $menu)
{
    return [
        'template' => 'form',
        'title'    => $GLOBALS['action'],
        'menu'     => $menu->data,
        'layout'   => __DIR__ . '/../templates/layout.php',
        'post'     => ['', ''],
    ];
}

function index($title, \League\Csv\Reader $csv, Menu $menu)
{
    $file = __DIR__ . '/../templates/' . $title . '.php';
    if(file_exists($file)) {
        return loadTemplate($title);
    }
    $id = array_search($title, $menu->data);

    if($id === false) {
        $post = ['not found', '<p>sorry, this page doesn\'t exists</p>'];
    } else {
        $post = $csv->fetchOne($id);
    }

    if(_request('a') !== null) {
        _json($post);
    }

    return ['post' => $post, 'template' => 'post'];
}

function loadTemplate($title)
{
    return['template' => $title];
}

function edit(\League\Csv\Reader $csv, $id)
{
    return ['template' => 'add', 'post' => $csv->fetchOne((int) $id)];
}

function save($id = null, Config $config, $content, $title, $position)
{
    $posts = file($config->get('csv'));
    if($id !== null) unset($posts[$id]);
    array_splice($posts, $position, 0, urlencode($title) . ';' . str_replace(PHP_EOL, '<br>', $content) . PHP_EOL);
    file_put_contents($config->get('csv'), implode('', $posts));
    _redirect('/manage');
}

function delete($id, Config $config)
{
    $posts = file($config->get('csv'));
    unset($posts[$id]);
    file_put_contents($config->get('csv'), implode('', $posts));
    _redirect('/manage');
}
