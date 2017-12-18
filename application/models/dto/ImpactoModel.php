<?php

class ImpactoModel extends Model {

    protected $k_id_impacto;
    protected $n_descripcion;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "impacto";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdImpacto($k_id_impacto) {
        $this->k_id_impacto = $k_id_impacto;
    }
    public function getKIdImpacto() {
        return $this->k_id_impacto;
    }
    public function setNDescripcion($n_descripcion) {
        $this->n_descripcion = $n_descripcion;
    }
    public function getNDescripcion() {
        return $this->n_descripcion;
    }


}

