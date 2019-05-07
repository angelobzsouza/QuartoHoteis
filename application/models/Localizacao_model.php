<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Localizacao_model extends CI_Model {
	// Return: Array with all states
	public function readStates () {
		// Busca os estados
		return $this->db->get('Estados')->result();
	}

	// Param: State ID
	// Return:Array with all cities
	public function readCitiesByState ($state_id = NULL) {
		// Busca as cidades
		if ($state_id != NULL) {
			return $this->db->where('IDEstado', $state_id)->get("Cidades")->result();	
		}
		else {
			return false;
		}
	}

	public function getStateUf ($state_id = NULL) {
		// Query
		return $this->db->where("IDEstado", $state_id)->get("Estados")->row()->UF;
	}

	public function getCityName ($city_id = NULL) {
		// Query
		return $this->db->where("IDCidade", $city_id)->get("Cidades")->row()->NomeCidade;
	}
}
?>