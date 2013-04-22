<h2>Cadastro de tipo oficina</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('cria-tipo-oficina') ?>

	<label for="titulo">T&iacute;tulo*</label> 
	<input type="input" name="titulo" /><br />
	
	<label for="idadeInicial">Idade Inicial*</label> 
	<input type="input" name="idadeInicial" /><br />
	
	<label for="idadeFinal">Idade Final*</label> 
	<input type="input" name="idadeFinal" /><br />
	
	<label for="oficineiro1">Oficineiro 1*</label> 
	<input type="input" name="oficineiro1" /><br />
	
	<label for="oficineiro2">Oficineiro 2</label> 
	<input type="input" name="oficineiro2" /><br />
	
	<label for="oficineiro3">Oficineiro 3</label> 
	<input type="input" name="oficineiro3" /><br />
	
	<label for="oficineiro4">Oficineiro 4</label> 
	<input type="input" name="oficineiro4" /><br />
	
	<label for="oficineiro5">Oficineiro 5</label> 
	<input type="input" name="oficineiro5" /><br />
	
	<input type="submit" name="submit" value="Cria Tipo Oficina" /> 

</form>
Campos marcados com * s&atilde;o obrigat&oacute;rios!