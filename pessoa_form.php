<?php
require_once 'database/pessoa_db.php';

$pessoa = [];
$pessoa['id']        = '';
$pessoa['nome']      = '';
$pessoa['endereco']  = '';
$pessoa['bairro']    = '';
$pessoa['telefone']  = '';
$pessoa['email']     = '';
$pessoa['id_cidade'] = '';

if (!empty($_REQUEST['action'])) { //request pega tanto get quanto post
    $conn = mysqli_connect('localhost', 'root', '', 'livro');

    if ($_REQUEST['action'] == 'edit') {
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $result = mysqli_query($conn, "SELECT * FROM pessoas WHERE id='{$id}'");
            $pessoa = mysqli_fetch_assoc($result);
        }
    } else if ($_REQUEST['action'] == 'save') {
        $id = $_POST['id'];
        $pessoa = $_POST;

        if (empty($_POST['id'])) {
            $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoas");
            $row = mysqli_fetch_assoc($result);
            $next = (int)$row = $row['next'] + 1; //proximo registro

            $sql = "INSERT INTO pessoas (id, nome, endereco, bairro, telefone, email, id_cidade)
                    VALUES ('{$next}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['id_cidade']}')";

            $result = mysqli_query($conn, $sql);
        } else {
            $sql = "UPDATE pessoas SET nome = '{$pessoa['nome']}',
                                      endereco = '{$pessoa['endereco']}',
                                      bairro = '{$pessoa['bairro']}',
                                      telefone = '{$pessoa['telefone']}',
                                      email = '{$pessoa['email']}',
                                      id_cidade = '{$pessoa['id_cidade']}'
                                      WHERE id = '{$id}'";
            $result = mysqli_query($conn, $sql);
        }
        print ($result) ? 'Registro salvo com sucesso' : mysqli_error($conn);
        mysqli_close($conn);
    }
}
require_once 'lista_combo_cidades.php';
$cidades = lista_combo_cidades($pessoa ['id_cidade']); //gera as options do select

$form = file_get_contents('html/form.html'); //retorna como string o conteudo do arquivo
$form = str_replace('{id}',        $pessoa['id'], $form);
$form = str_replace('{nome}',      $pessoa['nome'], $form);
$form = str_replace('{endereco}',  $pessoa['endereco'], $form);
$form = str_replace('{bairro}',    $pessoa['bairro'], $form);
$form = str_replace('{telefone}',  $pessoa['telefone'], $form);
$form = str_replace('{email}',     $pessoa['email'], $form);
$form = str_replace('{id_cidade}', $pessoa['id_cidade'], $form);
$form = str_replace('{cidades}',   $cidades, $form); //retornando as cidades aqui, de $cidades

print $form;