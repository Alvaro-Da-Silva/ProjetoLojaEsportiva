<?php
//iniciar sessão PHP
session_start();

//Comandos de conexao com BD(localweb,usuario,senha)
$conectar = mysql_connect('localhost','root','');

//selecionar o BD revenda
$banco = mysql_select_db('loja'); 

//verificar se botão gravar foi selecionado
if (isset($_POST['gravar']))
{
    //capturar as variaveis do HTML
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];

    // comando do SQL para gravar
    $sql = "insert into marca (codigo,nome)
    values ('$codigo','$nome')";

    //executar o comando no BD
    $resultado = mysql_query($sql);

    //verificar se deu certo ou errado

    if($resultado === TRUE)
    {    //exibir mensagem
        echo"Dados gravados com sucesso.";
    }
    else
    {
        echo"Erro ao gravar dados.";
    }
}

//verificar se botão excluir foi selecionado
if (isset($_POST['excluir']))
{
    //capturar as variaveis do HTML
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    

    // comando do SQL para excluir
      $sql = "DELETE FROM marca WHERE codigo = '$codigo'";

    //executar o comando no BD
    $resultado = mysql_query($sql);

    //verificar se deu certo ou errado

    if($resultado === TRUE)
    {    //exibir mensagem
        echo"Dados excluidos com sucesso.";
    }
    else
    {
        echo"Erro ao excluir dados.";
    }
}

//verificar se botão alterar foi selecionado
if (isset($_POST['alterar']))
{
    //capturar as variaveis do HTML
    $codigo = $_POST['codigo'];
    $nome = $_POST['nome'];
    

    // comando do SQL para alterar
    $sql = " update marca set nome = '$nome'
           where codigo = '$codigo'";

    //executar o comando no BD
    $resultado = mysql_query($sql);

    //verificar se deu certo ou errado

    if($resultado === TRUE)
    {    //exibir mensagem
        echo"Dados alterados com sucesso.";
    }
    else
    {
        echo"Erro ao alterar dados.";
    }
}

//verificar se botão pesquizar foi selecionado
if (isset($_POST['pesquizar']))
{

    // comando do SQL para pesquizar
    $sql = mysql_query("SELECT * FROM marca");

    echo "<b>Marcas Cadastradas:</b><br><br>";

    while ($dados = mysql_fetch_object($sql))
    {
        echo "Codigo: ".$dados->codigo."";
        echo "Nome: ".$dados->nome."<br>";
    }



}
?>