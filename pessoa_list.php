<?php

$dados = $_POST;

$conn = mysqli_connect('mysql:host=localhost; dbname=livro', 'root', '');

$sql = "INSERT INTO pessoa (nome, rua, bairro, cidade, estado, email, telefone)";