<?php
require_once 'classes/Pessoa.php';

try { //tratar excessao, todas vao pra fora do if, operações que interagem com o banco de dados
    if (!empty($_GET['action']) and $_GET['action'] == 'delete') {
        $id = (int) $_GET['id'];
        Pessoa::delete($id); //metodo delete da classe Pessoa
    }
    $pessoas = Pessoa::all(); //metodo all da classe Pessoa
} catch (Exception $e) {
    print $e->getMessage();
}
$items = '';

if ($pessoas) {
    foreach ($pessoas as $pessoa) {
        $item = file_get_contents('html/item.html'); //para cada registro, leio o item.html e substituo as variaveis do modelo
        $item = str_replace('{id}', $pessoa['id'], $item);
        $item = str_replace('{nome}', $pessoa['nome'], $item);
        $item = str_replace('{endereco}', $pessoa['endereco'], $item);
        $item = str_replace('{bairro}', $pessoa['bairro'], $item);
        $item = str_replace('{telefone}', $pessoa['telefone'], $item);

        $items .= $item;
    }
}

$list = file_get_contents('html/list.html'); //leio o list.html
$list = str_replace('{items}', $items, $list);
print $list;
