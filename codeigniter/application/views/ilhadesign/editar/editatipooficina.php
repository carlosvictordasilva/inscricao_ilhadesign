<h2>Edi&ccedil;&atilde;o de Tipo Oficina</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('edita-tipo-oficina/'.$tipooficina['codTipoOficina']) ?>

	<label for="titulo">T&iacute;tulo*</label> 
	<input type="input" name="titulo" value="<?php echo $tipooficina['titulo'] ?>" /><br />
	
	<label for="idadeInicial">Idade Inicial*</label> 
	<input type="input" name="idadeInicial" value="<?php echo $tipooficina['idadeInicial'] ?>" /><br />
	
	<label for="idadeFinal">Idade Final*</label> 
	<input type="input" name="idadeFinal" value="<?php echo $tipooficina['idadeFinal'] ?>" /><br />
	
	<label for="oficineiro1">Oficineiro 1*</label> 
	<input type="input" name="oficineiro1" value="<?php echo $tipooficina['oficineiro1'] ?>" /><br />
	
	<label for="oficineiro2">Oficineiro 2</label> 
	<input type="input" name="oficineiro2" value="<?php echo $tipooficina['oficineiro2'] ?>" /><br />
	
	<label for="oficineiro3">Oficineiro 3</label> 
	<input type="input" name="oficineiro3" value="<?php echo $tipooficina['oficineiro3'] ?>" /><br />
	
	<label for="oficineiro4">Oficineiro 4</label> 
	<input type="input" name="oficineiro4" value=" <?php echo $tipooficina['oficineiro4'] ?>" /><br />
	
	<label for="oficineiro5">Oficineiro 5</label> 
	<input type="input" name="oficineiro5" value="<?php echo $tipooficina['oficineiro5'] ?>" /><br />
	
	<input type="submit" name="submit" value="Salvar Altera&ccedil;&otilde;es" /> 

</form>
Campos marcados com * s&atilde;o obrigat&oacute;rios!
