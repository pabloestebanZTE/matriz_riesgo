<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Dao_risk_model extends CI_Model {

    public function __construct() {
        $this->load->model('dto/RiesgoModel');
    }

    public function insertRisk($request) {
        try {
            $riesgo = new RiesgoModel();
            //Verificamos que no exista un control con le mismo nombre en la misma plataforma...
            $exist = $riesgo->where("k_id_plataforma", "=", $request->k_id_plataforma)
                            ->where("nombre_riesgo", "=", $request->nombre_riesgo)->exist();
            if ($exist) {
                return (new Response(EMessages::ERROR))->setMessage("Ya existe un riesgo con el mismo id para esta plataforma.");
            }
            $request->k_id_riesgo = $request->nombre_riesgo;
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

    public function getAll($request) {
        try {
            $user = new RiesgoModel();
            if ($request->idPlataforma != "-1") {
                $datos = $user->where("k_id_plataforma", "=", $request->idPlataforma)->get();
            } else {
                $datos = $user->get();
            }
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getListRisk($request) {
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

    public function getListMatrizByRisk($request) {
        try {
            $model = new RiesgoEspecificoModel();
            $datos = $model->where("k_id_riesgo", "=", $request->idRisk)->get();
            $this->getRiskListFKDetails($datos);
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
                    if (count($causa->controls)) {
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
                    //Comprobamos el index exista en soporteRecords...
                    if ($soporteRecords && count($soporteRecords) < $i) {
                        var_dump($soporteRecords[$i]);
                        if ($valid->required(null, $soporteRecords[$i])) {
                            $soporteModel->where("k_id_soporte", "=", $value->k_id_soporte)->update([
                                "k_id_impacto" => $riesgoEspecifico->k_id_impacto,
                                "n_nombre" => $soporteRecords[$i]
                            ]);
                        }
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
                    if (is_object($causa)) {
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
                                        if (is_object($control)) {
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
                                }
                            } else {//De lo contrario la insertamos...
                                //Insertamos la causa...
                                $idCausa = $causaModel->insert([
                                            "k_id_riesgo_especifico" => $idRiesgo,
                                            "n_nombre" => $causa->text
                                        ])->data;
                                //Insertamos los controles..
                                if (count($causa->controls) > 0) {
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

    public function findByIdUnic($id) {
        try {
            $user = new RiesgoModel();
            $datos = $user->where("k_id", "=", $id)
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

        //Consultamos el riesgo inherente.
        $obj["riesgo_inherente"] = (new RefProbabilidadImpactoModel())
                        ->where("k_id_probabilidad", "=", $data->k_id_probabilidad)
                        ->where("k_id_impacto", "=", $data->k_id_impacto)->first();

        //Consultamos el riesgo...
        $obj["riesgo"] = (new RiesgoModel())->where("k_id_riesgo", "=", $data->k_id_riesgo)->first();

        //Consultamos el riesgo residual...
        $idRisk = $data->k_id_riesgo_especifico;
        $db = new DB();
        //Verificamos si disminuye la probabilidad...
        $dProbabilidad = $db->select("select c.*, cc.k_id_causa, ce.k_id_control, ctrl.n_disminuye_probabilidad, ctrl.n_disminuye_impacto from calificacion c inner join control_especifico ce 
                                    on c.k_id_calificacion = ce.k_id_calificacion inner join causa cc 
                                    inner join control ctrl on ctrl.k_id_control = ce.k_id_control 
                                    where cc.k_id_riesgo_especifico = " . $idRisk . " and ctrl.n_disminuye_probabilidad = 'Sí' 
                                    group by ce.k_id_control 
                                    order by c.niveles_disminuye desc limit 1;")->first();

        //Verificamos si disminuye el impacto...
        $dImpacto = $db->select("select c.*, cc.k_id_causa, ce.k_id_control, ctrl.n_disminuye_probabilidad, 
                    ctrl.n_disminuye_impacto from calificacion c inner join control_especifico ce 
                    on c.k_id_calificacion = ce.k_id_calificacion inner join causa cc 
                    inner join control ctrl on ctrl.k_id_control = ce.k_id_control 
                    where cc.k_id_riesgo_especifico = " . $idRisk . " and ctrl.n_disminuye_impacto = 'Sí' 
                    group by ce.k_id_control 
                    order by c.niveles_disminuye desc limit 1;")->first();

        //Ahora verificamos a cual escala baja...
        $idProbabilidad = $data->k_id_probabilidad;
        $idImpacto = $data->k_id_impacto;
        if ($dProbabilidad && $dProbabilidad->niveles_disminuye <= 2) {
            $idProbabilidad += $dProbabilidad->niveles_disminuye;
            if ($idProbabilidad > 5) {
                $idProbabilidad = 5;
            }
        }
        if ($dImpacto && $dImpacto->niveles_disminuye <= 2) {
            $idImpacto += $dImpacto->niveles_disminuye;
            if ($idImpacto > 5) {
                $idImpacto = 5;
            }
        }

        $model = new RefProbabilidadImpactoModel();
        $riesgoResidual = $model->where("k_id_probabilidad", "=", $idProbabilidad)
                        ->where("k_id_impacto", "=", $idImpacto)->first();

        $obj["riesgo_residual"] = $riesgoResidual;
        $obj["cmpl_riesgo_residual"] = [
            "k_id_probabilidad" => $idProbabilidad,
            "k_id_impacto" => $idImpacto
        ];
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
            $exist = $rm->where("k_id_plataforma", "=", $request->k_id_plataforma)
                    ->where("nombre_riesgo", "=", $request->nombre_riesgo)
                    ->where("k_id", "!=", $request->k_id_registro)
                    ->exist();
            if ($exist) {
                return (new Response(EMessages::ERROR))->setMessage("Ya existe un control con el mismo id para esta plataforma.");
            }

            $rm = new RiesgoModel();
            $datos = $rm->where("k_id", "=", $request->k_id_registro)
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
            $sql = "select re.*, p.n_nombre, r.nombre_riesgo, r.n_riesgo, ce.k_id_control_especifico from riesgo_especifico re inner join causa cc
                    on cc.k_id_riesgo_especifico = re.k_id_riesgo_especifico 
                    inner join riesgo r on r.k_id_riesgo = re.k_id_riesgo 
                    inner join control_especifico ce on ce.k_id_causa = cc.k_id_causa 
                    inner join control c on c.k_id_control = ce.k_id_control 
                    inner join plataforma p on p.k_id_plataforma = re.k_id_plataforma 
                    where c.nombre_control  = '$idControl' group by re.k_id_riesgo_especifico";

            $datos = $db->select($sql)->get();
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
        $typeFilter = ($request->typeFilter == "WITHCONTROL") ? $request->typeFilter : "NONE";
        $db = new DB();
//        $list = $db->select("SELECT riesgo_especifico.*, reisgo.n_riesgo FROM riesgo_especifico "
//                . "INNER JOIN riesgo ON "
//                . "riesgo.k_id_riesgo = riesgo_especifico.k_id_riesgo WHERE k_id_plataforma = ")->get();
        $list = null;
        if ($typeFilter == "NONE") {
            $list = $daoRisk
                            ->join("riesgo", "riesgo.k_id_riesgo", "=", "riesgo_especifico.k_id_riesgo")
                            ->where("riesgo.k_id_plataforma", "=", $request->id)
                            ->select("riesgo.n_riesgo", "riesgo_especifico.*")->get();
        } else if ($typeFilter == "WITHCONTROL") {
            $list = (new DB())->select("select re.*, r.n_riesgo from riesgo_especifico re inner join 
                                        causa c on re.k_id_riesgo_especifico = c.k_id_riesgo_especifico 
                                        inner join control_especifico ce on ce.k_id_causa = c.k_id_causa 
                                        inner join riesgo r on r.k_id_riesgo = re.k_id_riesgo 
                                        inner join calificacion cc on cc.k_id_calificacion = ce.k_id_calificacion
                                        inner join control ctrl on ce.k_id_control = ctrl.k_id_control 
                                        where re.k_id_plataforma = $request->id group by re.k_id_riesgo_especifico")->get();
            //Calculmos el riesgo residual de cada registro.
            foreach ($list as $record) {
                $idRisk = $record->k_id_riesgo_especifico;
                $db = new DB();
                //Verificamos si disminuye la probabilidad...
                $dProbabilidad = $db->select("select c.*, cc.k_id_causa, ce.k_id_control, ctrl.n_disminuye_probabilidad, ctrl.n_disminuye_impacto from calificacion c inner join control_especifico ce 
                                    on c.k_id_calificacion = ce.k_id_calificacion inner join causa cc 
                                    inner join control ctrl on ctrl.k_id_control = ce.k_id_control 
                                    where cc.k_id_riesgo_especifico = " . $idRisk . " and ctrl.n_disminuye_probabilidad = 'Sí' 
                                    group by ce.k_id_control 
                                    order by c.niveles_disminuye desc limit 1;")->first();

                //Verificamos si disminuye el impacto...
                $dImpacto = $db->select("select c.*, cc.k_id_causa, ce.k_id_control, ctrl.n_disminuye_probabilidad, 
                    ctrl.n_disminuye_impacto from calificacion c inner join control_especifico ce 
                    on c.k_id_calificacion = ce.k_id_calificacion inner join causa cc 
                    inner join control ctrl on ctrl.k_id_control = ce.k_id_control 
                    where cc.k_id_riesgo_especifico = " . $idRisk . " and ctrl.n_disminuye_impacto = 'Sí' 
                    group by ce.k_id_control 
                    order by c.niveles_disminuye desc limit 1;")->first();

                //Ahora verificamos a cual escala baja...
                $idProbabilidad = $record->k_id_probabilidad;
                $idImpacto = $record->k_id_impacto;
                if ($dProbabilidad && $dProbabilidad->niveles_disminuye <= 2) {
                    $idProbabilidad += $dProbabilidad->niveles_disminuye;
                    if ($idProbabilidad > 5) {
                        $idProbabilidad = 5;
                    }
                }
                if ($dImpacto && $dImpacto->niveles_disminuye <= 2) {
                    $idImpacto += $dImpacto->niveles_disminuye;
                    if ($idImpacto > 5) {
                        $idImpacto = 5;
                    }
                }
                $record->k_id_probabilidad = $idProbabilidad;
                $record->k_id_impacto = $idImpacto;
            }
        }

        if (count($list) == 0) {
            $response = new Response(EMessages::NO_FOUND_REGISTERS);
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

    public function insertTratamiento($request) {
        try {
            $valid = new Validator();
            //Se limpia el objeto de posibles cadenas vacias...
            foreach ($request->all() as $key => $value) {
                if ((!is_object($value)) && (!$valid->required(null, $value))) {
                    $request->{$key} = DB::NULLED;
                }
            }
            $response = new Response(EMessages::INSERT);
            $request->create_at = Hash::getDate();
            (new TratamientoRiesgosModel())->insert($request->all());
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function updateTratamiento($request) {
        try {
            $valid = new Validator();
            //Se limpia el objeto de posibles cadenas vacias...
            foreach ($request->all() as $key => $value) {
                if ((!is_object($value)) && (!$valid->required(null, $value))) {
                    $request->{$key} = DB::NULLED;
                }
            }
            $response = new Response(EMessages::UPDATE);
            $request->create_at = Hash::getDate();
            (new TratamientoRiesgosModel())->where("k_id_tratamiento", "=", $request->id_tratamiento)
                    ->update($request->all());
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function listRiskByIdPlataform($id) {
        try {
            $risk = new RiesgoModel();
            $datos = $risk->where("k_id_plataforma", "=", $id)
                    ->get();
//            echo $risk->getSQL();
            $response = new Response(EMessages::SUCCESS);
            $response->setData($datos);
            return $response;
        } catch (ZolidException $ex) {
            return $ex;
        }
    }

    public function getListTratamientosByIdMatriz($request) {
        $response = new Response(EMessages::QUERY);
        $tratamientosModel = new TratamientoRiesgosModel();
        $riesgoEspecifico = (new RiesgoEspecificoModel())->where("k_id_riesgo_especifico ", "=", $request->k_id_riesgo_especifico)->first();
        if ($riesgoEspecifico) {
            $riesgoEspecifico->n_severidad_riesgo_inherente = (new RefProbabilidadImpactoModel())
                    ->where("k_id_probabilidad", "=", $riesgoEspecifico->k_id_probabilidad)
                    ->where("k_id_impacto", "=", $riesgoEspecifico->k_id_impacto)
                    ->first();

            $riesgoEspecifico->k_id_plataforma = (new PlataformaModel())->where("k_id_plataforma", "=", $riesgoEspecifico->k_id_plataforma)->first();
        } else {
            return new Response(EMessages::ERROR_QUERY);
        }
        $datos = $tratamientosModel->where("k_id_riesgo_especifico", "=", $request->k_id_riesgo_especifico)->get();
        foreach ($datos as $dato) {
            $dato->k_id_riesgo_especifico = $riesgoEspecifico;
            $dato->k_id_riesgo = (new RiesgoModel())->where("k_id_riesgo", "=", $dato->k_id_riesgo)->first();
            $tempModel = new RefProbabilidadImpactoModel();
            $dato->k_id_probabilidad = $tempModel
                    ->where("k_id_probabilidad", "=", $dato->k_id_probabilidad_riesgo_residual)
                    ->where("k_id_impacto", "=", $dato->k_id_impacto_riesgo_residual)
                    ->first();
        }
        $response->setData($datos);
        return $response;
    }

    function getTratamientoById($request) {
        $response = new Response(EMessages::QUERY);
        $tratamientoModel = new TratamientoRiesgosModel();
        $riesgoEspecifico = new RiesgoEspecificoModel();
        $tratamiento = $tratamientoModel->where("k_id_tratamiento", "=", $request->id)->first();
        if ($tratamiento) {
            //Consultamos el riesgo...
            $tratamiento->k_id_riesgo_especifico = $riesgoEspecifico->where("k_id_riesgo_especifico", "=", $tratamiento->k_id_riesgo_especifico)->first();
            //Consultamos el riesgo inherente...
            $riesgoTempModel = new RefProbabilidadImpactoModel();
            $riesgoInherente = $riesgoTempModel
                    ->where("k_id_probabilidad", "=", $tratamiento->k_id_riesgo_especifico->k_id_probabilidad)
                    ->where("k_id_impacto", "=", $tratamiento->k_id_riesgo_especifico->k_id_impacto)
                    ->first();
            //Consultamos el riesgo residual...
            $riesgoTempModel = new RefProbabilidadImpactoModel();
            $riesgoResidual = $riesgoTempModel
                    ->where("k_id_probabilidad", "=", $tratamiento->k_id_probabilidad_riesgo_residual)
                    ->where("k_id_impacto", "=", $tratamiento->k_id_impacto_riesgo_residual)
                    ->first();
        }
        $comboxDAO = new Dao_combox_model();

        //Organizamos el objeto que vamos a retornar...
        $tratamiento = [
            "record" => [
                "riesgo" => (new RiesgoModel())->where("k_id_riesgo", "=", $tratamiento->k_id_riesgo_especifico->k_id_riesgo)->first(),
                "riesgo_especifico" => $tratamiento->k_id_riesgo_especifico,
                "riesgo_inherente" => $riesgoInherente,
                "riesgo_residual" => $riesgoResidual,
                "cmpl_riesgo_residual" => [
                    "k_id_probabilidad" => $tratamiento->k_id_probabilidad_riesgo_residual,
                    "k_id_impacto" => $tratamiento->k_id_impacto_riesgo_residual,
                ]
            ],
            "riesgos" => $comboxDAO->getListComboxById(1)->data,
            "tratamiento" => $tratamiento
        ];
        return $tratamiento;
    }

}

?>
