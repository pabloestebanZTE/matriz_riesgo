<?php

class ActividadModel extends Model {

    protected $k_id_actividad;
    protected $n_nombre;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "actividad";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdActividad($k_id_actividad) {
        $this->k_id_actividad = $k_id_actividad;
    }
    public function getKIdActividad() {
        return $this->k_id_actividad;
    }
    public function setNNombre($n_nombre) {
        $this->n_nombre = $n_nombre;
    }
    public function getNNombre() {
        return $this->n_nombre;
    }


}

