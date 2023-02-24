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
    <?php $lista = get_imoveis_list(); ?>
    <main class="imoveis">
      <?php foreach ($lista as $data): ?>
      <article>
        <img src="<?=$data['imgPath']?>" alt="<?=$data['altimg']?>">
        <h2><?=$data['descricao']?></h2>
        <a href="ver.php?id=<?=$data['id']?>" class="btn">More Info</a>
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
