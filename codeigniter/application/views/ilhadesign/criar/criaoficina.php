<h2>Cadastro de oficina</h2>

<?php echo validation_errors(); ?>

<?php echo form_open('cria-oficina') ?>

	<label for="tipooficina">Tipo Oficina*</label> 
	<input type="input" name="tipooficina" /><br />
	
	<label for="local">Local*</label> 
	<input type="input" name="local" /><br />
	
	<label for="horaInicial">Hora Inicial*</label> 
	<input type="input" name="horaInicial" /><br />
	
	<label for="horaFinal">Hora Final*</label> 
	<input type="input" name="horaFinal" /><br />
	
	<label for="dia">Dia*</label> 
	<input type="input" name="dia" /><br />
	
	<label for="vagas">Vagas*</label> 
	<input type="input" name="vagas" /><br />
	
	<label for="sala">Sala*</label> 
	<input type="input" name="sala" /><br />
		
	<input type="submit" name="submit" value="Cria Oficina" /> 

</form>
Campos marcados com * s&atilde;o obrigat&oacute;rios!
Mudar tipos de Local e de Tipo oficina pra dropdown list com dados vindo do BD.