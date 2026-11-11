<?php
class User extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index() { 
        $this->view->title = "User";
        $this->view->render("user/index");
    }
    public function balance() { 
        $this->view->title = "Balance";
        $this->view->render("user/balance");
    }
    public function game() { 
        $this->view->title = "Games";
        $this->view->render("user/game-details");
    }











}
