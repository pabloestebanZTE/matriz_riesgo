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

    public function updatePlataform($request) {
        try {
            $response = new Response(EMessages::INSERT);
            $plataformaModel = new PlataformaModel();
            $plataformaModel->where("k_id_plataforma", "=", $request->k_id_plataforma)
                    ->update($request->all());
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function insertPlataform($request) {
        try {
            $response = new Response(EMessages::INSERT);
            $plataformaModel = new PlataformaModel();
            $plataformaModel->insert($request->all());
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
            $valid = new Validator();
            $riesgoEspecifico = new ObjUtil($request->riesgo_especifico->all());
            //Se limpia el objeto de posibles cadenas vacias...
            $requireds = ["k_id_plataforma", "k_id_riesgo", "k_id_zona_geografica", "k_id_tipo_evento_2", "k_id_probabilidad", "k_id_impacto"];
            foreach ($requireds as $required) {
                if (!$valid->required(null, $riesgoEspecifico->{$required})) {
                    $riesgoEspecifico->{$required} = DB::NULLED;
                }
            }

            $idRiesgo = $riesgoEspecificoModel->insert($riesgoEspecifico->all())->data;
            if ($idRiesgo <= 0) {
                $response = new Response(EMessages::ERROR_INSERT);
                $response->setData("$idRiesgo - " . $riesgoEspecificoModel->getSQL());
                return $response;
            }
            //Insertamos los soportes de impacto...
            $soporteRecords = $request->soporte_impacto->all();
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
            return (new Response(EMessages::INSERT))->setData($idRiesgo);
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

            $requireds = ["k_id_plataforma", "k_id_riesgo", "k_id_zona_geografica", "k_id_tipo_evento_2", "k_id_probabilidad", "k_id_impacto"];

            //Actualizamos el riesgo...
            $riesgoEspecifico = new ObjUtil($request->riesgo_especifico->all());
            foreach ($requireds as $required) {
                if (!$valid->required(null, $riesgoEspecifico->{$required}) || $riesgoEspecifico->{$required} < 0) {
                    $riesgoEspecifico->{$required} = DB::NULLED;
                }
            }
            $riesgoEspecificoModel->where("k_id_riesgo_especifico", "=", $request->idRecord)
                    ->update($riesgoEspecifico->all());

//            echo $riesgoEspecificoModel->getSQL();
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
                        if ($causa->idRecord) {
                            $causaModel = new CausaModel();
                            $causaModel->where("k_id_causa", "=", $causa->idRecord)->update([
                                "n_nombre" => $causa->text
                            ]);
                            //Como la causa existe, tenemos que actualizar los controles de la causa...
                            if (count($causa->controls) > 0) {
                                $controls = $causa->controls->all();
                                foreach ($controls as $control) {
                                    $controlEspecificoModel = new ControlEspecificoModel();
                                    //Verificamos si el control viene con id de registro y lo actualizamos...
                                    if ($control->idRecord > 0) {
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
                                            "k_id_causa" => $causa->idRecord,
                                            "k_id_factor_riesgo" => $control->factorRiesgo,
                                        ]);
                                    }
                                }
                            }
                        } else {//De lo contrario la insertamos...
                            //Insertamos la causa...
                            $idCausa = $causaModel->insert([
                                        "k_id_riesgo_especifico" => $idRiesgo,
                                        "n_nombre" => $causa->text
                                    ])->data;
                            //Insertamos los controles..
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
                }
            }

            //Se comprueba si existen casuas para eliminar...
            if ($request->causasForDelete) {
                $causas = $request->causasForDelete->all();
                foreach ($causas as $causa) {
                    $causaModel = new CausaModel();
                    $causaModel->where("k_id_causa", "=", $causa->idRecord)->update([
                        "n_state" => "DELETED"
                    ]);
                }
            }

            //Se comprueba si existen controles para eliminar...
            if ($request->controlsForDelete) {
                $controls = $request->controlsForDelete->all();
                foreach ($controls as $control) {
                    $controlModel = new ControlEspecificoModel();
                    $controlModel->where("k_id_control_especifico", "=", $control->idRecord)->update([
                        "n_state" => "DELETED"
                    ]);
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
        $response = new Response(EMessages::QUERY);
        $obj = null;
        $soporteModel = new SoporteModel();
        if ($data) {
            //Consultamos el riesgo especifico 1...
            $tipoEventoModel = new TipoEvento2Model();
            $k_id_tipo_evento_2 = $tipoEventoModel->where("k_id_tipo_evento_2", "=", $data->k_id_tipo_evento_2)->first();
            if ($k_id_tipo_evento_2) {
                $data->k_id_tipo_evento_1 = $k_id_tipo_evento_2->k_id_tipo_evento_1;
            }

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
            $causas = $causasModel->where("k_id_riesgo_especifico", "=", $data->k_id_riesgo_especifico)
                            ->where("n_state", "=", "ACTIVE")->get();
            foreach ($causas as $causa) {
                $controlEspecificoModel = new ControlEspecificoModel();
                $controls = $controlEspecificoModel->where("k_id_causa", "=", $causa->k_id_causa)
                                ->where("n_state", "=", "ACTIVE")->get();
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
            $idControl = $request->idControl;
            $datos = $db->select("SELECT ri.k_id_riesgo, ri.n_riesgo, pl.n_nombre, ce.k_id_control_especifico 
                                FROM control_especifico ce
                                INNER JOIN causa ca ON ce.k_id_causa = ca.k_id_causa
                                INNER JOIN riesgo_especifico re ON ca.k_id_riesgo_especifico = re.k_id_riesgo_especifico
                                INNER JOIN riesgo ri ON ri.k_id_riesgo = re.k_id_riesgo
                                INNER JOIN plataforma pl ON pl.k_id_plataforma = re.k_id_plataforma
                                WHERE ce.k_id_control = '$idControl'")->get();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getFormData($request) {
        $dataForm = [];
        if ($request->id) {
            //Consultamos el registro...
            $dao = new Dao_risk_model();
            $response = $dao->getRiskById($request);
            $dataForm["record"] = $response->data;
            //Consultamos la lista de tipo evento2...
            $dao = new Dao_combox_model();
            if ($dataForm["record"]) {
                $dataForm["tipo_evento2"] = $dao->getListComboxTipoEventoNvl2ById($dataForm["record"]["riesgo_especifico"]->k_id_tipo_evento_2)->data;
            }
        }
        $dao = new Dao_combox_model();
        $dataForm["riesgos"] = $dao->getListComboxById(1)->data;
        $dataForm["factoresriesgo"] = $dao->getListComboxById(2)->data;
        $dataForm["probabilidad"] = $dao->getListComboxById(3)->data;
        $dataForm["impacto"] = $dao->getListComboxById(4)->data;
        $dataForm["plataforma"] = $dao->getListComboxById(5)->data;
        $dataForm["listcontrols"] = $dao->getListComboxById(6)->data;
        $dataForm["tipo_evento1"] = $dao->getListComboxById(7)->data;
        $dataForm["zonas_geograficas"] = $dao->getListComboxById(8)->data;
        return $dataForm;
    }

    public function getControlEspecifico($request) {
        $controlDao = new ControlEspecificoModel();
        //Consultamos el riesgo especifico...
        $control = $controlDao
                ->join("control", "control.k_id_control", "=", "control_especifico.k_id_control")
                ->where("k_id_control_especifico", "=", $request->id)
                ->first();
        $calificacion = null;
        if ($control) {
            //Consultamos si el registro tiene una calificación actualmente...
            $calificacionDao = new CalificacionModel();
            $calificacion = $calificacionDao->where("k_id_calificacion", "=", $control->k_id_calificacion)->first();
        }
        $this->load->view('qualificationControlsView', [
            "control" => $control,
            "calificacion" => $calificacion
        ]);
    }

    public function getRiskByIdPlataform($request) {
        $response = new Response(EMessages::QUERY);
        $daoRisk = new RiesgoEspecificoModel();
        $db = new DB();
//        $list = $db->select("SELECT riesgo_especifico.*, reisgo.n_riesgo FROM riesgo_especifico "
//                . "INNER JOIN riesgo ON "
//                . "riesgo.k_id_riesgo = riesgo_especifico.k_id_riesgo WHERE k_id_plataforma = ")->get();
        $list = $daoRisk
                ->join("riesgo", "riesgo.k_id_riesgo", "=", "riesgo_especifico.k_id_riesgo")
                ->where("k_id_plataforma", "=", $request->id)
                ->select("riesgo.n_riesgo", "riesgo_especifico.*")
                ->get();

        if (count($list) == 0) {
            $response = new Response(EMessages::NO_FOUND_REGISTERS);
//            $response->setData($daoRisk->getSQL());
        }
        $response->setData($list);
        return $response;
    }

    public function listPlataforms() {
        $response = new Response(EMessages::QUERY);
        $plataformsModel = new PlataformaModel();
        $data = $plataformsModel->orderBy("n_nombre", "asc")->get();
        $response->setData($data);
        return $response;
    }

}

?>
