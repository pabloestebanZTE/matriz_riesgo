<?php

class ControlModel extends Model {

    protected $k_id_control;
    protected $n_descripcion;
    protected $n_asignacion;
    protected $n_cargo;
    protected $n_tipo;
    protected $n_funcionalidad_tipo;
    protected $n_naturaleza_control;
    protected $n_periodicidad;
    protected $n_funcionalidad_frecuencia;
    protected $n_documentacion;
    protected $n_actividades;
    protected $n_ejecucion;
    protected $n_importancia;
    protected $n_disminuye_probabilidad;
    protected $n_disminuye_impacto;
    protected $n_riesgo_residual;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "control";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdControl($k_id_control) {
        $this->k_id_control = $k_id_control;
    }
    public function getKIdControl() {
        return $this->k_id_control;
    }
    public function setNDescripcion($n_descripcion) {
        $this->n_descripcion = $n_descripcion;
    }
    public function getNDescripcion() {
        return $this->n_descripcion;
    }
    public function setNAsignacion($n_asignacion) {
        $this->n_asignacion = $n_asignacion;
    }
    public function getNAsignacion() {
        return $this->n_asignacion;
    }
    public function setNCargo($n_cargo) {
        $this->n_cargo = $n_cargo;
    }
    public function getNCargo() {
        return $this->n_cargo;
    }
    public function setNTipo($n_tipo) {
        $this->n_tipo = $n_tipo;
    }
    public function getNTipo() {
        return $this->n_tipo;
    }
    public function setNFuncionalidadTipo($n_funcionalidad_tipo) {
        $this->n_funcionalidad_tipo = $n_funcionalidad_tipo;
    }
    public function getNFuncionalidadTipo() {
        return $this->n_funcionalidad_tipo;
    }
    public function setNNaturalezaControl($n_naturaleza_control) {
        $this->n_naturaleza_control = $n_naturaleza_control;
    }
    public function getNNaturalezaControl() {
        return $this->n_naturaleza_control;
    }
    public function setNPeriodicidad($n_periodicidad) {
        $this->n_periodicidad = $n_periodicidad;
    }
    public function getNPeriodicidad() {
        return $this->n_periodicidad;
    }
    public function setNFuncionalidadFrecuencia($n_funcionalidad_frecuencia) {
        $this->n_funcionalidad_frecuencia = $n_funcionalidad_frecuencia;
    }
    public function getNFuncionalidadFrecuencia() {
        return $this->n_funcionalidad_frecuencia;
    }
    public function setNDocumentacion($n_documentacion) {
        $this->n_documentacion = $n_documentacion;
    }
    public function getNDocumentacion() {
        return $this->n_documentacion;
    }
    public function setNActividades($n_actividades) {
        $this->n_actividades = $n_actividades;
    }
    public function getNActividades() {
        return $this->n_actividades;
    }
    public function setNEjecucion($n_ejecucion) {
        $this->n_ejecucion = $n_ejecucion;
    }
    public function getNEjecucion() {
        return $this->n_ejecucion;
    }
    public function setNImportancia($n_importancia) {
        $this->n_importancia = $n_importancia;
    }
    public function getNImportancia() {
        return $this->n_importancia;
    }
    public function setNDisminuyeProbabilidad($n_disminuye_probabilidad) {
        $this->n_disminuye_probabilidad = $n_disminuye_probabilidad;
    }
    public function getNDisminuyeProbabilidad() {
        return $this->n_disminuye_probabilidad;
    }
    public function setNDisminuyeImpacto($n_disminuye_impacto) {
        $this->n_disminuye_impacto = $n_disminuye_impacto;
    }
    public function getNDisminuyeImpacto() {
        return $this->n_disminuye_impacto;
    }
    public function setNRiesgoResidual($n_riesgo_residual) {
        $this->n_riesgo_residual = $n_riesgo_residual;
    }
    public function getNRiesgoResidual() {
        return $this->n_riesgo_residual;
    }


}

