<h2>Cadastro de Inscri&ccedil;&atilde;o</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('cria-inscricao') ?>

	<label for="aluno">Nome do Aluno*</label> 
	<input type="input" name="aluno" /><br />
	
	<label for="numeroAluno">N&uacute;mero do Aluno*</label> 
	<input type="input" name="numeroAluno" /><br />
	
	<label for="turmaAluno">Turma do Aluno*</label> 
	<input type="input" name="turmaAluno" /><br />

	<label for="idade">Idade*</label> 
	<input type="input" name="idade" /><br />
	
	<label for="oficina">Oficina*</label> 
	<input type="input" name="oficina" /><br />
	
	<input type="submit" name="submit" value="Cria Tipo Oficina" /> 

</form>
Campos marcados com * s&atilde;o obrigat&oacute;rios!
Oficina e Hora inscrição precisam ser modificados