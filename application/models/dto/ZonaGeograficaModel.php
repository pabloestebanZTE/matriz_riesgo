<?php

class ZonaGeograficaModel extends Model {

    protected $k_id_zona_geografica;
    protected $n_nombre;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "zona_geografica";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdZonaGeografica($k_id_zona_geografica) {
        $this->k_id_zona_geografica = $k_id_zona_geografica;
    }
    public function getKIdZonaGeografica() {
        return $this->k_id_zona_geografica;
    }
    public function setNNombre($n_nombre) {
        $this->n_nombre = $n_nombre;
    }
    public function getNNombre() {
        return $this->n_nombre;
    }


}

