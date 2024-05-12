<?php

class IndexController
{
    private $view;

    public function __construct()
    {
        $this->view = new View();
    }

    public function index()
    {
        $this->view->view('weather.php');
    }
}
