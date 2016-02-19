<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_GEO_Countries extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllCountries() {
        $query = $this->db->get('M_GEO_Countries');
        return $query->result();
    }

}