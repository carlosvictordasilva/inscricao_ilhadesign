   <h2>Cadastro de Aluno</h2>
   <?php echo validation_errors(); ?>
   <?php echo form_open('escolhe-oficinas'); ?>
     <label for="aluno">Nome do Aluno:</label>
     <input type="text" size="20" id="aluno" name="aluno"/>
     <br/>
     <label for="idade">Idade do Aluno:</label>
     <input type="text" size="20" id="idade" name="idade"/>
     <br/>
     <label for="turma">Turma do Aluno:</label>
     <input type="text" size="20" id="turma" name="turma" value="<?php echo $turma ?>"/>
     <br/>
     <label for="numero">N&uacute;mero do Aluno:</label>
     <input type="text" size="20" id="numero" name="numero" value="<?php echo $numero ?>"/>
     <br/>
     <input type="submit" value="Escolher Oficinas"/>
   </form>
