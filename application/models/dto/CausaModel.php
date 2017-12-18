<?php

class CausaModel extends Model {

    protected $k_id_causa;
    protected $n_nombre;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "causa";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdCausa($k_id_causa) {
        $this->k_id_causa = $k_id_causa;
    }
    public function getKIdCausa() {
        return $this->k_id_causa;
    }
    public function setNNombre($n_nombre) {
        $this->n_nombre = $n_nombre;
    }
    public function getNNombre() {
        return $this->n_nombre;
    }


}

