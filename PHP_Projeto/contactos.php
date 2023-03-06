<?php include_once './lib/calls.php'; ?>
<section class="contact">
    <div class="contact-form">
        <h1>Contactos</h1>
        <form action="contactos.php" method="post">
            <input type="text" name="nome" placeholder="Nome" required>
            <input type="email" name="email" placeholder="Email" required>
            <input type="text" name="assunto" placeholder="Assunto" required>
            <textarea name="mensagem" placeholder="Mensagem" required></textarea>
            <button type="submit" name="submit">Enviar</button>
        </form>
    </div>
</section>