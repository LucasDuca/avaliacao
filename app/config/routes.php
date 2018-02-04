<?php
use Phalcon\Mvc\Router;
$router = new Router(false);
$router->removeExtraSlashes(true);
$router->notFound(['controller' => 'Error', 'action' => 'error404']);
$router->add('/',       ['controller' => 'Index', 'action' => 'index'])->setName('site.inicio');


$router->add('/imoveis',                        ['controller' => 'Imovel', 'action' => 'listar'])       ->setName('site.imovel.listar');
$router->add('/imoveis/adicionar',              ['controller' => 'Imovel', 'action' => 'adicionar'])       ->setName('site.imovel.adicionar');
$router->add('/imoveis/editar',                 ['controller'=>'Imovel', 'action'=>'editar'])   ->setName('site.imovel.edit');
$router->add('/imoveis/visualizar',             ['controller'=>'Imovel', 'action'=>'visualizar'])   ->setName('site.imovel.visualizar');
$router->add('/imoveis/remover',                ['controller'=>'Imovel', 'action'=>'remover'])   ->setName('site.imovel.remover');
$router->add('/imoveis/validarCodigo',          ['controller'=>'Imovel', 'action'=>'validarCodigo'])   ->setName('site.imovel.validarCodigo');
$router->add('/imoveis/preencherEndereco',      ['controller'=>'Imovel', 'action'=>'preencherEndereco'])   ->setName('site.imovel.preencherEndereco');
$router->add('/imoveis/search',                 ['controller'=>'Imovel', 'action'=>'listar'])   ->setName('site.imovel.search');

return $router;