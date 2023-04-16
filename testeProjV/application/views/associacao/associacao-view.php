<div class="main">
    <?php if($this->msg != null): ?>
        <div class="msgs">
            <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
        </div>
    <?php endif; ?>
    <div class="grid">
        <div>
            <div class="container">
                <?php if ($this->superAdm):?>
                    <div class="link">
                        <div class="text"><a href="<?php echo HOME_URI . 'associacao/editar/' . $assoc->id . "?next=$pagina".(($nextPage != null)?'?next='.$nextPage:""); ?>">Editar</a></div>
                    </div>
                    <div class="link">
                        <div class="text"><a href="#" onclick="confirma('<?php echo HOME_URI . 'associacao/apagar/' . $assoc->id . "?next=$pagina".(($nextPage != null)?'?next='.$nextPage:""); ?>')">Apagar</a></div>
                    </div>
                <?php endif; ?>
                <?php if ($adm): ?>
                    <div class="link">
                        <div class="text"><a href="<?php echo HOME_URI . 'register/' . $assoc->id . "?next=$pagina".(($nextPage != null)?'?next='.$nextPage:""); ?>">Add Socio</a></div>
                    </div>
                <?php endif; ?>
                <?php if ($gerirEventos): ?>
                    <div class="link">
                        <div class="text"><a href="<?php echo HOME_URI . 'evento/criar' . "?next=$pagina".(($nextPage != null)?'?next='.$nextPage:""); ?>">Add Evento</a></div>
                    </div>
                <?php endif; ?>
                <?php if ($gerirNoticias): ?>
                    <div class="link">
                        <div class="text"><a href="<?php echo HOME_URI . 'noticia/criar' . "?next=$pagina".(($nextPage != null)?'?next='.$nextPage:""); ?>">Add noticia</a></div>
                    </div>
                <?php endif; ?>
                <div class="link">
                    <div class="text"><a href="<?php echo HOME_URI . 'noticia/all/' . $assoc->id; ?>">Ver noticias</a></div>
                </div>
                <div class="link">
                    <div class="text"><a href="<?php echo HOME_URI . '?assocId=' . $assoc->id; ?>">Ver Eventos</a></div>
                </div>
            </div>
        </div>
        <div>
            <div class="grid">
                <div class="col">
                    <div>
                        <div class="img">
                            <img src="" alt="" id="img-assoc">
                        </div>
                        <div class="controls">
                            <div class="grid">
                                <div class="col">
                                    <i class="fas fa-arrow-circle-left" onclick="galeria(true)"></i>
                                </div>
                                <div class="col">
                                    <i class="fas fa-arrow-circle-right" onclick="galeria()"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div>
                        <h1><?php echo $assoc->nome; ?></h1>
                        <p>Telefone: <?php echo $assoc->telefone; ?></p>
                        <p>Morada: <?php echo $assoc->morada; ?></p>
                        <p>Nº de contribuinte: <?php echo $assoc->nContribuinte; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="title">
        <h1>Socios</h1>
    </div>
    <div class="socio-grid">
        <?php echo $socios; ?>
    </div>
</div>