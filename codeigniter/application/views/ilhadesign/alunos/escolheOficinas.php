Aluno: <?php echo $nome ?> <br/>
Idade: <?php echo $idade ?><br/>
N&uacute;mero: <?php echo $numero ?><br/>
Turma: <?php echo $turma ?><br/>

<?php if( isset($aviso) ){ echo $aviso; } ?>

<?php if( isset($inscricoes) ){ ?>
Inscrito em:
<table>
<tr>
<td>T&iacute;tulo</td>
<td>Hora Inicial</td>
<td>Hora Final</td>
<td>Data</td>
<td>Vagas</td>
<td>Sala</td>
<td>Idade Inicial</td>
<td>Idade Final</td>
</tr>
<?php foreach ($inscricoes as $inscricao_item): ?>
<tr>
    <td> <?php echo $inscricao_item['titulo'] ?> </td>
    
    <td> <?php echo $inscricao_item['horaInicial'] ?> </td>
    
    <td> <?php echo $inscricao_item['horaFinal'] ?> </td>

    <td> <?php echo $inscricao_item['dia'] ?> </td>
    
    <td> <?php echo $inscricao_item['vagas'] ?> </td>
   
    <td> <?php echo $inscricao_item['sala'] ?> </td>
    
    <td> <?php echo $inscricao_item['idadeInicial'] ?> </td>
   
    <td> <?php echo $inscricao_item['idadeFinal'] ?> </td>
</tr>    
<?php endforeach ?>
</table>
<?php } ?>
Escolha oficinas abaixo:

<table>
<tr>
<td>T&iacute;tulo</td>
<td>Hora Inicial</td>
<td>Hora Final</td>
<td>Data</td>
<td>Vagas</td>
<td>Sala</td>
<td>Idade Inicial</td>
<td>Idade Final</td>
<td>Inscreva-se</td>
</tr>
<?php foreach ($oficinas as $oficina_item): ?>
<tr>
    <td> <?php echo $oficina_item['titulo'] ?> </td>
    
    <td> <?php echo $oficina_item['horaInicial'] ?> </td>
    
    <td> <?php echo $oficina_item['horaFinal'] ?> </td>

    <td> <?php echo $oficina_item['dia'] ?> </td>
    
    <td> <?php echo $oficina_item['vagas'] ?> </td>
   
    <td> <?php echo $oficina_item['sala'] ?> </td>
    
    <td> <?php echo $oficina_item['idadeInicial'] ?> </td>
   
    <td> <?php echo $oficina_item['idadeFinal'] ?> </td>
    <td>  <a href="inscricao-oficina/<?php echo $oficina_item['codOficina']."/".$numero."/".$idade."/".$nome."/".$turma ?>">Se inscrever</a> </td>
</tr>    
<?php endforeach ?>
</table>