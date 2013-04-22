<h2>Edi&ccedil;&atilde;o de Inscri&ccedil;&atilde;o</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('edita-inscricao/'.$inscricao['codInscricao']) ?>

	<label for="aluno">Nome do Aluno*</label> 
	<input type="input" name="aluno" value="<?php echo $inscricao['aluno'] ?>" /><br />
	
	<label for="numeroAluno">N&uacute;mero do Aluno*</label> 
	<input type="input" name="numeroAluno" value="<?php echo $inscricao['numAluno'] ?>" /><br />
	
	<label for="turmaAluno">Turma do Aluno*</label> 
	<input type="input" name="turmaAluno" value="<?php echo $inscricao['turma'] ?>" /><br />

	<label for="idade">Idade*</label> 
	<input type="input" name="idade" value="<?php echo $inscricao['idade'] ?>" /><br />
	
	<label for="oficina">Oficina*</label> 
	<input type="input" name="oficina" value="<?php echo $inscricao['codOficina'] ?>" /><br />
	
	<input type="submit" name="submit" value="Salvar Altera&ccedil;&otilde;es" /> 

</form>
Campos marcados com * s&atilde;o obrigat&oacute;rios!
Oficina e Hora inscrição precisam ser modificados
Alterar CodOficina pra mostrar o nome da oficina