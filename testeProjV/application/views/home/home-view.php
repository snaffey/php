<?php if($this->msg != null): ?>
    <div class="msgs">
        <p><small style="color:<?php echo ($this->msg[1] == 'success') ? 'green' : 'red';?>;"><?php echo $this->msg[0]; ?></small></p>
    </div>
<?php endif; ?>
<p style="text-align: center; font-size: 40px; margin-bottom: 30px;">Eventos</p>
<div class="filter">
        <form action="" method="get">
            <div class="grid">
                <?php if ($this->superAdm): ?>
                    <div>
                        <select name="assocId" onchange="this.parentNode.parentNode.parentNode.submit();">
                            <option value="">Associacao</option>
                            <?php echo $assocOptions ?? '' ?>
                        </select>
                    </div>
                <?php endif; ?>
                <div>
                    <label for="">Data começo: <input placeholder="Data Começo" type="date" name="dateS" onchange="this.parentNode.parentNode.parentNode.parentNode.submit();" value="<?php echo $dataStart ?? ''; ?>"></label>
                    <label for="">Data fim: <input type="date" name="dateF" onchange="this.parentNode.parentNode.parentNode.parentNode.submit();" value="<?php echo $dataEnd ?? ''; ?>"></label>
                </div>
            </div>
        </form>
</div>
<div class="event-grid">
    <?php echo $eventosHTML ?? ''; ?>
</div>
