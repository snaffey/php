

            <section class="location_banner">
                <h1>Melhores casas e apartamentos em um só lugar</h1>
            </section>
            

        <?php
            include_once './functiondb.php';
        ?>

        <?php
            $lista = get_imoveis_list();         
        ?>
        <main class="imoveis">
            <?php foreach ($lista as $data) : ?>
                <article>
                    <img src=<?php echo $data['imgPath'] ?> alt=<?php echo $data['altimg'] ?> />
                    <h2><? echo $data['descricao'] ?></h2>
                    <a href="ver.php?id=<?php echo $data['id'] ?>">Ver mais</a>
                </article>
            <?php endforeach; ?>
        </main>