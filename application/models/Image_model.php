<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Image_model extends CI_Model {
	// Carrega e configura a biblioteca, faz o upload e em caso de sucesso exlui o arquivo antigo ou em caso de falha retorna false
	public function uploadImage($table = NULL, $image_column = NULL, $input_name = NULL, $row_id = -1) {
		// Configura a biblioteca de upload
		$config['upload_path'] = FCPATH.'assets/uploads';
		$config['allowed_types'] = "png|jpg|jpeg";
		$config['max_size'] = 2048000;
		$config['max_width'] = 1920;
		$config['max_height'] = 1920;
		$config['encrypt_name'] = TRUE;

		// Carrega a biblioteca
		$this->upload->initialize($config, TRUE);

		// Faz o upload do arquivo
		if ($this->upload->do_upload($input_name)) {
			// Se for atualização apaga o arquivo antigo
			$arquivo_antigo = @$this->db->query("SELECT ".$image_column." FROM ".$table." WHERE IDHotel = ".$row_id)->row()->$image_column;
			if (!empty($arquivo_antigo)) {
				// Tenta exluir e caso não consiga retorna erro
				if(!unlink(FCPATH.'assets/uploads/'.$arquivo_antigo)) {	
					return false;
				}
			}


			// Retorna o nome do arquivo
			$info_arquivo = $this->upload->data();
			$nome_arquivo = $info_arquivo['file_name'];
			return $nome_arquivo;
		}
		else {
			return false;
		}
	}

	// Carrega e configura a biblioteca, faz o upload e em caso de sucesso exlui o arquivo antigo ou em caso de falha retorna false
	public function uploadImages($table = NULL, $image_column = NULL, $indice = NULL, $arquivo_antigo = "") {
		// Configura a biblioteca de upload
		$config['upload_path'] = FCPATH.'assets/uploads';
		$config['allowed_types'] = "png|jpg|jpeg";
		$config['max_size'] = 2048000;
		$config['max_width'] = 1920;
		$config['max_height'] = 1920;
		$config['encrypt_name'] = TRUE;

		// Carrega a biblioteca
		$this->upload->initialize($config, TRUE);

		// Se o arquiov antigo não for nulo, delete o arquivo na pasta upload e o banco
		if ($arquivo_antigo != "") {
			// Exclui na pasta de uploads
			if(!unlink(FCPATH.'assets/uploads/'.$arquivo_antigo)) {	
				return false;
			}
			else {
				if(!$this->db->where('Foto', $arquivo_antigo)->delete($table)) {
					return false;
				}
			}
		}

		// Faz o upload do arquivo
		if ($this->upload->do_upload('input_'.$indice)) {
			// Retorna o nome do arquivo
			$info_arquivo = $this->upload->data();
			$nome_arquivo = $info_arquivo['file_name'];
			return $nome_arquivo;
		}
		else {
			return false;
		}
	}


	public function updateImageName ($table = NULL, $image_column = NULL, $row_id = -1, $image_name = NULL) {
		return $this->db->query("
			UPDATE ".$table."
			SET ".$image_column." = '".$image_name."'
			WHERE ID = ".$row_id
		);
	}
}
?>