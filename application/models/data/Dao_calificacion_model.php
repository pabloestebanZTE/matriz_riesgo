<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_calificacion_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/CalificacionModel');
    }

    public function insertQualification($request) {
        try {
            $dao = new CalificacionModel();
            $request->total_disenio = $request->n_pd1 + $request->n_pd2 + $request->n_pd3 + $request->n_pd4 + $request->n_pd5;
            $request->total_ejecucion = $request->n_pe1 + $request->n_pe2 + $request->n_pe3 + $request->n_pe4;
            $request->total_calificacion = $request->total_disenio + $request->total_ejecucion;
            if ($request->total_calificacion <= 100 && $request->total_calificacion >= 76) {
                $request->niveles_disminuye = 1;
            } else {
                if ($request->total_calificacion <= 75 && $request->total_calificacion >= 51) {
                    $request->niveles_disminuye = 1;
                } else {
                    $request->niveles_disminuye = 0;
                }
            }
            $datos = $dao->insert($request->all())->data;

            $cm = new ControlEspecificoModel();
            $datos = $cm->where("k_id_control_especifico", "=", $request->k_id_control_especifico)
                    ->update([
                "k_id_calificacion" => $datos
            ]);

            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function updateQualification($request) {
        try {
            $cm = new CalificacionModel();
            $datos = $cm->where("k_id_calificacion", "=", $request->k_id_calificacion)
                    ->update($request->all());
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
