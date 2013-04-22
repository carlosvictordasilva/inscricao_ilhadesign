<script type="text/javascript">
    function horarioSobreposto() {
    	var msg = "Conflito de Horário";
    	alert(msg);
    }
    function semVagas() {
        var msg = "As vagas dessa oficina acabaram!";
        alert(msg);
    }
</script>
<?php
session_start(); //we need to call PHP's session object to access it through CI
class IlhaDesignController extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('ilhaDesignModel');
	}

	public function index()
	{
		$data['title'] = 'Ilha Design - Procurar Aluno';
		
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		$this->load->view('templates/header', $data);
		$this->load->view('ilhadesign/alunos/procuraAluno', $data);
		$this->load->view('templates/footer', $data);
		
	}
	
	public function verificaAluno()
	{
		$this->load->library('form_validation');
	
		$this->form_validation->set_rules('numero', 'Número do Aluno', 'required|is_natural_no_zero|less_than[100]');
		$this->form_validation->set_rules('turma', 'Turma do Aluno', 'required|min_length[1]|max_length[10]');
	
		if($this->form_validation->run() == FALSE)
		{
			//Título da Página
			$data['title'] = 'Ilha Design - Procurar Aluno';
	
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/alunos/procuraAluno', $data);
			$this->load->view('templates/footer');
		}
		else
		{
			$existeAluno = $this->ilhaDesignModel->existeNumeroTurma();
			if($existeAluno)
			{//Aluno já cadastrado
				$data['inscricoes'] = $this->ilhaDesignModel->getInscricaoNumeroTurma($this->input->post('numero'), $this->input->post('turma'));
				$data['oficinas'] = $this->ilhaDesignModel->getOficinasPorIdade($data['inscricoes'][0]['idade']);
				$data['title'] = 'Ilha Design - Inscrição em Oficinas';
				
				$data['numero'] = $this->input->post('numero');
				$data['turma'] =  $this->input->post('turma');
				$data['nome'] =  $data['inscricoes'][0]['aluno'];
				$data['idade'] =  $data['inscricoes'][0]['idade'];
				
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/alunos/escolheOficinas', $data);
				$this->load->view('templates/footer');
			}else{
				$data['title'] = 'Ilha Design - Inscrição de Novo Aluno';
				$data['numero'] =  $this->input->post('numero');
				$data['turma'] =  $this->input->post('turma');
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/alunos/novoAluno', $data);
				$this->load->view('templates/footer');
			}
		}
	}
	
	public function novoAluno()
	{
		$this->load->helper('form');
		$this->load->library('form_validation');
		
		//Título da Página
		$data['title'] = 'Escolhendo Oficinas';
		
		$this->form_validation->set_rules('aluno', 'Nome do Aluno', 'required|min_length[7]|max_length[100]');
		$this->form_validation->set_rules('numero', 'Número do Aluno', 'required|is_natural_no_zero|less_than[100]');
		$this->form_validation->set_rules('turma', 'Turma do Aluno', 'required|min_length[1]|max_length[10]');
		$this->form_validation->set_rules('idade', 'Idade', 'required|is_natural_no_zero|less_than[100]');
		
		if ($this->form_validation->run() === FALSE)
		{
			$data['numero'] =  $this->input->post('numero');
			$data['turma'] =  $this->input->post('turma');
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/alunos/novoAluno', $data);
			$this->load->view('templates/footer');
		
		}
		else
		{
			$data['oficinas'] =$this->ilhaDesignModel->getOficinasPorIdade($this->input->post('idade'));
			$data['numero'] =  $this->input->post('numero');
			$data['turma'] =  $this->input->post('turma');
			$data['nome'] =  $this->input->post('aluno');
			$data['idade'] =  $this->input->post('idade');
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/alunos/escolheOficinas', $data);
			$this->load->view('templates/footer');
		}
	}
	
	public function inscricaoAluno($codOficina, $numero, $idade, $nome, $turma)
	{
		$oficina = $this->ilhaDesignModel->getOficinaById($codOficina);
		if ( $oficina['vagas'] >= 1 ){
			
			if (!( $this->conflitoHorario($codOficina, $numero, $turma) ))
			{
				$this->ilhaDesignModel->setInscricaoAluno($codOficina, $numero, $idade, $nome, $turma);
				$this->load->view('ilhadesign/success');
				$this->ilhaDesignModel->updateOficinaVagas($codOficina, (($oficina['vagas']) -1 ));
			}
			else
			{
				$data['inscricoes'] = $this->ilhaDesignModel->getInscricaoNumeroTurma($numero, $turma);
				$data['oficinas'] = $this->ilhaDesignModel->getOficinasPorIdade($idade);
				$data['title'] = 'Ilha Design - Inscrição em Oficinas';
			
				$data['numero'] = $numero;
				$data['turma'] =  $turma;
				$data['nome'] =  $nome;
				$data['idade'] = $idade;
			
				echo '<script type="text/javascript"> horarioSobreposto(); </script>';
				redirect('procura-aluno', 'refresh');
			}
		}
		else
		{
			$data['inscricoes'] = $this->ilhaDesignModel->getInscricaoNumeroTurma($numero, $turma);
			$data['oficinas'] = $this->ilhaDesignModel->getOficinasPorIdade($idade);
			$data['title'] = 'Ilha Design - Inscrição em Oficinas';
				
			$data['numero'] = $numero;
			$data['turma'] =  $turma;
			$data['nome'] =  $nome;
			$data['idade'] = $idade;
				
			echo '<script type="text/javascript"> semVagas(); </script>';
			redirect('procura-aluno', 'refresh');
		}
		
	}
	
	public function conflitoHorario($codOficina, $numero, $turma)
	{
		$oficinaNova = $this->ilhaDesignModel->getOficinaById($codOficina);
		$inscricoes = $this->ilhaDesignModel->getInscricaoNumeroTurma($numero, $turma);

		foreach ($inscricoes as $inscricao_item){
			if ($oficinaNova['dia'] == $inscricao_item['dia'])
			{
				if (($oficinaNova['horaInicial'] >= $inscricao_item['horaInicial']) &&
					($oficinaNova['horaInicial'] < $inscricao_item['horaFinal']))
					return true;
	
				if (($oficinaNova['horaFinal'] > $inscricao_item['horaInicial']) &&
					($oficinaNova['horaFinal'] <= $inscricao_item['horaFinal']))
					return true;
	
				if (($oficinaNova['horaInicial'] <= $inscricao_item['horaInicial']) &&
					($oficinaNova['horaFinal'] >= $inscricao_item['horaFinal']))
					return true;
					
			}
		}
	
		return false;
	}
	
	public function gerencia()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['title'] = 'Ilha Design - Gerenciamento';
				
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/gerenciar/gerencia', $data);
			$this->load->view('templates/footer', $data);
	
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	public function gerenciaLocais()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['title'] = 'Ilha Design - Gerenciando Locais';
			
			$data['locais'] = $this->ilhaDesignModel->getLocais();
			
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/gerenciar/locais', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	public function gerenciaOficina()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['title'] = 'Ilha Design - Gerenciando Oficinas';
			
			$data['oficina'] = $this->ilhaDesignModel->getOficina();
			
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/gerenciar/oficinas', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	public function gerenciaTipoOficina()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['title'] = 'Ilha Design  - Gerenciando Tipos de Oficinas';
			
			$data['tipooficina'] = $this->ilhaDesignModel->getTipoOficina();
			
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/gerenciar/tipooficinas', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}

	public function gerenciaInscricao()
	{
		if($this->session->userdata('logged_in'))
		{
			$data['title'] = 'Ilha Design - Gerenciando Inscri&ccedil;&otilde;es';
			
			$data['inscricoes'] = $this->ilhaDesignModel->getInscricao();
			
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/gerenciar/inscricoes', $data);
			$this->load->view('templates/footer', $data);
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function criaLocal()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			//Título da Página
			$data['title'] = 'Cadastro de Local';
			
			$this->form_validation->set_rules('nome', 'Nome do Local', 'required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('endereco', 'Endereço', 'required|min_length[5]|max_length[70]');
			$this->form_validation->set_rules('telefone', 'Telefone', 'required|min_length[8]|max_length[20]');
			$this->form_validation->set_rules('cidade', 'Cidade', 'required|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('estado', 'Estado', 'required|min_length[5]|max_length[20]');
			$this->form_validation->set_rules('link', 'Página da Internet', 'min_length[7]|max_length[128]');
			
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/criar/crialocal');
				$this->load->view('templates/footer');
			
			}
			else
			{
				$this->ilhaDesignModel->setLocal();
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function criaInscricao()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			//Título da Página
			$data['title'] = 'Inscri&ccedil;&atilde;o';
			
			$this->form_validation->set_rules('aluno', 'Nome do Aluno', 'required|min_length[7]|max_length[100]');
			$this->form_validation->set_rules('numeroAluno', 'Número do Aluno', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('turmaAluno', 'Turma do Aluno', 'required|min_length[1]|max_length[10]');
			$this->form_validation->set_rules('idade', 'Idade', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('oficina', 'Oficina', 'required|is_natural');
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/criar/criainscricao');
				$this->load->view('templates/footer');
			
			}
			else
			{
				$this->ilhaDesignModel->setInscricao();
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function criaOficina()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			//Título da Página
			$data['title'] = 'Cadastro de Oficina';
			
			$this->form_validation->set_rules('tipooficina', 'Tipo de Oficina', 'required|is_natural');
			$this->form_validation->set_rules('local', 'Local', 'required|is_natural');
			$this->form_validation->set_rules('horaInicial', 'Hora Inicial', 'required|min_length[2]|max_length[10]');
			$this->form_validation->set_rules('horaFinal', 'Hora Final', 'required|min_length[2]|max_length[10]');
			$this->form_validation->set_rules('dia', 'Dia', 'required|min_length[2]|max_length[15]');
			$this->form_validation->set_rules('vagas', 'Vagas', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('sala', 'Sala', 'required|min_length[1]|max_length[20]');
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/criar/criaoficina');
				$this->load->view('templates/footer');
			
			}
			else
			{
				$this->ilhaDesignModel->setOficina();
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function criaTipoOficina()
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			//Título da Página
			$data['title'] = 'Cadastro de Tipo de Oficina';
			
			$this->form_validation->set_rules('titulo', 'Título da Oficina', 'required|min_length[3]|max_length[100]');
			$this->form_validation->set_rules('idadeInicial', 'Idade Inicial', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('idadeFinal', 'Idade Final', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('oficineiro1', 'Oficineiro 1', 'required|min_length[8]|max_length[100]');
			$this->form_validation->set_rules('oficineiro2', 'Oficineiro 2', 'min_length[8]|max_length[100]');
			$this->form_validation->set_rules('oficineiro3', 'Oficineiro 3', 'min_length[8]|max_length[100]');
			$this->form_validation->set_rules('oficineiro4', 'Oficineiro 4', 'min_length[8]|max_length[100]');
			$this->form_validation->set_rules('oficineiro5', 'Oficineiro 5', 'min_length[8]|max_length[100]');
				
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/criar/criatipooficina');
				$this->load->view('templates/footer');
			
			}
			else
			{
				$this->ilhaDesignModel->setTipoOficina();
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function excluiLocal($id)
	{
		if($this->session->userdata('logged_in'))
		{
			//ID não definido
			if ($id === FALSE)
			{
				show_404();
			}
			else{
				$this->ilhaDesignModel->removeLocal($id);
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	}
	
	public function excluiInscricao($id)
	{
		if($this->session->userdata('logged_in'))
		{
			//ID não definido
			if ($id === FALSE)
			{
				show_404();
			}
			else{
				$this->ilhaDesignModel->removeInscricao($id);
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
		
	}
	
	public function excluiOficina($id)
	{
		if($this->session->userdata('logged_in'))
		{
			//ID não definido
			if ($id === FALSE)
			{
				show_404();
			}
			else{
				$this->ilhaDesignModel->removeOficina($id);
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
	
	}
	
	public function excluiTipoOficina($id)
	{
		if($this->session->userdata('logged_in'))
		{
			//ID não definido
			if ($id === FALSE)
			{
				show_404();
			}
			else{
				$this->ilhaDesignModel->removeTipoOficina($id);
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function editaLocal($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			//Título da Página
			$data['title'] = 'Edição de Local';
			$data['local'] = $this->ilhaDesignModel->getLocaisById($id);
			
			$this->form_validation->set_rules('nome', 'Nome do Local', 'required|min_length[3]|max_length[50]');
			$this->form_validation->set_rules('endereco', 'Endereço', 'required|min_length[5]|max_length[70]');
			$this->form_validation->set_rules('telefone', 'Telefone', 'required|min_length[8]|max_length[20]');
			$this->form_validation->set_rules('cidade', 'Cidade', 'required|min_length[5]|max_length[30]');
			$this->form_validation->set_rules('estado', 'Estado', 'required|min_length[5]|max_length[20]');
			$this->form_validation->set_rules('link', 'Página da Internet', 'min_length[7]|max_length[128]');
			
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/editar/editalocal', $data);
				$this->load->view('templates/footer');
			
			}
			else
			{
				$this->ilhaDesignModel->updateLocal($id);
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function editaInscricao($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			//Título da Página
			$data['title'] = 'Edição de Inscrição';
			$data['inscricao'] = $this->ilhaDesignModel->getInscricaoById($id);
			
			$this->form_validation->set_rules('aluno', 'Nome do Aluno', 'required|min_length[7]|max_length[100]');
			$this->form_validation->set_rules('numeroAluno', 'Número do Aluno', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('turmaAluno', 'Turma do Aluno', 'required|min_length[1]|max_length[10]');
			$this->form_validation->set_rules('idade', 'Idade', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('oficina', 'Oficina', 'required|is_natural');
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/editar/editainscricao', $data);
				$this->load->view('templates/footer');
			
			}
			else
			{
				$this->ilhaDesignModel->updateInscricao($id);
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function editaOficina($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			//Título da Página
			$data['title'] = 'Edição de Oficina';
			$data['oficina'] = $this->ilhaDesignModel->getOficinaById($id);
			
			$this->form_validation->set_rules('tipooficina', 'Tipo de Oficina', 'required|is_natural');
			$this->form_validation->set_rules('local', 'Local', 'required|is_natural');
			$this->form_validation->set_rules('horaInicial', 'Hora Inicial', 'required|min_length[2]|max_length[10]');
			$this->form_validation->set_rules('horaFinal', 'Hora Final', 'required|min_length[2]|max_length[10]');
			$this->form_validation->set_rules('dia', 'Dia', 'required|min_length[2]|max_length[15]');
			$this->form_validation->set_rules('vagas', 'Vagas', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('sala', 'Sala', 'required|min_length[1]|max_length[20]');
			
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/editar/editaoficina', $data);
				$this->load->view('templates/footer');
			
			}
			else
			{
				$this->ilhaDesignModel->updateOficina($id);
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function editaTipoOficina($id)
	{
		if($this->session->userdata('logged_in'))
		{
			$this->load->helper('form');
			$this->load->library('form_validation');
			
			//Título da Página
			$data['title'] = 'Edição de Tipo de Oficina';
			$data['tipooficina'] = $this->ilhaDesignModel->getTipoOficinaById($id);
			
			$this->form_validation->set_rules('titulo', 'Título da Oficina', 'required|min_length[3]|max_length[100]');
			$this->form_validation->set_rules('idadeInicial', 'Idade Inicial', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('idadeFinal', 'Idade Final', 'required|is_natural_no_zero|less_than[100]');
			$this->form_validation->set_rules('oficineiro1', 'Oficineiro 1', 'required|min_length[8]|max_length[100]');
			$this->form_validation->set_rules('oficineiro2', 'Oficineiro 2', 'min_length[8]|max_length[100]');
			$this->form_validation->set_rules('oficineiro3', 'Oficineiro 3', 'min_length[8]|max_length[100]');
			$this->form_validation->set_rules('oficineiro4', 'Oficineiro 4', 'min_length[8]|max_length[100]');
			$this->form_validation->set_rules('oficineiro5', 'Oficineiro 5', 'min_length[8]|max_length[100]');
				
			if ($this->form_validation->run() === FALSE)
			{
				$this->load->view('templates/header', $data);
				$this->load->view('ilhadesign/editar/editatipooficina', $data);
				$this->load->view('templates/footer');
			
			}
			else
			{
				$this->ilhaDesignModel->updateTipoOficina($id);
				$this->load->view('ilhadesign/success');
			}
		}
		else
		{
			//If no session, redirect to login page
			redirect('login', 'refresh');
		}
		
	}
	
	public function login()
	{
		$this->load->helper(array('form'));
		$this->load->library('form_validation');
	
		//Título da Página
		$data['title'] = 'Login de Gerenciamento';
	
		$this->load->view('templates/header', $data);
		$this->load->view('ilhadesign/login');
		$this->load->view('templates/footer');
	
	}
	
	public function verificaLogin()
	{
		//This method will have the credentials validation
		$this->load->library('form_validation');

		$this->form_validation->set_rules('username', 'Username', 'trim|required|xss_clean');
		$this->form_validation->set_rules('password', 'Password', 'trim|required|xss_clean|callback_validaUsuarioSenha');
		
		if($this->form_validation->run() == FALSE)
		{
			//Field validation failed.&nbsp; User redirected to login page
			//Título da Página
			$data['title'] = 'Login de Gerenciamento';
		
			$this->load->view('templates/header', $data);
			$this->load->view('ilhadesign/login');
			$this->load->view('templates/footer');
		}
		else
		{
			//Go to private area
			redirect('gerencia', 'refresh');
		}
	
	}
	
	public function validaUsuarioSenha($password)
	{
		//Field validation succeeded.&nbsp; Validate against database
		$username = $this->input->post('username');

		//query the database
		$result = $this->ilhaDesignModel->login($username, $password);
	
		if($result)
		{
			$sess_array = array();
			foreach($result as $row)
			{
				$sess_array = array(
						'id' => $row->id,
						'username' => $row->username
				);
				$this->session->set_userdata('logged_in', $sess_array);
			}
			return TRUE;
		}
		else
		{
			$this->form_validation->set_message('validaUsuarioSenha', 'Usuário ou senha inválidos!');
			return false;
		}
	}
	
	public function logout()
	{
		$this->session->unset_userdata('logged_in');
		session_destroy();
		redirect('login', 'refresh');
	}
}