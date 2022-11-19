<?php

class App
{
    private $controller = 'Home';
    private $method = 'index';
    private $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        if (is_null($url)) {
            $url = [$this->controller];
        }

        $urlController = ucfirst($url[0]);
        if (file_exists('../app/controllers/' . $urlController . '.php')) {
            $this->controller = $urlController;
            unset($url[0]);
        }

        require_once '../app/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        if (isset($url[1])) {
            if (method_exists($this->controller, strtolower($url[1]))) {
                $this->method = strtolower($url[1]);
                unset($url[1]);
            }
        }

        if (!empty($url)) {
            $this->params = array_values($url);
        }

        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseURL()
    {
        if (isset($_GET['url'])) {
            $url = rtrim($_GET['url'], '/');
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
