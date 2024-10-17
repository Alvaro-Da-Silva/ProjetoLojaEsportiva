<?php
// conectar o banco de dados com o PHP
$connect = mysql_connect('localhost','root','');
$db      = mysql_select_db('loja');

if(isset($_POST['conectar'])){  // se apertar o botão 'cadastrar' 

    $login = $_POST['login'];     //atribuindo valor para a variavel pelo html
    $senha = $_POST['senha'];

    $sql = mysql_query("select * FROM usuario where login='$login' and senha='$senha'");  //comando SQL

    $resultado = mysql_num_rows($sql); //resultado do comando 

    if($resultado == 0){
        echo "Login ou senha invalido...!!";
    }
                                                      
    else{
        session_start();
        $_SESSION['login'] = $login;
        header("Location:Lista.html");  //mostrar na tela o resultado
    }

}
?>