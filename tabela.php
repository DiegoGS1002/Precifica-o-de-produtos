<!DOCTYPE html>
<html lang=pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tabela de precificação</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/bootstrap.bundle.min.js"></script>

</head>
<body>
    <header>
        <h1>Tabela de Precificação</h1>
    </header>
    <main>
        <?php 
           $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "sistema_preco"; // exatamente igual ao nome criado no phpMyAdmin

            $conn = new mysqli($servername, $username, $password, $database);

            $custoMatPrima = $_GET["cmp"] ?? 0;
            $dsp = $_GET["despesas"] ?? 0;
            $Imposto = $_GET["impostos"] ?? 0;
            $Comissao = $_GET["comissao"] ?? 0;
            $FRETE = $_GET["frete"] ?? 0;
            $PRAZO = $_GET["prazo"] ?? 0;
            $Inadimplencia = $_GET["inad"] ?? 0;
            $Assistencia = $_GET["assistencia"] ?? 0;
            $VPC = $_GET["vpc"] ?? 0;
            //Calculo do preço
            $preco = 1/(1 - (($Imposto/100) + ($Comissao/100) + ($FRETE/100) + ($PRAZO/100) + ($Inadimplencia/100) + ($Assistencia/100) + ($VPC/100)));
         
            //SKU
            $SKU = $_GET['sku'] ?? '';
            //Descrição
            $descricao =$_GET['descricao'] ?? '';
            // irá pegar o custo da materia prima * a % que o cliente escolher para despesas 
            $despesas = $custoMatPrima * ($dsp/100);
            // irá pegar  as despesas + o custo da materia prima
            $custoProduto = $custoMatPrima + $despesas; 
            //Preço base
            $precoBase = $custoProduto * $preco;
            //COMERCIALIZAÇÃO
            // irá pegar o preço que o cliente irá vender o produto * pela % de impostos
            $impostos = $precoBase * ($Imposto/100);
            // irá pegar o preço que o cliente irá vender o produto * pela % da comissão
            $comissao = $precoBase * ($Comissao / 100);
            // irá pegar o preço que o cliente irá vender o produto * pela % do frete
            $frete = $precoBase * ($FRETE/100);
            // irá pegar o preço que o cliente irá vender o produto * pela % do prazo
            $prazo = $precoBase * ($PRAZO/100);
            // irá pegar o preço que o cliente irá vender o produto * pela % da inadimplencia
            $inadimplencia = $precoBase * ($Inadimplencia/100);
            // irá pegar o preço que o cliente irá vender o produto * pela % da assistencia
            $assistencia = $precoBase * ($Assistencia/100); 
            // irá pegar o preço que o cliente irá vender o produto * pela % do vpc
            $vpc = $precoBase * ($VPC/100);
        
            $precoFinal = $custoProduto*$preco;
            $lucro = (1 - ($custoTotal/$precoFinal))*100;

            echo "Descrição: $descricao | SKU: $SKU <br>";
            echo "Custo materia prima: R\$ ".number_format($custoMatPrima, 2, ",", ".")." | Despesas: R\$ ".number_format($despesas, 2, ",", ".")." | <br>";
            echo "<p>=================== COMERCIALIZAÇÃO ===================</p><br>";
            echo "Impostos: R\$ ".number_format($impostos, 2, ",", ".")." | Comissão: R\$ ".number_format($comissao, 2, ",", ".")." | Frete: R\$ ".number_format($frete, 2, ",", ".")." | Prazo : R\$ ".number_format($prazo, 2, ",", ".")." | Inadimplência: R\$ ".number_format($inadimplencia, 2, ",", ".")."| Assistência: R\$ ".number_format($assistencia, 2, ",", ".")." | VPC: R\$ ".number_format($vpc, 2, ",", ".")." | <br>";
            echo "<p> =================================================== </p><br>";
            echo "<p>Custo total: R\$ ".number_format($custoTotal, 2, ",", ".")." | Lucro:".number_format($lucro, 1, ",", ".")."% | Preço: R\$ ".number_format($precoFinal, 2, ",", ".")." |</p>";
        ?>

        <button onclick="history.go(-1)">Voltar</button>
    </main>
</body>
</html>

