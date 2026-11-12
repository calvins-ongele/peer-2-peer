<?php
class Games extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index($url = null)
    { 
        if ($url) {
            if (Session::get('userid') !== null) {
                //CustomFunctions::locate("/user/games/{$url}");die;
            }
            $this->view->game = $this->model->gameDetails($url);  
            if (empty($this->view->game) || empty($this->view->game['game']) ) return $this->notFound();

            $title = $this->view->game['title'] ?? $this->view->game['game']['title'] ?? 'Games';
            $this->view->title = $title; 
            $this->view->render("games/view-details"); 
            return;
        }
        $this->view->title = "Games";
        $this->view->render("games/index");
    }
    public function start()
    { 
        $this->view->title = "Create a Game";
        $this->view->render("games/start");
    }






}
