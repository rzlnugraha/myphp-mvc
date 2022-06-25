<?php

class App
{
    protected $controller = 'Home';
    protected $method = 'index';
    protected $params = [];

    public function __construct()
    {
        $url = $this->parseURL();

        // controler versi baru
        if ($url == null) {
            $url = [$this->controller];
        }

        if (file_exists('../app/controllers/' . ucwords($url[0]) . '.php')) {
            $this->controller = ucwords($url[0]);
        }


        require_once '../app/controllers/' . $this->controller . '.php';

        // Method
        if (isset($url[1])) {
            if (method_exists($this->controller, $url[1])) {
                $this->method = $url[1];
            }
        }

        // params
        if (!empty($url)) {
            if (count($url) > 2) {
                for ($i = 2; $i < count($url); $i++) {
                    $this->params[] = $url[$i];
                }
            }
        }

        // jalankan controller & method, serta kirimlan params jika ada
        call_user_func_array([new $this->controller, $this->method], $this->params);
    }

    public function parseURL()
    {
        if (isset($_SERVER['REQUEST_URI'])) {
            $url = substr($_SERVER['REQUEST_URI'], 1);
            $url = trim($url);
            $url = filter_var($url, FILTER_SANITIZE_URL);
            $url = explode('/', $url);

            return $url;
        }
    }
}
