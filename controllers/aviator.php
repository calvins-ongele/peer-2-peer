<?php
class Aviator extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $this->view->title = "AVIATOR | Crash Game";
        $this->view->render("aviator/index");
    }
}
