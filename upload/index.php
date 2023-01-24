<html>
    <head>
        <title>Upload</title>
        <link rel="stylesheet" href="estilo.css">
    </head>
    <body>
        <div class="div-form">
            <h1>Formulario de Upload</h1>
        <form action="upload.php" method="post" enctype="multipart/form-data">
            <fieldset>
                <p>
                    <label for="enviar arquivo">Enviar arquivo:</label>
                </p>
                    <input type="file" name="arquivo" />
                    <input type="submit" value="Enviar" name="enviar" />
            </fieldset>
        </form>
    </body>
</html>