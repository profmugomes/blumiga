<?php
// Controller: Home
// Gerado pelo Blumiga CLI e customizado

namespace Blumiga\controllers\home;

function index(): void
{
    view('home', [
        'titulo' => 'BluMiga — Microframework MVC para PHP',
        'currentPage' => '/'
    ], 'layout');
}
