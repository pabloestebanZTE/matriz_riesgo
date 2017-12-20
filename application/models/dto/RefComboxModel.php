<?php

class RefComboxModel extends Model {

    protected $k_id_combox;
    protected $n_value;
    protected $n_text;
    protected $n_table;
    protected $n_sql;
    protected $d_created_at;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "ref_combox";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdCombox($k_id_combox) {
        $this->k_id_combox = $k_id_combox;
    }
    public function getKIdCombox() {
        return $this->k_id_combox;
    }
    public function setNValue($n_value) {
        $this->n_value = $n_value;
    }
    public function getNValue() {
        return $this->n_value;
    }
    public function setNText($n_text) {
        $this->n_text = $n_text;
    }
    public function getNText() {
        return $this->n_text;
    }
    public function setNTable($n_table) {
        $this->n_table = $n_table;
    }
    public function getNTable() {
        return $this->n_table;
    }
    public function setNSql($n_sql) {
        $this->n_sql = $n_sql;
    }
    public function getNSql() {
        return $this->n_sql;
    }
    public function setDCreatedAt($d_created_at) {
        $this->d_created_at = $d_created_at;
    }
    public function getDCreatedAt() {
        return $this->d_created_at;
    }


}

