<a href="../cria-local/">Criar Novo Local</a>
<br>

<table>
<tr>
<td>C&oacute;digo Local</td>
<td>Nome</td>
<td>Endere&ccedil;o</td>
<td>Telefone</td>
<td>Cidade</td>
<td>Estado</td>
<td>Link</td>
<td>Excluir</td>
<td>Editar</td>
</tr>
<?php foreach ($locais as $locais_item): ?>
    <tr>
    <td> <?php echo $locais_item['codLocal'] ?> </td>
    
    <td> <?php echo $locais_item['nome'] ?> </td>
    
    <td> <?php echo $locais_item['endereco'] ?> </td>

    <td> <?php echo $locais_item['telefone'] ?> </td>
    
    <td> <?php echo $locais_item['cidade'] ?> </td>
   
    <td> <?php echo $locais_item['estado'] ?> </td>
    
    <td> <?php echo $locais_item['link'] ?> </td>
 
    <td> <a href="../exclui-local/<?php echo $locais_item['codLocal'] ?>">Excluir</a> </td>
    <td> <a href="../edita-local/<?php echo $locais_item['codLocal'] ?>">Editar</a> </td>
</tr>    
<?php endforeach ?>
</table>