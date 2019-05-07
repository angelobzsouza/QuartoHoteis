<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Credenciais extends CI_Controller {

	function __construct() {
		parent::__construct();
		$this->load->model('Credentials_model', 'credencial');
	}

	public function index() {
		redirect(base_url(''));
	}

	//Return: A view de login
	public function loginView () {
		$this->load->view('login');
	}

	// Param: Email e senha
	// Return: Profile Page
	public function login () {
		$this->form_validation->set_rules("email", "Email", "required|valid_email");
		$this->form_validation->set_rules("senha", "Senha", "required|max_length[50]");
		// Se a validação der certo, loga
		if ($this->form_validation->run('form_login')) {
			$email = $this->input->post('email');
			$senha = sha1($this->input->post('senha'));
			// Param: Email e senha
			// Return: 1 - Logou/2 - Usuário não econtrado/3 - Senha Incorreta
			$resposta = $this->credencial->login($email, $senha);

			if ($resposta == 1) {
				redirect(base_url('hotel/'.$this->session->hotel_id));
			}
			else if ($resposta == 2) {
				$this->load->view('login', ['invalid_email' => true]);
			}
			else if ($resposta == 3) {
				$this->load->view('login', ['wrong_password' => true]);
			}
		}
		else {
			$this->load->view('errors/QuartoHoteis_errors/error_general');
		}
	}

	// Return: Home page
	public function logout() {
		$this->session->sess_destroy();
		redirect(base_url());
	}
 
	// Param: Usuário por POST
	// Return: Da um echo para a requisão se o usuário está no banco ou não
	public function existEmail () {
		$email = $this->input->post('email');
		echo $this->credencial->existEmail($email);
	}
}