<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Control extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_control_model');
    }

    public function insertControl() {
        $vm = new Dao_control_model();
        $response = $vm->insertControl($this->request);
        $this->json($response);
    }

    public function getALLControls() {
        //Se comprueba si no hay sesión.
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }

        $response = null;
        if (Auth::check()) {
            $dao = new Dao_control_model();
            $res = $dao->getAllControlsAssigned();
            $this->json($res);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function updateControl() {
        $vm = new Dao_control_model();
        $response = $vm->updateControl($this->request);
        $this->json($response);
    }

    public function findControlById() {
        $id = $this->request->idControl;
        $vm = new Dao_control_model();
        $response = $vm->findById($id);
        $answer['control'] = json_encode($response->data);
        $this->load->view('controlsView', $answer);
    }
    
    public function qualificationControl() {
        $id = $this->request->idControlEsp;
        $vm = new Dao_control_model();
        $response = $vm->findSpecificControlById($id);
        $answer['control'] = json_encode($response->data);
        $this->load->view('qualificationControlsView', $answer);
    }

}
