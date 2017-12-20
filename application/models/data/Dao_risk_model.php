<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_risk_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/RiesgoModel');
    }

    public function insertRisk($request) {
        try {
            $riesgo = new RiesgoModel();
            $datos = $riesgo->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getAll() {
        try {
            $user = new RiesgoModel();
            $datos = $user->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
