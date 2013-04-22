<a href="../cria-inscricao/">Criar Nova Inscri&ccedil;&atilde;o</a>
<br>
<table>
<tr>
<td>Nome</td>
<td>Codigo Oficina</td>
<td>Numero Aluno</td>
<td>Idade</td>
<td>Turma</td>
<td>Excluir</td>
<td>Editar</td>

</tr>
<?php foreach ($inscricoes as $inscricoes_item): ?>
<tr>
    <td> <?php echo $inscricoes_item['aluno'] ?> </td>
    
    <td> <?php echo $inscricoes_item['codOficina'] ?> </td>
    
    <td>  <?php echo $inscricoes_item['numAluno'] ?> </td>

    <td> <?php echo $inscricoes_item['idade'] ?> </td>
    
    <td> <?php echo $inscricoes_item['turma'] ?> </td>
   
    <td> <a href="../exclui-inscricao/<?php echo $inscricoes_item['codInscricao'] ?>">Excluir</a> </td>
    
    <td> <a href="../edita-inscricao/<?php echo $inscricoes_item['codInscricao'] ?>">Editar</a> </td>
 
</tr>    
<?php endforeach ?>
</table>