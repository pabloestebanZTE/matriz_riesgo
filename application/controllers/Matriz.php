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
        //Consultamos las plataformas...
        $plataformaModel = new PlataformaModel();
        $data = $plataformaModel->get();
        $this->load->view('controlsView', ["plataformas" => json_encode($data)]);
    }

    public function generalControlsView() {
        $plataformaModel = new PlataformaModel();
        $data = $plataformaModel->get();
        $this->load->view('generalControlsView', ["plataformas" => json_encode($data)]);
    }

    public function riskView() {
        //Consultamos las plataformas...
        $plataformaModel = new PlataformaModel();
        $data = $plataformaModel->get();
        $this->load->view('riskView', ["plataformas" => json_encode($data)]);
    }

    public function generalRisksMatrixView() {
        $this->load->view('generalRisksMatrixView');
    }

    public function grid() {
        $this->load->view('grid');
    }

    public function riskMatrixView() {
        //Consultamos la información de los select...
        $dao = new Dao_risk_model();
        $this->load->view('riskMatrixView', ["dataForm" => json_encode($dao->getFormData($this->request))]);
    }

    public function generalRisksView() {
        //Consultamos las plataformas...
        $plataformaModel = new PlataformaModel();
        $data = $plataformaModel->get();
        $this->load->view('generalRisksView', ["plataformas" => json_encode($data)]);
    }

    public function gridView() {
        $this->load->view('gridView');
    }

    public function gridByPlataform() {
        $this->load->view('gridByPlataform');
    }

    public function adminPlataform() {
        $plataformModel = new PlataformaModel();
        $id = $this->request->id;
        $formData = null;
        if ($id) {
            $data = $plataformModel->where("k_id_plataforma", "=", $id)->first();
            $formData = json_encode($data);
        }        
        return $this->load->view('newPlataforma', ["formData" => $formData]);
//        $this->load->view('newPlataforma');
    }

    public function listPlataforms() {
        $this->load->view('listPlataforms');
    }

}
?>

