   <h2>Procura de Alunos</h2>
   <?php echo validation_errors(); ?>
   <?php echo form_open('procura-aluno'); ?>
     <label for="turma">Turma do Aluno:</label>
     <input type="text" size="20" id="turma" name="turma"/>
     <br/>
     <label for="numero">N&uacute;mero do Aluno:</label>
     <input type="text" size="20" id="numero" name="numero"/>
     <br/>
     <input type="submit" value="Procurar"/>
   </form>
