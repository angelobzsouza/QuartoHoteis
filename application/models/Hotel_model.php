<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hotel_model extends CI_Model {
	// Param: Hotel ID
	// Return: An object
	public function read ($hotel_id = NULL) {
		// Busca Hotel
		return $this->db->where('IDHotel', $hotel_id)->get('Hoteis')->row();
	}

	// Return: int numero de hoteis
	public function countHoteis () {
		// Conta os hoteis
		return $this->db->count_all('Hoteis');
	}

	// Param: Hotel
	// Return: Object id
	public function create ($hotel = NULL) {
		$this->db->insert('Hoteis', $hotel);
		return $this->db->insert_id();
	}

	// Param: Hotel e um array com os nomes dos arquivos das fotos do hotel
	// Return Bool with answer
	public function update ($hotel = NULL, $fotos = NULL) {
		$ta_ok = true;
		// Só altera o nome das fotos no banco caso elas tenham sido alteradas
		if ($hotel['logo'] != "") {
			$query = "UPDATE Hoteis SET Logo = ? WHERE IDHotel = ?";
			$ta_ok = $this->db->query($query, array($hotel['logo'], $hotel['IDHotel']));
		}
		if (!$ta_ok) {
			return false;
		}
		if ($hotel['foto_capa'] != "") {
			$query = "UPDATE Hoteis SET FotoCapa = ? WHERE IDHotel = ?";
			$ta_ok = $this->db->query($query, array($hotel['foto_capa'], $hotel['IDHotel']));
		}
		if (!$ta_ok) {
			return false;
		}

		$query = "UPDATE Hoteis
							SET NomeHotel = ?,
									DescricaoHotel = ?,
									CEP = ?,
									Bairro = ?,
									Rua = ?,
									Numero = ?,
									Complemento = ?,
									IDEstado = ?,
									IDCidade = ?,
									Telefone = ?,
									Estrelas = ?
							WHERE IDHotel = ?";

		$ta_ok = $this->db->query($query, array(
			$hotel['NomeHotel'],
			$hotel['descricao'],
			$hotel['CEP'],
			$hotel['Bairro'],
			$hotel['Rua'],
			$hotel['Numero'],
			$hotel['Complemento'],
			$hotel['IDEstado'],
			$hotel['IDCidade'],
			$hotel['telefone'],
			$hotel['estrelas'],
			$hotel['IDHotel'],
		));
		if (!$ta_ok) {
			return false;
		}
		if (!empty($fotos)) {
			foreach($fotos as $foto) {
				// Se for edição, busca o id da foto para atualizar o nome
				if ($this->db->where('Foto', $foto)->count_all_results('FotosHotel') > 0) {
					$foto_id = $this->db->select('IDFoto')->where("Foto", $foto)->get('FotosHotel')->row()->IDFoto;
					$query = "UPDATE FotosHotel
										SET Foto = ?
										WHERE IDFoto = ?";
					$ta_ok = $this->db->query($query, array($foto, $foto_id));
				}
				else {
					$query = "INSERT INTO FotosHotel (IDHotel, Foto)
										VALUES (?, ?)";
					$ta_ok = $this->db->query($query, array($hotel['IDHotel'], $foto));
				}
			}
		}

		return $ta_ok;
	}

	// Param: ID do hotel
	// Return: Array de objetos com as fotos do hotel
	public function buscaFotosDoHotel ($hotel_id = NULL) {
		// Busca Fotos
		return $this->db->where('IDHotel', $hotel_id)->order_by('IDFoto', 'DESC')->get('FotosHotel')->result();
	}

	// Param: ID do hotel
	// Return: Array de objetos com os quartos do hotel
	public function buscaQuartosDoHotel ($hotel_id = NULL) {
		// Busca Fotos
		return $this->db->where('IDHotel', $hotel_id)->get('Quartos')->result();
	}
}
?>