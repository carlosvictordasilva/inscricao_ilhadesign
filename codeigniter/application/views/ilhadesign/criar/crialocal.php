<h2>Cadastro de local</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('cria-local') ?>

	<label for="nome">Nome*</label> 
	<input type="input" name="nome" /><br />
	
	<label for="endereco">Endere&ccedil;o*</label> 
	<input type="input" name="endereco" /><br />
	
	<label for="telefone">Telefone*</label> 
	<input type="input" name="telefone" /><br />
	
	<label for="cidade">Cidade*</label> 
	<input type="input" name="cidade" /><br />
	
	<label for="estado">Estado*</label> 
	<input type="input" name="estado" /><br />
	
	<label for="link">P&aacute;gina da Internet</label> 
	<input type="input" name="link" /><br />
	
	<input type="submit" name="submit" value="Cria Local" /> 

</form>
Campos marcados com * s&atilde;o obrigat&oacute;rios!