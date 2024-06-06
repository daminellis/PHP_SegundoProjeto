<?php
    $codigo             = $_GET['codigo'];
    $nome             = $_GET['nome'];


    $conectar = mysql_connect('localhost','root','');
    $db       = mysql_select_db('livraria');
    $sql       = "insert into classificacao (codigo,nome) values ('$codigo','$nome')";
    $resultado = mysql_query($sql);
?>

<script>
	alert('Adicionado com Sucesso!');
	<?php
		echo "location.href='cad_class.php'";
	?>
</script>
