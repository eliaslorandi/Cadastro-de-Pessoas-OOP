<?php
$conn = mysqli_connect('localhost', 'root', '', 'livro');
if (!empty($_GET['action']) and $_GET['action'] == 'delete') {
    $id = (int) $_GET['id'];
    $result = mysqli_query($conn, "DELETE FROM pessoas WHERE id = '{$id}'");
}
$result = mysqli_query($conn, 'SELECT * from pessoas ORDER BY id'); //carrega as pessoas do db

$items = '';
while ($row = mysqli_fetch_assoc($result)) { //percorro os registros
    $item = file_get_contents('html/item.html'); //para cada registro, leio o item.html e substituo as variaveis do modelo
    $item = str_replace('{id}', $row['id'], $item);
    $item = str_replace('{nome}', $row['nome'], $item);
    $item = str_replace('{endereco}', $row['endereco'], $item);
    $item = str_replace('{bairro}', $row['bairro'], $item);
    $item = str_replace('{telefone}', $row['telefone'], $item);

    $items .= $item;
}

$list = file_get_contents('html/list.html'); //leio o list.html
$list = str_replace('{items}', $items, $list);
print $list;