<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Quarto_model extends CI_Model {

// Return: the last 6 quartos inseted in db
public function readLastQuartos ($qtde = NULL) {
	// Faz a busca
	return $this->db->limit($qtde)->order_by("IDQuarto", "DESC")->get('Quartos')->result();
}

// Return: int total of quartos
public function countQuartos () {
	// Conta as vagas
	return $this->db->count_all('Quartos');
}

// Param: Filters array
// Return: int "Quartos" number
public function contaQuartosComFiltros ($filtros = NULL) {
	$query = "SELECT count(IDQuarto) AS qtde_quartos FROM Quartos JOIN Hoteis ON Hoteis.IDHotel = Quartos.IDHotel";

	//Se tiver algum filtro, adiciona clausula WHERE 
	foreach($filtros as $filtro => $valor) {
		if($valor != NULL && $valor != "") {
			$query .= " WHERE ";
			break;
		}
	}
	// Adiciona cada um dos filtros exceto preco
	foreach($filtros as $filtro => $valor) {
		if($valor != "" && $filtro != "ValorMinimo" && $filtro != "ValorMaximo" && $filtro != "BuscaTexto") {
			$query .=  $filtro." = ".$valor." AND ";
		}
	}
	// Como a condição de filtro de preço é diferente, ela é adicionada a parte
	if ($filtros['ValorMinimo'] != "") {
		$query .=  "Preco >= ".$filtros['ValorMinimo']." AND ";
	}
	if ($filtros['ValorMaximo'] != "") {
		$query .=  "Preco <= ".$filtros['ValorMaximo']." AND ";
	}
	// Como a condição de texto também é diferente, adiciona a parte
	if ($filtros['BuscaTexto'] != "") {
		$query .=  "Hoteis.NomeHotel LIKE '%".$filtros['BuscaTexto']."%' OR Quartos.TituloQuarto LIKE '%".$filtros['BuscaTexto']."%' AND ";
	}
	// Se tiver algum filtro, remove o "AND" que é adicionado a mais no fim da String
	foreach($filtros as $filtro => $valor) {
		if($valor != NULL && $valor != "") {
			$query =  substr($query, 0, -5);
			break;
		}
	}	
	return $this->db->query($query)->row()->qtde_quartos;
}

// Busca os quartos da pagina 
public function readQuartosByPageFilter ($offset = NULL, $filtros = NULL) {
	$query = "SELECT * FROM Quartos JOIN Hoteis ON Hoteis.IDHotel = Quartos.IDHotel";

	//Se tiver algum filtro, adiciona clausula WHERE 
	foreach($filtros as $filtro => $valor) {
		if($valor != NULL && $valor != "") {
			$query .= " WHERE ";
			break;
		}
	}
	// Adiciona cada um dos filtros exceto preco
	foreach($filtros as $filtro => $valor) {
		if($valor != "" && $filtro != "ValorMinimo" && $filtro != "ValorMaximo" && $filtro != "BuscaTexto") {
			$query .=  $filtro." = ".$valor." AND ";
		}
	}
	// Como a condição de filtro de preço é diferente, ela é adicionada a parte
	if ($filtros['ValorMinimo'] != "") {
		$query .=  "Preco >= ".$filtros['ValorMinimo']." AND ";
	}
	if ($filtros['ValorMaximo'] != "") {
		$query .=  "Preco <= ".$filtros['ValorMaximo']." AND ";
	}
	// Como a condição de texto também é diferente, adiciona a parte
	if ($filtros['BuscaTexto'] != "") {
		$query .=  "Hoteis.NomeHotel LIKE '%".$filtros['BuscaTexto']."%' OR Quartos.TituloQuarto LIKE '%".$filtros['BuscaTexto']."%' AND ";
	}
	// Se tiver algum filtro, remove o "AND" que é adicionado a mais no fim da String
	foreach($filtros as $filtro => $valor) {
		if($valor != NULL && $valor != "") {
			$query =  substr($query, 0, -5);
			break;
		}
	}	
	$query .= " LIMIT 30";
	if(!empty($offset)) {
	 $query .= " OFFSET ".$offset;
	}
	return $this->db->query($query)->result();
}

// Busca os quartos da pagina 
public function readQuartosByPage ($offset = NULL) {
	$this->db->limit(30, $offset)->order_by("IDQuarto", "ASC");
	return $this->db->get('Quartos')->result();
}

// Param: Quarto ID
// Return: An object
public function read ($quarto_id = NULL) {
	// Busca Quarto
	return $this->db->where('IDQuarto', $quarto_id)->get('Quartos')->row();
}

// Param: Quarto ID
// Return: Array with all phtos name
public function buscaFotos ($quarto_id = NULL) {
	// Busca fotos
	return $this->db->where('IDQuarto', $quarto_id)->get('FotosQuarto')->result();
}

// Param: Id do quarto
// Return: Bool
public function limpaFotos ($quarto_id = NULL) {
	$fotos = $this->db->where("IDQuarto", $quarto_id)->get('FotosQuarto')->result();
	// Percorre todas as fotos cadastradas e exclui, retornando falso caso alguma de errado
	foreach($fotos as $foto) {
		if(!unlink(FCPATH.'assets/uploads/'.$foto->Foto)) {
			return false;
		}
	}
	// Csao tudo tenha funcionado, retorna true
	return true;
}


// Param: Quarto ID
// Return: string Thumbnail
public function buscaThumbQuarto ($quarto_id = NULL) {
	// Busca
	$thumb = $this->db->select("Foto")->where("IDQuarto", $quarto_id)->get('FotosQuarto')->row();
	if ($thumb) {
		return $thumb->Foto;
	}
	else {
		return NULL;
	}
}

// Param: Quarto e fotos
// Return: Bool with answer
public function create ($quarto = NULL, $fotos = NULL) {
	// Tipo quarto: 0 standard, 1 superior, 2 deluxe
	$query = "INSERT INTO Quartos  (IDHotel, Preco, DescricaoQuarto, TipoQuarto, SalvoEm, TituloQuarto)
						VALUES (?, ?, ?, ?, NOW(), ?)";
	$ok = $this->db->query($query, array($this->session->hotel_id, $quarto['valor'], $quarto['descricao'], $quarto['tipo'], $quarto['titulo']));
	$quarto_id = $this->db->insert_id();
	foreach ($fotos as $foto) {
		$query = 'INSERT INTO FotosQuarto VALUES (default, ?, ?)';
		$ok = $this->db->query($query, array($quarto_id, $foto));
	}
	return $ok;
}

// Param: Quarto e os nomes dos arquivos das fotos
// Return Bool with answer
public function update ($quarto = NULL, $fotos = NULL) {
	$query = "UPDATE Quartos 
						SET Preco = ?,
								DescricaoQuarto = ?,
								TipoQuarto = ?,
								SalvoEm = NOW(),
								TituloQuarto = ?
						WHERE IDQuarto = ?";
	if (!$this->db->query($query, array($quarto['valor'], $quarto['descricao'], $quarto['tipo'], $quarto['titulo'], $quarto['quarto_id']))) {
		return false;
	}
	if (!empty($fotos)) {
		foreach($fotos as $foto) {
			// Se for edição, busca o id da foto para atualizar o nome
			if ($this->db->where('Foto', $foto)->count_all_results('FotosQuarto') > 0) {
				$foto_id = $this->db->select('IDFoto')->where("Foto", $foto)->get('FotosQuarto')->row()->IDFoto;
				$query = "UPDATE FotosQuarto
									SET Foto = ?
									WHERE IDFoto = ?";
				//Tenta fazer o update, retorna falso caso de errado 
				if(!$this->db->query($query, array($foto, $foto_id))) {
					return false;
				}
			}
			// Se for adicionar uma nova foto, é só adicionar
			else {
				$query = "INSERT INTO FotosQuarto (IDQuarto, Foto)
									VALUES (?, ?)";
				if(!$this->db->query($query, array($quarto['quarto_id'], $foto))) {
					return false;
				}
			}
		}
	}
	return true;
}

// Param: ID da quarto
// Return: Bool
public function delete ($quarto_id = NULL) {
	// Deleta a quarto
	return $this->db->where('IDQuarto', $quarto_id)->delete('Quartos');
}

// Param: $reserva
// Return: Bool
public function storeReserva ($reserva = NULL) {
	// Vetor de validação
	$validacao = [
		$reserva['DataInicial'],
		$reserva['DataFinal'],
		$reserva['DataInicial'],
		$reserva['DataFinal'],
		$reserva['DataInicial'],
		$reserva['DataFinal'],
		$reserva['DataInicial'],
		$reserva['HoraEntrada']
	];

	// Verifica se o horario está disponível
	$horario = $this->db->query("
		SELECT *
		FROM Reservas
		WHERE DataInicial BETWEEN ? AND ?
		OR (DataFinal BETWEEN ? AND ? AND DataFinal <> ? AND DataFinal <> ?)
		OR (DataFinal = ? AND HoraSaida >= ?)
	", $validacao)->result();

	if (empty($horario)) {
		return $this->db->query("
			INSERT INTO Reservas (IDQuarto, DataInicial, HoraEntrada, DataFinal, HoraSaida, NomeCliente, EmailCliente, QuantidadePessoas)
			VALUES (?, ?, TIME(?), ?, TIME(?), ?, ?, ?)
		", $reserva);
	}
	else {
		return false;
	}
}

}
?>