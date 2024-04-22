<?php
    $codigo             = $_GET['codigo'];
    $titulo             = $_GET['titulo'];
    $codcategoria       = $_GET['codcategoria'];
    $codclassificacao   = $_GET['codclassificacao'];
    $ano                = $_GET['ano'];
    $edicao             = $_GET['edicao'];
    $codautor           = $_GET['codautor'];
    $editora            = $_GET['editora'];
    $paginas            = $_GET['paginas'];
    $fotocapa           = $_GET['fotocapa'];
    $valor              = $_GET['valor'];

    $conectar = mysql_connect('localhost','root','');
    $db       = mysql_select_db('livraria');
    $sql       = "insert into classificacao (codigo,titulo,codcategoria,codclassificacao,ano,edicao,
                  codautor,editora,paginas,fotocapa,valor) values ('$codigo','$titulo','$codcategoria','$codclassificacao'
                  '$ano','$edicao','$codautor','$editora','$paginas','$fotocapa','$valor')";
    $resultado = mysql_query($sql);
?>

<script>
	alert('Adicionado com Sucesso!');
	<?php
		echo "location.href='cad_class.php'";
	?>
</script>
