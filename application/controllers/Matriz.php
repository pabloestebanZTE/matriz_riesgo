<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Matriz extends CI_Controller {

    function __construct() {
        parent::__construct();
        if (!Auth::check()) {
            Redirect::to(URL::base());
        }
    }

    private function validUser($request) {
        return Auth::attempt([
                    "n_nombre_usuario" => $request->username,
                    "n_password" => $request->password,
                    "OR" => [
                        "n_username_usuario" => $request->username
                    ]
        ]);
    }

    public function loginUser() {
        if (!Auth::check()) {
            $res = $this->validUser($this->request);
        } else {
            $res = true;
        }
        //Comprobamos si el Auth ha encontrado válida las credenciales consultadas...
        if ($res) {
            Redirect::redirect(URL::to("Matriz/generalRisksMatrixView"));
        } else {
            $answer['error'] = "error";
            $this->load->view('login', $answer);
        }
    }

    public function logout() {
        Auth::logout();
        Redirect::to(URL::to("welcome/index"));
    }

    public function comprobarSesion() {
        //Comprobar si existe una sesión...
        if (Auth::check()) {
            $this->json(new Response(EMessages::SESSION_ACTIVE));
        } else {
            $this->json(new Response(EMessages::SESSION_INACTIVE));
        }
    }

    public function controlsView() {
        $this->load->view('controlsView');
    }

    public function generalControlsView() {
        $this->load->view('generalControlsView');
    }

    public function riskView() {
        $this->load->view('riskView');
    }

    public function generalRisksMatrixView() {
        $this->load->view('generalRisksMatrixView');
    }

    public function grid() {
        $this->load->view('grid');
    }

    public function riskMatrixView() {
        //Consultamos la información de los select...
        $dataForm = [];
        if ($this->request->id) {
            //Consultamos el registro...
            $dao = new Dao_risk_model();
            $response = $dao->getRiskById($this->request);
            $dataForm["record"] = $response->data;
            //Consultamos la lista de tipo evento2...
            $dao = new Dao_combox_model();
            if ($dataForm["record"]) {
                $dataForm["tipo_evento2"] = $dao->getListComboxTipoEventoNvl2ById($dataForm["record"]["riesgo_especifico"]->k_id_tipo_evento_2)->data;
            }
        }
        $dao = new Dao_combox_model();
        $dataForm["riesgos"] = $dao->getListComboxById(1)->data;
        $dataForm["factoresriesgo"] = $dao->getListComboxById(2)->data;
        $dataForm["probabilidad"] = $dao->getListComboxById(3)->data;
        $dataForm["impacto"] = $dao->getListComboxById(4)->data;
        $dataForm["plataforma"] = $dao->getListComboxById(5)->data;
        $dataForm["listcontrols"] = $dao->getListComboxById(6)->data;
        $dataForm["tipo_evento1"] = $dao->getListComboxById(7)->data;
        $this->load->view('riskMatrixView', ["dataForm" => $dataForm]);
    }

    public function generalRisksView() {
        $this->load->view('generalRisksView');
    }

    public function qualificationControlsView() {
        $this->load->view('qualificationControlsView');
    }

    public function gridView() {
        $this->load->view('gridView');
    }

}
?>

