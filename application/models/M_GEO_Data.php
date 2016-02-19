<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_GEO_Data extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getAllCountries() {
        $query = $this->db->get('GEO_Countries');
        return $query->result();
    }

    public function getRegionsByCountry($data_country) {
        $this->db->where('country', $data_country["code"]);
        $query = $this->db->get('GEO_Regions');
        return $query->result();
    }

    public function getCitiesByRegionAndCountry($data) {
        $this->db->where('country', $data["code_country"]);
        $this->db->where('region', $data["code_region"]);
        $query = $this->db->get('GEO_Cities');
        return $query->result();
    }

}