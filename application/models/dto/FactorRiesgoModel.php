<?php

class FactorRiesgoModel extends Model {

    protected $k_id_factor_riesgo;
    protected $n_descripcion;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "factor_riesgo";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdFactorRiesgo($k_id_factor_riesgo) {
        $this->k_id_factor_riesgo = $k_id_factor_riesgo;
    }
    public function getKIdFactorRiesgo() {
        return $this->k_id_factor_riesgo;
    }
    public function setNDescripcion($n_descripcion) {
        $this->n_descripcion = $n_descripcion;
    }
    public function getNDescripcion() {
        return $this->n_descripcion;
    }


}

