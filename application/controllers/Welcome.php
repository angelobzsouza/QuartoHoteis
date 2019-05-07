<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model("Localizacao_model", "cidade");
	}

	public function index() {
		$data['estados'] = $this->cidade->readStates(); 
		$this->load->model('Quarto_model', 'quarto');
		$data['ultimos_quartos'] = $this->quarto->readLastQuartos(6);
		// Pega uma foto de cada quarto para ser a thumb
		foreach($data['ultimos_quartos'] as $quarto) {
			$quarto->Thumb = $this->quarto->buscaThumbQuarto($quarto->IDQuarto);
		}
		// Numero de quartos
		$data['qtde_quartos'] = $this->quarto->countQuartos();
		// Numero de hoteis
		$this->load->model('Hotel_model', 'hotel');
		$data['qtde_hoteis'] = $this->hotel->countHoteis();

		$data['title'] = "QuartoHoteis";
		$this->load->view('index.php', $data);
	}

	// Param: ID do estado
	// Return: Retorna as cidades como json para o ajax
	public function buscaCidades () {
		$estado_id = $this->input->post('estado_id');
		$cidades = $this->cidade->readCitiesByState($estado_id);
		echo json_encode($cidades);
	}
}