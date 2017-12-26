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
                                LEFT JOIN control_especifico coe ON co.k_id_control = coe.k_id_control
                                GROUP BY co.k_id_control")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function findById($id) {
        try {
            $cm = new ControlModel();
            $datos = $cm->where("k_id_control", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function updateControl($request) {
        try {
            $cm = new ControlModel();
            $datos = $cm->where("k_id_control", "=", $request->k_id_control)
                    ->update($request->all());
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }
    
    public function findSpecificControlById($id) {
        try {
            $db = new DB();
            $datos = $db->select("SELECT ce.k_id_control_especifico, co.k_id_control, co.n_descripcion, ca.*
                                FROM control_especifico ce
                                INNER JOIN control co ON co.k_id_control = ce.k_id_control
                                LEFT JOIN calificacion ca ON ca.k_id_calificacion = ce.k_id_calificacion
                                WHERE ce.k_id_control_especifico = $id")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
