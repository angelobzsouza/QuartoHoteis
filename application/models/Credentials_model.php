<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credentials_model extends CI_Model {
	// Param: string $email
	// Return: Bool if user exist in db or not
	public function existEmail ($email = NULL) {
		if ($this->db->where("EmailResponsavel", $email)->count_all_results('Hoteis') > 0) {
			return 1;
		}
		else {
			return 0;
		}
	}

	// Param: Email and password
	// Return: 1 - Ok/2 - Email dosn't exist/3 - Wrong password
	public function login ($email = NULL, $password = NULL) {
		if (!$this->db->where("EmailResponsavel", $email)->count_all_results('Hoteis') > 0) {
			return 2;
		}
		else if (!$this->db->where("EmailResponsavel", $email)->where("Senha", $password)->count_all_results('Hoteis') > 0) {
			return 3;
		}
		else {
			$user = $this->db->where("EmailResponsavel", $email)->where("Senha", $password)->get('Hoteis')->row();
			// Star session
			$this->session->login = true;
			$this->session->user = $user->NomeHotel;
			$this->session->foto_hotel = $user->Logo;
			$this->session->foto_capa = $user->FotoCapa;
			$this->session->hotel_id = $user->IDHotel;

			return 1;
		}
	}
}
?>