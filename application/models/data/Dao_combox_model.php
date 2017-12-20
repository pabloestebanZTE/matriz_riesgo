<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_combox_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/ControlModel');
    }

    public function getListCombox($request) {
        $idcombox = $request->idCombox;
        $dataComobox = DB::table("ref_combox")
                        ->where("k_id_combox", "=", $idcombox)->first();
        $response = new Response(EMessages::QUERY);
        if ($dataComobox) {
            $db = new DB();
            $sql = "SELECT $dataComobox->n_value as value, $dataComobox->n_text   as text FROM $dataComobox->n_table";
            if ($dataComobox->n_sql) {
                $sql = $dataComobox->n_sql;
            }
            $data = $db->select($sql)->get();
            $response->setData($data);
        } else {
            $response = new Response(EMessages::ERROR_QUERY);
        }
        return $response;
    }

    public function getListComboxCmbTipoEventoNvl2($request) {
        $idcombox = $request->idNivel1;
        $response = new Response(EMessages::QUERY);
        $db = new DB();
        $sql = "select te2.k_id_tipo_evento_2 as value, te2.n_descripcion as text from tipo_evento_2 te2 inner join tipo_evento_1 te1 on te2.k_id_tipo_evento_1 = te1.k_id_tipo_evento_1 
                WHERE te1.k_id_tipo_evento_1 = $idcombox";
        $data = $db->select($sql)->get();
        $response->setData($data);
        return $response;
    }

}
