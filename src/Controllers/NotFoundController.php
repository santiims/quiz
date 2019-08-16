<?php


namespace Quiz\Controllers;


class NotFoundController
{
    public function index()
    {
        header('HTTP/1.1 404 Not Found');
        echo '<h1>404: Page not found</h1>';
        die;
    }
}