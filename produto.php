<?php
//iniciar sessão PHP
session_start();

//Comandos de conexao com BD(localweb,usuario,senha)
$conectar = mysql_connect('localhost','root','');

//selecionar o BD revenda
$banco = mysql_select_db('loja');  

if (isset($_POST['gravar']))
{
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $codcategoria = $_POST['codcategoria'];
    $codclassicacao = $_POST['codclassicacao'];
    $codmarca = $_POST['codmarca'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];
    //fotos
    $foto1 = $_FILES['foto1'];
    $foto2 = $_FILES['foto2'];
    $foto3 = $_FILES['foto3'];
     
    $diretorio = "fotos/";    
    $extensao1 = strtolower(substr($_FILES['foto1']['name'],-4));    
    $novo_nome1 = md5(time()).$extensao1;    
    move_uploaded_file($_FILES['foto1']['tmp_name'],$diretorio.$novo_nome1);    
    
    $extensao2 = strtolower(substr($_FILES['foto2']['name'],-6));    
    $novo_nome2 = md5(time()).$extensao2;    
    move_uploaded_file($_FILES['foto2']['tmp_name'],$diretorio.$novo_nome2);

    $extensao3 = strtolower(substr($_FILES['foto3']['name'],-8));    
    $novo_nome3 = md5(time()).$extensao3;    
    move_uploaded_file($_FILES['foto3']['tmp_name'],$diretorio.$novo_nome3);

 $sql = "INSERT INTO produto (codigo,descricao,codcategoria,codclassicacao,codmarca,cor,tamanho,preco,foto1,foto2,foto3)
         VALUES ('$codigo','$descricao','$codcategoria','$codclassicacao','$codmarca','$cor','$tamanho','$preco','$novo_nome1','$novo_nome2','$novo_nome3')";

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





if (isset($_POST['excluir']))
{
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $codcategoria = $_POST['codcategoria'];
    $codclassicacao = $_POST['codclassicacao'];
    $codmarca = $_POST['codmarca'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];

    $sql = "DELETE FROM produto WHERE codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if($resultado === TRUE)
    {    //exibir mensagem
    echo"Dados excliuidos com sucesso.";
    }
       
    else
    { 
    echo"Erro ao excluir dados.";
    }
}
if (isset($_POST['alterar']))
{
    $codigo = $_POST['codigo'];
    $descricao = $_POST['descricao'];
    $codcategoria = $_POST['codcategoria'];
    $codclassicacao = $_POST['codclassicacao'];
    $codmarca = $_POST['codmarca'];
    $cor = $_POST['cor'];
    $tamanho = $_POST['tamanho'];
    $preco = $_POST['preco'];

    $sql = " update veiculo set valor = '$valor', descricao = '$descricao'
    where codigo = '$codigo'";

    $resultado = mysql_query($sql);

    if($resultado === TRUE)
    {    //exibir mensagem
        echo"Dados alterados com sucesso.";
    }
    else
    {
        echo"Erro ao alterar dados.";
    }
}

if (isset($_POST['pesquizar']))
{

    // comando do SQL para pesquizar
    $sql = mysql_query("SELECT codigo,descricao,codcategoria,codclassicacao,codmarca,placa,opcionais,valor,foto1,foto2,foto3 FROM veiculo");

    echo "<b>Veiculos Cadastradas:</b><br><br>";

    while ($dados = mysql_fetch_object($sql))
    {
        echo "Codigo: ".$dados->codigo."";
        echo "Nome: ".$dados->descricao." ";
        echo "Cod Modelo: ".$dados->codmodelo."<br>";
        echo "Ano: ".$dados->ano." ";
        echo "cor: ".$dados->cor." ";
        echo "placa: ".$dados->placa."<br>";
        echo "Opcionais: ".$dados->opcionais." ";
        echo "Valor $: ".$dados->valor."<br>";
        echo '<img src="fotos/'.$dados->foto1.'"  height="100" width="100" />'." ";
        echo '<img src="fotos/'.$dados->foto2.'"  height="100" width="100" />'."<br><br>";

    }



}

?>