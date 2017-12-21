<?php

defined('BASEPATH') OR exit('No direct script access allowed');

//    session_start();

class Dao_risk_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/RiesgoModel');
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
                        "k_id_riesgo_especifico" => $riesgoEspecifico->k_id_riesgo_especifico,
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
                    "k_id_riesgo_especifico" => $riesgoEspecifico->k_id_riesgo_especifico,
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
//            $soporteRecords = $request->soporte_impacto->all();
//            $valid = new Validator();
//            $soporteModel = new SoporteModel();
//            foreach ($soporteRecords as $value) {
//                if ($valid->required(null, $value)) {
//                    $soporteModel = new SoporteModel();
//                    //Comprobamos que no exista...
//                    $soporteModel->insert([
//                        "k_id_impacto" => $riesgoEspecifico->k_id_impacto,
//                        "k_tipo" => "2",
//                        "n_nombre" => $value
//                    ]);
//                }
//            }
            //Insertamos los soportes de probabilidad.
//            $value = $request->soporte_probabilidad;
//            if ($valid->required(null, $value)) {
//                $soporteModel = new SoporteModel();
//                $soporteModel->insert([
//                    "k_id_probabilidad" => $riesgoEspecifico->k_id_probabilidad,
//                    "k_tipo" => "1",
//                    "n_nombre" => $value
//                ]);
//            }
            //Insertamos las causas...
//            $causas = $request->causas;
//            if ($causas) {
//                $causas = $request->causas->all();
//                foreach ($causas as $value) {
//                    $causa = new ObjUtil($value->all());
//                    $causaModel = new CausaModel();
//                    //Insertamos la causa...
//                    $idCausa = $causaModel->insert([
//                                "n_nombre" => $causa->text
//                            ])->data;
//                    //Insertamos los controles...
//                    $controls = $causa->controls->all();
//                    foreach ($controls as $control) {
//                        $controlEspecificoModel = new ControlEspecificoModel();
//                        $controlEspecificoModel->insert([
//                            "k_id_riesgo_especifico" => $idRiesgo,
//                            "k_id_control" => $control->id,
//                            "k_id_causa" => $idCausa,
//                            "k_id_factor_riesgo" => $control->factorRiesgo,
//                        ]);
//                    }
//                }
//            }
            return new Response(EMessages::INSERT, "ADFKJASDF", $idRiesgo);
        } catch (ZolidException $ex) {
            return $ex;
        }
    }
    
    public function findById($id) {
        try {
            $user = new RiesgoModel();
            $datos = $user->where("k_id_riesgo", "=", $id)
                    ->first();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function listAllRisk($request) {
        $model = new RiesgoEspecificoModel();
        $data = $model->get();
        $this->getRiskListFKDetails($data);
        $resposne = new Response(EMessages::QUERY);
        $resposne->setData($data);
        return $resposne;
    }

    public function getRiskById($request) {
        $model = new RiesgoEspecificoModel();
        $data = $model->where("k_id_riesgo_especifico", "=", $request->id)->first();
//        $this->getRiskFKDetails($data);
        $response = new Response(EMessages::QUERY);
        $obj = null;
        $soporteModel = new SoporteModel();
        if ($data) {
            //Consultamos el riesgo especifico 1...
            $tipoEventoModel = new TipoEvento2Model();
            $k_id_tipo_evento_2 = $tipoEventoModel->where("k_id_tipo_evento_2", "=", $data->k_id_tipo_evento_2)->first();
            $data->k_id_tipo_evento_1 = $k_id_tipo_evento_2->k_id_tipo_evento_1;

            //Consultamos el soporte probabilidad...
            $temp = $soporteModel->where("k_id_riesgo_especifico", "=", $data->k_id_riesgo_especifico)
                    ->where("k_id_probabilidad", "=", $data->k_id_probabilidad)
                    ->first();
            $soporteProbabilidad = ($temp) ? $temp->n_nombre : null;

            //Consultamos los soportes de impacto...
            $soporteImpacto = $soporteModel->where("k_id_riesgo_especifico", "=", $data->k_id_riesgo_especifico)
                            ->isNotNull("k_id_impacto")->get();


            //Consultamos el control especifico...
            $controlEspecificoModel = new ControlEspecificoModel();
            $controlEspecifico = $controlEspecificoModel->where("k_id_riesgo_especifico", "=", $data->k_id_riesgo_especifico)->first();

            $causas = null;

            if ($controlEspecifico) {
                //Consultamos las causas...
                $causasModel = new CausaModel();
                $causas = $causasModel->where("k_id_riesgo_especifico", "=", $data->k_id_riesgo_especifico)
                                ->select("n_nombre")->get();
                foreach ($causas as $causa) {
                    $controls = $controlEspecificoModel->where("k_id_causa", "=", $causa->k_id_causa)->get();
                    $causa->controls = $controls;
                }
            }

            $obj = [
                "riesgo_especifico" => $data,
                "soporte_probabilidad" => $soporteProbabilidad,
                "soporte_impacto" => $soporteImpacto,
                "causas" => $causas
            ];
        }
        $response->setData($obj);
        return $response;
    }

    public function getRiskListFKDetails(&$risks) {
        foreach ($risks as $risk) {
            $this->getRiskFKDetails($risk);
        }
    }

    public function getRiskFKDetails(&$risk) {
        if (empty($risk)) {
            return null;
        }
        $plataformaModel = new PlataformaModel();
        $riesgoModel = new RiesgoModel();
        $zonaGeograficaModel = new ZonaGeograficaModel();
        $tipoEvento2Model = new TipoEvento2Model();
        $soporteModel = new SoporteModel();
        $probabilidadModel = new ProbabilidadModel();
        $impactoModel = new ImpactoModel();
        $risk->k_id_plataforma = $plataformaModel->where("k_id_plataforma", "=", $risk->k_id_plataforma)->first();
        $risk->k_id_riesgo = $riesgoModel->where("k_id_riesgo", "=", $risk->k_id_riesgo)->first();
        $risk->k_id_zona_geografica = $zonaGeograficaModel->where("k_id_zona_geografica", "=", $risk->k_id_zona_geografica)->first();
        $risk->k_id_tipo_evento_2 = $tipoEvento2Model->where("k_id_tipo_evento_2", "=", $risk->k_id_tipo_evento_2)->first();
        $risk->k_id_probabilidad = $probabilidadModel->where("k_id_probabilidad", "=", $risk->k_id_probabilidad)->first();
        $risk->k_id_impacto = $impactoModel->where("k_id_impacto", "=", $risk->k_id_impacto)->first();
    }

}

?>
