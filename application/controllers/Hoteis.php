<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hoteis extends CI_Controller {

function __construct() {
	parent::__construct();
	$this->load->model('Hotel_model', 'hotel');
}

public function index() {
	redirect(base_url());
}

// Retorno: Tela de perfil do hotel
public function hotel ($hotel_id = NULL) {
	$this->load->model("Localizacao_model", "localizacao");
	// Busca hotel
	$data['hotel'] = $this->hotel->read($hotel_id);
	$data['estado'] = $this->localizacao->getStateUf($data['hotel']->IDEstado);
	$data['cidade'] = $this->localizacao->getCityName($data['hotel']->IDCidade);
	$data['fotos'] = $this->hotel->buscaFotosDoHotel($hotel_id);
	$data['quartos'] = $this->hotel->buscaQuartosDoHotel($hotel_id);
	$data['title'] = $data['hotel']->NomeHotel;
	// Chama view
	$this->load->view('hotel', $data);
}

// CRUD
// Retorno: Tela do cadastro de hoteis
public function createView () {
	// Busca os estados
	$this->load->model('Localizacao_model', 'estados');
	$data['estados'] = $this->estados->readStates();
	$data['title'] = "Cadastrar";
	$this->load->view('create_hotel', $data);
}

// Parametros: Infos do cadastro por POST
// Retorno: Vai para  a tela de perfil
public function create () {
	// Validação
	$this->form_validation->set_rules('nome_hotel', "Nome do Hotel", "required|max_length[50]");
	$this->form_validation->set_rules('email', "Email do Responsável", "required|valid_email");
	$this->form_validation->set_rules('senha', "Senha", "required|max_length[50]|min_length[8]|matches[senha]");
	$this->form_validation->set_rules('senha2', "Confirmação de Senha", "required|max_length[50]|min_length[8]");
	$this->form_validation->set_rules('cep', "CEP", "required|max_length[9]");
	$this->form_validation->set_rules('estrelas', "Estrelas", "required|numeric");
	$this->form_validation->set_rules('telefone', "Telefone", "required|max_length[15]");
	$this->form_validation->set_rules('estado', "Estado", "required");
	$this->form_validation->set_rules('cidade', "Cidade", "required");
	$this->form_validation->set_rules('bairro', 'Bairro', "max_length[100]");
	$this->form_validation->set_rules('rua', 'Rua', "max_length[200]|required");
	$this->form_validation->set_rules('numero', 'Numero', "max_length[10]");
	$this->form_validation->set_rules('complemento', 'Complemento', "max_length[50]");

	// Pega as variáveis
	$hotel['NomeHotel'] = $this->input->post('nome_hotel');
	$hotel['EmailResponsavel'] = $this->input->post('email');
	$hotel['Senha'] = sha1($this->input->post('senha'));
	$hotel['CEP'] = $this->input->post('cep');
	$hotel['IDEstado'] = $this->input->post('estado');
	$hotel['IDCidade'] = $this->input->post('cidade');
	$hotel['Bairro'] = $this->input->post('bairro');
	$hotel['Rua'] = $this->input->post('rua');
	$hotel['Numero'] = $this->input->post('numero');
	$hotel['Complemento'] = $this->input->post('complemento');
	$hotel['Telefone'] = $this->input->post('telefone');
	$hotel['Estrelas'] = $this->input->post('estrelas');

	// Se a validação der certo cadastra, se não, vai para a tela de erro
	if($this->form_validation->run('form_cadastro')) {
		$hotel_id = $this->hotel->create($hotel);
		$this->load->model("Credentials_model", "credencial");
		$this->credencial->login($hotel['EmailResponsavel'], $hotel['Senha']);
	}
	else {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return;
	}
	redirect(base_url('hotel/'.$hotel_id));
}

// Parametros: Id do hotel por GET
// Retorno: Tela de edição
public function updateView ($hotel_id = NULL, $erro = NULL) {
	// Verifica se o hotel é o mesmo que fez o login
	if ($hotel_id != $this->session->hotel_id) {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return false;
	}

	// Busca Hotel
	$data['hotel'] = $this->hotel->read($hotel_id);
	$data['fotos'] = $this->hotel->buscaFotosDoHotel($hotel_id);
	$this->load->model('Localizacao_model', 'estados');
	$data['estados'] = $this->estados->readStates();
	$data['cidades'] = $this->estados->readCitiesByState($data['hotel']->IDEstado);
	$data['title'] = "Editar Perfil";
	if (!empty($erro)) $data['erro'] = true;

	$this->load->view('update_hotel', $data);
}

// Parametros: Infos do hotel por POST
// Retorno: Página de perfil
public function update () {
	// Verifica se o hotel é dono do perfil de edição
	if ($this->input->post('hotel_id') != $this->session->hotel_id) {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return false;
	}

	// Valida o forms
	// Validação
	$this->form_validation->set_rules('nome_hotel', "Nome do Hotel", "required|max_length[50]");
	$this->form_validation->set_rules('cep', "CEP", "required|max_length[9]");
	$this->form_validation->set_rules('estado', "Estado", "required");
	$this->form_validation->set_rules('cidade', "Cidade", "required");
	$this->form_validation->set_rules('bairro', 'Bairro', "max_length[100]");
	$this->form_validation->set_rules('rua', 'Rua', "max_length[200]|required");
	$this->form_validation->set_rules('numero', 'Numero', "max_length[10]");
	$this->form_validation->set_rules('complemento', 'Complemento', "max_length[50]");
	$this->form_validation->set_rules('telefone', 'Telefone', "required|max_length[15]");
	$this->form_validation->set_rules('estrelas', 'Estrelas', "numeric|required");
	$this->form_validation->set_rules('descricao', 'Descricao', "max_length[2000]");

	// Recebe as variáveis por post
	$hotel['IDHotel'] = $this->input->post('hotel_id');
	$hotel['NomeHotel'] = $this->input->post('nome_hotel');
	$hotel['CEP'] = $this->input->post('cep');
	$hotel['IDEstado'] = $this->input->post('estado');
	$hotel['IDCidade'] = $this->input->post('cidade');
	$hotel['Bairro'] = $this->input->post('bairro');
	$hotel['Rua'] = $this->input->post('rua');
	$hotel['Numero'] = $this->input->post('numero');
	$hotel['Complemento'] = $this->input->post('complemento');
	$hotel['telefone'] = $this->input->post('telefone');
	$hotel['estrelas'] = $this->input->post('estrelas');
	$hotel['descricao'] = $this->input->post('descricao');
	$hotel['logo'] = "";
	$hotel['foto_capa'] = "";

	// Se a validação der certo, começa a validação de imagem
	if($this->form_validation->run('form_update_perfil')) {
		// Verifica tamanho, formato e dimensões das imagens antes de fazer o upload
		for ($i = 0; $i < 6 && $_FILES['input_'.$i]['size'] != 0; $i++) {
			$input_name = "input_".$i;
			// Pegando as dimensões
			$image_info = getimagesize($_FILES[$input_name]["tmp_name"]);
			$width = $image_info[0];
			$height = $image_info[1];
			$size = $_FILES[$input_name]['size'];
			$format = substr($_FILES[$input_name]['type'], 6);
			if ($width > 1920 || $height > 1920 || $size > 2048000 || ($format != 'png' && $format != 'jpg' && $format != 'jpeg')) {
				// Caso de algum erro
				redirect(base_url('editar-perfil/'.$hotel['IDHotel']."/1"));
			}
		}



		$this->load->model("Image_model", "image");
		// Upload da foto de perfil
		if ($_FILES['logo']['size'] > 0 && $_FILES['logo']['size'] < 2048000) {
			$hotel['logo'] = $this->image->uploadImage("Hoteis", "Logo", "logo", $this->session->hotel_id);
			if (!$hotel['logo']) {
				redirect(base_url('editar-perfil/'.$hotel['IDHotel']."/1"));
			}
		}
		// Upload da foto de capa
		if ($_FILES['foto_capa']['size'] > 0 && $_FILES['foto_capa']['size'] < 2048000) {
			$hotel['foto_capa'] = $this->image->uploadImage("Hoteis", "FotoCapa", 'foto_capa', $this->session->hotel_id);
			if (!$hotel['foto_capa']) {
				redirect(base_url('editar-perfil/'.$hotel['IDHotel']."/1"));	
			}
		}

		// Vetor para armazenar os nomes das fotos do hotel
		$nomes_fotos = NULL;
		// Upload das fotos do hotel
		for($i = 0; $i < 6; $i++) {
			$file_name = false;
			if ($_FILES['input_'.$i]['size'] > 0) {
				$file_name = $this->image->uploadImages("FotosHotel", "Foto", $i, $this->input->post('arquivo_'.$i));
			}
			if ($file_name) {
				$nomes_fotos[$i] = $file_name;
			}
		}

		// Se todos os uploads deram certo, salva as infos no banco
		if($this->hotel->update($hotel, $nomes_fotos)) {
			// if ($hotel['foto_perfil'] != "") {
				$this->session->foto_hotel = $hotel['logo'];
			// }
			redirect(base_url('hotel/'.$hotel['IDHotel']));
		}
		else {
			$this->load->view('errors/QuartoHoteis_errors/error_general');
			return;
		}
	}
	else {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return;
	}
}

}