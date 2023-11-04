<?php
require_once 'database/pessoa_db.php';
require_once 'lista_combo_cidades.php';

$pessoa = [];
$pessoa['id']        = '';
$pessoa['nome']      = '';
$pessoa['endereco']  = '';
$pessoa['bairro']    = '';
$pessoa['telefone']  = '';
$pessoa['email']     = '';
$pessoa['id_cidade'] = '';

if (!empty($_REQUEST['action'])) { //request pega tanto get quanto post

    if ($_REQUEST['action'] == 'edit') {
        if (!empty($_GET['id'])) {
            $id = (int) $_GET['id'];
            $pessoa = get_pessoa($id); //funcao do banco (pessoa_db.php
        }
    } else if ($_REQUEST['action'] == 'save') {
        $id = $_POST['id'];
        $pessoa = $_POST;

        if (empty($_POST['id'])) { //id vazio vai para insert, se não update
            $pessoa['id'] = get_next_pessoa(); //get pega o id e joga na variavel
            $result = insert_pessoa($pessoa);
        } else {
            $result = update_pessoa($pessoa);
        }
        print ($result) ? 'Registro salvo com sucesso' : 'Problemas ao salvar o registro';
    }
}
$cidades = lista_combo_cidades($pessoa['id_cidade']); //gera as options do select

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
