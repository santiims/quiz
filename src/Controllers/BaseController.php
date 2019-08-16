<?php


namespace Quiz\Controllers;


use Quiz\View;

abstract class BaseController
{

    protected $template = 'default';

    protected $input;

    public function __construct()
    {
        $this->input = $_POST ?? [];
    }

    protected function view(string $viewName, array $params = []): string
    {
        $view = $this->getView($viewName);

        return $view->render($params);
    }

    protected function getView(string $viewName): View
    {
        return new View($viewName, $this->template);
    }
}