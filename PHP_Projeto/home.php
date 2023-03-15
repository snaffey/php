<?php include_once './lib/calls.php'; ?>
<?php include_once './lib/Iterator/List.php'; ?>
<?php include_once './lib/Iterator/Loop.php'; ?>
<section class="section-banner">
      <h1>Fast cars only for you</h1>
    </section>
    <section class="section-destaque">
    <div class="slick-slider" id="carousel1">
    <?php $iterator = new ArticleIterator($destaque); ?> 
    <?php foreach ($iterator as $row): ?>
      <div>
        <a href="ver.php?id=<?= $row['ID'] ?>">
          <img src="<?= $row['Img'] ?>" alt="<?= $row['AltImg'] ?>">
        </a>
      </div>
    <?php endforeach ?>
    </div>
    </section>
    <main class="Artigos">
      <!-- Usar iterator loop e looplist para mostrar artigos -->
      <?php $iterator = new ArticleIterator($artigo_list); ?>
      <?php $loop = new Loop(); ?>
      <?php $loop->loopList($iterator); ?>
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