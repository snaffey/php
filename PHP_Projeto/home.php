<?php include_once './lib/calls.php'; ?>
<section class="section-banner">
      <h1>Fast cars only for you</h1>
    </section>
    <section class="section-destaque">
    <div class="slick-slider" id="carousel1">
    <?php foreach ($destaque as $row): ?>
      <div>
        <a href="ver.php?id=<?= $row['ID'] ?>">
          <img src="<?= $row['Img'] ?>" alt="<?= $row['AltImg'] ?>">
        </a>
      </div>
    <?php endforeach ?>
    </div>
    </section>
    <?php $lista = $artigo_list; ?>
    <main class="Artigos">
      <?php foreach ($lista as $data): ?>
      <article>
        <img src="<?=$data['Img']?>" alt="<?=$data['AltImg']?>"> <!-- show image from database -->
        <h2><?=$data['Nome']?></h2>
        <h2 class="desc" ><?=$data['Descrição']?></h2> <!-- show description from database -->
        <a href="ver.php?id=<?=$data['ID']?>" class="btn">More Info</a> <!-- show more info from database -->
      </article>
      <?php endforeach; ?>
    </main>
    <script type="text/javascript">
      $('#carousel1').slick({
        dots: true,
        arrows: false,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        slidesToScroll: 1,
        autoplay: true,
        adaptiveHeight: true,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                    infinite: true,
                    dots: true,
                },
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 2,
                },
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1,
                },
            },
        ],
    });
    </script>