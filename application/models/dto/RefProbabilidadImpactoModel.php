<?php

class RefProbabilidadImpactoModel extends Model {

    protected $k_id_ref;
    protected $k_id_probabilidad;
    protected $k_id_impacto;
    protected $n_calificacion;
    protected $n_color;
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "ref_probabilidad_impacto";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }

    public function setKIdRef($k_id_ref) {
        $this->k_id_ref = $k_id_ref;
    }

    public function getKIdRef() {
        return $this->k_id_ref;
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

    public function setNCalificacion($n_calificacion) {
        $this->n_calificacion = $n_calificacion;
    }

    public function getNCalificacion() {
        return $this->n_calificacion;
    }

    public function setNColor($n_color) {
        $this->n_color = $n_color;
    }

    public function getNColor() {
        return $this->n_color;
    }

}
