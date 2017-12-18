<?php

class RiesgoModel extends Model {

    protected $k_id_riesgo;
    protected $n_riesgo;
    protected $n_riesgo_descripcion;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "riesgo";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdRiesgo($k_id_riesgo) {
        $this->k_id_riesgo = $k_id_riesgo;
    }
    public function getKIdRiesgo() {
        return $this->k_id_riesgo;
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


}

