<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<title>ZENET</title>
<link rel="stylesheet" href="cadastro.css">
<link rel="shortcut icon" href="bbb.ico" type="image/x-icon">
</head>







<?php
    include("conexao.php");   // chamando a conexao do outro arquivo

    $erro = "";

    //verificando se os campos abaixo existem , para nao dar erro de primeira
    if (
        isset($_POST["nome"]) &&
        isset($_POST["cpf"]) &&
        isset($_POST["email"]) &&
        isset($_POST["senha"]) &&
        isset($_POST["senha2"]) &&
        isset($_POST["telefone"])
    ) {

        $nome = $_POST["nome"];
        $cpf = $_POST["cpf"];
        $email = $_POST["email"];
        $senha = $_POST["senha"];
        $senha2 = $_POST["senha2"];
        $telefone = $_POST["telefone"];

        // Verifica campos vazios
        if (empty($nome) || empty($cpf) || empty($email) || empty($senha) || empty($senha2) || empty($telefone)) {
            $erro = "Preencha todo o formulário";
        }

        // Verifica senha
        else if ($senha != $senha2) {
            $erro = "As senhas não coincidem";
        }

        // Inserir no banco
        else {

            $sql = "INSERT INTO login2 (nome, cpf, email, senha, telefone)     
                    VALUES ('$nome', '$cpf', '$email', '$senha', '$telefone')"; // comando INSERT INTO para colocar os dados na tabela depois o nome da tabela e o nome das colunas na tabela, depois vem os valors da tavela com as variaveis que vai receber 

            if(mysqli_query($conexao, $sql)){ // esse comando é como se fosse um comando para se comunicar e enviar o conteudo para a tabela 
                echo " Inserido com sucesso!";
                
                header("Location: /login/login.php");
                exit();
            } else {
                echo " Erro: " . mysqli_error($conexao); //mostra o erro que deu ao enviar 
            }
        }
    }
?>


<body>
    
    
    <div class="caixa">
        <a class = voltar href="/login/login.php">Voltar</a>


        <img src="img/semfundo.png" alt="Imagem">


    
        <form method="post">

            <h1 class = cadastros>CADASTRO</h1>
            <input type="text" name="nome" placeholder="Nome completo" required><br><br>
            <input type="cpf" name="cpf" maxlength="11" minlength="11"placeholder="CPF"required><br><br>
            <input type="email" name="email" placeholder="E-mail"required><br><br>
            <input type="password" name="senha" placeholder="Senha"required><br><br>
            <input type="password" name="senha2" placeholder="Digite novamente a senha"required><br><br>
            <input type="tel" name="telefone" maxlength="11"  placeholder="(11) 55555-5555"required><br><br>
            <p><?php  echo $erro ?></p>
            <button type="submit"><b>Cadastrar</b></button><br>
    
        </form>
    </div>



</body>
</html>