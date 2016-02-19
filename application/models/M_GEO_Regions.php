<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_GEO_Regions extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getRegionsByCountry($data_country) {
        $this->db->where('country', $data_country["code"]);
        $query = $this->db->get('GEO_Regions');
        return $query->result();
    }

}