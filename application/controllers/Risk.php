<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Risk extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_risk_model');
    }

    public function insertRisk() {
        $vm = new Dao_risk_model();
        $response = $vm->insertRisk($this->request);
        $this->json($response);
    }

    public function getALLRisks() {
        //Se comprueba si no hay sesión.
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }

        $response = null;
        if (Auth::check()) {
            $dao = new Dao_risk_model();
            $res = $dao->getAll();
            $this->json($res);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function insertRiskFull() {
        $dao = new Dao_risk_model();
        $response = $dao->insertRiskFull($this->request);
        $this->json($response);
    }

    public function updateRiskFull() {
        $dao = new Dao_risk_model();
        $response = $dao->updateRiskFull($this->request);
        $this->json($response);
    }

}
