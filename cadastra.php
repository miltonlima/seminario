<?php

require_once "conexao.php";

$nome = $_POST['nome'];
$nome_artistico = $_POST['nome_artistico'];
$cpf = $_POST['cpf'];
$data_nascimento = $_POST['data_nascimento'];
$nacionalidade = $_POST['nacionalidade'];
$naturalidade = $_POST['naturalidade'];
$email = $_POST['email'];
//$confirma_email = $_POST['confirma_email'];
$endereco = $_POST['endereco'];
$complemento = $_POST['complemento'];
$bairro = $_POST['bairro'];
$cep = $_POST['cep'];
$estado = $_POST['estado'];
$cidade = $_POST['cidade'];
$telefone = $_POST['telefone'];
$vinculo_institucional = $_POST['vinculo_institucional'];
$descricao_vinculo = $_POST['descricao_vinculo'];
//$data_registro = $_POST['data_registro'];
$data_nascimento = '1111-11-11';

$Conexao    = Conexao::getConnection();

$sql = "insert into inscricao_seminario (nome, nome_artistico, cpf, data_nascimento, nacionalidade, naturalidade, email, endereco, complemento, bairro, cep, estado, cidade, telefone, vinculo_institucional, descricao_vinculo, data_registro) values('$nome', '$nome_artistico', '$cpf', '$data_nascimento', '$nacionalidade', '$naturalidade', '$email', '$endereco', '$complemento', '$bairro', '$cep', '$estado', '$cidade', '$telefone', '$vinculo_institucional', '$descricao_vinculo', CURRENT_TIMESTAMP)";

echo $sql;

//$Conexao->query($sql);



/*
$k = '';
$v = '';
foreach ($_POST as $key => $value) {
  echo "POST parameter '$key' has '$value'";

  echo "POST parameter '$key' has '$value'<br>";
  $k .=  $key . ", ";
  $v .=  "'" . $value . "', ";
}

$k .= "data_registro";
$v .= "CURRENT_TIMESTAMP";

$sql = "select * from inscricao_seminario ($k) values($v)";

echo $sql;

'nome', 'nome_artistico', 'cpf', 'data_nascimento', 'nacionalidade', 'naturalidade', 'email', 'confirma_email', 'endereco', 'complemento', 'bairro', 'cep', 'estado', 'cidade', 'telefone', 'vinculo_institucional', 'descricao_vinculo', 'data_registro'
*/
