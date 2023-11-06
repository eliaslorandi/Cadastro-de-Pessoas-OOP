<?php

class Cidade{
    public static function all()
    {
        $conn = new PDO("mysql:host=localhost;dbname=livro", "root", "");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); //tratamento de erros será tratado como excessao

        $result = $conn->query("SELECT * FROM cidades ORDER BY id");
        return $result->fetchAll();
    }
}
