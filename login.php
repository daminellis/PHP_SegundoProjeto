<?php
$connect = mysql_connect('localhost','root','');
$db      = mysql_select_db('livraria');

if (isset($_POST['conectar']))
{
    $login = $_POST['login'];
    $senha = $_POST['senha'];

    $sql = mysql_query("select * from usuario where login='$login' and senha='$senha'");

    $resultado = mysql_num_rows($sql);

    if ($resultado == 0)
    {
        echo "<script>alert('Login ou senha inválidos');</script>"; // Exibir pop-up
    }

    else
    {
        session_start();
        $_SESSION['login'] = $login;
        echo "<script>window.location.href = 'menu.html';</script>"; // Redirecionar após o login bem-sucedido
    }
}
?>

<!DOCTYPE html>
<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <title>Login de Usuários</title>
    <link rel="stylesheet" type="text/css" href="styleLogin.css">
</head>
<body>
    <div>
        <button class="Voltar" onclick="window.location.href='home.php'">Voltar</button>
        <div class="container">
            <form name='formulario' method='post' action='login.php'>
                <h2>Login de Usuários</h2>
                <label>Login:</label>
                <input type='text' name='login' id='login' size=20 required>
                <br><br>
                <label>Senha:</label>
                <input type='password' name='senha' id='senha' size=20 required>
                <br><br>
                <input type='submit' value='Conectar' id='conectar' name='conectar'>
            </form>
        </div>
    
    </div>
</body>
</html>
    