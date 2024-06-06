<html lang="PT-BR">
<head>
    <meta charset="UTF-8">
    <title>Menu de Cadastros</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('livraria.jpg'); 
            background-size: cover;
            background-position: center;
        }
        .container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .menu {
            width: 300px;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #f9f9f9;
            text-align: center;
            display: flex; 
            flex-direction: column; 
            justify-content: center; 
            align-items: center;
        }

        .menu button {
            display: block;
            margin-bottom: 10px;
            padding: 10px;
            text-decoration: none;
            color: #ffffff;
            font-size: 16px;
            transition: color 0.3s ease;
            border: none;
            background: gray;
            border-radius: 5px;
            cursor: pointer;
        }
        .menu button:hover {
            color: #0056b3;
        }
        .voltar {
            margin-top: 20px;
            text-align: center;
        }
        .voltar button {
            color: #ffffff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: gray;
            cursor: pointer;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }
        .voltar button:hover {
            color: #0056b3;
        }
        table {
            width: 80%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="menu">
            <h2><b>Informações de Vendas:</b></h2>
            <?php
                // Database connection
                $connect = mysqli_connect('localhost', 'root', '', 'livraria');

                // Verificar a conexão
                if (!$connect) {
                    die('Erro de conexão: ' . mysqli_connect_error());
                }

                // Query to retrieve sales data
                $sql = "SELECT id, data, hora, nomecliente, endcliente, valortotal, valordesc FROM vendas";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Data</th><th>Hora</th><th>Nome do Cliente</th><th>Endereço do Cliente</th><th>Valor Total</th><th>Valor Desconto</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["data"] . "</td>";
                        echo "<td>" . $row["hora"] . "</td>";
                        echo "<td>" . $row["nomecliente"] . "</td>";
                        echo "<td>" . $row["endcliente"] . "</td>";
                        echo "<td>" . $row["valortotal"] . "</td>";
                        echo "<td>" . $row["valordesc"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 resultados";
                }

                // Query to retrieve book sales data
                $sql = "SELECT lv.id, lv.codvendas, lv.codlivro, lv.qtde, lv.preco FROM livrosvendas lv";
                $result = $connect->query($sql);

                if ($result->num_rows > 0) {
                    echo "<h2><b>Informações de Livros Vendidos:</b></h2>";
                    echo "<table>";
                    echo "<tr><th>ID</th><th>Código da Venda</th><th>Código do Livro</th><th>Quantidade</th><th>Preço</th></tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["id"] . "</td>";
                        echo "<td>" . $row["codvendas"] . "</td>";
                        echo "<td>" . $row["codlivro"] . "</td>";
                        echo "<td>" . $row["qtde"] . "</td>";
                        echo "<td>" . $row["preco"] . "</td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "0 resultados";
                }

                $connect->close();
            ?>
        </div>
        <div class="voltar">
            <button onclick="window.location.href='menu.php'">Voltar ao menu</button>
        </div>
    </div>
</body>
</html>
