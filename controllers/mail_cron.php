<?php
class Mail_cron extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    { 
        $this->model->run();
    }
}
