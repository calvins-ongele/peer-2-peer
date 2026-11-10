<?php
class Games extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    { 
        $this->view->title = "Games";
        $this->view->render("games/index");
    }
    public function start()
    { 
        $this->view->title = "Create a Game";
        $this->view->render("games/start");
    }






}
