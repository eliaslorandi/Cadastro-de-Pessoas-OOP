<?php

$id = '';
$nome = '';
$endereco = '';
$bairro = '';
$telefone = '';
$email = '';
$cidade = '';

$conn = mysqli_connect('mysql:host=localhost;dbname=livro', 'root', '');

if(!empty($_REQUEST['action'])){
}

$form = file_get_contents('html/form.html');
$form = str_replace('{id}', $id, $form);
$form = str_replace('{nome}', $nome, $form);
$form = str_replace('{endereco}', $endereco, $form);
$form = str_replace('{bairro}', $bairro, $form);
$form = str_replace('{telefone}', $telefone, $form);
$form = str_replace('{email}', $email, $form);
$form = str_replace('{cidade}', $cidade, $form);

print $form;