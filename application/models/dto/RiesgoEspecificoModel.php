<?php

class RiesgoEspecificoModel extends Model {

    protected $k_id_riesgo_especifico;
    protected $k_id_plataforma;
    protected $k_id_riesgo;
    protected $k_id_zona_geografica;
    protected $k_id_tipo_evento_2;
    protected $k_id_soporte;
    protected $n_macro_proceso;
    protected $n_proceso;
    protected $n_servicio;
    protected $n_responsable;
    protected $n_probabilidad;
    protected $n_impacto;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "riesgo_especifico";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdRiesgoEspecifico($k_id_riesgo_especifico) {
        $this->k_id_riesgo_especifico = $k_id_riesgo_especifico;
    }
    public function getKIdRiesgoEspecifico() {
        return $this->k_id_riesgo_especifico;
    }
    public function setKIdPlataforma($k_id_plataforma) {
        $this->k_id_plataforma = $k_id_plataforma;
    }
    public function getKIdPlataforma() {
        return $this->k_id_plataforma;
    }
    public function setKIdRiesgo($k_id_riesgo) {
        $this->k_id_riesgo = $k_id_riesgo;
    }
    public function getKIdRiesgo() {
        return $this->k_id_riesgo;
    }
    public function setKIdZonaGeografica($k_id_zona_geografica) {
        $this->k_id_zona_geografica = $k_id_zona_geografica;
    }
    public function getKIdZonaGeografica() {
        return $this->k_id_zona_geografica;
    }
    public function setKIdTipoEvento2($k_id_tipo_evento_2) {
        $this->k_id_tipo_evento_2 = $k_id_tipo_evento_2;
    }
    public function getKIdTipoEvento2() {
        return $this->k_id_tipo_evento_2;
    }
    public function setKIdSoporte($k_id_soporte) {
        $this->k_id_soporte = $k_id_soporte;
    }
    public function getKIdSoporte() {
        return $this->k_id_soporte;
    }
    public function setNMacroProceso($n_macro_proceso) {
        $this->n_macro_proceso = $n_macro_proceso;
    }
    public function getNMacroProceso() {
        return $this->n_macro_proceso;
    }
    public function setNProceso($n_proceso) {
        $this->n_proceso = $n_proceso;
    }
    public function getNProceso() {
        return $this->n_proceso;
    }
    public function setNServicio($n_servicio) {
        $this->n_servicio = $n_servicio;
    }
    public function getNServicio() {
        return $this->n_servicio;
    }
    public function setNResponsable($n_responsable) {
        $this->n_responsable = $n_responsable;
    }
    public function getNResponsable() {
        return $this->n_responsable;
    }
    public function setNProbabilidad($n_probabilidad) {
        $this->n_probabilidad = $n_probabilidad;
    }
    public function getNProbabilidad() {
        return $this->n_probabilidad;
    }
    public function setNImpacto($n_impacto) {
        $this->n_impacto = $n_impacto;
    }
    public function getNImpacto() {
        return $this->n_impacto;
    }


}

