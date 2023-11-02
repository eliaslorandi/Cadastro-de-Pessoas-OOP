<?php

$id         = '';
$nome       = '';
$endereco   = '';
$bairro     = '';
$telefone   = '';
$email      = '';
$id_cidade  = '';

if (!empty($_REQUEST['action'])) { //request pega tanto get quanto post
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    if ($_REQUEST['action'] == 'edit') {
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $result = mysqli_query($conn, "SELECT * FROM pessoas WHERE id='{$id}'");
            $row = mysqli_fetch_assoc($result);

            $id         = $row['id'];
            $nome       = $row['nome'];
            $endereco   = $row['endereco'];
            $bairro     = $row['bairro'];
            $telefone   = $row['telefone'];
            $email      = $row['email'];
            $id_cidade  = $row['id_cidade'];
        }
    } else if ($_REQUEST['action'] == 'save') {
        $id         = $_POST['id'];
        $nome       = $_POST['nome'];
        $endereco   = $_POST['endereco'];
        $bairro     = $_POST['bairro'];
        $telefone   = $_POST['telefone'];
        $email      = $_POST['email'];
        $id_cidade  = $_POST['id_cidade'];

        if (empty($_POST['id'])) {
            $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoas");
            $row = mysqli_fetch_assoc($result);
            $next = (int)$row = $row['next'] + 1;

            $sql = "INSERT INTO pessoas (id, nome, endereco, bairro, telefone, email, id_cidade)
                    VALUES ('{$next}', '{$nome}', '{$endereco}', '{$bairro}', '{$telefone}', '{$email}', '{$id_cidade}')";

            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE pessoas SET nome = '{$nome}',
                                      endereco = '{$endereco}',
                                      bairro = '{$bairro}',
                                      telefone = '{$telefone}',
                                      email = '{$email}',
                                      id_cidade = '{$id_cidade}'
                                      WHERE id = '{$id}'";
            $result = mysqli_query($conn, $sql);
        }
        print ($result) ? 'Registro salvo com sucesso' : mysqli_error($conn);
        mysqli_close($conn);
    }
}
require_once 'lista_combo_cidades.php';
$cidades = lista_combo_cidades($id_cidade); //gera as options do select

$form = file_get_contents('html/form.html'); //retorna como string o conteudo do arquivo
$form = str_replace('{id}', $id, $form);
$form = str_replace('{nome}', $nome, $form);
$form = str_replace('{endereco}', $endereco, $form);
$form = str_replace('{bairro}', $bairro, $form);
$form = str_replace('{telefone}', $telefone, $form);
$form = str_replace('{email}', $email, $form);
$form = str_replace('{id_cidade}', $id_cidade, $form);
$form = str_replace('{cidades}', $cidades, $form); //retornando as cidades aqui, de $cidades

print $form;