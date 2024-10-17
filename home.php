<?php
//conectar com bando dados
$connect = mysql_connect('localhost','root','');
$db      = mysql_select_db('loja');
?>

<HTML>
<HEAD>
 <TITLE> Pesquisa Produtos</TITLE>
  <link rel="stylesheet" href="css/bootstrap.min.css" >
  <style type="text/css">
      .form-controle {
        display: block;
        width: 35%; 
        height: 60px;
        padding: 6px 12px;
        font-size: 14px;
        line-height: 1.42857143;
        color: #555;
        background-color: #fff;
        background-image: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
        -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
        -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
        transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            margin-left: 35px;
       }
       label {
        display: inline-block;
        max-width: 100%;
        margin-bottom: 5px;
        font-weight: 700;
        margin-left: 35px;
        }
        .h1, h1 {
        font-size: 36px;
        margin-left: 35px;
        }
        body{
            text-align: center
        }
        .imagem {
            text-align: right;
        }

  </style>
</HEAD>
<body>
        <form name="formulario" method="post" action="home.php">
        <div class="imagem">
         <a href="login.html"><img class="imagem" src="./fotos/loginbtn.png" width=100 height=050 ></a>
       </div>
       <img src="./fotos/logoLoja.png" width=200 height=150 align="center">
        <h1>VENDA DE PRODUTOS</h1><br>
        
        <h1>Pesquisa de Produtos por:</h1>
        <label for="">Marcas: </label>
            <select name="marca">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, nome FROM marca");
            while($marcas = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $marcas['codigo']?>">
                        <?php echo $marcas['nome']  ?></option>
            <?php }
            ?>
            </select>

            <label for="">Categoria: </label>
            <select name="categoria">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, descricao  FROM categoria");
            while($categoria = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $categoria['codigo']?>">
                        <?php echo $categoria['descricao']  ?></option>
            <?php }
            ?>

            </select>

            <label for="">Classificacao: </label>
            <select name="classificacao">
            <option value="" selected="selected">Selecione...</option>

            <?php
            $query = mysql_query("SELECT codigo, nome  FROM classificacao");
            while($classificacao = mysql_fetch_array($query))
            {?>
            <option value="<?php echo $classificacao['codigo']?>">
                        <?php echo $classificacao['nome']  ?></option>
            <?php }
            ?>

            </select>
            <input  type="submit" name="pesquisar" value="Pesquisar">
        </form>
            <br><br>

<?php

