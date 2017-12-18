<?php

class ProbabilidadModel extends Model {

    protected $k_id_probabilidad;
    protected $n_descripcion;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "probabilidad";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdProbabilidad($k_id_probabilidad) {
        $this->k_id_probabilidad = $k_id_probabilidad;
    }
    public function getKIdProbabilidad() {
        return $this->k_id_probabilidad;
    }
    public function setNDescripcion($n_descripcion) {
        $this->n_descripcion = $n_descripcion;
    }
    public function getNDescripcion() {
        return $this->n_descripcion;
    }


}

