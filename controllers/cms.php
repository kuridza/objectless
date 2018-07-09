<?php
namespace cms;

use Doctrine\ORM\EntityManager;

function index(EntityManager $em)
{
    $p = new \Product();
    $p->name = md5(uniqid());
    $em->persist($p);
    //$em->flush();
    _dump($em->getRepository('Product')->findAll());
}

function _warmup(){}
