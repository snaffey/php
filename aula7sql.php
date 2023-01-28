<html>
    <head>
        <title>Aula 7 SQL</title>
    </head>
    <body>
         <?php
            /*
            Cria uma conexão com o servidor referenciando no 1 argumento, segundo argumento user que tem que estar registado no servidor referido, bem como a pass(3 argumento) referente ao user, o ultimo referencia a BD
            mysqli_connect(domain, user, pass, db)
            */
            $conexao = mysqli_connect('localhost','root','','teste');

            mysqli_select_db($conexao, 'teste');

            $consulta = 'SELECT id, nome, dataNasc FROM Aluno';

            // mysqli_query() executa a query

            if ($resultado = mysqli_query($conexao, $consulta)) {
                //mysqli_num_rows() conta o numero de linhas
                $numLinhas = mysqli_num_rows($resultado);
                echo "Numero de linhas: $numLinhas <br>";
                //mysqli_fetch_row() retorna um array com os dados da linha
                while ($linha = mysqli_fetch_row($resultado)) {
                    echo "ID: $linha[0] - Nome: $linha[1] - Data de Nascimento: $linha[2] <br>";
                }
            }

            echo "Conexão: ".mysqli_get_host_info ($conexao)."<br>";
            echo "Versão do servidor: ".mysqli_get_server_info ($conexao)."<br>";
         ?>
    </body>
</html>