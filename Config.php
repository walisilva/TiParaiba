<?php
//LEMBRAR DE SEMPRE ABRIR A TAG <? COM PHP JUNTO, SHORT_TAG ESTÁ SENDO INUTILIZADO

$fone = $_POST["fone"];
	
echo "Telefone = +55".$fone; 
echo nl2br("\n");
echo nl2br("\n");
	
$servidor = 'mysql.hostinger.com.br';
$banco    = 'u978267253_tipb';
$usuario  = 'u978267253_tipb';
$senha    = 'senha';
//Melhorei a conexão para caso não conectar já matar o script e mostrar a mensagem, evita aquele if que tinha logo abaixo
$link     = mysql_connect($servidor, $usuario, $senha) or die("Falha ao conectar com o banco de dados!");
$db       = mysql_select_db($banco, $link);
$datahora = date('Y-m-d H:i:s');

//Seu grande problema estava aqui no SQL, como pode ver os nomes dos campos não podem ter aspas simples, se for mais de um aí separa por vírgulas.
//Outra coisa é evitar passar o $_POST direto no SQL para evitar injection e como você já tinha colocado em uma variável é melhor utiliza-la
//SQL Anterior: $SQL = "INSERT INTO Chekin ('fone') VALUES ('$_POST[fone]')";
$SQL = "INSERT INTO Chekin (fone, datahora) VALUES ('$fone', '$datahora')";

//inserir o $link é sempre bom para manter organizado e direcionar a query para o link correto
$resultado = mysql_query($SQL, $link);

//trecho de código para exibir o número do erro e a mensagem de erro caso o $resultado for igual a false
if (!$resultado){
echo mysql_errno($link) . ": " . mysql_error($link) . "\n";

echo nl2br("\n");
echo nl2br("\n");
}
  
//exibindo a ID da Linha Inserida no registro, caso não seja inserido a linha no bd é retornado 0, pode-se fazer várias verificações com isso
echo 'ID da Linha Inserida: ' . mysql_insert_id($link);

echo nl2br("\n");
echo nl2br("\n");
	
//echo "CHECKIN NAO FOI REALIZADO, AINDA TA DANDO PAU AQUI. TEM PACIENCIA CARA! hehehehe.";
echo "CHECKIN EM VERSAO DE TESTES! <br>
SEUS DADOS FORAM RECEBIDOS. OBRIGADO!";
?>
