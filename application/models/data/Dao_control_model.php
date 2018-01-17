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
            //Verificamos que no exista un control con le mismo nombre en la misma plataforma...
            $exist = $cvm->where("k_id_plataforma", "=", $request->k_id_plataforma)
                    ->where("nombre_control", "=", $request->nombre_control)
                    ->exist();
            if ($exist) {
                return (new Response(EMessages::ERROR))->setMessage("Ya existe un control con el mismo id para esta plataforma.");
            }
            $request->k_id_control = $request->nombre_control;
            $datos = $cvm->insert($request->all());
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getAllControlsAssigned($request) {
        try {
            $db = new DB();
            $datos = $db->select("SELECT co.*, count(coe.k_id_control) k_control_asinado
                                FROM control co
                                LEFT JOIN control_especifico coe ON co.k_id_control = coe.k_id_control 
                                " . (($request->idPlataforma != "-1") ? "WHERE co.k_id_plataforma =  $request->idPlataforma" : "") . "
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
            //Verificamos que no exista un control con le mismo nombre en la misma plataforma...
            $exist = $cm->where("k_id_plataforma", "=", $request->k_id_plataforma)
                    ->where("nombre_control", "=", $request->nombre_control)
                    ->where("k_id", "!=", $request->k_id_registro)
                    ->exist();
            if ($exist) {
                return (new Response(EMessages::ERROR))->setMessage("Ya existe un control con el mismo id para esta plataforma.");
            }
            $id = $request->k_id_registro;
            $args = $request->all();
            $cm = new ControlModel();
            $datos = $cm->where("k_id", "=", $id)
                    ->update($args);
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
