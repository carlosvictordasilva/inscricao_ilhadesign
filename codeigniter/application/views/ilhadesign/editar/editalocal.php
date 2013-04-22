<h2>Edi&ccedil;&atilde;o de local</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('edita-local/'.$local['codLocal']) ?>

	<label for="nome">Nome*</label> 
	<input type="input" name="nome" value="<?php echo $local['nome'] ?>" /><br />
	
	<label for="endereco">Endere&ccedil;o*</label> 
	<input type="input" name="endereco" value="<?php echo $local['endereco'] ?>" /><br />
	
	<label for="telefone">Telefone*</label> 
	<input type="input" name="telefone" value="<?php echo $local['telefone'] ?>" /><br />
	
	<label for="cidade">Cidade*</label> 
	<input type="input" name="cidade" value="<?php echo $local['cidade'] ?>" /><br />
	
	<label for="estado">Estado*</label> 
	<input type="input" name="estado" value="<?php echo $local['estado'] ?>" /><br />
	
	<label for="link">P&aacute;gina da Internet</label> 
	<input type="input" name="link" value="<?php echo $local['link'] ?>" /><br />
	
	<input type="submit" name="submit" value="Salvar Altera&ccedil;&otilde;es" /> 

</form>
Campos marcados com * s&atilde;o obrigat&oacute;rios!
