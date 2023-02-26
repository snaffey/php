<!DOCTYPE html>
<html>
  <head>
    <meta charset="UTF-8">
    <title>Home Page</title>
    <link rel="stylesheet" href="./css/style.css">
    <script src="<https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js>"></script>
    <script src="./js/home.js"></script>
  </head>
  <body>
    <header class="header">
      <img src="./img/logo.webp" alt="Logo">
      <nav class="menu">
        <a href="#">Home</a>
        <a href="#">Contact</a>
        <div class="admin">
          <a href="admin.php">
            <img src="./img/admin.png" alt="Login">
          </a>
        </div>
      </nav>
    </header>
    <section class="section-banner">
      <h1>Find Your Dream Home</h1>
    </section>
    <?php include_once './functionDB.php'; ?>
    <?php $lista = get_artigos_list(); ?>
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
    <footer>
      <div class="footer-bottom">
        <p>&copy; 2021 Tiago</p>
      </div>
    </footer>
  </body>
</html>
