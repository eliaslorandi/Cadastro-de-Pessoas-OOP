<?php
class Pessoa
{
    public static function find($id)
    {
        $conn = new PDO("mysql:host=localhost;dbname=livro", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //tratamento de erros será tratado como excessao

        $result = $conn->query("SELECT * FROM pessoas WHERE id='{$id}'");
        return $result->fetch(); //retorne para quem chamou
    }

    public static function delete($id)
    {
        $conn = new PDO("mysql:host=localhost;dbname=livro", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //tratamento de erros será tratado como excessao

        $result = $conn->query("DELETE FROM pessoas WHERE id='{$id}'");
        return $result;
    }

    public static function all()
    {
        $conn = new PDO("mysql:host=localhost;dbname=livro", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //tratamento de erros será tratado como excessao

        $result = $conn->query("SELECT * FROM pessoas ORDER BY id");
        return $result->fetchAll();
    }

    public static function save($pessoa)
    {
        $conn = new PDO("mysql:host=localhost;dbname=livro", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //tratamento de erros será tratado como excessao

        if (empty($pessoa['id'])) {
            $result = $conn->query("SELECT max(id) as next FROM pessoas");
            $row = $result->fetch();
            $pessoa['id'] = (int)$row['next'] + 1;

            $sql = "INSERT INTO pessoas (id, nome, endereco, bairro, telefone, email, id_cidade)
                    VALUES ('{$pessoa['id']}', '{$pessoa['nome']}', '{$pessoa['endereco']}', '{$pessoa['bairro']}', '{$pessoa['telefone']}', '{$pessoa['email']}', '{$pessoa['id_cidade']}')";
        } else {
            $sql = "UPDATE pessoas SET nome = '{$pessoa['nome']}',
                                      endereco = '{$pessoa['endereco']}',
                                      bairro = '{$pessoa['bairro']}',
                                      telefone = '{$pessoa['telefone']}',
                                      email = '{$pessoa['email']}',
                                      id_cidade = '{$pessoa['id_cidade']}'
                                      WHERE id = '{$pessoa['id']}'";
        }

        return $conn->query($sql);
    }
}
