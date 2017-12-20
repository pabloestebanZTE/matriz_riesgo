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

    public function getAllControlsAssigned() {
        try {
            $db = new DB();
            $datos = $db->select("SELECT co.*, count(coe.k_id_control) k_control_asinado
                                FROM control co
                                LEFT JOIN control_especifico coe ON coe.k_id_control = co.k_id_control
                                GROUP BY coe.k_id_control")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function findById($id) {
        try {
            $user = new UserModel();
            $datos = $user->where("k_id_control", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
