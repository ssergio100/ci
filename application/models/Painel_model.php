<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Painel_model extends CI_Model {

    private $var;
    function __construct()
    {
        parent::__construct();
        $this->load->helper('funcoes');
        $this->var = teste();
    }

    function getProdutos( $id = null)
    {
        if ($id) {
            $this->db->where('id',$id);
        }
        $result =  $this->db->get('produto')->result();
        return $result;
    }

    function doAdd( $array)
    {

        if ($this->db->insert('produto',$array)) {
            return  $this->db->insert_id();
        } else {
            return null;
        }

    }

}



