<?php

class ControlEspecificoModel extends Model {

    protected $k_id_control_especifico;
    protected $k_id_riesgo_especifico;
    protected $k_id_control;
    protected $k_id_causa;
    protected $k_id_factor_riesgo;
    protected $k_id_calificacion;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "control_especifico";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdControlEspecifico($k_id_control_especifico) {
        $this->k_id_control_especifico = $k_id_control_especifico;
    }
    public function getKIdControlEspecifico() {
        return $this->k_id_control_especifico;
    }
    public function setKIdRiesgoEspecifico($k_id_riesgo_especifico) {
        $this->k_id_riesgo_especifico = $k_id_riesgo_especifico;
    }
    public function getKIdRiesgoEspecifico() {
        return $this->k_id_riesgo_especifico;
    }
    public function setKIdControl($k_id_control) {
        $this->k_id_control = $k_id_control;
    }
    public function getKIdControl() {
        return $this->k_id_control;
    }
    public function setKIdCausa($k_id_causa) {
        $this->k_id_causa = $k_id_causa;
    }
    public function getKIdCausa() {
        return $this->k_id_causa;
    }
    public function setKIdFactorRiesgo($k_id_factor_riesgo) {
        $this->k_id_factor_riesgo = $k_id_factor_riesgo;
    }
    public function getKIdFactorRiesgo() {
        return $this->k_id_factor_riesgo;
    }
    public function setKIdCalificacion($k_id_calificacion) {
        $this->k_id_calificacion = $k_id_calificacion;
    }
    public function getKIdCalificacion() {
        return $this->k_id_calificacion;
    }


}

