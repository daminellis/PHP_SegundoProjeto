<?php
    $codigo             = $_GET['codigo'];
    $nome             = $_GET['nome'];

    $conectar = mysql_connect('localhost','root','');
    $db       = mysql_select_db('livraria');
    $sql      = "update classificacao set nome = '$nome' where codigo = '$codigo'";
    $resultado = mysql_query($sql);
?>

<script>
	alert('Alterado com Sucesso!');
	<?php
		echo "location.href='cad_class.php'";
	?>
</script>
