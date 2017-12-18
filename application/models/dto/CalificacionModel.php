<?php

class CalificacionModel extends Model {

    protected $k_id_calificacion;
    protected $n_pd1;
    protected $n_pd2;
    protected $n_pd3;
    protected $n_pd4;
    protected $n_pd5;
    protected $n_pe1;
    protected $n_pe2;
    protected $n_pe3;
    protected $n_pe4;
    protected $total_disenio;
    protected $total_ejecucion;
    protected $total_calificacion;
    protected $niveles_disminuye;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "calificacion";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdCalificacion($k_id_calificacion) {
        $this->k_id_calificacion = $k_id_calificacion;
    }
    public function getKIdCalificacion() {
        return $this->k_id_calificacion;
    }
    public function setNPd1($n_pd1) {
        $this->n_pd1 = $n_pd1;
    }
    public function getNPd1() {
        return $this->n_pd1;
    }
    public function setNPd2($n_pd2) {
        $this->n_pd2 = $n_pd2;
    }
    public function getNPd2() {
        return $this->n_pd2;
    }
    public function setNPd3($n_pd3) {
        $this->n_pd3 = $n_pd3;
    }
    public function getNPd3() {
        return $this->n_pd3;
    }
    public function setNPd4($n_pd4) {
        $this->n_pd4 = $n_pd4;
    }
    public function getNPd4() {
        return $this->n_pd4;
    }
    public function setNPd5($n_pd5) {
        $this->n_pd5 = $n_pd5;
    }
    public function getNPd5() {
        return $this->n_pd5;
    }
    public function setNPe1($n_pe1) {
        $this->n_pe1 = $n_pe1;
    }
    public function getNPe1() {
        return $this->n_pe1;
    }
    public function setNPe2($n_pe2) {
        $this->n_pe2 = $n_pe2;
    }
    public function getNPe2() {
        return $this->n_pe2;
    }
    public function setNPe3($n_pe3) {
        $this->n_pe3 = $n_pe3;
    }
    public function getNPe3() {
        return $this->n_pe3;
    }
    public function setNPe4($n_pe4) {
        $this->n_pe4 = $n_pe4;
    }
    public function getNPe4() {
        return $this->n_pe4;
    }
    public function setTotalDisenio($total_disenio) {
        $this->total_disenio = $total_disenio;
    }
    public function getTotalDisenio() {
        return $this->total_disenio;
    }
    public function setTotalEjecucion($total_ejecucion) {
        $this->total_ejecucion = $total_ejecucion;
    }
    public function getTotalEjecucion() {
        return $this->total_ejecucion;
    }
    public function setTotalCalificacion($total_calificacion) {
        $this->total_calificacion = $total_calificacion;
    }
    public function getTotalCalificacion() {
        return $this->total_calificacion;
    }
    public function setNivelesDisminuye($niveles_disminuye) {
        $this->niveles_disminuye = $niveles_disminuye;
    }
    public function getNivelesDisminuye() {
        return $this->niveles_disminuye;
    }


}

