<?php
/*
FILE_USE_INCLUDE_PATH - Procura o arquivo em todos os diretórios do include_path
FILE_IGNORE_NEW_LINES - Não acrescentar a quebra de linha no final de cada elemento do array
FILE_SKIP_EMPTY_LINES - Não acrescentar linhas vazias no array
FILE_TEXT - O arquivo é retornado na codificação UTF-8.
FILE_BINARY - O arquivo é retornado na codificação binária. Não pode ser usada com FILE_TEXT
*/
// file metodo que manipula ficheiros, return array
    /*
    $lines = file('https://www.google.com');
    foreach ($lines as $line_num => $line) {
        echo "Linha #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
    }*/

    /*
    $html = implode ('',file(
        'https://www.epcc.pt/'
    ));
    echo $html;*/

    /*
    $site = file('https://www.epcc.pt/',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($site as $line_num => $line) {
        echo "Linha #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
    }*/

    /*
    $site = file('arquivo.txt',FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($site as $line_num => $line) {
        echo "Linha #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
    }*/

    // file_exists - verifica se o ficheiro existe
    /*
    $filename = './arquivos/arquivo.txt';
    if (file_exists($filename)) {
       $site = file($filename,FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
         foreach ($site as $line_num => $line) {
              echo "Linha #<b>{$line_num}</b> : " . htmlspecialchars($line) . "<br />\n";
         }
    } else {
        echo "O ficheiro $filename não existe";
    }*/

    /*
    fopen- Abre um arquivo ou URL (Se não existir cria um novo)
    Mode: 
    'r' - Abre para leitura; coloca o ponteiro do arquivo no começo do arquivo.
    'r+' - Abre para leitura e escrita; coloca o ponteiro do arquivo no começo do arquivo.
    'w' - Abre para escrita somente; coloca o ponteiro do arquivo no começo do arquivo e reduz o comprimento do arquivo para zero. Se o arquivo não existir, tenta criá-lo.
    'b' - Abre o arquivo em modo binário.   
     */

     /*
     $handle = fopen($filename, 'r');
     echo $handle;*/

     /*
     $srcImg = "C:\Users\Tiago\Documents\php\arquivos\cat.jpg";
     if (!$handle = fopen($srcImg, 'rb')) {
         echo "Não foi possível abrir o arquivo ($srcImg)";
         exit;
     }else{
        echo filesize($srcImg);
        $conteudo = fread($handle, filesize($srcImg));
        echo $conteudo;
        fclose($handle);
     }*/

     /*
     $filename = 'https://www.epcc.pt/';
     if (!$handle = file_get_contents($filename)) {
        echo "Não foi possível abrir o arquivo ($filename)";
        exit;
     }else
        echo $handle; 
     fclose($handle);*/

    /*
    $srcImg = "C:\Users\Tiago\Documents\php\arquivos\arquivo.txt";
    $conteudo = "\n\n\n Tiago via code \n";
    if(file_exists($srcImg)) {
        if(is_writable($srcImg)){
            if(!$handle = fopen($srcImg, 'a')){
                echo "Não foi possível abrir o arquivo ($srcImg)";
                exit;
            }
            if(fwrite($handle, $conteudo) === FALSE){
                echo "Não foi possível escrever no arquivo ($srcImg)";
                exit;
            }
            echo "Sucesso: Escrito ($conteudo) no arquivo ($srcImg)";
            fclose($handle);
        }else{
            echo "O ficheiro $srcImg não é gravável";
        }
    }else
        echo "O ficheiro $srcImg não existe";
    */

    // Exemplo de contador de visitas
    $filename = 'C:\Users\Tiago\Documents\php\arquivos\count.txt';
    $abir = fopen($filename, 'r');
    $total = fread($abir, filesize($filename));
    fclose($abir);
    $abir = fopen($filename, 'w');
    $total++;
    $guardar = fwrite($abir, $total);
    fclose($abir);
    echo "Total de visitas: $total";
?>

<html>
    <head>
        <title>Aula 4</title>
    </head>
    <body>

    </body>
</html>