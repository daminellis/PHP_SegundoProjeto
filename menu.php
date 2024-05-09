<?php
// Conectar ao banco de dados usando mysqli
$connect = mysqli_connect('localhost', 'root', '', 'livraria');

// Verificar a conexão
if (!$connect) {
    die('Erro de conexão: ' . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="menu.css">
  <title>Pagina Inicial</title>
</head>
<body>
<header>
  <div class="logo-container">
    <i class="fa-solid fa-bookmark"></i>
    <h2>LIVROS.COM</h2>
  </div>
  <button onclick="window.location.href='login.php'" class="login-button">Login</button>
</header>

<div class="tipo-div">
  <form class="tipo" action="menu.php" method="post">
    <label class="radio">Categoria:</label>
    <?php
      // Consulta para obter categorias do banco de dados
      $query_categoria = mysqli_query($connect, 'SELECT codigo, nome FROM categoria');
      while($categorias = mysqli_fetch_array($query_categoria)) { ?>
        <label class="radio">
          <input type="radio" name="categoria" value="<?php echo $categorias['codigo']?>" />
          <span><?php echo $categorias['nome'] ?></span>
        </label>
    <?php } ?>
    <label class="radio"><input type="radio" name="categoria" value="null" checked><span>Todos</span></label>

    <label class="radio">Autor:</label>
    <?php
      // Consulta para obter autores do banco de dados
      $query_autor = mysqli_query($connect, 'SELECT codigo, nome FROM autor');
      while($autores = mysqli_fetch_array($query_autor)) { ?>
        <label class="radio">
          <input type="radio" name="autor" value="<?php echo $autores['codigo']?>" />
          <span><?php echo $autores['nome'] ?></span>
        </label>
    <?php } ?>
    <label class="radio"><input type="radio" name="autor" value="null" checked><span>Todos</span></label>

    <label class="radio">Classificação:</label>
    <?php
      // Consulta para obter classificações do banco de dados
      $query_classificacao = mysqli_query($connect, 'SELECT codigo, nome FROM classificacao');
      while($classificacoes = mysqli_fetch_array($query_classificacao)) { ?>
        <label class="radio">
          <input type="radio" name="classificacao" value="<?php echo $classificacoes['codigo']?>" />
          <span><?php echo $classificacoes['nome'] ?></span>
        </label>
    <?php } ?>
    <label class="radio"><input type="radio" name="classificacao" value="null" checked><span>Todos</span></label>
    
    <input type="submit" value="Pesquisar" class="pesquisar">
  </form>
</div>

<div class="container">
  <h1>Livros: </h1>

  <div class="livros">
    <div class="livros1">
      <?php 
          // Definir a consulta SQL
          $livros_query = "SELECT livro.*, autor.nome as autor_nome FROM livro INNER JOIN autor ON livro.codautor = autor.codigo";

          // Verificar se uma categoria foi selecionada
          if(isset($_POST['categoria']) && $_POST['categoria'] != 'null') {
            $categoria_id = $_POST['categoria'];
            $livros_query .= " WHERE livro.codcategoria = $categoria_id";
          }
          
          // Verificar se um autor foi selecionado
          if(isset($_POST['autor']) && $_POST['autor'] != 'null') {
            $autor_id = $_POST['autor'];
            // Se já houver uma condição WHERE, adicione a cláusula AND
            $livros_query .= isset($categoria_id) ? " AND livro.codautor = $autor_id" : " WHERE livro.codautor = $autor_id";
          }
          
          // Verificar se uma classificação foi selecionada
          if(isset($_POST['classificacao']) && $_POST['classificacao'] != 'null') {
            $classificacao_id = $_POST['classificacao'];
            // Se já houver uma condição WHERE, adicione a cláusula AND
            $livros_query .= isset($categoria_id) || isset($autor_id) ? " AND livro.codclassificacao = $classificacao_id" : " WHERE livro.codclassificacao = $classificacao_id";
          }
          
          // Ordenar por título
          $livros_query .= " ORDER BY livro.titulo ASC";
          
          // Executar a consulta SQL
          $livros_result = mysqli_query($connect, $livros_query);
          
          if(mysqli_num_rows($livros_result) > 0) {
            while($resultado = mysqli_fetch_array($livros_result)) {
              $caminho_foto = 'livro/fotos/' . $resultado["fotocapa"];
              echo '<div class="livro-container">
                    <div class="livro">
                      <img src="'.$caminho_foto.'" width="100" height="130" />
                      <h4>'.$resultado["titulo"].'</h4>
                      <p>Autor: '.$resultado["autor_nome"].'</p>
                      <p>Preço: R$ '.$resultado["valor"].'</p>
                      <a href="comprar.php?codigo='.$resultado["codigo"].'">COMPRAR</a>
                    </div>
                  </div>';
            }
        } else {
            echo '<p>Nenhum livro encontrado.</p>';
        }
      ?>  
    </div>
    </div>
  </div>
</div>
</body>
</html>
