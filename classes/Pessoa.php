<?php
class Pessoa
{
    private static $conn; //static para manter o valor inicial

    public static function getConneciton()
    {
        if (empty(self::$conn)) { //if para nao abrir a conexao só vez, se estiver aberta, usa a mesma conexão
            $ini = parse_ini_file('config/livro.ini');
            $host = $ini['host'];
            $name = $ini['name'];
            $user = $ini['user'];
            $pass = $ini['pass'];

            self::$conn = new PDO("mysql:host={$host}; dbname={$name}; password={$pass}; user={$user}");
            self::$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }
        return self::$conn;
    }

    public static function find($id)
    {
        $conn = self::getConneciton();

        $result = $conn->query("SELECT * FROM pessoas WHERE id='{$id}'");
        return $result->fetch(); //retorne para quem chamou
    }

    public static function delete($id)
    {
        $conn = self::getConneciton();

        $result = $conn->query("DELETE FROM pessoas WHERE id='{$id}'");
        return $result;
    }

    public static function all()
    {
        $conn = self::getConneciton();

        $result = $conn->query("SELECT * FROM pessoas ORDER BY id");
        return $result->fetchAll();
    }

    public static function save($pessoa)
    {
        $conn = self::getConneciton();

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
