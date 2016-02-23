<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class M_GEO_Data extends CI_Model{

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function getCountryByCode($code_country) {
        $this->db->where('code', $code_country);
        $this->db->order_by("name", "asc");
        $query = $this->db->get('GEO_Countries');
        return $query->result();
    }

    public function getAllCountries() {
        $this->db->order_by("name", "asc");
        $query = $this->db->get('GEO_Countries');
        return $query->result();
    }

    public function getRegionByCodeAndCountry($data) {
        $this->db->order_by("name", "asc");
        $this->db->where('country', $data["code_country"]);
        $this->db->where('code', $data["code_region"]);
        $query = $this->db->get('GEO_Regions');
        return $query->result();
    }

    public function getRegionsByCountry($code_country) {
        $this->db->order_by("name", "asc");
        $this->db->where('country', $code_country);
        $query = $this->db->get('GEO_Regions');
        return $query->result();
    }

    public function getCityByIDAndRegionAndCountry($data) {
        $this->db->order_by("name", "asc");
        $this->db->where('name !=', '');
        $this->db->where('ID', $data["id_city"]);
        $this->db->where('country', $data["code_country"]);
        $this->db->where('region', $data["code_region"]);
        $query = $this->db->get('GEO_Cities');
        return $query->result();
    }

    public function getCitiesByRegionAndCountry($data) {
        $this->db->order_by("name", "asc");
        $this->db->where('name !=', '');
        $this->db->where('country', $data["code_country"]);
        $this->db->where('region', $data["code_region"]);
        $query = $this->db->get('GEO_Cities');
        return $query->result();
    }
}