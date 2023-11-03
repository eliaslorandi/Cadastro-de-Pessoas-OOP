<?php

function get_pessoa($id){//id
    $conn = mysqli_connect('localhost', 'root', '', 'livro');

    $result = mysqli_query($conn, "SELECT * FROM pessoas WHERE id='{$id}'");
    $pessoa = mysqli_fetch_assoc($result); //obtem os dados
    mysqli_close($conn);
    return $pessoa;
}

function excluir_pessoa($id){//id
    $conn = mysqli_connect('localhost', 'root', '', 'livro');

    $result = mysqli_query($conn, "DELETE FROM pessoas WHERE id='{$id}'");
    //$pessoa = mysqli_fetch_assoc($result);
    mysqli_close($conn);
    return $result;
}

function insert_pessoa($pessoa){//vetor
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $sql = "INSERT INTO pessoas (id, nome, endereco, bairro, telefone, email, id_cidade)
                    VALUES ('{$pessoa['id']}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['id_cidade']}')";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function update_pessoa($pessoa){//vetor
    $conn = mysqli_connect('localhost', 'root', '', 'livro');
    $sql = "UPDATE pessoas SET nome = '{$pessoa['nome']}',
                                      endereco = '{$pessoa['endereco']}',
                                      bairro = '{$pessoa['bairro']}',
                                      telefone = '{$pessoa['telefone']}',
                                      email = '{$pessoa['email']}',
                                      id_cidade = '{$pessoa['id_cidade']}'
                                      WHERE id = '{$pessoa['id']}'";
    $result = mysqli_query($conn, $sql);
    mysqli_close($conn);
    return $result;
}

function lista_pessoas(){
    $conn = mysqli_connect('localhost', 'root', '', 'livro');

    $result = mysqli_query($conn, "SELECT * FROM pessoas ORDER BY id");
    $list = mysqli_fetch_all($result); //retorna todas as linhas de uma vez, formando uma matriz
    mysqli_close($conn);
    return $list;
}

function get_next_pessoa(){ //pega o proximo id
    $conn = mysqli_connect('localhost', 'root', '', 'livro');

    $result = mysqli_query($conn, "SELECT max(id) as next FROM pessoas");
    $pessoa = mysqli_fetch_assoc($result);
    $next = (int)$pessoa['next'] + 1;
    mysqli_close($conn);
    return $next;
}