if (isset($_POST['pesquisar']))
{

//------- pesquisa marcas
$sql_marcas  = "SELECT * FROM marca ";
$pega_marcas = mysql_query($sql_marcas);

$sql_categoria  = "SELECT * FROM categoria ";
$pega_categoria = mysql_query($sql_categoria);

$sql_classificacao  = "SELECT * FROM classificacao ";
$pega_classificacao = mysql_query($sql_classificacao);


//-------- verificar as opcoes selecionadas ou nao
$marca      = (empty($_POST['marca']))? 'null' : $_POST['marca'];
$categoria  = (empty($_POST['categoria']))? 'null' : $_POST['categoria'];
$classificacao  = (empty($_POST['classificacao']))? 'null' : $_POST['classificacao'];

if (($marca <> 'null') and ($categoria == 'null') and ($classificacao == 'null'))
{
     $sql_produto       = "SELECT produto.descricao, produto.cor, produto.tamanho,
                                  produto.preco, produto.foto1, produto.foto2, produto.foto3
                            FROM produto, marca, categoria, classificacao
                            WHERE produto.codcategoria = categoria.codigo
                            and produto.codmarca = marca.codigo
                            and produto.codclassicacao = classificacao.codigo
                            and marca.codigo = $marca ";
                            
     $seleciona_produto = mysql_query($sql_produto);

}

if (($marca == 'null') and ($categoria <> 'null') and ($classificacao == 'null'))
{
     $sql_produto       = "SELECT produto.descricao, produto.cor, produto.tamanho,
                                  produto.preco, produto.foto1, produto.foto2, produto.foto3
                            FROM produto, marca, categoria, classificacao
                            WHERE produto.codcategoria = categoria.codigo
                            and produto.codmarca = marca.codigo
                            and produto.codclassicacao = classificacao.codigo
                            and categoria.codigo = $categoria ";
                            
     $seleciona_produto = mysql_query($sql_produto);

}

if (($marca == 'null') and ($categoria == 'null') and ($classificacao <> 'null'))
{
     $sql_produto        = "SELECT produto.descricao, produto.cor, produto.tamanho,
                                  produto.preco, produto.foto1, produto.foto2, produto.foto3
                            FROM produto, marca, categoria, classificacao
                            WHERE produto.codcategoria = categoria.codigo
                            and produto.codmarca = marca.codigo
                            and produto.codclassicacao = classificacao.codigo
                            and classificacao.codigo = $classificacao ";
                            
     $seleciona_produto = mysql_query($sql_produto);

}

if (($marca <> 'null') and ($categoria <> 'null') and ($classificacao == 'null'))
{
     $sql_produto       = "SELECT produto.descricao, produto.cor, produto.tamanho,
                                  produto.preco, produto.foto1, produto.foto2, produto.foto3
                            FROM produto, marca, categoria, classificacao
                            WHERE produto.codcategoria = categoria.codigo
                            and produto.codmarca = marca.codigo
                            and produto.codclassicacao = classificacao.codigo
                            and marca.codigo = $marca
                            and categoria.codigo = $categoria";
                            
     $seleciona_produto = mysql_query($sql_produto);
}

if (($marca <> 'null') and ($categoria == 'null') and ($classificacao <> 'null'))
{
     $sql_produto       = "SELECT produto.descricao, produto.cor, produto.tamanho,
                                  produto.preco, produto.foto1, produto.foto2, produto.foto3
                            FROM produto, marca, categoria, classificacao
                            WHERE produto.codcategoria = categoria.codigo
                            and produto.codmarca = marca.codigo
                            and produto.codclassicacao = classificacao.codigo
                            and marca.codigo = $marca
                            and classificacao.codigo = $classificacao ";
                            
     $seleciona_produto = mysql_query($sql_produto);
}

if (($marca == 'null') and ($categoria <> 'null') and ($classificacao <> 'null'))
{
     $sql_produto       = "SELECT produto.descricao, produto.cor, produto.tamanho,
                                  produto.preco, produto.foto1, produto.foto2, produto.foto3
                            FROM produto, marca, categoria, classificacao
                            WHERE produto.codcategoria = categoria.codigo
                            and produto.codmarca = marca.codigo
                            and produto.codclassicacao = classificacao.codigo
                            and categoria.codigo = $categoria
                            and classificacao.codigo = $classificacao ";
                            
     $seleciona_produto = mysql_query($sql_produto);
}

if (($marca <> 'null') and ($categoria <> 'null') and ($classificacao <> 'null'))
{
     $sql_produto       = "SELECT produto.descricao, produto.cor, produto.tamanho,
                                  produto.preco, produto.foto1, produto.foto2, produto.foto3
                            FROM produto, marca, categoria, classificacao
                            WHERE produto.codcategoria = categoria.codigo
                            and produto.codmarca = marca.codigo
                            and produto.codclassicacao = classificacao.codigo
                            and marca.codigo = $marca
                            and categoria.codigo = $categoria
                            and classificacao.codigo = $classificacao ";
                            
     $seleciona_produto = mysql_query($sql_produto);
}

if (($marca == 'null') and ($categoria == 'null') and ($classificacao == 'null'))
{
     $sql_produto       = "SELECT produto.descricao, produto.cor, produto.tamanho,
                                  produto.preco, produto.foto1, produto.foto2, produto.foto3
                            FROM produto";
                            
     $seleciona_produto = mysql_query($sql_produto);
}



//--------mostrar os produtos pesquisados--------exportar banco//
if ($seleciona_produto != TRUE)  
{
    echo '<h1>Desculpe, mas sua busca nao retornou resultados ... </h1>';
}

else
{
   echo "Resultado da pesquisa de Produtos: <br><br>";
   echo "<ul>";
			while($resultado = mysql_fetch_array($seleciona_produto))
			{
			echo "<tr><td> descricao:".utf8_encode($resultado['descricao'])."</td>
			          Cor: <td>".utf8_encode($resultado['cor'])."</td>
			         Tamanho: <td>".utf8_encode($resultado['tamanho'])."</td>
			        Valor:<td>".($resultado['preco'])."</td></tr><br><br>";
            echo '<img src="fotos/'.$resultado['foto1'].'" height="100" width="100" />'." ";
            echo '<img src="fotos/'.$resultado['foto2'].'" height="100" width="100" />'." ";
            echo '<img src="fotos/'.$resultado['foto3'].'" height="100" width="100" />'."<br><br> ";
			}
}
}
?>
</body>

</HTML>
