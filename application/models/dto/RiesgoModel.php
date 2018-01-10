<?php

class RiesgoModel extends Model {

    protected $k_id;
    protected $k_id_riesgo;
    protected $nombre_riesgo;
    protected $k_id_plataforma;
    protected $n_riesgo;
    protected $n_riesgo_descripcion;
    protected $n_responsable;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "riesgo";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKId($k_id) {
        $this->k_id = $k_id;
    }
    public function getKId() {
        return $this->k_id;
    }
    public function setKIdRiesgo($k_id_riesgo) {
        $this->k_id_riesgo = $k_id_riesgo;
    }
    public function getKIdRiesgo() {
        return $this->k_id_riesgo;
    }
    public function setNombreRiesgo($nombre_riesgo) {
        $this->nombre_riesgo = $nombre_riesgo;
    }
    public function getNombreRiesgo() {
        return $this->nombre_riesgo;
    }
    public function setKIdPlataforma($k_id_plataforma) {
        $this->k_id_plataforma = $k_id_plataforma;
    }
    public function getKIdPlataforma() {
        return $this->k_id_plataforma;
    }
    public function setNRiesgo($n_riesgo) {
        $this->n_riesgo = $n_riesgo;
    }
    public function getNRiesgo() {
        return $this->n_riesgo;
    }
    public function setNRiesgoDescripcion($n_riesgo_descripcion) {
        $this->n_riesgo_descripcion = $n_riesgo_descripcion;
    }
    public function getNRiesgoDescripcion() {
        return $this->n_riesgo_descripcion;
    }
    public function setNResponsable($n_responsable) {
        $this->n_responsable = $n_responsable;
    }
    public function getNResponsable() {
        return $this->n_responsable;
    }


}

