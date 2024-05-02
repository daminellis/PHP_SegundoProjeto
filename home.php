<?php
$connect = mysqli_connect('localhost', 'root','','livraria');

$sql_livros = "select * from livro";

$livros = mysqli_query($connect, $sql_livros);
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="home.css">
  <title>Document</title>
</head>
<body>
  <header>
    <i class="fa-solid fa-bookmark"></i>
    <h2>BOOKLY</h2>
  </header>
  <div class="tipo-div">
    <form class="tipo" action="home.php" method="post">
      <?php
        $query = mysqli_query($connect,'SELECT codigo, nome FROM categoria');
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
          while($resultado = mysqli_fetch_array($livros)) {
            echo '<div class="livro">
              <img src="img/'.$resultado["fotocapa"].'" width="100" height="130" />
              <h4>'.$resultado["titulo"].'</h4>
              <a href="comprar.php?codigo='.$resultado["codigo"].'">COMPRAR</a>
            </div>';
          }
        ?>
      </div>

    </div>
  </div>
</body>
</html>