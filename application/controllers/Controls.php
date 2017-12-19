<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Controls extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_control_model');
    }

    public function insertControl() {
        $vm = new Dao_control_model();
        $response = $vm->insertControl($this->request);
        $this->json($response);
    }
    
    
}
