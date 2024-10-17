<?php
// conectar o banco de dados com o PHP
$connect = mysql_connect('localhost','root','');
$db      = mysql_select_db('loja');

if(isset($_POST['gravar'])){  // se apertar o botão 'gravar' 

    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    $login = $_POST['login'];     //atribuindo valor para a variavel pelo html
    $senha = $_POST['senha'];

    $sql = "insert into usuario(codigo,nome,login,senha) values('$codigo','$nome','$login','$senha')";

    $resultado = mysql_query($sql); //resultado do comando 

    if($resultado == 0)
    {
        echo "Informações gravadas com sucesso!!";
    }  
                                                      
    else{
         echo "Falha ao cadastrar informações!!"; //mostrar na tela o resultado
    }
}
    if(isset($_POST['excluir'])){

        $codigo = $_POST['codigo'];
        $nome = $_POST['nome'];
        $login = $_POST['login'];     
        $senha = $_POST['senha'];

        $sql = "delete from usuario where codigo = $codigo";

        $resultado = mysql_query($sql);

        if($resultado == 0){
            echo "Falha ao cadastrar informações!!";
        }
                                                          
        else{
            echo "Informações gravadas com sucesso!!";  //mostrar na tela o resultado
        }

    }

    if(isset($_POST['alterar'])){
        $codigo = $_POST['codigo'];
        $nome = $_POST['nome'];
        $login = $_POST['login'];     
        $senha = $_POST['senha'];

        $sql = " update usuario set nome = '$nome', login = '$login', senha = '$senha'
        where codigo = '$codigo'";

        $resultado = mysql_query($sql);

        if($resultado == 0){
            echo "Falha ao cadastrar informações!!";
        }
                                                          
        else{
            echo "Informações gravadas com sucesso!!";   //mostrar na tela o resultado
        }
    }

    if(isset($_POST['pesquizar'])){

        $sql = mysql_query("select codigo,nome,login,senha from usuario");

        if(mysql_num_rows($sql) == 0){
            echo"Desculpe,sua pesquiza não retornou resultados";
        }

        else{
            echo "Resultado da pesquiza do Usuário:"."<br><br>";
            while($resultado = mysql_fetch_arrey($sql)){
                echo "Codigo: ".$dados->codigo."";           


            }
        }
    }







?>