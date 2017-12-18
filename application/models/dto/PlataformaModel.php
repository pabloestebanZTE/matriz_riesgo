<?php

class PlataformaModel extends Model {

    protected $k_id_plataforma;
    protected $n_nombre;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "plataforma";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdPlataforma($k_id_plataforma) {
        $this->k_id_plataforma = $k_id_plataforma;
    }
    public function getKIdPlataforma() {
        return $this->k_id_plataforma;
    }
    public function setNNombre($n_nombre) {
        $this->n_nombre = $n_nombre;
    }
    public function getNNombre() {
        return $this->n_nombre;
    }


}

