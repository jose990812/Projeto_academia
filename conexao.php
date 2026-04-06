
<?php 

    $servidor = "localhost"; // Onde esta o banco
    $usuario = "root";       // usuario do banco padrão do xampp
    $senha = "";             // o xampp nao tem senha entao deixamos sem nada 
    $dbname = "aluno";       // nome do banco 

    $conexao = mysqli_connect($servidor, $usuario, $senha, $dbname); // aqui sao os campos para ele se conectar com o banco

    if (!$conexao) {
        die("Erro na conexão: " . mysqli_connect_error()); // retorna o erro que deu se caso nao se conectar com o banco
}