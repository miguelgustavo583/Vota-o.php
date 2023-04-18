<!DOCTYPE html>
<html>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<head>
<title>Sistema de Votação</title>
</head>
<body>
<h1>Qual sua opção favorita?</h1>

<form method="post" action="">
<input type="radio" name="opcao" value="opcao1">Opção 1<br>
<input type="radio" name="opcao" value="opcao2">Opção 2<br>
<input type="radio" name="opcao" value="opcao3">Opção 3<br><br>
<input type="submit" name="votar" value="Votar">
</form>

<?php

// define as opções de votação
$opcoes = array(
'opcao1' => 'Opção 1',
'opcao2' => 'Opção 2',
'opcao3' => 'Opção 3'
);

// verifica se o formulário foi enviado
if(isset($_POST['votar'])) {

// obtém a opção selecionada pelo usuário
$opcao = $_POST['opcao'];

// verifica se a opção selecionada é válida
if(array_key_exists($opcao, $opcoes)) {

// abre o arquivo de votos
$arquivo = fopen("votos.txt", "a+");

// adiciona o voto à opção selecionada
fwrite($arquivo, $opcao."\n");

// fecha o arquivo de votos
fclose($arquivo);

echo "<p>Voto registrado com sucesso!</p>";

} else {

echo "<p>Opção inválida!</p>";

}

}

// abre o arquivo de votos
$arquivo = fopen("votos.txt", "r");

// inicializa o contador de votos
$votos = array(
'opcao1' => 0,
'opcao2' => 0,
'opcao3' => 0
);

// conta os votos de cada opção
while(!feof($arquivo)) {

$linha = fgets($arquivo);

if(array_key_exists(trim($linha), $votos)) {

$votos[trim($linha)]++;

}

}

// fecha o arquivo de votos
fclose($arquivo);

// exibe os resultados da votação
echo "<h2>Resultados:</h2>";

foreach($votos as $opcao => $qtd_votos) {

echo "<p>".$opcoes[$opcao].": ".$qtd_votos." votos</p>";

}

?>
</body>
</html>