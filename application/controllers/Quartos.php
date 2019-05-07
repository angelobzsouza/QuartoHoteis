<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quartos extends CI_Controller {

function __construct() {
	parent::__construct();
	$this->load->model("Quarto_model", "quarto");
}

public function index() {

}


// Retorno: View do quarto
public function quarto ($quarto_id = NULL) {
	$this->load->model("Hotel_model", "hotel");

	$data['quarto'] = $this->quarto->read($quarto_id);
	$data['fotos'] = $this->quarto->buscaFotos($quarto_id);
	$data['hotel'] = $this->hotel->read($data['quarto']->IDHotel);
	$data['title'] = "Quarto do ".$data['hotel']->NomeHotel;

	$this->load->view('quarto', $data);
}

// CRUD
// Retorno: Tela do cadastro de quartos
public function createView () {
	// Para cadastrar deve estar logado
	if (!$this->session->login) {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return false;
	}
	$this->load->view('create_quarto', ['title' => 'Novo Quarto']);
}

// Parametros: Infos do cadastro por POST
// Retorno: Vai para  a tela de perfil
public function create () {
	// Validação dos campos simples
	$this->form_validation->set_rules('titulo', "Titulo", "required|max_length[100]");
	$this->form_validation->set_rules('valor', "Valor", "required|numeric");
	$this->form_validation->set_rules('tipo', "Tipo", "required");
	$this->form_validation->set_rules('descricao', "Descricao", "required|max_length[400]|min_length[70]");

	$quarto['titulo'] = $this->input->post('titulo');
	$quarto['tipo'] = $this->input->post('tipo');
	$quarto['valor'] = $this->input->post('valor');
	$quarto['descricao'] = $this->input->post('descricao');

	// Se a validação der certo, vai para o upload de imagens
	if($this->form_validation->run('form_create_vaga')) {
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
				$this->load->view('create_quarto', ["erro" => true, "title" => "Novo Quarto"]);
				return;	
			}
		}

		$this->load->model("Image_model", "image");

		// Vetor para armazenar os nomes das fotos da rep
		$nomes_fotos = NULL;
		// Upload das fotos da rep
		for($i = 0; $i < 6; $i++) {
			$file_name = false;
			if ($_FILES['input_'.$i]['size'] > 0) {
				$file_name = $this->image->uploadImages("FotosQuarto", "Foto", $i, $this->input->post('arquivo_'.$i));
			}
			if ($file_name) {
				$nomes_fotos[$i] = $file_name;
			}
		}

		// Se os uploads deram certo
		if (!$this->quarto->create($quarto, $nomes_fotos)) {
			$this->load->view('errors/QuartoHoteis_errors/error_general');
			return;	
		}
	}
	else {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return;
	}
	redirect(base_url('hotel/'.$this->session->hotel_id));
}

// Parametros: Id do quarto por GET
// Retorno: Tela de edição
public function updateView ($quarto_id = NULL) {
	// Verifica se o usuário é o dono do quarto
	$data['quarto'] = $this->quarto->read($quarto_id);
	if ($this->session->hotel_id != $data['quarto']->IDHotel) {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return false;
	}
	// Busca as infos do quarto
	$data['fotos'] = $this->quarto->buscaFotos($quarto_id);
	$data['title'] = "Editar Quarto";
	// Chama a tela com as infos
	$this->load->view('update_quarto', $data);
}

// Parametros: Infos do Quarto por POST
// Retorno: Página de perfil do Hotel
public function update () {
	// Verifica se o usuário é o dono do quarto
	$data['quarto'] = $this->quarto->read($this->input->post('quarto_id'));
	if ($this->session->hotel_id != $data['quarto']->IDHotel) {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return false;
	}
	// Valida o formulário
	$this->form_validation->set_rules('titulo', "Titulo", "required|max_length[100]");
	$this->form_validation->set_rules('valor', "Valor", "required|numeric");
	$this->form_validation->set_rules('tipo', "Tipo", "required");
	$this->form_validation->set_rules('descricao', "Descricao", "required|max_length[400]|min_length[70]");

	// Obtem as informações
	$quarto['quarto_id'] = $this->input->post('quarto_id');
	$quarto['titulo'] = $this->input->post('titulo');
	$quarto['tipo'] = $this->input->post('tipo');
	$quarto['valor'] = $this->input->post('valor');
	$quarto['descricao'] = $this->input->post('descricao');

	// Se o formulário estiver correto
	if ($this->form_validation->run('form_update_quarto')) {
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

		// Upload das imagens, excluido os arquivos do banco caso estejam sendo substituidos
		$this->load->model("Image_model", "image");
		// Vetor para armazenar os nomes das fotos da rep
		$nomes_fotos = NULL;
		// Upload das fotos do quarto
		for($i = 0; $i < 6; $i++) {
			$file_name = false;
			if ($_FILES['input_'.$i]['size'] > 0) {
				$file_name = $this->image->uploadImages("FotosQuarto", "Foto", $i, $this->input->post('arquivo_'.$i));
			}
			if ($file_name) {
				$nomes_fotos[$i] = $file_name;
			}
		}
		// Salva os dados no banco
		if ($this->quarto->update($quarto, $nomes_fotos)) {
			// Redireciona para a página de perfil do hotel
			redirect(base_url('hotel/'.$this->session->hotel_id));
		}
		// Caso o armazenamento no banco tenha dado errado
		else {
			$this->load->view('errors/QuartoHoteis_errors/error_general');
			return false;
		}
	}
	// Se a validação do formulário der errado
	else {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return false;
	}
}

// Parametros: ID da quarto por GET
// Return: Bool para a requisição
public function delete ($quarto_id = NULL) {
	// Busca o quarto para verificar a permissão do hotel
	$quarto = $this->quarto->read($quarto_id);
	// Caso haja algum problema encerra o processo
	if ($this->session->hotel_id != $quarto->IDHotel) {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return false;
	}
	// Apaga os arquivos das fotos do quarto na pasta uploads
	$resposta = $this->quarto->limpaFotos($quarto_id);
	// Apaga o quarto (O banco apaga as fotos do quarto na tabela automaticamente por cascadae)
	$reposta = $this->quarto->delete($quarto_id);
	if ($resposta) {
		redirect(base_url('hotel/'.$this->session->hotel_id));
	}
	else {
		$this->load->view('errors/QuartoHoteis_errors/error_general');
		return false;
	}
}

// Parâmetros: Data e horario de entrada e saida, email, nome e quantidade de pessoas por post
// Return: Bool para a requisição
public function reserva () {
	// Recebe os dados
	$reserva['IDQuarto'] = $this->input->post('quarto_id');
	$reserva['DataInical'] = $this->input->post('data_entrada');
	$reserva['HoraEntrada'] = $this->input->post('hora_entrada');
	$reserva['DataFinal'] = $this->input->post('data_saida');
	$reserva['HoraSaida'] = $this->input->post('hora_saida');
	$reserva['NomeCliente'] = $this->input->post('nome');
	$reserva['EmailCliente'] = $this->input->post('email');
	$reserva['QuantidadePessoas'] = $this->input->post('quantidade_pessoas');

	// Salva no banco e retorna o resultado da operação
	echo $this->quarto->storeReserva($reserva);
}

}