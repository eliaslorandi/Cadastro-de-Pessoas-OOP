<?php

function lista_combo_cidades(){
    $conn = mysqli_connect("localhost", "livro", "root", "",);

    $output = '';
    $result = mysqli_query($conn, 'SELECT id, nome FROM cidades');
    if ($result){
        while($row = mysqli_fetch_assoc($result)){
            $id = $row['id'];
            $nome = $row['nome'];
            $output .="<option value='{id}'> $nome </option>";
        }
    }
    mysqli_close($conn);
    return $output;
}
