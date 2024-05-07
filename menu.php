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
    <?php
      // Alterado de mysql_query para mysqli_query e corrigido o nome da variável de conexão
      $query = mysqli_query($connect, 'SELECT codigo, nome FROM categoria');
      while($categorias = mysqli_fetch_array($query)) { ?>
      <label class="radio">
        <input type="radio" name="tipo" value="<?php echo $categorias['codigo']?>" />
        <span><?php echo $categorias['nome'] ?></span>
      </label>
      <?php } ?>
      <label class="radio"><input type="radio" name="tipo" value="null" checked><span>Todos</span></label>
  </form>
</div>

<div class="container">
  <h1>Livros: </h1>

  <div class="livros">
    <div class="livros1">
      <?php 
        $livros_query = "SELECT livro.*, autor.nome as autor_nome FROM livro INNER JOIN autor ON livro.codautor = autor.codigo";
        
        // Verificar se um autor foi selecionado
        if(isset($_POST['autor']) && $_POST['autor'] != 'null') {
          $autor_id = $_POST['autor'];
          $livros_query .= " WHERE livro.codautor = $autor_id";
        }
        
        // Ordenar por título
        $livros_query .= " ORDER BY livro.titulo ASC";
        
        // Alterado de mysql_query para mysqli_query e corrigido o nome da variável de conexão
        $livros_result = mysqli_query($connect, $livros_query);
        
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
      ?>
    </div>
    </div>
  </div>
</div>
</body>
</html>
