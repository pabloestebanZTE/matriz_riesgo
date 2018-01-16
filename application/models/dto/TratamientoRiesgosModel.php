<?php

class TratamientoRiesgosModel extends Model {

    protected $k_id_tratamiento;
    protected $k_id_riesgo_especifico;
    protected $k_id_riesgo;
    protected $descripcion_riesgo;
    protected $k_id_impacto_riesgo_residual;
    protected $k_id_probabilidad_riesgo_residual;
    protected $opcion_manejo;
    protected $control_propuesto;
    protected $tipo_control;
    protected $fecha_inicio;
    protected $fecha_fin;
    protected $responsable;
    protected $indicador;
    protected $create_at;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "tratamiento_riesgos";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdTratamiento($k_id_tratamiento) {
        $this->k_id_tratamiento = $k_id_tratamiento;
    }
    public function getKIdTratamiento() {
        return $this->k_id_tratamiento;
    }
    public function setKIdRiesgoEspecifico($k_id_riesgo_especifico) {
        $this->k_id_riesgo_especifico = $k_id_riesgo_especifico;
    }
    public function getKIdRiesgoEspecifico() {
        return $this->k_id_riesgo_especifico;
    }
    public function setKIdRiesgo($k_id_riesgo) {
        $this->k_id_riesgo = $k_id_riesgo;
    }
    public function getKIdRiesgo() {
        return $this->k_id_riesgo;
    }
    public function setDescripcionRiesgo($descripcion_riesgo) {
        $this->descripcion_riesgo = $descripcion_riesgo;
    }
    public function getDescripcionRiesgo() {
        return $this->descripcion_riesgo;
    }
    public function setKIdImpactoRiesgoResidual($k_id_impacto_riesgo_residual) {
        $this->k_id_impacto_riesgo_residual = $k_id_impacto_riesgo_residual;
    }
    public function getKIdImpactoRiesgoResidual() {
        return $this->k_id_impacto_riesgo_residual;
    }
    public function setKIdProbabilidadRiesgoResidual($k_id_probabilidad_riesgo_residual) {
        $this->k_id_probabilidad_riesgo_residual = $k_id_probabilidad_riesgo_residual;
    }
    public function getKIdProbabilidadRiesgoResidual() {
        return $this->k_id_probabilidad_riesgo_residual;
    }
    public function setOpcionManejo($opcion_manejo) {
        $this->opcion_manejo = $opcion_manejo;
    }
    public function getOpcionManejo() {
        return $this->opcion_manejo;
    }
    public function setControlPropuesto($control_propuesto) {
        $this->control_propuesto = $control_propuesto;
    }
    public function getControlPropuesto() {
        return $this->control_propuesto;
    }
    public function setTipoControl($tipo_control) {
        $this->tipo_control = $tipo_control;
    }
    public function getTipoControl() {
        return $this->tipo_control;
    }
    public function setFechaInicio($fecha_inicio) {
        $this->fecha_inicio = $fecha_inicio;
    }
    public function getFechaInicio() {
        return $this->fecha_inicio;
    }
    public function setFechaFin($fecha_fin) {
        $this->fecha_fin = $fecha_fin;
    }
    public function getFechaFin() {
        return $this->fecha_fin;
    }
    public function setResponsable($responsable) {
        $this->responsable = $responsable;
    }
    public function getResponsable() {
        return $this->responsable;
    }
    public function setIndicador($indicador) {
        $this->indicador = $indicador;
    }
    public function getIndicador() {
        return $this->indicador;
    }
    public function setCreateAt($create_at) {
        $this->create_at = $create_at;
    }
    public function getCreateAt() {
        return $this->create_at;
    }


}

