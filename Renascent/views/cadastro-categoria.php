<?php
session_start();
if (($_SESSION['email'] != 'adm') ||
    ($_SESSION['password'] != md5('123'))
) {
    header("Location: ../index.php");
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Renascent</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link href="../CSS/cadastro.css"
          type="text/css"
          rel="stylesheet">
</head>
<body>
    <center>
<div class="card">
    <br>
    <br>
<h2 class= "card-header">Cadastrar Categoria!</h2>
            <div class="card-body">
            <form action="../controllers/ClassificacaoController.php" method="post">
            <h4><span>Categoria: 
                    <br>
                    <br>
                    
                <select name="classificacao" class="custom-select sources" placeholder="Selecione"></h4>
                <option value="null">Selecione</option>
                <option value="Escultura">Escultura</option>
                <option value="Pintura">Pintura</option>
                <option value="vitral">Vitral</option>
                <option value="arquitetonica">Arquitetônica</option></select>
                </select></span>
                <br>
                <br>
                <button class="fonteBtn">Cadastrar Categoria</button>
                <br>
                <br>
                <a href="index-funcionario.php" class="voltar">Voltar</a>
            </form>
        </div>
</div>
    </center>
</body>
</html>