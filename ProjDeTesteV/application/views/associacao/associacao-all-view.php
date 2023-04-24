<div class="main">
    <div class="title">
        <h1>Associações</h1>
    </div>
    <div class="filter">
        <form action="" method="get">
            <input type="text" name="q" onchange="fParentSubmit(this)" placeholder="Pesquise..." value="<?php echo $q ?? ''?>">
        </form>
    </div>
    <?php if($this->msg != null): ?>
        <div class="msgs">
            <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
        </div>
    <?php endif; ?>
    <div class="socio-grid">
        <?php echo $assocs; ?>
    </div>
</div>