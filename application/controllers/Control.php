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
            $res = $dao->getAllControlsAssigned($this->request);
            $this->json($res);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function updateControl() {
        $vm = new Dao_control_model();
        $response = $vm->updateControl($this->request);
        // $this->json($response);
        header('Location: '. URL::to("Matriz/generalControlsView"));
    }

    public function findControlById() {
        $id = $this->request->idControl;
        $vm = new Dao_control_model();
        $response = $vm->findById($id);
        $answer['control'] = json_encode($response->data);
        //Consultamos las plataformas...
        $plataformaModel = new PlataformaModel();
        $data = $plataformaModel->get();
        $answer['plataformas'] = json_encode($data);
        $this->load->view('controlsView', $answer);
    }

    public function duplicarControl() {
        $v = strpos($this->request->url, "duplicarControl") != false;
        $id = $this->request->idControl;
        $vm = new Dao_control_model();
        $response = $vm->findByIdUnic($id);
        $answer['control'] = json_encode($response->data);
        //Consultamos las plataformas...
        $plataformaModel = new PlataformaModel();
        $data = $plataformaModel->get();
        $answer['plataformas'] = json_encode($data);
        if ($v) {
            $answer["duplicar"] = true;
        }
        $c = strpos($this->request->url, "controlsView") != false;
        if ($v || $c) {
            //Consultamos el consecutivo...
            $count = (new DB())
                    ->select("select count(k_id) as count from control where k_id_plataforma = "
                            . $response->data->k_id_plataforma)
                    ->first();
            $consecutivo = "C" . ($count->count + 1);
            $answer["consecutivo"] = $consecutivo;
        }
        $this->load->view('controlsView', $answer);
    }

    public function qualificationControl() {
        $dao = new Dao_risk_model();
        $dao->getControlEspecifico($this->request);
    }

}
