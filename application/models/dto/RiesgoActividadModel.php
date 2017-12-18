<?php

class RiesgoActividadModel extends Model {

    protected $k_id_riesgo_actividad;
    protected $k_id_riesgo;
    protected $k_id_actividad;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "riesgo_actividad";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdRiesgoActividad($k_id_riesgo_actividad) {
        $this->k_id_riesgo_actividad = $k_id_riesgo_actividad;
    }
    public function getKIdRiesgoActividad() {
        return $this->k_id_riesgo_actividad;
    }
    public function setKIdRiesgo($k_id_riesgo) {
        $this->k_id_riesgo = $k_id_riesgo;
    }
    public function getKIdRiesgo() {
        return $this->k_id_riesgo;
    }
    public function setKIdActividad($k_id_actividad) {
        $this->k_id_actividad = $k_id_actividad;
    }
    public function getKIdActividad() {
        return $this->k_id_actividad;
    }


}

