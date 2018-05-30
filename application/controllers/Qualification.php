<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Qualification extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_calificacion_model');
    }

    public function insertQualification() {
        $dao = new Dao_calificacion_model();
        $response = $dao->insertQualification($this->request);
        $this->json($response);
    }

    public function updateQualification() {
        $dao = new Dao_calificacion_model();
        $response = $dao->updateQualification($this->request);
        $this->json($response);
    }
    
}
