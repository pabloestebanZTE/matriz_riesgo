<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Utils extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_control_model');
        $this->load->model('data/Dao_combox_model');
    }

    function getListCombox() {
        $dao = new Dao_combox_model();
        $response = $dao->getListCombox($this->request);
        $this->json($response);
    }

    function getListComboxCmbTipoEventoNvl2() {
        $dao = new Dao_combox_model();
        $response = $dao->getListComboxCmbTipoEventoNvl2($this->request);
        $this->json($response);
    }

    function getSeveridad() {
        $request = $this->request;
        $model = new RefProbabilidadImpactoModel();
        $data = $model->where("k_id_probabilidad", "=", $request->idProbabilidad)
                        ->where("k_id_impacto", "=", $request->idImpacto)->first();
        $response = new Response(EMessages::QUERY);
        $response->setData($data);
        $this->json($response);
    }

    function prueba() {
        for ($i = 0; $i < 26; $i++) {
            echo $this->addMonth($i);
            echo "<br/>";
        }
    }

    function getOnTime() {
        $onTimeTypes = ["Y", "N", "Y"];
        $i = rand(0, 2);
        return $onTimeTypes[$i];
    }

    function addMonth($i) {
        $fecha = date('12/01/2017');
        $nuevafecha = strtotime('+' . $i . ' day', strtotime($fecha));
        $nuevafecha = date('Y-m-d H:i:s', $nuevafecha);
        return $nuevafecha;
    }

    function insertKPI($idTicket, $user) {
        for ($i = 0; $i < 26; $i++) {
            echo $i;
            $kpi = [];
            $kpi["k_id_onair"] = $idTicket;
            $kpi["n_round"] = 1;
            $kpi["k_id_summary_precheck"] = DB::table("kpi_summary")->insert([
                "e_type" => "PRE",
                "on_time" => $this->getOnTime(),
                "d_start" => $this->addMonth($i),
                "d_exec" => $this->addMonth($i),
                "d_end" => $this->addMonth($i),
                "k_id_executor" => $user,
                "d_created_at" => Hash::getDate()
            ]);
            $kpi["k_id_summary_12h"] = DB::table("kpi_summary")->insert([
                "e_type" => "POS",
                "on_time" => $this->getOnTime(),
                "d_start" => $this->addMonth($i),
                "d_exec" => $this->addMonth($i),
                "d_end" => $this->addMonth($i),
                "k_id_executor" => $user,
                "d_created_at" => Hash::getDate()
            ]);
            ;
            $kpi["k_id_summary_24h"] = DB::table("kpi_summary")->insert([
                "e_type" => "POS",
                "on_time" => $this->getOnTime(),
                "d_start" => $this->addMonth($i),
                "d_exec" => $this->addMonth($i),
                "d_end" => $this->addMonth($i),
                "k_id_executor" => $user,
                "d_created_at" => Hash::getDate()
            ]);
            $kpi["k_id_summary_36h"] = DB::table("kpi_summary")->insert([
                "e_type" => "POS",
                "on_time" => $this->getOnTime(),
                "d_start" => $this->addMonth($i),
                "d_exec" => $this->addMonth($i),
                "d_end" => $this->addMonth($i),
                "k_id_executor" => $user,
                "d_created_at" => Hash::getDate()
            ]);
            $kpi["d_created_at"] = Hash::getDate();
            DB::table("kpi_summary_onair")->insert($kpi);
        }
    }

    function insertRecordsKPIS() {
        ini_set('memory_limit', '-1');
        set_time_limit(-1);
        $users = DB::table("user")->isNotNull("n_role_user")->get();
        $idTickets = 700;
        foreach ($users as $user) {
//            $idTicket = rand(1, 500);
            $idTickets[] = $idTicket;
            $this->insertKPI($idTickets, $user->k_id_user);
            $idTickets++;
        }
    }

    function getConsecutivoControl() {
        $count = (new DB())
                ->select("select count(k_id) as count from control where k_id_plataforma = "
                        . $this->request->idPlataforma)
                ->first();
        $consecutivo = "C" . ($count->count + 1);
        $response = (new Response(EMessages::SUCCESS))->setData($consecutivo);
        $this->json($response);
    }

    function getConsecutivoRiesgo() {
        $count = (new DB())
                ->select("select count(k_id) as count from riesgo where k_id_plataforma = "
                        . $this->request->idPlataforma)
                ->first();
        $consecutivo = "R" . ($count->count + 1);
        $response = (new Response(EMessages::SUCCESS))->setData($consecutivo);
        $this->json($response);
    }

    function getRiskById() {
        $response = new Response(EMessages::QUERY);
        $data = (new RiesgoModel())->where("k_id_riesgo", "=", $this->request->id)->first();
        $response->setData($data);
        $this->json($response);
    }

}
