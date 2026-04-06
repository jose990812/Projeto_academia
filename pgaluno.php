<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Pagina do Aluno</title>
    <link rel="stylesheet" href="pgaluno.css">
</head>
<body>

<?php
session_start();
include("conexao.php");

$cpf = $_SESSION["cpf"];

$sql = "SELECT nome, exercicios1, exercicios2, exercicios3, exercicios4, exercicios5, exercicios6, exercicios7 FROM login2 WHERE cpf = '$cpf'";
$resultado = mysqli_query($conexao, $sql);

if(mysqli_num_rows($resultado) > 0){

    $linha = mysqli_fetch_assoc($resultado);

    $nome = $linha["nome"];
    $segunda = $linha["exercicios1"];
    $terca   = $linha["exercicios2"];
    $quarta  = $linha["exercicios3"];
    $quinta  = $linha["exercicios4"];
    $sexta   = $linha["exercicios5"];
    $sabado  = $linha["exercicios6"];
    $domingo = $linha["exercicios7"];

} 

?>



    <div class = img1>
        <img src="img/semfundo.png" alt="Imagem">
    </div>
    
    <div class = "nome">
        <h2><?php echo $nome ?></h2>
    </div>

    <div class = "caixas">
            


            <div class = "segunda">
                <h2>SEGUNDA</h2>
                <p><?php echo str_replace(", ", "<br><br>", $segunda); ?></p>
            </div>

            <div class = "terça">
                <h2>TERÇA</h2>
                <p><?php echo str_replace(", ", "<br><br>", $terca); ?></p>
            </div>

            <div class = "quarta">
                <h2>QUARTA</h2>
                <p><?php echo str_replace(", ", "<br><br>", $quarta); ?></p>
            </div>

            <div class = "quinta">
                <h2>QUINTA</h2>
                <p><?php echo str_replace(", ", "<br><br>", $quinta); ?></p>
            </div>

            <div class = "sexta">
                <h2>SEXTA</h2>
                <p><?php echo str_replace(", ", "<br><br>",  $sexta); ?></p>
            </div>

            <div class = "sabado">
                <h2>SÁBADO</h2>
                <p><?php echo str_replace(", ", "<br><br>", $sabado); ?></p>
            </div>

            <div class = "domingo">
                <h2>DOMINGO</h2>
                <p><?php echo str_replace(", ", "<br><br>", $domingo); ?></p>
            </div>
            <div class = "falsa">
            </div>
            
    </div>

  

</body>
</html>