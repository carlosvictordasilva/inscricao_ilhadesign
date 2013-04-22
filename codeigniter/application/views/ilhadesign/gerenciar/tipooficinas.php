<a href="../cria-tipo-oficina/">Criar Novo Tipo de Oficina</a>
<br>

<table>
<tr>
<td>C&oacute;digo Tipo Oficina</td>
<td>T&iacute;tulo</td>
<td>Oficineiro 1</td>
<td>Oficineiro 2</td>
<td>Oficineiro 3</td>
<td>Oficineiro 4</td>
<td>Oficineiro 5</td>
<td>Idade Inicial</td>
<td>Idade Final</td>
<td>Excluir</td>
<td>Editar</td>
</tr>
<?php foreach ($tipooficina as $tipooficina_item): ?>
    <tr>
    <td> <?php echo $tipooficina_item['codTipoOficina'] ?> </td> 
    <td> <?php echo $tipooficina_item['titulo'] ?> </td>
    <td> <?php echo $tipooficina_item['oficineiro1'] ?> </td>   
    <td> <?php echo $tipooficina_item['oficineiro2'] ?> </td>
    <td> <?php echo $tipooficina_item['oficineiro3'] ?> </td>    
    <td> <?php echo $tipooficina_item['oficineiro4'] ?> </td>   
    <td> <?php echo $tipooficina_item['oficineiro5'] ?> </td>
    <td> <?php echo $tipooficina_item['idadeInicial'] ?> </td>
    <td> <?php echo $tipooficina_item['idadeFinal'] ?> </td>
    <td> <a href="../exclui-tipo-oficina/<?php echo $tipooficina_item['codTipoOficina'] ?>">Excluir</a> </td>
    <td> <a href="../edita-tipo-oficina/<?php echo $tipooficina_item['codTipoOficina'] ?>">Editar</a> </td>
</tr>    
<?php endforeach ?>
</table>