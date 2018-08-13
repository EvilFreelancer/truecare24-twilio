<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

class Call
{
    public $view;

    public function __construct()
    {
        $this->view = new \Slim\Views\PhpRenderer(__DIR__ . '/../Views/');
    }

    public function index(Request $request, Response $response, array $args)
    {
        return $this->view->render($response, 'myTemplate.html');
    }
}
