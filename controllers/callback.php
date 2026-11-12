<?php
class Callback extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {

        $this->view->title = "Callback";
        $this->view->render("callback/index");
    }

    public function paypaldepositfeedback() { $this->model->paypaldepositfeedback(); }
    public function mpesadepositfeedback() { $this->model->mpesadepositfeedback(); }
    public function mpesawithdrawalfeedback() { $this->model->mpesawithdrawalfeedback(); }




}
