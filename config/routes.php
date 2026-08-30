<?php
if (!defined('BLUMIGA')) exit;

// Página Inicial
routeGET('/', 'home@index', 'home');

// Documentação
routeGROUP('/doc', '', function () {
    routeGET('/', 'doc@index', 'doc.index');
    routeGET('/instalacao', 'doc@instalacao', 'doc.instalacao');
    routeGET('/rotas', 'doc@rotas', 'doc.rotas');
    routeGET('/controllers', 'doc@controllers', 'doc.controllers');
    routeGET('/views', 'doc@views', 'doc.views');
    routeGET('/models', 'doc@models', 'doc.models');
    routeGET('/middleware', 'doc@middleware', 'doc.middleware');
    routeGET('/helpers', 'doc@helpers', 'doc.helpers');
    routeGET('/cli', 'doc@cli', 'doc.cli');
    routeGET('/seguranca', 'doc@seguranca', 'doc.seguranca');
}, ['log@run']);

// Página 404
route404(function () {
    view('errors/404');
});
