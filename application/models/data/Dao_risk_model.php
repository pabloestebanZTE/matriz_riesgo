<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_risk_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/RiesgoModel');
        $this->load->model('dto/RiesgoEspecificoModel');
        $this->load->model('dto/SoporteModel');
        $this->load->model('dto/CausaModel');
        $this->load->model('dto/ControlEspecificoModel');
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

    public function insertRiskFull($request) {
        try {
            //Insertamos el riesgo especifico.
            $riesgoEspecificoModel = new RiesgoEspecificoModel();
            $riesgoEspecifico = new ObjUtil($request->riesgo_especifico->all());
            $idRiesgo = $riesgoEspecificoModel->insert($riesgoEspecifico->all())->data;
            if ($idRiesgo <= 0) {
                return new Response(EMessages::ERROR_INSERT);
            }
            //Insertamos los soportes de impacto...
            $soporteRecords = $request->soporte_impacto->all();
            $valid = new Validator();
            foreach ($soporteRecords as $value) {
                if ($valid->required(null, $value)) {
                    $soporteModel = new SoporteModel();
//                    var_dump($riesgoEspecifico);
                    $soporteModel->insert([
                        "k_id_impacto" => $riesgoEspecifico->k_id_impacto,
                        "k_tipo" => "2",
                        "n_nombre" => $value
                    ]);
                }
            }

            //Insertamos los soportes de probabilidad.
            $value = $request->soporte_probabilidad;
            if ($valid->required(null, $value)) {
                $soporteModel = new SoporteModel();
                $soporteModel->insert([
                    "k_id_probabilidad" => $riesgoEspecifico->k_id_probabilidad,
                    "k_tipo" => "1",
                    "n_nombre" => $value
                ]);
            }
            //Insertamos las causas...
            $causas = $request->causas;
            if ($causas) {
                $causas = $request->causas->all();
                foreach ($causas as $value) {
                    $causa = new ObjUtil($value->all());
                    $causaModel = new CausaModel();
                    //Insertamos la causa...
                    $idCausa = $causaModel->insert([
                                "n_nombre" => $causa->text
                            ])->data;
                    //Insertamos los controles...
                    $controls = $causa->controls->all();
                    foreach ($controls as $control) {
                        $controlEspecificoModel = new ControlEspecificoModel();
                        $controlEspecificoModel->insert([
                            "k_id_riesgo_especifico" => $idRiesgo,
                            "k_id_control" => $control->id,
                            "k_id_causa" => $idCausa,
                            "k_id_factor_riesgo" => $control->factorRiesgo,
                        ]);
                    }
                }
            }
            return new Response(EMessages::INSERT, "ADFKJASDF", $idRiesgo);
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function updateRiskFull($request) {
        try {
            return new Response(EMessages::UPDATE);
            //Consultamos y actualizamos el riesgo...            
            $riesgoEspecificoModel = new RiesgoEspecificoModel();
            $record = $riesgoEspecificoModel->where("", "=", $request->idRecord)->first();
            if ($record) {
                return new Response(EMessages::ERROR_UPDATE);
            }
            $riesgoEspecifico = new ObjUtil($request->riesgo_especifico->all());
            $riesgoEspecificoModel->where("k_id_riesgo_especifico", "=", $request->idRecord)
                    ->update($riesgoEspecifico->all());


            //Verificamos, actualizmos e insertamos los nuevos soportes de impacto...
            $soporteRecords = $request->soporte_impacto->all();
            $valid = new Validator();
            foreach ($soporteRecords as $value) {
                if ($valid->required(null, $value)) {
                    $soporteModel = new SoporteModel();
//                    var_dump($riesgoEspecifico);
                    $soporteModel->insert([
                        "k_id_impacto" => $riesgoEspecifico->k_id_impacto,
                        "k_tipo" => "2",
                        "n_nombre" => $value
                    ]);
                }
            }

            //Insertamos los soportes de probabilidad.
            $value = $request->soporte_probabilidad;
            if ($valid->required(null, $value)) {
                $soporteModel = new SoporteModel();
                $soporteModel->insert([
                    "k_id_probabilidad" => $riesgoEspecifico->k_id_probabilidad,
                    "k_tipo" => "1",
                    "n_nombre" => $value
                ]);
            }
            //Insertamos las causas...
            $causas = $request->causas;
            if ($causas) {
                $causas = $request->causas->all();
                foreach ($causas as $value) {
                    $causa = new ObjUtil($value->all());
                    $causaModel = new CausaModel();
                    //Insertamos la causa...
                    $idCausa = $causaModel->insert([
                                "n_nombre" => $causa->text
                            ])->data;
                    //Insertamos los controles...
                    $controls = $causa->controls->all();
                    foreach ($controls as $control) {
                        $controlEspecificoModel = new ControlEspecificoModel();
                        $controlEspecificoModel->insert([
                            "k_id_riesgo_especifico" => $idRiesgo,
                            "k_id_control" => $control->id,
                            "k_id_causa" => $idCausa,
                            "k_id_factor_riesgo" => $control->factorRiesgo,
                        ]);
                    }
                }
            }
            return new Response(EMessages::INSERT, "ADFKJASDF", $idRiesgo);
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

}

?>
