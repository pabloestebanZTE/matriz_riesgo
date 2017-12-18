<?php

class SoporteModel extends Model {

    protected $k_id_soporte;
    protected $k_id_probabilidad;
    protected $k_id_impacto;
    protected $k_tipo;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "soporte";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdSoporte($k_id_soporte) {
        $this->k_id_soporte = $k_id_soporte;
    }
    public function getKIdSoporte() {
        return $this->k_id_soporte;
    }
    public function setKIdProbabilidad($k_id_probabilidad) {
        $this->k_id_probabilidad = $k_id_probabilidad;
    }
    public function getKIdProbabilidad() {
        return $this->k_id_probabilidad;
    }
    public function setKIdImpacto($k_id_impacto) {
        $this->k_id_impacto = $k_id_impacto;
    }
    public function getKIdImpacto() {
        return $this->k_id_impacto;
    }
    public function setKTipo($k_tipo) {
        $this->k_tipo = $k_tipo;
    }
    public function getKTipo() {
        return $this->k_tipo;
    }


}

