   <h1>Login de Gerenciamento de Tabelas</h1>
   <?php echo validation_errors(); ?>
   <?php echo form_open('verifica-login'); ?>
     <label for="username">Usuário:</label>
     <input type="text" size="20" id="username" name="username"/>
     <br/>
     <label for="password">Senha:</label>
     <input type="password" size="20" id="passowrd" name="password"/>
     <br/>
     <input type="submit" value="Entrar"/>
   </form>
