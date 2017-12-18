<?php

class TipoEvento2Model extends Model {

    protected $k_id_tipo_evento_2;
    protected $k_id_tipo_evento_1;
    protected $n_descripcion;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "tipo_evento_2";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdTipoEvento2($k_id_tipo_evento_2) {
        $this->k_id_tipo_evento_2 = $k_id_tipo_evento_2;
    }
    public function getKIdTipoEvento2() {
        return $this->k_id_tipo_evento_2;
    }
    public function setKIdTipoEvento1($k_id_tipo_evento_1) {
        $this->k_id_tipo_evento_1 = $k_id_tipo_evento_1;
    }
    public function getKIdTipoEvento1() {
        return $this->k_id_tipo_evento_1;
    }
    public function setNDescripcion($n_descripcion) {
        $this->n_descripcion = $n_descripcion;
    }
    public function getNDescripcion() {
        return $this->n_descripcion;
    }


}

