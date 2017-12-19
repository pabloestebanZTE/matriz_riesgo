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

}
