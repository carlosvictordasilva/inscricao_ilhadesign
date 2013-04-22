<a href="../cria-oficina/">Criar Nova Oficina</a>
<br>

<table>
<tr>
<td>C&oacute;digo Oficina</td>
<td>C&oacute;digo Tipo Oficina</td>
<td>C&oacute;digo Local</td>
<td>Hora Inicial</td>
<td>Hora Final</td>
<td>Dia</td>
<td>Vagas</td>
<td>Sala</td>
<td>Excluir</td>
<td>Editar</td>
</tr>
<?php foreach ($oficina as $oficina_item): ?>

    <tr>
    <td> <?php echo $oficina_item['codOficina'] ?> </td>
    
    <td> <?php echo $oficina_item['codTipoOficina'] ?> </td>
    
    <td> <?php echo $oficina_item['codLocal'] ?> </td>

    <td> <?php echo $oficina_item['horaInicial'] ?> </td>
    
    <td> <?php echo $oficina_item['horaFinal'] ?> </td>
   
    <td> <?php echo $oficina_item['dia'] ?> </td>
    
    <td> <?php echo $oficina_item['vagas'] ?> </td>
   
    <td> <?php echo $oficina_item['sala'] ?> </td>
    <td>  <a href="../exclui-oficina/<?php echo $oficina_item['codOficina'] ?>">Excluir</a> </td>
    <td>  <a href="../edita-oficina/<?php echo $oficina_item['codOficina'] ?>">Editar</a> </td>
</tr>    
<?php endforeach ?>
</table>