<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_control_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/ControlModel');
    }

    public function insertControl($request) {
        try {
            $cvm = new ControlModel();
            $datos = $cvm->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
