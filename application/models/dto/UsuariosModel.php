<?php

class UsuariosModel extends Model {

    protected $k_id_usuarios;
    protected $n_nombre_usuario;
    protected $n_apellido_usuario;
    protected $n_username_usuario;
    protected $n_mail_usuario;
    protected $i_telefono_usuario;
    protected $i_celular_usuario;
    protected $n_password;
    protected $n_rol_ususario;
    
    //Los campos que desea ocultar para que no se reflejen en la vista.    
    protected $table = "usuarios";
    //Los campos que desea exculir del modelo.
    protected $exclude = ["hidden", "exclude", "table", "class", "db", "__data"];

    public function __construct($properties = null) {
        parent::__construct($properties);
        $this->class = get_class($this);
    }
    
        public function setKIdUsuarios($k_id_usuarios) {
        $this->k_id_usuarios = $k_id_usuarios;
    }
    public function getKIdUsuarios() {
        return $this->k_id_usuarios;
    }
    public function setNNombreUsuario($n_nombre_usuario) {
        $this->n_nombre_usuario = $n_nombre_usuario;
    }
    public function getNNombreUsuario() {
        return $this->n_nombre_usuario;
    }
    public function setNApellidoUsuario($n_apellido_usuario) {
        $this->n_apellido_usuario = $n_apellido_usuario;
    }
    public function getNApellidoUsuario() {
        return $this->n_apellido_usuario;
    }
    public function setNUsernameUsuario($n_username_usuario) {
        $this->n_username_usuario = $n_username_usuario;
    }
    public function getNUsernameUsuario() {
        return $this->n_username_usuario;
    }
    public function setNMailUsuario($n_mail_usuario) {
        $this->n_mail_usuario = $n_mail_usuario;
    }
    public function getNMailUsuario() {
        return $this->n_mail_usuario;
    }
    public function setITelefonoUsuario($i_telefono_usuario) {
        $this->i_telefono_usuario = $i_telefono_usuario;
    }
    public function getITelefonoUsuario() {
        return $this->i_telefono_usuario;
    }
    public function setICelularUsuario($i_celular_usuario) {
        $this->i_celular_usuario = $i_celular_usuario;
    }
    public function getICelularUsuario() {
        return $this->i_celular_usuario;
    }
    public function setNPassword($n_password) {
        $this->n_password = $n_password;
    }
    public function getNPassword() {
        return $this->n_password;
    }
    public function setNRolUsusario($n_rol_ususario) {
        $this->n_rol_ususario = $n_rol_ususario;
    }
    public function getNRolUsusario() {
        return $this->n_rol_ususario;
    }


}

