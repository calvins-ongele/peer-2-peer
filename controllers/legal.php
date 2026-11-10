<?php
 

class Legal extends Controller {

    function __construct() {
        parent::__construct();
    }

    public function index($pid = '') {  
          $this->view->pid = $pid;
		  $this->view->title =  'Legal';
		  $this->view->render('legal/index');
    }
     
    public function faq($pid = '') {   
		  $this->view->title =  'Frequently Asked Questions';
		  $this->view->render('legal/faq');
    }
      
    















    //////////////////////////////////////////////////

}
