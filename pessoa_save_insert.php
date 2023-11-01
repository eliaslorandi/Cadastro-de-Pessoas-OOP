<?php

$dados = $_POST;

$conn = mysqli_connect("localhost", "livro", "root", "",);

$result = mysqli_query($conn, "SELECT max(id) as next FROM pessoas");// max() retorna o ultimo id
$row = mysqli_fetch_assoc($result);
$next = (int) $row['next'] + 1;

$sqli = "INSERT INTO pessoas (id, nome, endereco, bairro, telefone, email, id_cidade) VALUES ( '{$next}', 
'{$dados['nome']}', 
'{$dados['endereco']}', 
'{$dados['bairro']}', 
'{$dados['telefone']}',
'{$dados['email']}', 
'{$dados['id_cidade']}')";

print $sqli;

if($result){
    print 'Registro inserido com sucesso!';

}else{
    print mysqli_error($conn) . '<br>';
}

mysqli_close($conn);