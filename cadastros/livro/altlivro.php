<?php
    $codigo = $_POST['codigo'];
    $titulo   = $_POST['titulo'];
    $codcategoria  = $_POST['codcategoria'];
    $codclassificacao  = $_POST['codclassificacao'];
    $ano  = $_POST['ano'];
    $edicao  = $_POST['edicao'];
    $codautor  = $_POST['codautor'];
    $editora  = $_POST['editora'];
    $paginas  = $_POST['paginas'];
    $fotocapa = $_FILES['fotocapa'];
    $valor  = $_POST['valor'];

    $diretorio = "fotos/";

    //usada para converter caracteres em string 
    $extensao1 = strtolower(substr($_FILES['fotocapa']['name'], -4));

    //faz md5 para n ter nomes repetidos 
    $novo_nome1 = md5(time()).$extensao1;

    //mover arquivo da foto para a pasta FOTOS no computador
    move_uploaded_file($_FILES['fotocapa']['tmp_name'], $diretorio.$novo_nome1);
    
    $conectar  = mysql_connect('localhost','root','');
    $db        = mysql_select_db('livraria');
    $sql       = "update livro set titulo = '$titulo', codcategoria = '$codcategoria', codclassificacao = '$codclassificacao', ano = '$ano', edicao = '$edicao', codautor = '$codautor', editora = '$editora', paginas = '$paginas', fotocapa = '$fotocapa', valor = '$valor' where codigo = '$codigo'";
    $resultado = mysql_query($sql);
?>

<script>
	alert('alterado com Sucesso!');
	<?php
		echo "location.href='cad_livro.php'";
	?>
</script>