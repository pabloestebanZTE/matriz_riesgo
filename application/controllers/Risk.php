<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Risk extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_risk_model');
    }

    public function insertRisk() {
        $dao = new Dao_risk_model();
        $response = $dao->insertRisk($this->request);
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
            $res = $dao->getAll($this->request);
            $this->json($res);
        } else {
            $response = new Response(EMessages::NOT_ALLOWED);
        }
    }

    public function getListMatricesByRisk() {
        //Se comprueba si no hay sesión.
        if (!Auth::check()) {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
            return;
        }

        $response = null;
        if (Auth::check()) {
            $dao = new Dao_risk_model();
            $res = $dao->getListMatrizByRisk($this->request);
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

    public function findRiskById() {
        $id = $this->request->idRiesgo;
        $dao = new Dao_risk_model();
        $response = $dao->findByIdUnic($id);
        $answer['riesgo'] = json_encode($response->data);
        //Consultamos las plataformas...
        $plataformaModel = new PlataformaModel();
        $data = $plataformaModel->get();
        $answer['plataformas'] = json_encode($data);
        $this->load->view('riskView', $answer);
    }

    public function duplicarRiesgo() {
        $v = strpos($this->request->url, "duplicarRiesgo") != false;
        $id = $this->request->idRiesgo;
        $dao = new Dao_risk_model();
        $response = $dao->findByIdUnic($id);
        $answer['riesgo'] = json_encode($response->data);
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
            $consecutivo = "R" . ($count->count + 1);
            $answer["consecutivo"] = $consecutivo;
        }
        $this->load->view('riskView', $answer);
    }

    public function listAllRisk() {
        $dao = new Dao_risk_model();
        $response = $dao->listAllRisk($this->request);
        $this->json($response);
    }

    public function getListRisk() {
        $dao = new Dao_risk_model();
        $response = $dao->getListRisk($this->request);
        $this->json($response);
    }

    public function getRiskById() {
        $dao = new Dao_risk_model();
        $response = $dao->getRiskById($this->request);
        $this->json($response);
    }

    public function updateGeneralRisk() {
        $dao = new Dao_risk_model();
        $response = $dao->updateGeneralRisk($this->request);
        $this->json($response);
    }

    public function getRiskAssociatedControl() {
        $dao = new Dao_risk_model();
        $response = $dao->getRiskAssociatedControl($this->request);
        $this->json($response);
    }

    public function getRiskByIdPlataform() {
        $dao = new Dao_risk_model();
        $resposne = $dao->getRiskByIdPlataform($this->request);
        $this->json($resposne);
    }

    public function listRiskByIdPlataform() {
        $dao = new Dao_risk_model();
        $resposne = $dao->listRiskByIdPlataform($this->request->id);
        $this->json($resposne);
    }

    public function insertPlataform() {
        $dao = new Dao_risk_model();
        $response = $dao->insertPlataform($this->request);
        $this->json($response);
    }

    public function updatePlataform() {
        $dao = new Dao_risk_model();
        $response = $dao->updatePlataform($this->request);
        $this->json($response);
    }

    public function listPlataforms() {
        $dao = new Dao_risk_model();
        $response = $dao->listPlataforms();
        $this->json($response);
    }

    public function insertTratamiento() {
        $dao = new Dao_risk_model();
        $response = $dao->insertTratamiento($this->request);
        $this->json($response);
    }

    public function updateTratamiento() {
        $dao = new Dao_risk_model();
        $response = $dao->updateTratamiento($this->request);
        $this->json($response);
    }

    public function getListTratamientoByMatriz() {
        $dao = new Dao_risk_model();
        $response = $dao->getListTratamientosByIdMatriz($this->request);
        $this->json($response);
    }

}
