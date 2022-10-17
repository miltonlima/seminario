<?php

/**
 * This example shows making an SMTP connection without using authentication.
 */

//Import the PHPMailer class into the global namespace
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
//SMTP needs accurate times, and the PHP time zone MUST be set
//This should be done in your php.ini, but this is how to do it if you don't have access to that
date_default_timezone_set('Etc/UTC');

require 'vendor/autoload.php';

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

//echo $sql;

$Conexao->query($sql);

$query = $Conexao->query("select top(1) id from inscricao_seminario order by id desc");
$ors = $query->fetchAll();

//Enviar e-mail

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
//SMTP::DEBUG_OFF = off (for production use)
//SMTP::DEBUG_CLIENT = client messages
//SMTP::DEBUG_SERVER = client and server messages
$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = '192.168.0.139';
//Set the SMTP port number - likely to be 25, 465 or 587
$mail->Port = 25;
$mail->CharSet = 'UTF-8';
//We don't need to set this as it's the default value
//$mail->SMTPAuth = false;
//Set who the message is to be sent from
$mail->setFrom('noreply@sescrio.org.br', 'noreply');
//Set an alternative reply-to address
//$mail->addReplyTo('replyto@example.com', 'First Last');
//Set who the message is to be sent to
$mail->addAddress($email);
//Set the subject line
$mail->Subject = 'Inscrição realizada - Seminário Internacional de Mediaçao Cultural';
//Read an HTML message body from an external file, convert referenced images to embedded,
//convert HTML into a basic plain-text alternative body
//$mail->msgHTML(file_get_contents('contents.html'), __DIR__);
//Replace the plain text body with one created manually
//$mail->AltBody = 'This is a plain-text message body22';
$mail->Body = "Sua inscrição número: " . $ors[0]['id'] . " foi realizada com sucesso.";
//Attach an image file
//$mail->addAttachment('images/phpmailer_mini.png');

//send the message, check for errors
if (!$mail->send()) {
  echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
  echo 'Message sent!';
}


//Fim enviar e-mail

header("location: sucesso.html");



/*

$nome = $_POST['nome'];
$nome_artistico = $_POST['nome_artistico'];
$cpf = $_POST['cpf'];

$sql = $db->prepare("INSERT INTO inscricao_seminario (nome, nome_artistico, cpf) VALUES ('?' ,'?' ,'?')");
$sql->bindParam(1, $nome);
$sql->bindParam(2, $nome_artistico);
$sql->bindParam(3, $cpf);
$sql->execute();


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
