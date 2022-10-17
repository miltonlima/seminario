<?php

require_once "conexao.php";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seminário Internacional de Mediação Cultural</title>

    <style>
        html {
            border: 0;
            width: 100%;
            font-size: 14px;
        }


        table tr td {
            border: 1px solid #000000;
        }        
        
        .btable {
            font-weight: bold;
        }
    </style>
    <script>
        var a = '';
        function displayLineInfo(v) {
            //alert('a: '+a+' v: '+v);   
            if(a != ''){
               document.getElementById('vline' + a).style.display = 'none';
               alert('teste');
            }         
            x = document.getElementById('vline' + v);
            if (x.style.display === 'none') {
                x.style.display = 'block';
            } else {
                x.style.display = 'none';
            }
            a = v;
            return true;
        }
    </script>
</head>

<body>
    <form method="GET" name="frmpost" action="">
        <h4><a href="relatorio.php">Seminário Internacional de Mediação Cultural</a></h4>
        <?php
        $s = '';
        $txt = '';
        $seq = ' order by nome asc';
        $o = 'asc';

        if (isset($_GET['order'])) {
            if ($_GET['order'] == 'asc') {
                $o = 'desc';
            } else {
                $o = 'asc';
            }
        }


        if (isset($_GET['seq'])) {
            $seq = " order by $_GET[seq] $o ";
        } else {
            $seq = " order by nome $o ";
        }

        if (isset($_GET['n'])) {
            $o = $_GET['order'];
            $seq = $_GET['seq'];
        }


        if (isset($_GET['txtsearch'])) {
            $txt = $_GET['txtsearch'];
            $s = " and (nome like '%" . $txt . "%' or email like '%" . $txt . "%')";
        }
        ?>
        <div>Procurar: <input type="text" name="txtsearch" value="<?= $txt ?>"> <button type="submit">Buscar</button></div>
        <?php
        try {

            $Conexao    = Conexao::getConnection();
            $query      = $Conexao->query("select count(*) total from inscricao_seminario where 1=1 $s");
            $objrs   = $query->fetchAll();
        } catch (Exception $e) {

            echo $e->getMessage();
            exit;
        }

        $total = 0;
        $tpage = 0;

        $total = $objrs[0]['total'];

        if (!empty($objrs[0]['total'])) {
            echo "<div style='padding-bottom: 10px;'>Total de alunos: " . $total . "</div><div><a href='#'><</a> ";
        }

        // Operador ternário
        $total % 100 ? $tpage = $total / 100 + 1 : $tpage / 100;

        for ($i = 1; $i <= $tpage; $i++) {
            $b = '';
            if (isset($_GET['page'])) {
                if ($_GET['page'] == $i) {
                    $b = "style='font-weight: bold;'";
                }
            }
            echo " <a $b href='?seq=$seq&order=$o&page=$i&txtsearch=$txt&n=1'>$i</a> ";
        }

        if (!empty($objrs[0]['total'])) {
            echo " <a href='#'>></a></div>";
        }

        $p = 'OFFSET 0 ROWS FETCH NEXT 100 ROWS ONLY';
        $n = 0;

        if (isset($_GET['page'])) {
            $n = ($_GET['page'] - 1) * 100;
            $p = " OFFSET $n ROWS FETCH NEXT 100 ROWS ONLY";
        }
        ?>
        <table>
            <tr>
                <td>
                    <div class="btable"></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=nome&order=<?= $o ?>&txtsearch=<?= $txt ?>">Nome</a></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=data_nascimento&order=<?= $o ?>&txtsearch=<?= $txt ?>">Data de nascimento</a></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=email&order=<?= $o ?>&txtsearch=<?= $txt ?>">Email</a></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=CPF&order=<?= $o ?>&txtsearch=<?= $txt ?>">CPF</a></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=id&order=<?= $o ?>&txtsearch=<?= $txt ?>">ID</a></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=telefone&order=<?= $o ?>&txtsearch=<?= $txt ?>">Telefone</a></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=endereco&order=<?= $o ?>&txtsearch=<?= $txt ?>">Endereço</a></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=cep&order=<?= $o ?>&txtsearch=<?= $txt ?>">Cep</a></div>
                </td>
                <td>
                    <div class="btable"><a href="?seq=data_registro&order=<?= $o ?>&txtsearch=<?= $txt ?>">Registro</a></div>
                </td>
                
            </tr>
            <?php
            try {
                //echo "select CPF, data_registro, id_pessoa, MATRICULA, TEL_CONTATO, LTRIM(nome_pessoa) nome, LTRIM(nome_pessoa) email from BPSPESSOASWEB_PESSOAS where 1=1 $s $seq $p";
                //echo "<br>";
                $query = $Conexao->query("select CPF, CONVERT(VARCHAR(10), data_registro, 103) + ' ' + CONVERT(VARCHAR(8), data_registro, 108) as data_registro1, id, endereco, telefone, LTRIM(nome) nome, LTRIM(email) email, nome_artistico, data_nascimento, nacionalidade, naturalidade, endereco, complemento, bairro, cep, estado, vinculo_institucional, descricao_vinculo from inscricao_seminario where 1=1 $s $seq $p");

                $objrs = $query->fetchAll();
            } catch (Exception $e) {

                echo $e->getMessage();
                exit;
            }

            $i = $n + 1;

            foreach ($objrs as $ors) {
            ?>
                <tr>
                    <td style='cursor: pointer;' onclick="displayLineInfo(<?= $i+1; ?>)"><?= $i++; ?></td>
                    <td>
                        <?php echo $ors['nome']; ?>
                        <div id="vline<?= $i; ?>" style="display: none; position: absolute;border: 1px solid #000000; background-color: #ffffff; padding: 5px;">aaaaaaaaa</div>
                    </td>
                    <td><?php echo $ors['data_nascimento']; ?></td>
                    <td><?php echo $ors['email']; ?></td>
                    <td><?php echo $ors['CPF']; ?></td>
                    <td><?php echo $ors['id']; ?></td>
                    <td><?php echo $ors['telefone']; ?></td>
                    <td><?php echo $ors['endereco']; ?></td>
                    <td><?php echo $ors['cep']; ?></td>
                    <td><?php echo $ors['data_registro1']; ?></td>
                </tr>
                
            <?php
            }
            ?>
        </table>
    </form>
</body>

</html>