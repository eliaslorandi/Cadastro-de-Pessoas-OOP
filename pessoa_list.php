<html>
    <head>
        <meta charset="utf-8">
        <title> Listagem de pessoas </title>
        <link href="css/list.css" rel="stylesheet" type="text/css" media="screen" />
    </head>
    <body>
    <table border=1>
    <thead>
        <tr>
            <td></td>
            <td></td>
            <td>Id</td>
            <td>Nome</td>
            <td>Endereço</td>
            <td>Bairro</td>
            <td>Telefone</td>
        </tr>
    </thead>
    <tbody>
        <?php
            $conn = mysqli_connect('localhost', 'root', '', 'livro');
            if ( !empty($_GET['action']) AND $_GET['action'] == 'delete' )
            {
                $id = (int) $_GET['id'];
                $result = mysqli_query($conn, "DELETE FROM pessoas WHERE id = '{$id}'");

            }
            $result = mysqli_query($conn, 'SELECT * from pessoas ORDER BY id');

            while ($row = mysqli_fetch_assoc($result))
            {
                $id        = $row['id'];
                $nome      = $row['nome'];
                $endereco  = $row['endereco'];
                $bairro    = $row['bairro'];
                $telefone  = $row['telefone'];
                $email     = $row['email'];
                $id_cidade = $row['id_cidade'];
                
                print '<tr>';
                print "<td> <a href='pessoa_form.php?action=edit&id={$id}'>
                             <img src='images/edit.svg' style='width:17px'>
                            </a> </td>";
                print "<td> <a href='pessoa_list.php?action=delete&id={$id}'>
                             <img src='images/remove.svg' style='width:17px'>
                            </a> </td>";
                print "<td> {$id} </td>";
                print "<td> {$nome} </td>";
                print "<td> {$endereco} </td>";
                print "<td> {$bairro} </td>";
                print "<td> {$telefone} </td>";
                print '</tr>';
            }
        ?>
    </tbody>
    </table>
    
    <button onclick="window.location='pessoa_form.php'">
        <img src="images/insert.svg" style="width:17px"> Inserir
    </button>
    
    </body>
</html>
