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
        $this->load->view('riskMatrixView');
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

