<?php
    $codigo= $_GET['codigo'];

    $conectar = mysql_connect('localhost','root','');
    $db       = mysql_select_db('livraria');
    $sql      = "delete from classiicacao where codigo = '$codigo'";

    $resultado = mysql_query($sql);
?>

<script>
	alert('Excluido com Sucesso!');
	<?php
		echo "location.href='cad_class.php'";
	?>
</script>