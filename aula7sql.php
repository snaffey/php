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
            echo "Versão do servidor: ".mysqli_get_server_info ($conexao)."<br>"."<br>";

            // 2 consulta mais complexa
            $consulta = "SELECT id, nome FROM Aluno WHERE nome LIKE 'Ti%'";
            $resultado = mysqli_query($conexao, $consulta);
            echo "<div>Alunos com nome a começar por Ti<br>";
            while ($linha = mysqli_fetch_row($resultado)) {
                echo "ID: $linha[0] - Nome: $linha[1] <br>";
            }
            echo "</div>"."<br>";

            // Criar uma função para fazer a consulta
            // O argumento query vai conter a identificação e o resultado da query
            // o argumento $conexao é a conexão com a BD

            function executaQuery($conexao, &$query){
                echo "Executa atraves de uma função<br>Conexão: ".mysqli_get_host_info ($conexao)."<br>";
                echo "<div>Nome";
                while ($linha = mysqli_fetch_row($query)) {
                    echo "ID: $linha[0] - Nome: $linha[1] <br>";
                }
                echo "</div>";
            }
            $consulta = "SELECT id, nome FROM Aluno WHERE nome LIKE '%ago%'";
            $resultado = mysqli_query($conexao, $consulta);
            executaQuery($conexao, $resultado);
            echo "<br>";

            // Usando a destruição explicita die()
            // Caso devolva erro a conexão com o servidor é chamado
            //mysqli_connect('localhost','root','','teste') or die(mysql_error());

            $conn = mysqli_connect('localhost','tiago','123','teste') or die(mysql_error());
            if (!$conn) {
                die(mysql_error());
            }
            $consulta = "SELECT id, nome FROM Aluno WHERE nome LIKE '%ago%'";
            $resultado = mysqli_query($conn, $consulta);
            executaQuery($conn, $resultado);

         ?>
    </body>
</html>