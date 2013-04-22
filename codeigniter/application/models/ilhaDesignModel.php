<?php
class IlhaDesignModel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	public function getOficina()
	{
		$query = $this->db->get('oficina');
		return $query->result_array();
	}
	
	public function getTipoOficina()
	{
		$query = $this->db->get('tipooficina');
		return $query->result_array();
	}
	
	public function getLocais()
	{
		$query = $this->db->get('locais');
		return $query->result_array();
	}
	
	public function getInscricao()
	{
		$query = $this->db->get('inscricao');
		return $query->result_array();
	}
	
	public function getInscricaoNumeroTurma($numero, $turma)
	{
		
		$this->db->select('inscricao.*, oficina.*, tipooficina.*');
		$this->db->from('inscricao');
		$this->db->join('oficina', 'oficina.codOficina = inscricao.codOficina');
		$this->db->join('tipooficina', 'tipooficina.codTipoOficina = oficina.codTipoOficina');
		$this -> db -> where('turma', "$turma");
		$this -> db -> where('numAluno', "$numero");
		
		//select inscricao.*, oficina.*, tipooficina.* from inscricao join oficina ON oficina.codOficina = inscricao.codOficina join tipooficina ON tipooficina.codTipoOficina = oficina.codTipoOficina
		//where turma = "CMED" AND numAluno = "22"
		
		$query = $this->db->get();

		return $query->result_array();
	}
	
	public function getOficinasPorIdade($idade)
	{
	
		$this->db->select('oficina.*, tipooficina.*');
		$this->db->from('tipooficina');
		$this->db->join('oficina', 'oficina.codTipoOficina = tipooficina.codTipoOficina');
		$this -> db -> where('idadeInicial <=', $idade);
		$this -> db -> where('idadeFinal >=', $idade);
	
		$query = $this->db->get();
	
		return $query->result_array();	
	}
	
	public function existeNumeroTurma()
	{
	
		$this->db->select('*');
		$this->db->from('inscricao');
		$this -> db -> where('turma', $this->input->post('turma'));
		$this -> db -> where('numAluno', $this->input->post('numero'));
	
		$query = $this->db->get();
	
		if($query->num_rows() >= 1)
		{
			return true;
		}
		else
		{
			return false;
		}
	
	}
	
	public function getOficinaById($id)
	{
		$query = $this->db->get_where('oficina', array('codOficina' => $id));
		return $query->row_array();	
	}
	
	public function getTipoOficinaById($id)
	{
		$query = $this->db->get_where('tipooficina', array('codTipoOficina' => $id));
		return $query->row_array();
	}
	
	public function getLocaisById($id)
	{
		$query = $this->db->get_where('locais', array('codLocal' => $id));
		return $query->row_array();
	}
	
	public function getInscricaoById($id)
	{
		$query = $this->db->get_where('inscricao', array('codInscricao' => $id));
		return $query->row_array();
	}
	
	public function setLocal()
	{
		$data = array(
				'nome' => $this->input->post('nome'),
				'endereco' => $this->input->post('endereco'),
				'telefone' => $this->input->post('telefone'),
				'cidade' => $this->input->post('cidade'),
				'estado' => $this->input->post('estado'),
				'link' => $this->input->post('link')
		);
	
		return $this->db->insert('locais', $data);
	}
	
	public function setOficina()
	{
		$data = array(
				'codTipoOficina' => $this->input->post('tipooficina'),
				'codLocal' => $this->input->post('local'),
				'horaInicial' => $this->input->post('horaInicial'),
				'horaFinal' => $this->input->post('horaFinal'),
				'dia' => $this->input->post('dia'),
				'vagas' => $this->input->post('vagas'),
				'sala' => $this->input->post('sala')
		);
	
		return $this->db->insert('oficina', $data);
	}
	
	public function setTipoOficina()
	{
		$data = array(
				'oficineiro1' => $this->input->post('oficineiro1'),
				'oficineiro2' => $this->input->post('oficineiro2'),
				'oficineiro3' => $this->input->post('oficineiro3'),
				'oficineiro4' => $this->input->post('oficineiro4'),
				'oficineiro5' => $this->input->post('oficineiro5'),
				'idadeInicial' => $this->input->post('idadeInicial'),
				'idadeFinal' => $this->input->post('idadeFinal'),
				'titulo' => $this->input->post('titulo')
		);
	
		return $this->db->insert('tipooficina', $data);
	}
	
	public function setInscricao()
	{
		$data = array(
				'codOficina' => $this->input->post('oficina'),
				'numAluno' => $this->input->post('numeroAluno'),
				'idade' => $this->input->post('idade'),
				'aluno' => $this->input->post('aluno'),
				'turma' => $this->input->post('turmaAluno')

		);
	
		return $this->db->insert('inscricao', $data);
	}
	
	public function setInscricaoAluno($codOficina, $numero, $idade, $nome, $turma)
	{
		$data = array(
				'codOficina' => $codOficina,
				'numAluno' => $numero,
				'idade' => $idade,
				'aluno' => $nome,
				'turma' => $turma
		);
		
		return $this->db->insert('inscricao', $data);
	}
	
	public function removeInscricao($id)
	{
		// Produces:
		// DELETE FROM inscricao
		// WHERE id = $id
		$this->db->delete('inscricao', array('codInscricao' => $id));
	}
	
	public function removeTipoOficina($id)
	{

		$this->db->delete('tipooficina', array('codTipoOficina' => $id));
	}
	
	public function removeOficina($id)
	{

		$this->db->delete('oficina', array('codOficina' => $id));
	}
	
	public function removeLocal($id)
	{

		$this->db->delete('locais', array('codLocal' => $id));
	}
	
	public function updateInscricao($id)
	{
		$data = array(
				'codOficina' => $this->input->post('oficina'),
				'numAluno' => $this->input->post('numeroAluno'),
				'idade' => $this->input->post('idade'),
				'aluno' => $this->input->post('aluno'),
				'turma' => $this->input->post('turmaAluno'),
		);
		
		// Produces:
		// UPDATE table
		// SET title = '{$title}', name = '{$name}', date = '{$date}'
		// WHERE id = $id
		
		$this->db->where('codInscricao', $id);
		$this->db->update('inscricao', $data);
	}
	
	public function updateTipoOficina($id)
	{
		$data = array(
				'oficineiro1' => $this->input->post('oficineiro1'),
				'oficineiro2' => $this->input->post('oficineiro2'),
				'oficineiro3' => $this->input->post('oficineiro3'),
				'oficineiro4' => $this->input->post('oficineiro4'),
				'oficineiro5' => $this->input->post('oficineiro5'),
				'idadeInicial' => $this->input->post('idadeInicial'),
				'idadeFinal' => $this->input->post('idadeFinal'),
				'titulo' => $this->input->post('titulo')
		);
				
		$this->db->where('codTipoOficina', $id);
		$this->db->update('tipooficina', $data);
	}
	
	public function updateOficina($id)
	{
		$data = array(
				'codTipoOficina' => $this->input->post('tipooficina'),
				'codLocal' => $this->input->post('local'),
				'horaInicial' => $this->input->post('horaInicial'),
				'horaFinal' => $this->input->post('horaFinal'),
				'dia' => $this->input->post('dia'),
				'vagas' => $this->input->post('vagas'),
				'sala' => $this->input->post('sala')
		);
		
		$this->db->where('codOficina', $id);
		$this->db->update('oficina', $data);
	}
	
	public function updateOficinaVagas($id, $vagas)
	{
		$data = array(
				'vagas' => $vagas
		);
	
		$this->db->where('codOficina', $id);
		$this->db->update('oficina', $data);
	}
	
	public function updateLocal($id)
	{	
		$data = array(
				'nome' => $this->input->post('nome'),
				'endereco' => $this->input->post('endereco'),
				'telefone' => $this->input->post('telefone'),
				'cidade' => $this->input->post('cidade'),
				'estado' => $this->input->post('estado'),
				'link' => $this->input->post('link')
		);
		
		$this->db->where('codLocal', $id);
		$this->db->update('locais', $data);
	}
	
	public function login($username, $password)
	{
		$this -> db -> select('id, username, password');
		$this -> db -> from('usuarios');
		$this -> db -> where('username', $username);
		$this -> db -> where('password', MD5($password));
		$this -> db -> limit(1);
		
		$query = $this -> db -> get();
		if($query -> num_rows() == 1)
		{
			return $query->result();
		}
		else
		{
			return false;
		}
	}
	
	
}