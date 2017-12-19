<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


defined('BASEPATH') OR exit('No direct script access allowed');

class Utils extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->model('data/Dao_control_model');
        $this->load->model('data/Dao_combox_model');
    }

    function getListCombox() {
        $dao = new Dao_combox_model();
        $response = $dao->getListCombox($this->request);
        $this->json($response);
    }

}
