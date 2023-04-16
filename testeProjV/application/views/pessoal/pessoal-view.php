<div id="clonar-form" title="Clonar Evento">
    <form id="clonar" method="post" enctype="multipart/form-data" action="<?php echo HOME_URI ;?>evento/clonar">
        <input type="hidden" name="eventoId" id="eventoId">
        <label for="assocs">Associação:</label><br>
        <select name="associacaoId" id="assocs">
            <option value="None">Selecione uma associação</option>
            <?php echo $options ?? '' ?>
        </select>
    </form>
</div>
<div class="main">
    <?php if($this->msg != null): ?>
        <div class="msgs">
            <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
        </div>
    <?php endif; ?>
    <div class="grid">
        <div class="col">
            <ul id="menu">
                <li>Conta</li>
                <li>Quotas</li>
                <?php if (!$this->adm): ?>
                    <li>Eventos que participou</li>
                    <li>Noticias que gostou</li>
                <?php else: ?>
                    <?php if ($this->superAdm): ?>
                        <li>Socios</li>
                    <?php endif; ?>
                    <li>Noticias</li>
                    <li>Eventos Ativos</li>
                <?php endif; ?>
            </ul>
        </div>
        <div class="line"></div>
        <div class="col">
            <article id="conta">
                <p>Conta</p>
                <form action="<?php echo HOME_URI;?>pessoal/edit/username" method="post">
                    <label for="">Username:</label><br />
                    <input type="text" name="username" placeholder="Username" value="<?php echo $this->userInfo->username ?? "" ?>">
                    <input type="submit" value="Guardar">
                </form>
                <form action="<?php echo HOME_URI;?>pessoal/edit/nome" method="post">
                    <label for="">Nome:</label><br />
                    <input type="text" name="nome" placeholder="Name" value="<?php echo $this->userInfo->nome ?? "" ?>">
                    <input type="submit" value="Guardar">
                </form>
                <form action="<?php echo HOME_URI;?>pessoal/edit/email" method="post">
                    <label for="">Email:</label><br />
                    <input type="text" name="email" placeholder="Email" value="<?php echo $this->userInfo->email ?? "" ?>">
                    <input type="submit" value="Guardar">
                </form>
                <form action="<?php echo HOME_URI;?>pessoal/edit/password" method="post">
                    <div class="grid">
                        <div>
                            <label for="">Password Antiga:</label><br />
                            <input type="password" name="oldPassword" placeholder="Password Antiga"><br />
                            <label for="">Nova password:</label><br />
                            <input type="password" name="password" placeholder="Nova Password">
                        </div>
                        <div class="col-btn">
                            <input type="submit" value="Guardar">
                        </div>
                    </div>
                </form>
            </article>
            <article id="noticias">
                <?php if (!$this->adm): ?>
                    <p>Noticias que gostou</p>
                <?php else: ?>
                    <p>Noticias</p>
                <?php endif; ?>
                <div id="acordionNoticias">
                    <?php echo $noticiasHTML; ?>
                </div>
                <?php if ($noticiasPaginator->show):?>
                    <div class="eventos-controls controls grid">
                        <?php if ($noticiasPaginator->hasPreviousPage): ?>
                            <div>
                                <form action="#noticias">
                                    <input type="hidden" name="page" value="<?php echo $noticiasPaginator->pageNum - 1; ?>">
                                    <i class="fas fa-arrow-circle-left"></i>
                                </form>
                            </div>
                        <?php endif; ?>
                        <div>
                            <span><small>Pagina: <?php echo $noticiasPaginator->pageNum; ?></small></span>
                        </div>
                        <?php if ($noticiasPaginator->hasNextPage): ?>
                            <div>
                                <form action="#noticias">
                                    <input type="hidden" name="page" value="<?php echo $noticiasPaginator->pageNum + 1; ?>">
                                    <i class="fas fa-arrow-circle-right"></i>
                                </form>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </article>
            <article id="quotas">
                <p>Quotas</p>
                <?php echo $quotasHTML; ?>
                <?php if (!$this->superAdm): ?>
                    <?php if ($quotasPaginator->show): ?>
                        <div class="controls grid">
                            <?php if ($quotasPaginator->hasPreviousPage): ?>
                                <div>
                                    <form action="#quotas">
                                        <input type="hidden" name="page" value="<?php echo $quotasPaginator->pageNum - 1; ?>">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <div>
                                <span><small>Pagina: <?php echo $quotasPaginator->pageNum; ?></small></span>
                            </div>
                            <?php if ($quotasPaginator->hasNextPage): ?>
                                <div>
                                    <form action="#quotas">
                                        <input type="hidden" name="page" value="<?php echo $quotasPaginator->pageNum + 1; ?>">
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </article>
            <article id="eventos">
                <?php if (!$this->adm): ?>
                    <p>Eventos que participou</p>
                <?php else: ?>
                    <p>Eventos Ativos</p>
                <?php endif; ?>
                <?php if ($this->superAdm): ?>
                    <div id="acordion-eventos">
                <?php endif; ?>
                        <?php echo $eventosHTML; ?>
                <?php if ($this->superAdm): ?>
                    </div>
                <?php endif; ?>
                <?php if (!$this->superAdm):?>
                    <?php if ($eventosPaginator->show): ?>
                        <div class="eventos-controls controls grid">
                            <?php if ($eventosPaginator->hasPreviousPage): ?>
                                <div>
                                    <form action="#eventos">
                                        <input type="hidden" name="page" value="<?php echo $eventosPaginator->pageNum - 1; ?>">
                                        <i class="fas fa-arrow-circle-left"></i>
                                    </form>
                                </div>
                            <?php endif; ?>
                            <div>
                                <span><small>Pagina: <?php echo $eventosPaginator->pageNum; ?></small></span>
                            </div>
                            <?php if ($eventosPaginator->hasNextPage): ?>
                                <div>
                                    <form action="#eventos">
                                        <input type="hidden" name="page" value="<?php echo $eventosPaginator->pageNum + 1; ?>">
                                        <i class="fas fa-arrow-circle-right"></i>
                                    </form>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif;?>
            </article>
            <?php if ($superAdm): ?>
                <article id="socios" style="height: 100%">
                    <p>Socios</p>
                    <div id="acordion-socios">
                        <?php echo $sociosHTML ?>
                    </div>
                </article>
            <?php //else: ?>
            <?php endif; ?>
        </div>
    </div>
</div>