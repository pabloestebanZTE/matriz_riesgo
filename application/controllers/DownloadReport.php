<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DownloadReport
 *
 * @author Admin
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class DownloadReport extends CI_Controller {

    //Genera el CSV de las matriz de riesgo...
    public function matrizRiesgo() {
        $lista = array(
            array('Plataforma', 'Zona Geográfica', 'Mapa proceso', 'Proceso',
                'Servicios', 'Objetivo', 'ID', 'Responsable', 'Riesgo',
                'Descripción del Riesgo', 'Tipo de Actividad',
                'Tipo de Evento (Nivel 1), Tipo de Evento (nivel 2)',
                'Probabilidad', 'Impacto', 'Severidad del Riesgo Inherente')
        );

        //Consultamos las matrices...
        $matrizModel = new RiesgoEspecificoModel();
        $array = $matrizModel->get();
        $this->getFkRecords($array);

        //Arreglamos el objeto...
        foreach ($array as $record) {
            $temp = [];
            $temp[] = ($record->k_id_plataforma) ? $record->k_id_plataforma->n_nombre : "Indefinido";
            $temp[] = ($record->k_id_zona_geografica) ? $record->k_id_zona_geografica->n_nombre : "Indefinido";
            $temp[] = $record->n_proceso;
            $temp[] = $record->n_servicio;
            $temp[] = $record->n_objetivo;
            $temp[] = ($record->k_id_riesgo) ? $record->k_id_riesgo->nombre_riesgo : "Indefinido";
            $temp[] = (($record->k_id_riesgo) ? $record->k_id_riesgo->n_responsable : "Indefinido");
            $temp[] = (($record->k_id_riesgo) ? $record->k_id_riesgo->n_riesgo : "Indefinido");
            $temp[] = (($record->k_id_riesgo) ? $record->k_id_riesgo->n_riesgo_descripcion : "Indefinido");
            $temp[] = $record->n_tipo_activad;
            $temp[] = (($record->k_id_tipo_evento_2) ? $record->k_id_tipo_evento_2->k_id_tipo_evento_1->n_descripcion : "Indefinido");
            $temp[] = (($record->k_id_tipo_evento_2) ? $record->k_id_tipo_evento_2->n_descripcion : "Indefinido");
            $temp[] = (($record->k_id_probabilidad) ? $record->k_id_probabilidad->n_descripcion : "Indefinido");
            $temp[] = (($record->k_id_impacto) ? $record->k_id_impacto->n_descripcion : "Indefinido");
            $temp[] = (($record->n_severidad_riesgo_inherente) ? $record->n_severidad_riesgo_inherente->n_calificacion : "Indefinido");
            $lista[] = $temp;
        }

        //Escribimos el reporte...
        $filename = 'Reporte Matriz de Riesgos - (' . date("Y-m-d") . ').csv';
        $fp = fopen($filename, 'w');

        foreach ($lista as $campos) {
            fprintf($fp, chr(0xEF) . chr(0xBB) . chr(0xBF));
            fputcsv($fp, $campos);
        }

        fclose($fp);

        return Redirect::to(URL::to($filename));
    }

    function getFkRecords(&$array) {
        $max = count($array);
        for ($i = 0; $i < $max; $i++) {
            $record = new ObjUtil($array[$i]);
            $record->k_id_plataforma = (new PlataformaModel())->where("k_id_plataforma", "=", $record->k_id_plataforma)->first();
            $record->k_id_zona_geografica = (new ZonaGeograficaModel())->where("k_id_zona_geografica", "=", $record->k_id_zona_geografica)->first();
            $record->k_id_riesgo = (new RiesgoModel())->where("k_id_riesgo", "=", $record->k_id_riesgo)->first();
            $record->k_id_tipo_evento_2 = (new TipoEvento2Model())->where("k_id_tipo_evento_2", "=", $record->k_id_tipo_evento_2)->first();
            if ($record->k_id_tipo_evento_2) {
                $record->k_id_tipo_evento_2->k_id_tipo_evento_1 = (new TipoEvento1Model())->where("k_id_tipo_evento_1", "=", $record->k_id_tipo_evento_2->k_id_tipo_evento_1)->first();
            }
            $record->causas = (new CausaModel())->where("k_id_riesgo_especifico", "=", $record->k_id_riesgo_especifico)->get();
            $record->k_id_probabilidad = (new ProbabilidadModel())->where("k_id_probabilidad", "=", $record->k_id_probabilidad)->first();
            $record->k_id_impacto = (new ImpactoModel())->where("k_id_impacto", "=", $record->k_id_impacto)->first();
            $record->n_severidad_riesgo_inherente = (new RefProbabilidadImpactoModel())->where("n_calificacion", "=", $record->n_severidad_riesgo_inherente)->first();
            $array[$i] = $record;
        }
    }

}
