<?php


namespace Quiz;


class Route
{

    private $controllerName;

    private $functionName;

    public function __construct(string $controllerName, string $functionName = 'index')
    {
        $this->controllerName = $controllerName;
        $this->functionName = $functionName;
    }

    public function handle()
    {
        $controller = new $this->controllerName;
        $response = call_user_func([$controller, $this->functionName]);

        echo $response;
    }
}