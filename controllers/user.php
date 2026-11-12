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
    public function balance($action = '') { 
        if ($action === 'withdraw') {
            $this->view->title = "Balance";
            $this->view->render("user/withdraw");
            return;
        }
        $this->view->title = "Balance";
        $this->view->render("user/balance");
    }
    public function games($url = null) { 
        $this->view->game = $this->model->gameDetails($url);
        //echo "<pre>";print_r($this->view->game);echo"</pre>";

        if (empty($this->view->game) || empty($this->view->game['game']) ) return $this->notFound();

        $title = $this->view->game['title'] ?? $this->view->game['game']['title'] ?? 'Games';
        $this->view->title = $title;
        $this->view->render("user/game-details");
    }











}
