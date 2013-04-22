<h2>Edi&ccedil;&atilde;o de oficina</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('edita-oficina/'.$oficina['codOficina']) ?>

	<label for="tipooficina">Tipo Oficina*</label> 
	<input type="input" name="tipooficina" value="<?php echo $oficina['codTipoOficina'] ?>" /><br />
	
	<label for="local">Local*</label> 
	<input type="input" name="local" value="<?php echo $oficina['codLocal'] ?>" /><br />
	
	<label for="horaInicial">Hora Inicial*</label> 
	<input type="input" name="horaInicial" value="<?php echo $oficina['horaInicial'] ?>" /><br />
	
	<label for="horaFinal">Hora Final*</label> 
	<input type="input" name="horaFinal" value="<?php echo $oficina['horaFinal'] ?>" /><br />
	
	<label for="dia">Dia*</label> 
	<input type="input" name="dia" value="<?php echo $oficina['dia'] ?>" /><br />
	
	<label for="vagas">Vagas*</label> 
	<input type="input" name="vagas" value=" <?php echo $oficina['vagas'] ?>" /><br />
	
	<label for="sala">Sala*</label> 
	<input type="input" name="sala" value="<?php echo $oficina['sala'] ?>" /><br />
		
	<input type="submit" name="submit" value="Salvar Altera&ccedil;&otilde;es" /> 

</form>
Campos marcados com * s&atilde;o obrigat&oacute;rios!
Mudar tipos de Local e de Tipo oficina pra aparecer os nomes