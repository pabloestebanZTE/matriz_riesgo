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
                        "k_id_riesgo_especifico" => $idRiesgo,
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
                    "k_id_riesgo_especifico" => $idRiesgo,
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
                                "k_id_riesgo_especifico" => $idRiesgo,
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
            //Verificamos que exista el riesgo...
            $riesgoEspecificoModel = new RiesgoEspecificoModel();
            $idRecord = $request->idRecord;
            $idRiesgo = $request->idRecord;
            $record = $riesgoEspecificoModel->where("k_id_riesgo_especifico", "=", $idRecord)->first();
            if (!$record) {
                return new Response(EMessages::ERROR_UPDATE);
            }
            $valid = new Validator();
            //Actualizamos el riesgo...
            $riesgoEspecifico = new ObjUtil($request->riesgo_especifico->all());
            $riesgoEspecificoModel->where("k_id_riesgo_especifico", "=", $request->idRecord)
                    ->update($riesgoEspecifico->all());

            //Ahora actualizamos o insertamos el soporte_probabilidad...
            $soporteModel = new SoporteModel();
            $temp = $soporteModel->where("k_id_riesgo_especifico", "=", $record->k_id_riesgo_especifico)
                    ->where("k_id_probabilidad", "=", $record->k_id_probabilidad)
                    ->first();
            $value = $request->soporte_probabilidad;
            if ($temp) {
                //Actualizamos el soporte probabilidad...
                if ($valid->required(null, $value)) {
                    $soporteModel->where("k_id_riesgo_especifico", "=", $record->k_id_riesgo_especifico)
                            ->where("k_id_probabilidad", "=", $record->k_id_probabilidad)
                            ->update([
                                "k_id_probabilidad" => $riesgoEspecifico->k_id_probabilidad,
                                "n_nombre" => $value
                    ]);
                }
            } else {
                //Si no existe, lo insertamos...
                if ($valid->required(null, $value)) {
                    $soporteModel = new SoporteModel();
                    $soporteModel->insert([
                        "k_id_riesgo_especifico" => $idRiesgo,
                        "k_id_probabilidad" => $riesgoEspecifico->k_id_probabilidad,
                        "k_tipo" => "1",
                        "n_nombre" => $value
                    ]);
                }
            }

            //Ahora actualizamos los soportes de impacto...
            $soporteModel = new SoporteModel();
            $temp = $soporteModel->where("k_id_riesgo_especifico", "=", $record->k_id_riesgo_especifico)
                            ->isNotNull("k_id_impacto")->get();

            $soporteRecords = $request->soporte_impacto->all();
            if ($temp) {
                $i = 0;
                foreach ($temp as $value) {
                    $soporteModel = new SoporteModel();
                    if ($valid->required(null, $soporteRecords[$i])) {
                        $soporteModel->where("k_id_soporte", "=", $value->k_id_soporte)->update([
                            "k_id_impacto" => $riesgoEspecifico->k_id_impacto,
                            "n_nombre" => $soporteRecords[$i]
                        ]);
                    }
                    $i++;
                }
                //Se realiza esta comprobación ya que es posible que en un registro inicial, se haya insertado solo un soporte de impacto y al realizar la actualización vengan los dos.
                if ($i == 1) {
                    if (count($soporteRecords) == 2) {
                        if ($valid->required(null, $soporteRecords[$i])) {
                            $soporteModel->insert([
                                "k_id_riesgo_especifico" => $idRiesgo,
                                "k_id_impacto" => $riesgoEspecifico->k_id_impacto,
                                "k_tipo" => "2",
                                "n_nombre" => $soporteRecords[$i]
                            ]);
                        }
                    }
                }
            } else {
                //Insertamos los soportes de impacto...
                $valid = new Validator();
                foreach ($soporteRecords as $value) {
                    if ($valid->required(null, $value)) {
                        $soporteModel = new SoporteModel();
                        $soporteModel->insert([
                            "k_id_riesgo_especifico" => $idRiesgo,
                            "k_id_impacto" => $riesgoEspecifico->k_id_impacto,
                            "k_tipo" => "2",
                            "n_nombre" => $value
                        ]);
                    }
                }
            }

            //Ahora actualizamos las causas y los controles...
            $causas = $request->causas;
            if ($causas) {
                $causas = $request->causas->all();
                foreach ($causas as $causa) {
                    $causa = new ObjUtil($causa->all());
                    $causaModel = new CausaModel();
                    //Verificamos si el valor es válido y si la causa existe...
                    if ($valid->required(null, $causa->text)) {
                        //Si existe, la actualizamos...
                        $temp = isset($causa->idRecord);
                        if ($temp) {
                            $causaModel = new CausaModel();
                            $causaModel->update([
                                "n_nombre" => $causa->text
                            ]);
                            //Como la causa existe, tenemos que actualizar los controles de la causa...
                            $controls = $causa->controls->all();
                            foreach ($controls as $control) {
                                $controlEspecificoModel = new ControlEspecificoModel();
                                //Verificamos si el control viene con id de registro y lo actualizamos...
                                if (isset($control->idRecord)) {
                                    $controlEspecificoModel
                                            ->where("k_id_control_especifico", "=", $control->idRecord)
                                            ->update([
                                                "k_id_control" => $control->id,
                                                "k_id_factor_riesgo" => $control->factorRiesgo,
                                    ]);
                                } else { //De lo contrario, significará que es un registro nuevo, entonces lo actualizamos...
                                    $controlEspecificoModel->insert([
                                        "k_id_riesgo_especifico" => $idRiesgo,
                                        "k_id_control" => $control->id,
                                        "k_id_causa" => $idCausa,
                                        "k_id_factor_riesgo" => $control->factorRiesgo,
                                    ]);
                                }
                            }
                        } else {//De lo contrario la insertamos...
                            //Insertamos la causa...
                            $idCausa = $causaModel->insert([
                                        "k_id_riesgo_especifico" => $idRiesgo,
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
                }
            }

            return new Response(EMessages::INSERT);
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
            $soporteModel = new SoporteModel();
            $temp = $soporteModel->where("k_id_riesgo_especifico", "=", $data->k_id_riesgo_especifico)
                            ->isNotNull("k_id_impacto")->get();

            $soporteImpacto = [];
            foreach ($temp as $value) {
                $soporteImpacto[] = $value->n_nombre;
            }

            //Consultamos las causas...
            $causasModel = new CausaModel();
            $causas = $causasModel->where("k_id_riesgo_especifico", "=", $data->k_id_riesgo_especifico)->get();
            foreach ($causas as $causa) {
                $controlEspecificoModel = new ControlEspecificoModel();
                $controls = $controlEspecificoModel->where("k_id_causa", "=", $causa->k_id_causa)->get();
                $causa->controls = $controls;
            }

            $obj = [
                "riesgo_especifico" => $data,
                "soporte_probabilidad" => $soporteProbabilidad,
                "soporte_impacto[]" => $soporteImpacto,
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

    public function updateGeneralRisk($request) {
        try {
            $rm = new RiesgoModel();
            $datos = $rm->where("k_id_riesgo", "=", $request->k_id_riesgo)
                    ->update($request->all());
            $response = new Response(EMessages::UPDATE);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }
    
    public function getRiskAssociatedControl($request) {
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

}

?>
